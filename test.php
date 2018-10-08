<?php
    require_once('./php/connect.php');

?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
        <meta name="theme-color" content="white">
        <?php include './content/header_base.html' ?>
        <title>dev</title>
    </head>
    <body>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <fieldset>
                <label>
                    <i class="far fa-star"></i>
                    <input type="radio" name="note" value="1">
                </label>

                <label>
                    <i class="far fa-star"></i>
                    <input type="radio" name="note" value="2">
                </label>

                <label>
                    <i class="far fa-star"></i>
                    <input type="radio" name="note" value="3">
                </label>

                <label>
                    <i class="far fa-star"></i>
                    <input type="radio" name="note" value="4">
                </label>

                <label>
                    <i class="far fa-star"></i>
                    <input type="radio" name="note" value="5">
                </label>
            </fieldset>

            <textarea name="text" placeholder="commentaire">

            </textarea>

            <input type="submit" value="envoyer">
        </form>

        <script>
            jQuery(document).ready(function(){
                $('input[name=note]').change(function () {
                    var value = this.value;
                    var etoiles = $('input[name=note]');

                    for (i = 0; i < etoiles.length; i++) {
                        if (i < value) {
                            etoiles[i].className = 'fas fa-star';
                        }else {
                            etoiles[i].className = 'far fa-star';
                        }
                    }
                });
            });
        </script>
    </body>
  </html>