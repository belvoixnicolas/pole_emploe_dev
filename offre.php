<?php 
    require_once('./php/user.php');
    session_start();

    require_once('./php/connect.php');
    require_once('./php/secu_acces.php');
    require_once('./php/notif_error.php');
    require_once('./php/liste_offre.php');

    autoris_acces(1);
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

        <div class="contain">
            <aside class="filtre">
                <h2>Filtre</h2>
            </aside>
            <main>
                <h1>Rechrche d'offre</h1>
                <article class="recherche">
                    <input type="text" name="recherche" id="">
                </article>

                <article class="resultat">
                    <h2>Resultat</h2>
                    <section>
                        <ul>
                            <?php echo liste_offre($_SESSION['user']->get('id')); ?>
                        </ul>
                    </section>
                </article>
            </main>
        </div>
        
        <!-- FOOTER -->
            <?php include './content/footer.html' ?>
        <!-- FOOTER -->
    </body>
  </html>