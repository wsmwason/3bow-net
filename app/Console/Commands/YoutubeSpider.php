<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Alaouy\Youtube\Youtube;
use TrafficBow\SearchKeyword;
use TrafficBow\ExcludeKeyword;
use TrafficBow\Video;

class YoutubeSpider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:spider {--rows=3} {--days=2}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse YouTube keywords and save 3bow videos';

    protected $youtube;

    /**
     * 排除關鍵字
     *
     * @var array
     */
    protected $excludeKeywords = [];

    public function __construct()
    {
        parent::__construct();
        $this->youtube =  new Youtube(config('youtube.api_key'));

        $excludeKeywords = ExcludeKeyword::all();
        foreach ($excludeKeywords as $excludeKeyword) {
            $this->excludeKeywords[] = $excludeKeyword->keyword;
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $searchKeywords = SearchKeyword::all();
        foreach ($searchKeywords as $searchKeyword) {
            $this->findKeywords($searchKeyword->keyword);
        }
    }

    protected function findKeywords($keyword)
    {
        $this->info($keyword);
        $rows = $this->option('rows');
        $days = $this->option('days');
        $videoList = $this->youtube->searchAdvanced([
            'q' => $keyword,
            'type' => 'video',
            'part' => 'id,snippet',
            'maxResults' => $rows,
            'publishedAfter' => date('Y-m-d', strtotime('-' . $days . 'days')) . 'T00:00:00Z',
        ]);

        if (is_array($videoList)) {
            foreach ($videoList as $video){
                $this->checkVideo($video);
            }
        }
    }

    protected function checkVideo($video)
    {
        $this->comment($video->id->videoId . ':' . $video->snippet->title);

        $count = Video::withTrashed()->where('source_id', $video->id->videoId)->count();
        if ($count > 0) {
            $this->comment('  exists');
            return;
        }

        $videoInfo = $this->youtube->getVideoInfo($video->id->videoId);

        // 排除特定關鍵字
        $allText = $videoInfo->snippet->title . $videoInfo->snippet->description;
        foreach ($this->excludeKeywords as $keyword) {
            if (strpos($allText, $keyword)!==false) {
                $this->comment('  exclude keyword ' . $keyword);
                return;
            }
        }

        Video::create([
          'source_site' => Video::SOURCE_SITE_YOUTUBE,
          'source_id' => $video->id->videoId,
          'title' => $this->getTitle($videoInfo),
          'description' => $videoInfo->snippet->description,
          'illegal' => $this->getIllegal($videoInfo),
          'license_plate' => $this->getLicensePlate($videoInfo),
          'year' => substr($videoInfo->snippet->publishedAt, 0, 4),
        ]);

        $this->comment('  ' . $video->id->videoId . ' saved');
    }

    protected function getLicensePlate($videoInfo)
    {
        $licensePlate = '';

        $allText = $videoInfo->snippet->title . $videoInfo->snippet->description;
        if (preg_match('#[A-Z0-9]{2,3}-[\d]{4}#', $allText, $matchPlate)) {
            return $matchPlate[0];
        }

        if (preg_match('#[\d]{3,4}-[A-Z]{2}#', $allText, $matchPlate)) {
            return $matchPlate[0];
        }

        return $licensePlate;
    }

    protected function getTitle($videoInfo)
    {
        $title = $videoInfo->snippet->title;
        $title = preg_replace('#20\d+年\d+月#', '', $title);
        $title = preg_replace('#20\d+年\d+月\d+日#', '', $title);
        $title = preg_replace('#\d+月\d+日#', '', $title);
        $title = preg_replace('#20[\.\d\/]+#', '', $title);
        $title = str_replace('行車記錄器', '', $title);
        $title = str_replace('行車記錄', '', $title);
        $title = str_replace('行車紀錄器', '', $title);
        $title = str_replace('行車紀錄', '', $title);
        $title = preg_replace('#『(.*?)』#u', '', $title);
        $title = preg_replace('#\[(.*?)\]#', '', $title);
        $title = preg_replace('#^-#', '', $title);
        $title = preg_replace('#^_#', '', $title);
        $title = trim($title);
        return $title;
    }

    protected function getIllegal($videoInfo)
    {
        $illegalTypes = Video::illegalTypes();
        $illegal = [];
        if (isset($videoInfo->snippet->tags)) {
            foreach ($videoInfo->snippet->tags as $tag) {
                $illegal[] = $tag;
            }
        }

        $allText = $videoInfo->snippet->title . $videoInfo->snippet->description;
        foreach ($illegalTypes as $type) {
            if (strpos($allText, $type)!==false) {
                $illegal[] = $type;
            }
        }

        return join(',', $illegal);
    }

}
