@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">發表新聞</div>
                <div class="panel-body">
                    @if(isset($news))
                    {!! Form::model($news, ['route' => ['news.update', $news->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
                    @else
                    {!! Form::open(['route' => ['news.store'], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                    @endif
                        <div class="form-group required{{ $errors->has('source_url') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">新聞網址</label>

                            <div class="col-md-8">
                                {{ Form::text('source_url', old('source_url'), [
                                    'class' => 'form-control',
                                    'placeholder' => 'https://',
                                ]) }}

                                <span class="help-block"></span>

                                @if ($errors->has('source_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('source_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group required{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">標題</label>

                            <div class="col-md-8">
                                {{ Form::text('title', old('title'), [
                                    'class' => 'form-control',
                                    'placeholder' => '新聞標題',
                                ]) }}

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group required{{ $errors->has('author') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">作者</label>

                            <div class="col-md-8">
                                {{ Form::text('author', old('author'), [
                                    'class' => 'form-control',
                                    'placeholder' => '新聞作者',
                                ]) }}

                                @if ($errors->has('author'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">新聞內文</label>

                            <div class="col-md-8">
                                {{ Form::textarea('description', old('description'), [
                                    'class' => 'form-control',
                                    'placeholder' => '新聞內文',
                                    'style' => 'height:95px',
                                ]) }}

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($news) ? '更新' : '發表' }}新聞
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script type="text/javascript">
        $(function(){

            // auto get new content
            $('input[name="source_url"]').on('change', function(){
                var url = $(this).val();
                $.ajax({
                    headers: { 'csrftoken' : '{{ csrf_token() }}' },
                    type: 'POST',
                    url: '/news/parser',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'url': url
                    },
                    dataType: 'json',
                    success: function(res){
                        if (res.status==1) {
                            $('input[name="title"]').val(res.title);
                            $('input[name="author"]').val(res.reporter);
                            $('textarea[name="description"]').val(res.content);
                        }
                    }
                });
            });
        });
    </script>
@endsection