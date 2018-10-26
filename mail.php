<?php 
    require_once('./php/user.php');
    session_start();

    require_once('./php/connect.php');
    require_once('./php/secu_acces.php');
    require_once('./php/notif_error.php');
    require_once('./php/verif_img.php');

    autoris_acces(0);

    if (isset($_SESSION['idMail']) && $_SESSION['idMail']) {
        $dbh = connect();

        $mail = $dbh->prepare('SELECT sujet, text, mail.date AS mailDate, id_usser_recoi AS idRecoi, suprimer.date AS supDate, usser.nom, usser.prenom, usser.img FROM mail INNER JOIN usser ON usser.id = mail.id_usser LEFT JOIN suprimer ON mail.id = suprimer.id WHERE mail.id = :idmail');

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
        <main>
            <article class="info"> 
                <section classe="retour">
                    <a href="./boite_mail.php">
                        <i class="fas fa-reply"></i>
                    </a>
                </section>

                <section class="ident">
                    <img src="./src/profil/<?php echo verif_img($mail['img']); ?>" alt="photo de <?php echo $mail['nom'] . ' ' . $mail['prenom']; ?>">
                    <span class="nom"><?php echo $mail['nom'] . ' ' . $mail['prenom']; ?></span>
                </section>

                <section class="date">
                    <span class="date"><?php echo $mail['mailDate'] ?></span>
                </section>
            </article>

            <article class="corp">
                <section class="sujet">
                    <p>
                        <?php echo $mail['sujet']; ?>
                    </p>
                </section>

                <section class="text">
                    <p>
                        <?php echo $mail['text']; ?>
                    </p>
                </section>
            </article>

            <article class="boutton">
                <section class="repondre">
                    <button>
                        <i class="fas fa-envelope-open"></i>
                        <span>Repondre</span>
                    </button>
                </section>

                <section class="suprimer">
                    <button>
                        <i class="fas fa-trash"></i>
                        <span>Suprimer</span>
                    </button>
                </section>
            </article>
        </main>
    </body>
  </html>