@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $video->title }}</div>
                <div class="panel-body">
                    <iframe class="videos_show" width="100%" height="500" src="https://www.youtube.com/embed/{{ $video->source_id }}" frameborder="0" allowfullscreen></iframe>

                    @if ($video->description)
                        <blockquote>{!! nl2br(e($video->description)) !!}</blockquote>
                    @endif

                    <dl class="dl-horizontal">
                        @if ($video->getIllegalArray())
                        <dt>違規事項</dt>
                        <dd>
                            @foreach ($video->getIllegalArray() as $illegal)
                                <a href="{{ url('videos/tag', $illegal) }}" class="btn btn-danger btn-xs">{{ $illegal }}</a>
                            @endforeach
                        </dd>
                        @endif
                        @if ($video->license_plate)
                            <dt>車牌</dt>
                            <dd>{{ $video->license_plate }}</dd>
                        @endif
                        @if ($video->place)
                            <dt>事發地點</dt>
                            <dd>{{ $video->place }}</dd>
                        @endif
                        @if ($video->place)
                            <dt>事發年份</dt>
                            <dd>{{ $video->year }}</dd>
                        @endif
                    </dl>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="fb-comments" data-href="{{ url('videos/show', $video->id) }}" data-width="100%" data-numposts="10"></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dba_b">
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

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h4>相關影片</h4>
                    @foreach ($relatedVideos as $rVideo)
                        @include ('videos.videos_thumbnail', ['video' => $rVideo])
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    @if (Auth::check() && (Auth::id()==$video->user_id || Auth::user()->is_admin))
        <ul class="list-inline">
            <li>
                <a href="{{ url('videos/'.$video->id.'/edit') }}" type="submit" class="btn btn-info btn-mini">編輯</a>
            </li>
            <li>
                {{ Form::open(array('route' => array('videos.destroy', $video->id), 'method' => 'delete')) }}
                    <button type="submit" class="btn btn-danger btn-mini">刪除</button>
                {{ Form::close() }}
            </li>
        </ul>
    @endif



@endsection
