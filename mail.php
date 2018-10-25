<?php 
    require_once('./php/user.php');
    session_start();

    require_once('./php/connect.php');
    require_once('./php/secu_acces.php');
    require_once('./php/notif_error.php');

    autoris_acces(0);

    if (isset($_SESSION['idMail']) && $_SESSION['idMail']) {
        $dbh = connect();

        $mail = $dbh->prepare('SELECT sujet, text, mail.date AS mailDate, id_usser_recoi AS idRecoi, suprimer.date AS supDate FROM mail LEFT JOIN suprimer ON mail.id = suprimer.id WHERE mail.id = :idmail');

        $mail->execute(array(':idmail' => $_SESSION['idMail']));

        if ($mail=$mail->fetch()) {
            if ($mail['supDate'] != NULL) {
                $_SESSION['error'][] = 'Le mail a étais suprimer';
                header('Location: ./boite_mail.php');
            }
        }else {
            $_SESSION['error'][] = 'Le mail n\'existe pas';
            header('Location: ./boite_mail.php');
        }
    }else {
        $_SESSION['error'][] = 'Vous n\'avais pas cliquer sur un lien d\'un mail';
        header('Location: ./boite_mail.php');
    }
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
        <meta name="theme-color" content="white">
        <?php include './content/header_base.html' ?>
        <title>dev</title>
    </head>
    <body id="viexmail">
    <?php echo notif_error($errors); ?>
        <!-- nav --> 
            <?php include './content/nav.php' ?>
        <!-- nav -->
    </body>
  </html>