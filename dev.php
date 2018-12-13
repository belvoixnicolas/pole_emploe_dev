<?php 
    require_once('./php/user.php');
     
    session_start();

    require_once('./php/connect.php');
    require_once('./php/secu_acces.php');
    require_once('./php/notif_error.php');

    autoris_acces(1);
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
         
        <?php include './content/header_base.html' ?>
         
    </head>
    <body id="dev">
    <?php echo notif_error($errors); ?>
        <!-- nav --> 
            <?php include './content/nav.php' ?>
        <!-- nav -->
        
        <!-- FOOTER -->
        <?php include './content/footer.php' ?>
        <!-- FOOTER -->
    </body>
  </html>