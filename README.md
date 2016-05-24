# 馬路三寶 3bow.net

[馬路三寶](https://3bow.net) 網站原始碼，Based on [Laravel Framework](https://laravel.com/) 5.2。

### 關於網站

這個馬路三寶網站主要是為了揭露並警惕駕駛人有正確的駕駛觀念，讓交通更順暢美好（？）

##### 什麼是馬路三寶？

請參考 [馬路三寶 鄉民百科](http://zh.pttpedia.wikia.com/wiki/%E9%A6%AC%E8%B7%AF%E4%B8%89%E5%AF%B6)，簡言之就是一部分會造成交通潛在危險的駕駛人。

##### 為什麼要成立這個網站？

會成立這個網站，主要是因為馬路三寶實在造成台灣交通許多潛在的危險，可怕的是造成交通事故或危險的這些人 卻完全不知道自己已經成為馬路三寶，我們的目的不在檢舉交通違規行為。

我們只希望揭發這些行為，除了警惕車主自己行為非常危險之外，也讓大家見識馬路三寶有哪些種類， 進而讓駕駛人能提醒自己不能犯相同的錯誤，或遠離這些危險因子。

##### 網站上的影片是哪裡來的？

網站上的所有影片皆從 [YouTube](https://www.youtube.com/) 網站的公開影片取得，並分類整理呈現，我們並不會自行拍攝影片上傳，僅整理影片提供瀏覽。

您也可以透過 YouTube 上傳影片後再透過 上傳影片 提供給我們， 如果有您的影片不希望被轉貼至此請 [與我們聯絡](https://3bow.net/contact)。

### Requirements

 * PHP>=5.5.9
 * MySQL/MariaDB
 * Composer
 * Node (With Bower)
 * Apache/Nginx
 * YouTube API key access
 * Facebook Application ID and key (For login)

### 安裝佈署環境

若不使用 [Laravel Homestead](https://laravel.com/docs/5.2/homestead) 的話，請自行備妥上列項目的環境即可。

Git clone web source

    git clone git@github.com:wsmwason/3bow-net.git
    cd 3bow-net
    composer install

建立 database 與設定 .env 請參考 [.env.example](https://github.com/wsmwason/3bow-net/blob/master/.env.example) 範例

初始化 database

    artisam migrate:install
    artisam migrate
    artisam db:seed

Javascript vendors

    bower install

### 使用方式

目前會員系統直接使用 Facebook 登入，沒有另外的密碼設定，認證成功後僅能發表影片，新聞的部份必須要是 admin 管理者權限才能新增。

### 貢獻

歡迎提交 pull request 修正 issue 或新增其他功能。

### 開發者碎歲唸

我只是個 Developer，首次把自己的 web 專案 open source 出來，將朋友的這個 idea 具現化為一個實體網站，並非什麼正義魔人、正義之士，希望大家快快樂樂出門，平平安安回家。

### License

The MIT License (MIT)