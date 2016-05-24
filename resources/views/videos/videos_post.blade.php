@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">發表新影片</div>
                <div class="panel-body">
                    @if(isset($video))
                    {!! Form::model($video, ['route' => ['videos.update', $video->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
                    @else
                    {!! Form::open(['route' => ['videos.store'], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                    @endif
                        <div class="form-group required{{ $errors->has('video_url') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">YouTube 影片網址</label>

                            <div class="col-md-8">
                                {{ Form::text('video_url', old('video_url'), [
                                    'class' => 'form-control',
                                    'placeholder' => 'https://',
                                ] + (isset($video) ? ['readonly' => false] : [])) }}

                                <span class="help-block"></span>

                                @if ($errors->has('video_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('video_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group required{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">標題</label>

                            <div class="col-md-8">
                                {{ Form::text('title', old('title'), [
                                    'class' => 'form-control',
                                    'placeholder' => '來給個符合三寶行為的標題',
                                ]) }}

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group required{{ $errors->has('illegal') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">違規行為</label>

                            <div class="col-md-8">
                                {{ Form::select('illegal[]', $illegalTypes, old('illegal'), [
                                    'class' => 'form-control',
                                    'multiple' => 'multiple',
                                    'style' => 'width:100%',
                                ]) }}

                                @if ($errors->has('illegal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('illegal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group required{{ $errors->has('illegal_other') ? ' has-error' : '' }}" style="display:none;">
                            <label class="col-md-3 control-label">其他違規行為</label>

                            <div class="col-md-8">
                                {{ Form::hidden('illegal_other_show', old('illegal_other_show')) }}
                                {{ Form::text('illegal_other', old('illegal_other'), [
                                    'class' => 'form-control',
                                ]) }}

                                @if ($errors->has('illegal_other'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('illegal_other') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('license_plate') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">違規車號</label>

                            <div class="col-md-8">
                                {{ Form::text('license_plate', old('license_plate'), [
                                    'class' => 'form-control',
                                    'placeholder' => '違規車號',
                                ]) }}

                                @if ($errors->has('license_plate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('license_plate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">短評</label>

                            <div class="col-md-8">
                                {{ Form::textarea('description', old('description'), [
                                    'class' => 'form-control',
                                    'placeholder' => '短評與描述',
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

                            <label class="col-md-3 control-label">事發地點</label>

                            <div class="col-md-3{{ $errors->has('place') ? ' has-error' : '' }}">
                                {{ Form::select('place', $places, old('place'), [
                                    'class' => 'form-control',
                                    'placeholder' => '請選擇',
                                ]) }}

                                @if ($errors->has('place'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('place') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label class="col-md-2 control-label">事發年份</label>

                            <div class="col-md-3{{ $errors->has('year') ? ' has-error' : '' }}">
                                {{ Form::text('year', old('year'), [
                                    'class' => 'form-control',
                                    'placeholder' => date('Y'),
                                ]) }}

                                @if ($errors->has('year'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($video) ? '更新' : '發表' }}影片
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    <link href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css" rel="stylesheet" />
    <style>
    .form-group.required .control-label:after {
       content:"*";
       color:red;
    }
    .select2-container--bootstrap .select2-selection{
        font-family: 'Noto Sans TC', sans-serif;
    }
    </style>
    <script type="text/javascript">

/**
* Get YouTube ID from various YouTube URL
* @author: takien
* @url: http://takien.com
* For PHP YouTube parser, go here http://takien.com/864
*/

function YouTubeGetID(url){
  var ID = '';
  url = url.replace(/(>|<)/gi,'').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
  if(url[2] !== undefined) {
    ID = url[2].split(/[^0-9a-z_\-]/i);
    ID = ID[0];
  }
  else {
    ID = url;
  }
    return ID;
}


/*
* Tested URLs:
var url = 'http://youtube.googleapis.com/v/4e_kz79tjb8?version=3';
url = 'https://www.youtube.com/watch?feature=g-vrec&v=Y1xs_xPb46M';
url = 'http://www.youtube.com/watch?feature=player_embedded&v=Ab25nviakcw#';
url = 'http://youtu.be/Ab25nviakcw';
url = 'http://www.youtube.com/watch?v=Ab25nviakcw';
url = '<iframe width="420" height="315" src="http://www.youtube.com/embed/Ab25nviakcw" frameborder="0" allowfullscreen></iframe>';
url = '<object width="420" height="315"><param name="movie" value="http://www.youtube-nocookie.com/v/Ab25nviakcw?version=3&amp;hl=en_US"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube-nocookie.com/v/Ab25nviakcw?version=3&amp;hl=en_US" type="application/x-shockwave-flash" width="420" height="315" allowscriptaccess="always" allowfullscreen="true"></embed></object>';
url = 'http://i1.ytimg.com/vi/Ab25nviakcw/default.jpg';
url = 'https://www.youtube.com/watch?v=BGL22PTIOAM&feature=g-all-xit';
url = 'BGL22PTIOAM';
*/


        $('select[name="illegal[]"]').select2({
            theme: "bootstrap",
            placeholder: '選擇違規行為'
        });
        $(function(){

            // show youtube thumbnail image preview
            $('input[name="video_url"]').on('change keyup', function(){
                var $videoUrl = $(this);
                var videoId = YouTubeGetID($(this).val());
                if (videoId!='') {
                    $videoUrl.next().html(
                        '<img class="img-rounded" style="width:100px;" src="https://img.youtube.com/vi/' + videoId + '/hqdefault.jpg" />' +
                        '<img class="img-rounded" style="width:100px;margin-left:5px" src="https://img.youtube.com/vi/' + videoId + '/1.jpg" />' +
                        '<img class="img-rounded" style="width:100px;margin-left:5px" src="https://img.youtube.com/vi/' + videoId + '/2.jpg" />'
                    );
                } else {
                    $videoUrl.next().html('');
                }
            }).keyup();

            // show/hide other illegal input
            $('select[name="illegal[]"]').on('change click', function(){
                var otherIllegal = ($(this).val().indexOf('其他')!==-1) ? true : false;
                if (otherIllegal===true) {
                    $('input[name="illegal_other"]').parents('.form-group').fadeIn('slow');
                    $('input[name="illegal_other_show"]').val('1');
                } else {
                    $('input[name="illegal_other"]').val('');
                    $('input[name="illegal_other"]').parents('.form-group').fadeOut('slow');
                    $('input[name="illegal_other_show"]').val('0');
                }
            });
            if ($('input[name="illegal_other_show"]').val()==='1') {
                $('input[name="illegal_other"]').parents('.form-group').show();
            }
        });
    </script>
@endsection