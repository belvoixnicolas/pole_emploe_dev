<?php 
    require_once('./php/user.php');
    
     
    session_start();

    require_once('./php/connect.php');
    require_once('./php/secu_acces.php');
    require_once('./php/notif_error.php');
    require_once('./php/verif_img.php');
    require_once('./php/commentaire.php');
    require_once('./php/liste_code.php');
    require_once('./php/envoie_mail.php');

    autoris_acces();

    if (isset($_GET['id']) == false) {
        header('Location: index.php');
    }

    $dbh = connect();

    $vuenotif = $dbh->prepare('UPDATE notification SET vu = "1" WHERE type = "profil" AND id_usser = :iduser');

    $vuenotif->execute(array(
        ':iduser' => $_SESSION['user']->get('id')
    ));

    $user = $dbh->prepare('SELECT nom, prenom, derniere_connexion, img, verif, role, ville FROM usser INNER JOIN ville ON usser.id_ville = ville.id WHERE usser.id = :id');
    $user->execute(array(':id' => $_GET['id']));

    if ($user = $user->fetch()) {}else {
        $_SESSION['error'][] = 'Cette utilisateur n\'existe pas.';
        $_SESSION['error'][] = 'Cette utilisateur n\'existe pas.';
        switch ($_SESSION['user']->get('role')) {
            case '1':
                header('Location: dev.php');
                break;
            
            case '2':
                header('Location: pat.php');
                break;

            default:
                header('Location: index.php');
                break;
        }
    }

    ///// NOTE /////
    $note = $dbh->prepare('SELECT note FROM note WHERE id_usser = :id');
    $note->execute(array(':id' => $_GET['id']));

    if ($note=$note->fetchAll()) {
        $nbnote = count($note);

        $calcul = 0;
        foreach ($note as $row) {
            $calcul = $calcul + $row['note'];
        }

        $note = round($calcul / $nbnote, 1);
    }else {
        $note = 'NULL';
    }
    ///// NOTE /////

    $date = explode(' ',$user['derniere_connexion']);
    $date = explode('-', $date[0]);
    $date = $date[2] . ' / ' . $date[1] . ' / ' . $date[0];

    if (isset($_POST['sujet']) && $_POST['sujet'] != '') {
        envoie_mail($_POST['sujet'], $_POST['text'], $_GET['id']);
    }
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
         
        <?php include './content/header_base.html' ?>
         
    </head>
    <body id="profil">
    <?php echo notif_error($errors); ?>
        <!-- nav --> 
            <?php include './content/nav.php' ?>
        <!-- nav -->

        <main>
            <!-- IDENT -->
            <article class="identite">
                <?php if ($user['verif'] == 1) { ?>
                    <span id="verif">
                        <i class="fas fa-award"></i>
                        <span>
                            v
                        </span>
                    </span>
                <?php } ?>

                <section class="photo">
                    <img src="./src/profil/<?php echo verif_img($user['img']); ?>" alt="Photo de <?php echo $user['nom'] . ' ' . $user['prenom']; ?>">
                    <p class="note">
                        <span><?php echo $note; ?></span>/5
                    </p>
                </section>
                <section class="nom">
                    <h1>
                        <?php echo $user['nom'] . ' ' . $user['prenom']; ?>
                    </h1>
                </section>

                <!-- SI AUTRE UTILISATEUR QUE CONECTER -->
                    <?php if ($_GET['id'] == $_SESSION['user']->get('id')) { ?>
                        <section class="signaler">
                            <p>
                                <i class="fas fa-user-cog"></i>
                                <span>Modifier le profil</span>
                            </p>
                        </section>
                    <?php }else { ?>
                        <section class="modif">
                            <p>
                                <i class="fas fa-exclamation-triangle"></i>
                                <span>Signaler</span>
                                
                            </p>
                        </section>
                    <?php } ?>
                <!-- SI AUTRE UTILISATEUR QUE CONECTER -->
            </article>
            <!-- IDENT -->

            <!-- ENTREPRISE SI PAT -->
                <?php 
                    if ($user['role'] == 2) {
                        $entreprise = $dbh->prepare('SELECT nom, description, img, ville FROM entreprise INNER JOIN ville ON entreprise.id_ville = ville.id WHERE id_usser = :id');
                        $entreprise->execute(array(':id' => $_GET['id']));

                        if ($entreprise=$entreprise->fetch()) { ?>
                            <article class="entreprise">
                                <h3>entreprise</h3>

                                <section>
                                    <p class="nom_ent">
                                        <?php echo $entreprise['nom']; ?>
                                    </p>

                                    <p class="descript">
                                        <?php echo $entreprise['description'] ; ?>
                                    </p>
                                
                                    <p class="ville_ent">
                                        <a href="https://www.google.com/maps/place/08000+<?php echo mb_strtolower($entreprise['ville']); ?>" target="_blank">
                                            <?php echo mb_strtolower($entreprise['ville']); ?>
                                        </a>
                                    </p>

                                    <?php if ($entreprise['img'] != '') { ?>
                                        <div class="img" style="background-image: url('./src/entreprise/<?php echo $entreprise['img'] ?>');"></div>
                                    <?php }else { ?>
                                        <div class="img"></div>
                                    <?php } ?>
                                </section>
                            </article>
                        <?php }else { ?>
                            <article class="entreprise">
                                <p>
                                    Une erreur empéche d'afficher cette partie
                                </p>
                            </article>
                        <?php }
                    }
                ?>
            <!-- ENTREPRISE SI PAT -->

            <!-- COMMENTAIRE -->
            <article class="commentaire" id="commentaire">
                <h3>Commentaire</h3>

                <ul>
                    <?php echo commentaire($_GET['id']); ?>
                </ul>
            </article>
            <!-- COMMENTAIRE -->

            <!-- CODE CONNUE SI DEV -->
            <?php if ($user['role'] == 1) { ?>
            <article class="code">
                <h3>Compétence</h3>
                <ul>
                    <?php echo liste_code($_GET['id'], $_SESSION['user']->get('id')); ?>

                    <!-- SI ID = CONNECT -->
                        <?php if ($_GET['id'] == $_SESSION['user']->get('id')) { ?>
                            <li class="add">
                                <i class="fas fa-plus"></i>
                                <span>ajouter</span>
                            </li>
                        <?php } ?>
                    <!-- SI ID = CONNECT -->
                </ul>
            </article>
            <?php } ?>
            <!-- CODE CONNUE SI DEV -->
        </main>
        
        
        <!-- FOOTER -->
        <?php include './content/footer.php' ?>
        <!-- FOOTER -->

        <div id="dernco">
            <span>
                <span class="phrase">
                Derniére connexion : 
                </span>
                
                <?php echo $date; ?>
            </span>
        </div>

        <?php if ($_GET['id'] != $_SESSION['user']->get('id')) { ?>
            <div id="mail">
                <span class="<?php echo $_SESSION['user']->get('id'); ?>">
                    <i class="fas fa-envelope-open"></i>
                </span>

                <?php include './content/form_mail.php'; ?>
            </div> 
        <?php } ?>
    </body>
    
    <script src="./js/mailprofil.js"></script>
    <script src="./js/ajax/evoie_mail.js"></script>

    <?php if ($_GET['id'] == $_SESSION['user']->get('id')) { ?>
        <script src="./js/ajax/form_code.js"></script>
    <?php } ?>
  </html>