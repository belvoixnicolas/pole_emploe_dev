jQuery(document).ready(function(){

    $('body').on('click', '#inscriptpat', function () {
        $('#connex_pat .expli').animate({opacity: '0'}, 'slow', function () {
            $(this).hide();
            $('#connex_pat .inscription').css('display', 'grid').fadeTo(0).animate({opacity: '1'}, 'slow');
        });
    });

    $('body').on('click', '#inscriptdev', function () {
        $('#connex_dev .expli').animate({opacity: '0'}, 'slow', function () {
            $(this).hide();
            $('#connex_dev .inscription').css('display', 'grid').fadeTo(0).animate({opacity: '1'}, 'slow');
        });
    });
});