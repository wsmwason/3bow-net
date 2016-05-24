<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Http\Requests\VideoCreateRequest;
use TrafficBow\Video;

class VideosController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * 發表影片
     */
    public function create()
    {
        $data = [
            'illegalTypes' => Video::illegalTypes(),
            'places' => Video::places(),
            'edit' => false,
        ];
        return view('videos.videos_post', $data);
    }

    /**
     * 顯示影片
     */
    public function show($id)
    {
        $video = Video::find($id);
        if (!$video) {
            return redirect()->route('videos.index');
        }

        $video->increment('click_times');
        $this->setPageTitle($video->license_plate.$video->title);
        $this->setPageOgTitle($video->license_plate.$video->title);
        $this->setPageOgImage($video->getVideoThumbnail());
        $this->setPageOgDescription($video->description);

        // order by rand
        $relatedVideos = Video::orderByRaw('RAND()')->take(1)->get();

        $data = [
            'video' => $video,
            'relatedVideos' => $relatedVideos,
        ];
        return view('videos.videos_show', $data);
    }

    /**
     * 影片清單
     */
    public function index($keyword = '')
    {
        if (!empty($keyword)) {
            $videos = Video::whereRaw("(title LIKE '%{$keyword}%' OR description LIKE '%{$keyword}%' OR illegal LIKE '%{$keyword}%')")->orderBy('id', 'DESC')->paginate(8);
            $this->setPageNavKeyword($keyword);
            $this->setPageTitle($keyword);
            $this->setPageDescription($keyword . '的馬路三寶影片');
        } else {
            $videos = Video::orderBy('id', 'DESC')->paginate(8);
            $this->setPageTitle('馬路三寶的影片');
            $this->setPageDescription('馬路三寶的影片');
        }

        $data = [
            'videos' => $videos,
        ];
        return view('videos.videos_index', $data);
    }

    /**
     * 儲存影片
     */
    public function store(VideoCreateRequest $request)
    {
        $videoId = $request->getVideoId();

        $illegal = $request->get('illegal');
        if ($request->get('illegal_other') ){
            $illegal[] = $request->get('illegal_other');
        }

        $video = Video::create([
            'source_site' => Video::SOURCE_SITE_YOUTUBE,
            'source_id' => $videoId,
            'user_id' => \Auth::id(),
            'title' => $request->get('title'),
            'illegal' => join(',', $illegal),
            'license_plate' => $request->get('license_plate'),
            'description' => $request->get('description'),
            'place' => $request->get('place'),
            'year' => $request->get('year'),
        ]);

        return redirect()->route('videos.show', $video->id);
    }

    /**
     * 更新影片
     */
    public function update(VideoCreateRequest $request, $id)
    {
        $illegal = $request->get('illegal');
        if ($request->get('illegal_other') ){
            $illegal[] = $request->get('illegal_other');
        }

        $video = Video::find($id);
        $video->title = $request->get('title');
        $video->illegal = join(',', $illegal);
        $video->license_plate = $request->get('license_plate');
        $video->description = $request->get('description');
        $video->place = $request->get('place');
        $video->year = $request->get('year');
        $video->save();

        return redirect()->route('videos.show', $video->id);
    }

    /**
     * 編輯影片
     */
    public function edit($id)
    {
        $video = Video::find($id);
        if ($video->userId!=\Auth::id() && !\Auth::user()->is_admin) {
            return redirect()->route('videos.create');
        }

        $video->video_url = $video->getVideoUrl();
        $video->formatForEdit();

        $data = [
            'video' => $video,
            'illegalTypes' => Video::illegalTypes(),
            'places' => Video::places(),
            'edit' => true,
        ];
        return view('videos.videos_post', $data);
    }

    /**
     * 刪除影片
     */
    public function destroy(Request $request, $id)
    {
        $video = Video::find($id);
        if ($video->userId==\Auth::id() || \Auth::user()->is_admin) {
            $video->deleted_user_id = \Auth::id();
            $video->save();
            $video->delete();
        }
        if ($request->isXmlHttpRequest()) {
            return response()->json(['status' => 1]);
        } else {
            return redirect()->route('videos.index');
        }
    }

}
