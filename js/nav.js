jQuery(document).ready(function(){

    $('nav form').hide();
    $('.main_nav span').hide();

    $('nav .deco').click(function () {
         window.location.href = 'index.php';
    });

    $('nav .connect').click(function () {
        $('nav form').animate({height: 'toggle'}, 'slow');
    });

    $('.main_nav a').hover(function () {
        $(this).parent().find('span').animate({width: 'toggle'}, 'slow');
    });

    $('.main_nav button').hover(function () {
        $(this).find('span').animate({width: 'toggle'}, 'slow');
    });
});