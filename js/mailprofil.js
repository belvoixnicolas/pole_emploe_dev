jQuery(document).ready(function(){
    $('#form_mail').hide();

    $('#mail span:nth-child(1)').click(function () {
        $('#form_mail').animate({height: 'toggle'}, 'slow');
    });
});