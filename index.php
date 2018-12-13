<?php 
     
    session_start();

    if (isset($_SESSION['user'])) {
        session_destroy();
         
        session_start();
    }

    require_once('./php/connect.php');
    require_once('./php/notif_error.php');
    require_once('./php/liste_ville.php');
    require_once('./php/ident.php');
    
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
         
        <?php include './content/header_base.html' ?>
         
    </head>
    <body id="index">
        <?php echo notif_error($errors); ?>
        <!-- nav --> 
            <?php include './content/nav.php' ?>
        <!-- nav --> 

        <header>
            <article id="connex_dev">
                <section class="expli">
                    <h2>Développeur</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem amet quae dolore, esse molestias aliquid alias laborum voluptate neque id doloribus consectetur cum earum! Molestias dolorum quibusdam suscipit quidem eius.
                    </p>

                    <button id="inscriptdev">
                        Je m'inscrie
                    </button>
                </section>

                <section class="inscription">
                    <h3>Inscription</h3>

                    <!-- FORM DEV -->
                        <?php include './content/form_dev.php' ?>
                    <!-- FORM DEV -->
                </section>
            </article>

            <article id="connex_pat">
                <section class="expli">
                    <h2>Porteur de projet</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem amet quae dolore, esse molestias aliquid alias laborum voluptate neque id doloribus consectetur cum earum! Molestias dolorum quibusdam suscipit quidem eius.
                    </p>

                    <button id="inscriptpat">
                        Je m'inscrie
                    </button>
                </section>

                <section class="inscription">
                    <h3>Inscription</h3>

                    <!-- FORM PAT -->
                        <?php include './content/form_pat.php' ?>
                    <!-- FORM PAT -->
                </section>
            </article>
        </header>

        <main>
            <article>
                <h2>Explication</h2>

                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque voluptatem amet at molestias delectus exercitationem quo sit voluptas, provident maiores quaerat cum error consequuntur voluptatum quae soluta illum possimus aliquid.
                </p>
            </article>
        </main>

        <!-- FOOTER -->
            <?php include './content/footer.php' ?>
        <!-- FOOTER -->

        <script src="./js/header.js"></script>
    </body>
</html>