<div class="thumbnail video_thumbnail">
    @if ($video->license_plate)
        <div class="license_plate">{{ $video->license_plate }}</div>
    @endif
    @if (Auth::check() && Auth::user()->is_admin)
        <a href="#" data-video-id="{{ $video->id }}" data-token="{{ csrf_token() }}" class="delete">刪除</a>
    @endif
    @if ($video->year)
        <div class="year">{{ $video->year }}</div>
    @endif
    <a href="/videos/{{ $video->id }}" title="{{ $video->title }}">
        <img src="{{ $video->getVideoThumbnail() }}" alt="{{ $video->title }}" />
    </a>
    <div class="caption">
        <a href="/videos/{{ $video->id }}" title="{{ $video->title }}">
            <h4>{{ $video->title }}</h4>
        </a>
        <p class="description">{{ $video->description }}</p>
        <div class="tags">
            @if ($video->place!='')
                <a href="{{ url('videos/tag', $video->place) }}" class="btn btn-info btn-xs">{{ $video->place }}</a>
            @endif
            @foreach ($video->getIllegalArray() as $illegal)
                <a href="{{ url('videos/tag', $illegal) }}" class="btn btn-danger btn-xs">{{ $illegal }}</a>
            @endforeach
        </div>
    </div>
</div>