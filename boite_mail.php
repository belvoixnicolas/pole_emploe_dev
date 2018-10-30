<?php 
    require_once('./php/user.php');
    session_start();

    require_once('./php/connect.php');
    require_once('./php/secu_acces.php');
    require_once('./php/notif_error.php');

    autoris_acces(0);

    $_SESSION['id'] = $_SESSION['user']->get('id');
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
        <meta name="theme-color" content="white">
        <?php include './content/header_base.html' ?>
        <title>dev</title>
    </head>
    <body id="mail">
    <?php echo notif_error($errors); ?>
        <!-- nav --> 
            <?php include './content/nav.php' ?>
        <!-- nav -->

        <!-- MAIN -->
            <?php 
                if (isset($_GET['section'])) {
                    switch ($_GET['section']) {
                        case 'reception':
                            include './content/mail_reception.php';
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