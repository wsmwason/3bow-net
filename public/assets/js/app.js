// Facebook Callback appends '#_=_' to Return URL
// http://stackoverflow.com/questions/7131909/facebook-callback-appends-to-return-url
if (window.location.hash && window.location.hash == '#_=_') {
    if (window.history && history.pushState) {
        window.history.pushState("", document.title, window.location.pathname);
    } else {
        // Prevent scrolling by storing the page's current scroll offset
        var scroll = {
            top: document.body.scrollTop,
            left: document.body.scrollLeft
        };
        window.location.hash = '';
        // Restore the scroll offset, should be flicker free
        document.body.scrollTop = scroll.top;
        document.body.scrollLeft = scroll.left;
    }
}

$(function(){

    // quick delete video
    $('a.delete').on('click', function(){
        if (confirm('確定刪除？')==false) {
            return false;
        }
        var videoId = $(this).data('video-id');
        var token = $(this).data('token');
        var $video = $(this).parent();
        $.ajax({
            url: '/videos/' + videoId,
            type: 'post',
            data: {_method: 'delete', _token :token},
            dataType: 'json',
            success:function(res){
                if (res.status==1) {
                    $video.fadeOut('slow');
                }
            }
        });
        return false;
    });

});

