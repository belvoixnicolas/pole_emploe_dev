<?php 
    session_start();

    if (isset($_SESSION['user'])) {
        session_destroy();
        session_start();
    }

    require_once('./php/connect.php');
    require_once('./php/liste_ville.php');
    require_once('./php/ident.php');
    require_once('./php/inscription.php');
    require_once('./php/notif_error.php');
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
        <meta name="theme-color" content="white">
        <?php include './content/header_base.html' ?>
        <title>site web</title>
    </head>
    <body id="index">
        <?php echo notif_error($errors); ?>
        <!-- nav --> 
            <?php include './content/nav.php' ?>
        <!-- nav --> 

        <header>
            <article id="connex_dev">
                <section class="expli">
                    <h4>Développeur</h4>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem amet quae dolore, esse molestias aliquid alias laborum voluptate neque id doloribus consectetur cum earum! Molestias dolorum quibusdam suscipit quidem eius.
                    </p>
                </section>

                <section class="inscription">
                    <h4>Inscription</h4>

                    <!-- FORM DEV -->
                        <?php include './content/form_dev.php' ?>
                    <!-- FORM DEV -->
                </section>
            </article>

            <article id="connex_pat">
                <section class="expli">
                    <h4>Employeur ou Particulier</h4>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem amet quae dolore, esse molestias aliquid alias laborum voluptate neque id doloribus consectetur cum earum! Molestias dolorum quibusdam suscipit quidem eius.
                    </p>
                </section>

                <section class="inscription">
                    <h4>Inscription</h4>

                    <!-- FORM PAT -->
                        <?php include './content/form_pat.php' ?>
                    <!-- FORM PAT -->
                </section>
            </article>
        </header>

        <main>
            <article>
                <h3>Explication</h3>

                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque voluptatem amet at molestias delectus exercitationem quo sit voluptas, provident maiores quaerat cum error consequuntur voluptatum quae soluta illum possimus aliquid.
                </p>
            </article>
        </main>

        <!-- FOOTER -->
            <?php include './content/footer.html' ?>
        <!-- FOOTER -->

        <script src="./js/header.js"></script>
    </body>
</html>