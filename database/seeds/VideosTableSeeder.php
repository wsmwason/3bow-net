<?php

use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TrafficBow\Video::truncate();
        TrafficBow\Video::create([
          'user_id' => 1,
          'source_site' => 'YouTube',
          'source_id' => '4Kh0oYx4Vcw',
          'title' => '2015台灣十大三寶',
          'description' => '台灣到處都有三寶出沒，在這裡我們挑出了台灣前十大離譜的三寶行為，希望可以給大家一­個警戒。
台灣開車或騎車的人口遠遠大於其他國家，平時路上總會有三寶出沒，即使再怎麼注意交通­，都容易出事，簡直是魔咒。
再者，如果發現身邊的親朋好友，有這些行車行為，請加以阻止，保護他人也愛護自己。',
          'illegal' => '並排,闖紅燈',
          'license_plate' => 'ABC-1234',
          'place' => '台北市',
          'year' => date('Y'),
        ]);
    }
}
