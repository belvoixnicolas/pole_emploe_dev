<?php 
    session_start();
    
    require('./php/connect.php');
    require('./php/secu_acces.php');

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