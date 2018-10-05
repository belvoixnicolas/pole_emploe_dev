jQuery(document).ready(function(){
    setInterval(notif, 1000);

    function notif() {
        var donner = $(int).serialize();
        $.post(
            './js/ajax/php/notif.php',
            'id=' + int,
            function injecter(data) {
                console.log(data);
            }
        );
    }
});