<?php 
    require_once('./php/user.php');
    session_start();

    require_once('./php/connect.php');
    require_once('./php/secu_acces.php');
    require_once('./php/notif_error.php');
    require_once('./php/liste_reponse.php');

    autoris_acces(1);

    $_SESSION['iduser'] = $_SESSION['user']->get('id');
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
        <meta name="theme-color" content="white">
        <?php include './content/header_base.html' ?>
        <title>Réponse</title>
    </head>
    <body id="offreresultat">
    <?php echo notif_error($errors); ?>
        <!-- nav --> 
            <?php include './content/nav.php' ?>
        <!-- nav -->

        <!-- SOUS-NAV -->
            <?php include './content/sous_nav_offre.php' ?>
        <!-- SOUS-NAV -->
            
        <main>
            <section class="optien">
                <label for="accepter">
                    <i class="far fa-check-circle"></i>
                </label>
                <input type="checkbox" name="accepter" id="accepter">

                <label for="attente">
                    <i class="far fa-dot-circle"></i>
                </label>
                <input type="checkbox" name="attente" id="attente">

                <label for="refu">
                    <i class="far fa-times-circle"></i>
                </label>
                <input type="checkbox" name="refu" id="refu">
            </section>

            <section class="resultat">
                <ul>
                    <?php echo liste_reponse($_SESSION['user']->get('id')) ?>
                </ul>
            </section>
        </main>

        <script src="./js/ajax/filtre_offre_rep.js"></script>
        <script src="./js/ajax/noter.js"></script>
        
        <!-- FOOTER -->
            <?php include './content/footer.html' ?>
        <!-- FOOTER -->
    </body>
  </html>