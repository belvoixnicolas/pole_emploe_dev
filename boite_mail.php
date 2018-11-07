<?php 
    require_once('./php/user.php');
    session_start();

    require_once('./php/connect.php');
    require_once('./php/secu_acces.php');
    require_once('./php/notif_error.php');
    require_once('./php/envoie_mail.php');

    autoris_acces(0);

    $_SESSION['id'] = $_SESSION['user']->get('id');
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
        <meta name="theme-color" content="white">
        <?php include './content/header_base.html' ?>
        <title>Mail</title>
    </head>
    <body id="mail">
    <?php echo notif_error($errors); ?>
        <!-- nav --> 
            <?php include './content/nav.php' ?>
        <!-- nav -->

        <!-- SOUS-NAV -->
            <?php include './content/sous_nav_mail.php' ?>
        <!-- SOUS-NAV -->

        <!-- MAIN -->
            <?php 
                if (isset($_GET['section'])) {
                    switch ($_GET['section']) {
                        case 'reception':
                            include './content/mail_reception.php';
                            break;

                        case 'envoie':
                            include './content/mail_envoier.php';
                            break;
                        
                        default:
                            include './content/mail_reception.php';
                            break;
                    }
                }else {
                    include './content/mail_reception.php';
                }
            ?>
        <!-- MAIN -->
        
        <!-- FOOTER -->
        <?php include './content/footer.html' ?>
        <!-- FOOTER -->
    </body>
  </html>