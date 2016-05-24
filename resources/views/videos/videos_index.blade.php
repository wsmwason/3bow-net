@extends('layouts.app')

@section('content')

    <div class="row">
        @foreach ($videos as $video)
        <div class="col-md-3">
            @include ('videos.videos_thumbnail')
        </div>
        @endforeach
    </div>

    <div class="row text-center">{!! $videos->links() !!}</div>

    <div class="row">
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

@endsection
