<?php
    require('./php/user.php');
    session_start();

    require('./php/connect.php');

    foreach ($_SESSION['user']->get() as $row) {
        echo '<p>' . $row . '</p>';
    }

    var_dump($_SERVER);

    if (isset($_POST['envoiera']) && isset($_POST['sujet']) && isset($_POST['text']) && isset($_GET['id'])) {
        if ($_POST['envoiera'] != '' && $_POST['sujet'] != '' && $_POST['text'] != '') {
            $dbh = connect();
            $envoie = $dbh->prepare('SELECT id FROM usser WHERE ');
        }
    }
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
        <meta name="theme-color" content="white">
        <?php include './content/header_base.html' ?>
        <title>dev</title>
    </head>
    <body>
        <form action="<?php echo $_SERVER['REQUEST_URI']?>?id=5" method="post">
            <input type="text" name="sujet" placeholder="Sujet">
            <textarea name="text" placeholder="Text"></textarea>
            <fieldset class="fichier">
                <label for="join"><i class="fas fa-file-upload"></i><span>Joindre un fichier</span></label>
                <input type="file" name="join" id="join" multiple class='hiden'>
            </fieldset>

            <input type="submit" value="Evoyer">
        </form>

        <script>
            
        </script>
    </body>
  </html>