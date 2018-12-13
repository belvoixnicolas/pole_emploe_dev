<?php 
    require_once('./php/user.php');
     
    session_start();

    require_once('./php/connect.php');
    require_once('./php/secu_acces.php');
    require_once('./php/notif_error.php');
    require_once('./php/liste_emploie.php');

    autoris_acces(2);

    $dbh = connect();

    $req = $dbh->prepare("UPDATE notification SET vu = '1' WHERE type = 'job' AND id_usser = :id");
    $req->execute(array(':id' => $_SESSION['user']->get('id')));

    $_SESSION['iduser'] = $_SESSION['user']->get('id');
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
         
        <?php include './content/header_base.html' ?>
         
    </head>
    <body id="emploie">
        <?php echo notif_error($errors); ?>

        <!-- nav --> 
            <?php include './content/nav.php' ?>
        <!-- nav -->

        <!-- SOUS-NAV -->
            <?php include './content/sous_nav_emploie.php' ?>
        <!-- SOUS-NAV -->

        <main>
            <section class="liste">
                <ul>
                    <?php echo liste_emploie($_SESSION['user']->get('id')); ?>
                </ul>
            </section>
        </main>
        <script src="./js/ajax/sup_offre.js"></script>
        <script src="./js/ajax/choix_offre.js"></script>

        <!-- FOOTER -->
            <?php include './content/footer.php' ?>
        <!-- FOOTER -->
    </body>
  </html>