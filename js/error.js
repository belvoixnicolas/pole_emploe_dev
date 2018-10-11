jQuery(document).ready(function(){
    $('#error .croix').click(function () {
        $(this).parent().animate({height: '0px'}, 'slow', function () {
            $(this).hide();
        });
    });
});