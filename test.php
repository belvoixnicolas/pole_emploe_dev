<?php
    session_start();

    require('./php/connect.php');
    require('./php/ident.php');
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
        <meta name="theme-color" content="white">
        <?php include './content/header_base.html' ?>
        <title>site web</title>
    </head>
    <body id="index">
        <form action="<?php echo $_SERVER['PHP_SELF']?>?form=ident" method="post">
            <input type="text" name="mail" placeholder='mail'>
            <input type="password" name="mdp" placeholder="mdp">
            <input type="submit" value="tester">
        </form>
    </body>
  </html>