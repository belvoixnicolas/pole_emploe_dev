<?php 
    require_once('./php/user.php');
     
    session_start();

    require_once('./php/connect.php');
    require_once('./php/secu_acces.php');
    require_once('./php/notif_error.php');

    autoris_acces(2);

    $_SESSION['iduser'] = $_SESSION['user']->get('id');
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
         
        <?php include './content/header_base.html' ?>
         
    </head>
    <body id="emploie_cree">
        <?php echo notif_error($errors); ?>

        <!-- nav --> 
            <?php include './content/nav.php' ?>
        <!-- nav -->

        <!-- SOUS-NAV -->
            <?php include './content/sous_nav_emploie.php' ?>
        <!-- SOUS-NAV -->

        <main>
            <?php include './content/form_new_offre.php' ?>
        </main>

        <!-- FOOTER -->
        <?php include './content/footer.php' ?>
        <!-- FOOTER -->
    </body>
  </html>