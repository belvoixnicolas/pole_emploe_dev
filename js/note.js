jQuery(document).ready(function(){
                

    $('input[name=note]').change(function () {
        var value = this.value;
        var etoiles = $('input[name=note]');

        for (i = 0; i < etoiles.length; i++) {
            if (i < value) {
                document.querySelectorAll('.start i')[i].className = 'fas fa-star';
            }else {
                document.querySelectorAll('.start i')[i].className = 'far fa-star';
            }
        }
    });
});