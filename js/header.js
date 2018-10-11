jQuery(document).ready(function(){
    $('.inscription').hide();

    $('#connex_dev, #connex_pat').hover(function () {
        $(this).find('.expli').animate({opacity: '0'}, 'slow', function () {
            $(this).hide();
            $(this).parent().find('.inscription').css({opacity: '0'}).show().animate({opacity: '1'}, 'slow');
        });
    },
    function () {
        $(this).find('.inscription').animate({opacity: '0'}, 'slow', function () {
            $(this).hide();
            $(this).parent().find('.expli').css({opacity: '0'}).show().animate({opacity: '1'}, 'slow');
        });
    });
});