@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">使用 Facebook 帳號即可登入發表影片</div>
                <div class="panel-body">
                    <h4><i class="fa fa-sign-in" aria-hidden="true"></i> 快速登入</h4>
                    <p>我們不須任何帳號密碼，僅須使用 Facebook 帳號即可直接登入，也只會存取您 Facebook 公開分享的基本資料。</p>
                    <div class="well-lg">
                        <a href="/login/facebook" class="btn btn-block btn-social btn-facebook">
                            <span class="fa fa-facebook"></span> 使用 Facebook 帳號登入
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
