<?php 
    require_once('./php/user.php');
     
    session_start();

    require_once('./php/connect.php');
    require_once('./php/secu_acces.php');
    require_once('./php/notif_error.php');
    require_once('./php/liste_ville.php');
    require_once('./php/liste_offre.php');

    autoris_acces(1);

    $_SESSION['iduser'] = $_SESSION['user']->get('id');
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
         
        <?php include './content/header_base.html' ?>
         
    </head>
    <body id="offre">
    <?php echo notif_error($errors); ?>
        <!-- nav --> 
            <?php include './content/nav.php' ?>
        <!-- nav -->

        <!-- SOUS-NAV -->
            <?php include './content/sous_nav_offre.php' ?>
        <!-- SOUS-NAV -->
            
        <main>
            <article class="recherche">
                <select name="ville" id="ville">
                <option value="NULL" focus>Ville</option>
                <optgroup>
                    <?php
                        $villes = liste_ville();

                        foreach ($villes as $ville) { 
                            $ville = explode('/', $ville)[0];
                            ?>
                            <option value="<?php echo $ville ?>"><?php echo ucfirst(mb_strtolower($ville)) ?></option>
                        <?php }
                    ?>
                </optgroup>
                </select>
            </article>

            <article class="resultat">
                <section>
                    <ul>
                        <?php echo liste_offre($_SESSION['user']->get('id')); ?>
                    </ul>
                </section>
            </article>
        </main>
        <script src="./js/ajax/recher_offre.js"></script>
        <script src="./js/ajax/postule_offre.js"></script>
        
        <!-- FOOTER -->
            <?php include './content/footer.html' ?>
        <!-- FOOTER -->
    </body>
  </html>