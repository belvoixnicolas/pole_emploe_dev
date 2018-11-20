<?php 
    require_once('./php/user.php');
    session_start();

    require_once('./php/connect.php');
    require_once('./php/secu_acces.php');
    require_once('./php/notif_error.php');
    require_once('./php/liste_pris.php');

    autoris_acces(2);

    $_SESSION['iduser'] = $_SESSION['user']->get('id');
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
        <meta name="theme-color" content="white">
        <?php include './content/header_base.html' ?>
        <title>Emploie</title>
    </head>
    <body id="emploie_pris">
        <?php echo notif_error($errors); ?>

        <!-- nav --> 
            <?php include './content/nav.php' ?>
        <!-- nav -->

        <!-- SOUS-NAV -->
            <?php include './content/sous_nav_emploie.php' ?>
        <!-- SOUS-NAV -->

        <main>
            <ul>
                <?php echo liste_pris($_SESSION['user']->get('id')); ?>
            </ul>
        </main>
        <script src="./js/ajax/noter_pat.js"></script>

        <!-- FOOTER -->
        <?php include './content/footer.html' ?>
        <!-- FOOTER -->
    </body>
  </html>