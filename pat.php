<?php 
    require_once('./php/user.php');
    session_start();
    
    require_once('./php/connect.php');
    require_once('./php/secu_acces.php');

    autoris_acces(2);
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
        <meta name="theme-color" content="white">
        <?php include './content/header_base.html' ?>
        <title>pat</title>
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