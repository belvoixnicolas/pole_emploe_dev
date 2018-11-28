jQuery(document).ready(function(){

    $('nav form').hide();

    $('nav .deco').click(function () {
         window.location.href = 'index.php';
    });

    $('nav .connect').click(function () {
        $('nav form').animate({height: 'toggle'}, 'slow');
    });

    $('.main_nav li').mouseenter(function () {
        $(this).find('span').animate({height: '2rem'}, 'slow');
    }).mouseleave(function () {
        $(this).find('span').animate({height: '0px'}, 'slow');
    });

    $('.main_nav button').mouseenter(function () {
        $(this).find('span').animate({height: '2rem'}, 'slow');
    }).mouseleave(function () {
        $(this).find('span').animate({height: '0px'}, 'slow');
    });

    //$('nav:nth-child(1)').

    $(window).scroll(function () {
        let scroll = $('html').scrollTop();
        if (scroll != 0) {
            $('nav:nth-child(1)').addClass('navscroll');
        }else {
            $('nav:nth-child(1)').removeClass('navscroll');
        }
    });
});