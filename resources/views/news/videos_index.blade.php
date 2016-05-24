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

@endsection
