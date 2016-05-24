@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $news->title }}</div>
                <div class="panel-body">
                    <p>新聞連結：<a href="{{ $news->source_url }}" target="_blank">{{ $news->source_url }}</a></p>
                    @if ($news->author)
                        <p>作者：{{ $news->author }}</a></p>
                    @endif
                    @if ($news->description)
                        <blockquote>{!! $news->description !!}</blockquote>
                    @endif
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">
                    @if (Auth::check() && (Auth::id()==$news->user_id || Auth::user()->is_admin))
                        <ul class="list-inline">
                            <li>
                                <a href="/news/{{ $news->id }}/edit" type="submit" class="btn btn-info btn-mini">編輯</a>
                            </li>
                            <li>
                                {{ Form::open(array('route' => array('news.destroy', $news->id), 'method' => 'delete')) }}
                                    <button type="submit" class="btn btn-danger btn-mini">刪除</button>
                                {{ Form::close() }}
                            </li>
                        </ul>
                    @endif
                    <h4>相關三寶影片</h4>
                </div>
                @foreach ($videos as $video)
                <div class="col-md-4">
                    @include ('videos.videos_thumbnail')
                </div>
                @endforeach
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

        </div>
    </div>

@endsection
