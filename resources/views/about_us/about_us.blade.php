@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="well well-lg">
                <h2>關於馬路三寶</h2>

                <h4 class="text-success"><i class="fa fa-question-circle" aria-hidden="true"></i> 什麼是馬路三寶？</h4>
                <p>
                    請參考 {{ Html::link('http://zh.pttpedia.wikia.com/wiki/%E9%A6%AC%E8%B7%AF%E4%B8%89%E5%AF%B6', '馬路三寶 鄉民百科', ['target' => '_blank']) }}
                    ，簡言之就是一部分會造成交通潛在危險的駕駛人。
                </p>

                <h4 class="text-success"><i class="fa fa-question-circle" aria-hidden="true"></i> 為什麼要成立這個網站？</h4>
                <p>
                    會成立這個網站，主要是因為馬路三寶實在造成台灣交通許多潛在的危險，可怕的是造成交通事故或危險的這些人
                    <b class="text-danger">卻完全不知道自己已經成為馬路三寶</b>，我們的目的不在檢舉交通違規行為。
                    我們只希望揭發這些行為，除了警惕車主自己行為非常危險之外，也讓大家見識馬路三寶有哪些種類，
                    進而讓駕駛人能提醒自己不能犯相同的錯誤，或遠離這些危險因子。
                </p>

                <h4 class="text-success"><i class="fa fa-question-circle" aria-hidden="true"></i> 網站上的影片是哪裡來的？</h4>
                <p>
                    網站上的所有影片皆從 {{ Html::link('https://www.youtube.com/', 'YouTube', ['target' => '_blank']) }} 網站的公開影片取得，並分類整理呈現，我們並不會自行拍攝影片上傳，
                    僅整理影片提供瀏覽。您也可以透過 {{ Html::link('https://www.youtube.com/', 'YouTube', ['target' => '_blank']) }} 上傳影片後再透過 上傳影片 提供給我們，
                    如果有您的影片不希望被轉貼至此請 <a href="/contact">與我們聯絡</a>。
                </p>
            </div>
        </div>
    </div>

@endsection
