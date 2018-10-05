<?php
    require_once('./php/user.php');
    session_start();

    require_once('./php/connect.php');
    require_once('./php/envoie_mail.php');

    if (isset($_POST['sujet']) && isset($_POST['text']) && isset($_GET['id'])) {
        echo envoie_mail($_POST['sujet'], $_POST['text'], $_GET['id']);
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
        <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data">
            <input type="text" name="sujet" placeholder="Sujet">
            <textarea name="text" placeholder="Text"></textarea>
            
                <label for="join"><i class="fas fa-file-upload"></i><span>Joindre un fichier</span></label>
                <input type="file" name="join[]" id="join" multiple class='hiden'>
            

            <input type="submit" value="Evoyer">
        </form>

        <script>
            
        </script>
    </body>
  </html>