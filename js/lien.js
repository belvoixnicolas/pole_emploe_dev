jQuery(document).ready(function(){
    var lien = $('.ident a').attr('href');

    var id = lien.split('=');

    var url = "./boite_mail.php?section=envoie&id=" + id[1];

    $('.repondre button').click(function () {
        $(location).attr('href', url);
    });
});