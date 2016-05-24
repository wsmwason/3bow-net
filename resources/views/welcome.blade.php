@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> 今日最寶</div>
                <div class="panel-body">
                    <div class="media">
                        <div class="media-left">
                            <a href="/videos/{{ $topVideo->id }}">
                                <img class="media-object" style="width:300px;" src="https://i.ytimg.com/vi/{{ $topVideo->source_id }}/hqdefault.jpg" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="/videos/{{ $topVideo->id }}">{{ $topVideo->title }}</a></h4>
                            <p style="max-height:100px;overflow: hidden">{{ $topVideo->description }}</p>

                            <p class="text-warning">
                                三寶指數
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </p>
                            <p>來源：{{ Html::link($topVideo->getVideoUrl(), 'YouTube', ['target' => '_blank']) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fa fa-info-circle" aria-hidden="true"></i> 交通要聞</div>
                <div class="panel-body">
                    <ul class="list-inline">
                        @foreach ($newsList as $news)
                        <li><i class="fa fa-rss" aria-hidden="true"></i> <a href="/news/{{ $news->id }}">{{ $news->title }}</a></li>
                        @endforeach
                      </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        @foreach ($allNewVideos as $video)
        <div class="col-md-3">
            @include ('videos.videos_thumbnail')
        </div>
        @endforeach

    </div>

    <div class="row">
        <p class="text-center"><a class="btn btn-primary btn-lg" href="/videos?page=2" role="button">看更多三寶</a></p>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="dba_a">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-3786120897915304"
                     data-ad-slot="5045702627"
                     data-ad-format="auto"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="fb-page" data-href="https://www.facebook.com/%E9%A6%AC%E8%B7%AF%E4%B8%89%E5%AF%B6%E7%84%A1%E6%AD%A2%E5%A2%83-234508873409521/timeline" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
        </div>
        <div class="col-md-4">
            <div class="fb-page" data-href="https://www.facebook.com/%E9%A6%AC%E8%B7%AF%E4%B8%89%E5%AF%B6%E5%BD%B1%E7%89%87%E5%8D%80-1090227511029121/timeline" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
        </div>
        <div class="col-md-4">
            <div class="fb-page" data-href="https://www.facebook.com/%E9%A6%AC%E8%B7%AF%E4%B8%89%E5%AF%B6%E5%8E%BB%E9%A7%9B%E5%8E%BB%E6%AD%BB%E5%9C%98-145705762301710/timeline" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
        </div>
    </div>

@endsection
