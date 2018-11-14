<?php 
    require_once('./php/user.php');
    session_start();

    require_once('./php/connect.php');
    require_once('./php/secu_acces.php');
    require_once('./php/notif_error.php');

    autoris_acces(2);

    $dbh = connect();

    $req = $dbh->prepare("UPDATE notification SET vu = '1' WHERE type = 'job' AND id_usser = :id");
    $req->execute(array(':id' => $_SESSION['user']->get('id')));

    //$_SESSION['iduser'] = $_SESSION['user']->get('id');
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
        <meta name="theme-color" content="white">
        <?php include './content/header_base.html' ?>
        <title>Offre</title>
    </head>
    <body id="offre">
        <?php echo notif_error($errors); ?>

        <!-- nav --> 
            <?php include './content/nav.php' ?>
        <!-- nav -->

        <!-- SOUS-NAV -->
            <?php include './content/sous_nav_emploie.php' ?>
        <!-- SOUS-NAV -->
    </body>
  </html>