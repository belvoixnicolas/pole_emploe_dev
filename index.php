<?php 
    session_start();
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
        <meta name="theme-color" content="white">
        <?php include './content/header_base.html' ?>
        <title>site web</title>
    </head>
    <body>
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
            <h3>Explication</h3>

            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque voluptatem amet at molestias delectus exercitationem quo sit voluptas, provident maiores quaerat cum error consequuntur voluptatum quae soluta illum possimus aliquid.
            </p>
        </main>

        <!-- FOOTER -->
            <?php include './content/footer.html' ?>
        <!-- FOOTER -->
    </body>
</html>