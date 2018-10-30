jQuery(document).ready(function(){
    var url = "./boite_mail.php?section=envoie";

    $('.repondre button').click(function () {
        $(location).attr('href', url);
    });
});