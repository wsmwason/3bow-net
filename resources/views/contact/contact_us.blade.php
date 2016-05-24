@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">聯絡我們</div>
                <div class="panel-body">
                    {!! Form::open(['route' => ['contact.store'], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                        <div class="form-group required{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">名字</label>

                            <div class="col-md-8">
                                {{ Form::text('name', old('name'), [
                                    'class' => 'form-control',
                                    'placeholder' => '您的名字',
                                ]) }}

                                <span class="help-block"></span>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group required{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Email</label>

                            <div class="col-md-8">
                                {{ Form::text('email', old('email'), [
                                    'class' => 'form-control',
                                    'placeholder' => '您的聯絡 Email',
                                ]) }}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">內文</label>

                            <div class="col-md-8">
                                {{ Form::textarea('description', old('description'), [
                                    'class' => 'form-control',
                                    'placeholder' => '描述',
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
                                    送出
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection