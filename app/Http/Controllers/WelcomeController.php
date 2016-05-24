<?php

namespace App\Http\Controllers;

use TrafficBow\Video;
use TrafficBow\News;

class WelcomeController extends Controller
{

    // index page
    public function index()
    {
        $this->setPageTitle('馬路三寶 - 揭開馬路三寶的神秘面紗');

        // get top 3bow video
        $topVideo = Video::find(1);
        $this->setPageOgDescription($topVideo->description);
        $this->setPageOgImage($topVideo->getVideoThumbnail());

        // list new videos
        $allNewVideos = Video::orderBy('id', 'DESC')->take(12)->get();

        // get top news
        $newsList = News::orderBy('id', 'DESC')->take(10)->get();

        $data = [
            'topVideo' => $topVideo,
            'allNewVideos' => $allNewVideos,
            'newsList' => $newsList,
        ];

        return view('welcome', $data);
    }

    // about us
    public function aboutUs()
    {
        return view('about_us.about_us');
    }

}
