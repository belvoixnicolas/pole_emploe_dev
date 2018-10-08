jQuery(document).ready(function(){
    setInterval(notif, 1000);

    function notif() {
        var donner = $(int).serialize();
        $.post(
            './js/ajax/php/notif.php',
            'id=' + int,
            function injecter(data) {
                data = data.split('/');
                if (data[0] > 0) {
                    $('nav .job i').css('color', 'red').addClass('animated infinite pulse');
                }else {
                    $('nav .job i').removeClass('animated infinite pulse').removeAttr('style');
                }

                if (data[1] > 0) {

                    $('nav .mail i').css('color', 'red').addClass('animated infinite pulse');
                }else {
                    $('nav .mail i').removeClass('animated infinite pulse').removeAttr('style');
                }
            }
        );
    }
});