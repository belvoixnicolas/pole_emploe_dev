<?php 
    require('./php/user.php');
    session_start();

    require('./php/connect.php');
    require('./php/secu_acces.php');

    autoris_acces('1');
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
        <meta name="theme-color" content="white">
        <?php include './content/header_base.html' ?>
        <title>dev</title>
    </head>
    <body id="dev">
        <!-- nav --> 
            <?php include './content/nav.php' ?>
        <!-- nav -->
        
        <!-- FOOTER -->
        <?php include './content/footer.html' ?>
        <!-- FOOTER -->
    </body>
  </html>