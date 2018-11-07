jQuery(document).ready(function(){
    $('input[type=file]').on('change', function () {
        var names = [];
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            names.push($(this).get(0).files[i].name);
        }

        var existe = document.querySelectorAll('.listefichier').length;
        
        if (names.length != 0 && existe == 0) {
            $('.add').before('<ul class="listefichier"></ul>');
            $('.add').css('display', 'none');

            var temp = 1000;

            for (let i = 0; i < names.length; i++) {
                var nomFichier = names[i];
                nomFichier = nomFichier.split('.');
                var dernierValue = nomFichier.length;
                var extention = nomFichier[--dernierValue];

                $('.listefichier').delay(temp).append('<li class="' + extention.toUpperCase() + '"><span>' + names[i] + '</span></li>');
                $('.listefichier li:last-child').delay(temp).css('opacity', '0').animate({opacity: '1'}, 'slow');

                temp = temp + 500;
            }
        }else if (names.length != 0 && existe > 0) {
            $('.listefichier li').animate({opacity: '0'}, 'slow', function () {
                $('.listefichier li').remove();

                var temp = 1000;

                for (let i = 0; i < names.length; i++) {
                    var nomFichier = names[i];
                    nomFichier = nomFichier.split('.');
                    var dernierValue = nomFichier.length;
                    var extention = nomFichier[--dernierValue];

                    $('.listefichier').delay(temp).append('<li class="' + extention.toUpperCase() + '"><span>' + names[i] + '</span></li>');
                    $('.listefichier li:last-child').delay(temp).css('opacity', '0').animate({opacity: '1'}, 'slow');

                    temp = temp + 500;
                }
            });
        }else {
            $('.listefichier').animate({opacity: '0'}, 'slow', function () {
                $('.listefichier').remove();
            });
        }
    });
});