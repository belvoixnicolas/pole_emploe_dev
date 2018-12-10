jQuery(document).ready(function(){
    setInterval(notif, 1000);

    function notif() {
        var donner = $(int).serialize();
        $.post(
            'http://ardennesdev.fr/js/ajax/php/notif.php',
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
                    $('nav .mail').attr('href', './boite_mail.php?section=reception');
                }else {
                    $('nav .mail i').removeClass('animated infinite pulse').removeAttr('style');
                    $('nav .mail').attr('href', './boite_mail.php');
                }

                if (data[2] > 0) {
                    let url = window.location.pathname;
                    url = url.split('/');
                    let i = url.length;

                    let fichier = url[--i];

                    $('nav .profil i').css('color', 'red').addClass('animated infinite pulse');

                    if (fichier == 'profil.php') {
                        location.reload();
                    }else {
                        $('nav .profil').attr('href', './profil.php?id=' + int + '#commentaire');
                    }
                }else {
                    $('nav .profil i').removeClass('animated infinite pulse').removeAttr('style');

                    let model= './profil.php?id=' + int;

                    if($('nav .profil').attr('href') != model) {
                        $('nav .profil').attr('href', './profil.php?id=' + int);
                    }
                }
            }
        );
    }
});