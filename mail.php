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

        $mail = $dbh->prepare('SELECT lu.date AS luDate, mail.id AS idMail, sujet, text, mail.date AS mailDate, id_usser_recoi AS idRecoi, suprimer.date AS supDate, usser.id AS usserId, usser.nom, usser.prenom, usser.img FROM mail INNER JOIN usser ON usser.id = mail.id_usser LEFT JOIN suprimer ON mail.id = suprimer.id LEFT JOIN lu ON mail.id = lu.id  WHERE mail.id = :idmail');

        $mail->execute(array(':idmail' => $_SESSION['idMail']));

        if ($mail=$mail->fetch()) {
            unset($_SESSION['idMail']);
            if ($mail['supDate'] != NULL) {
                $_SESSION['error'][] = 'Le mail a étais suprimer';
                header('Location: ./boite_mail.php');
            }else {
                $_SESSION['id'] = $_SESSION['user']->get('id');
                $_SESSION['mailid'] = $mail['idMail'];

                if ($mail['luDate'] == NULL) {
                    $lu = $dbh->prepare('INSERT INTO lu (id, id_usser, date) VALUES (:idmail, :iduser, :date)');

                    $donner = array (
                        ':idmail' => $mail['idMail'],
                        ':iduser' => $_SESSION['user']->get('id'),
                        ':date' => date('Y-m-d H:i:s')
                    );

                    $lu->execute($donner);
                }
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
    <body id="viewmail">
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
                    <a href="./profil.php?id=<?php echo $mail['usserId']; ?>">
                        <img src="./src/profil/<?php echo verif_img($mail['img']); ?>" alt="photo de <?php echo $mail['nom'] . ' ' . $mail['prenom']; ?>">
                        <span class="nom"><?php echo $mail['nom'] . ' ' . $mail['prenom']; ?></span>
                    </a>
                </section>

                <section class="date">
                    <span class="date">
                        <?php 
                            $date = explode('-', explode(' ', $mail['mailDate'])[0]);
                            $date = $date[2] . ' / ' . $date[1] . ' / ' .$date[0];
                            echo $date;
                        ?>
                    </span>
                </section>
            </article>

            <article class="corp">
                <section class="sujet">
                    <h2>
                        <?php echo ucfirst($mail['sujet']); ?>
                    </h2>
                </section>

                <section class="text">
                    <p>
                        <?php echo $mail['text']; ?>
                    </p>
                </section>

                <?php 
                    $resources = $dbh->prepare('SELECT lien FROM resource WHERE id_mail = :idmail');
                    $resources->execute(array(
                        ':idmail' => $mail['idMail']
                    ));

                     if ($resources=$resources->fetchAll()) { ?>
                        <section class="piecejoin">
                            <ul>
                                <?php
                                    $li = '';
                                    foreach ($resources as $row => $resource) {
                                        $li .= "
                                            <li>
                                                <a href=\"./src/mail/{$resource['lien']}\" target=\"_blank\">
                                                    <span>
                                                        {$resource['lien']}
                                                    </span>
                                                </a>
                                            </li>
                                        ";
                                    }

                                    echo $li;
                                ?>
                            </ul>
                        </section>
                <?php    } ?>
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
        <!-- FOOTER -->
            <?php include './content/footer.html' ?>
        <!-- FOOTER -->
    </body>
    <script src="./js/lien.js"></script>
    <script src="./js/ajax/sup_mail_view_mail.js"></script>
  </html>