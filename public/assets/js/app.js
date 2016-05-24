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

