<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsCreateRequest;
use Illuminate\Http\Request;
use TrafficBow\News;
use TrafficBow\Video;

class NewsController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * 發表新聞
     */
    public function create()
    {
        return view('news.news_create');
    }

    /**
     * 顯示新聞
     */
    public function show($id)
    {
        $news = News::find($id);
        if (!$news) {
            return redirect()->route('welcome.index');
        }

        $this->setPageTitle($news->title);
        $this->setPageOgTitle($news->title);
        $this->setPageOgDescription($news->description);

        // 取相關影片
        $videos = Video::orderBy('id', 'DESC')->take(6)->get();

        $data = [
            'news' => $news,
            'videos' => $videos,
        ];
        return view('news.news_show', $data);
    }

    /**
     * 新聞清單
     */
    public function index($keyword = '')
    {
        if (!empty($keyword)) {
            $videos = Video::whereRaw("(title LIKE '%{$keyword}%' OR description LIKE '%{$keyword}%' OR illegal LIKE '%{$keyword}%')")->orderBy('id', 'DESC')->paginate(8);
            $this->setPageNavKeyword($keyword);
            $this->setPageTitle([$keyword]);
        } else {
            $videos = Video::orderBy('id', 'DESC')->paginate(8);
        }

        $data = [
            'videos' => $videos,
        ];
        return view('videos.videos_index', $data);
    }

    /**
     * 儲存新聞
     */
    public function store(NewsCreateRequest $request)
    {
        $news = News::create([
            'user_id' => \Auth::id(),
            'title' => $request->get('title'),
            'author' => $request->get('author'),
            'source_url' => $request->get('source_url'),
            'description' => $request->get('description'),
        ]);

        return redirect()->route('news.show', $news->id);
    }

    /**
     * 更新新聞
     */
    public function update(NewsCreateRequest $request, $id)
    {
        $news = News::find($id);
        $news->title = $request->get('title');
        $news->author = $request->get('author');
        $news->source_url = $request->get('source_url');
        $news->description = $request->get('description');
        $news->save();
        return redirect()->route('news.show', $news->id);
    }

    /**
     * 編輯新聞
     */
    public function edit($id)
    {
        $news = News::find($id);
        if ($news->userId!=\Auth::id() && !\Auth::user()->is_admin) {
            return redirect()->route('news.create');
        }

        $data = [
            'news' => $news,
            'edit' => true,
        ];
        return view('news.news_create', $data);
    }

    /**
     * 刪除新聞
     */
    public function destroy($id)
    {
        $news = News::find($id);
        if ($news->userId==\Auth::id() || \Auth::user()->is_admin) {
            $news->delete();
        }
        return redirect()->route('welcome.index');
    }

    /**
     * 自動取得新聞內文
     */
    public function ajaxGetNewsContent(Request $request)
    {
        $newsParser = new \wsmwason\TaiwanNewsParser\TaiwanNewsParser();
        try{
            $newsEntry = $newsParser->parseUrl($request->get('url'));
            return response()->json([
                'status' => 1,
                'title' => $newsEntry->getTitle(),
                'reporter' => $newsEntry->getReporterName(),
                'content' => $newsEntry->getContent(),
            ]);
        } catch(Exception $ex){
            return response()->json(['status' => -1]);
        }
    }

}
