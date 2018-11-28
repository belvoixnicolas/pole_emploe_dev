jQuery(document).ready(function(){

    $('nav .deco').click(function () {
         window.location.href = 'index.php';
    });

    $('nav .connect').click(function () {
        let display = document.querySelector('nav form').style.display;
        
        if (display == 'flex') {
            $('nav form').animate({height: 'toggle'}, 'slow');
        }else {
            $('nav form').css('display', 'flex').hide().animate({height: 'toggle'}, 'slow');
        }
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