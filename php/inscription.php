<?php
    if (isset($_GET['form'])) {
        if ($_POST['nom'] != '' && $_POST['prenom'] != '' && $_POST['naissance'] != '' && $_POST['ville'] != 'none' && $_POST['mail'] != '' && $_POST['verif_mail'] != '' && $_POST['mdp'] != '' && $_POST['verif_mdp']) {
            $dbh = connect();
            $req = $dbh->prepare('SELECT id FROM ville WHERE ville = :ville');
            $req->execute(array(':ville' => html_entity_decode($_POST['ville'])));
            $req = $req->fetch();
            $id_ville = $req[0];
            
            $date = explode('-', $_POST['naissance']);
            $age = date('Y') - $date[0];
            if ($date[1].$date[2] >= date('md')) {
                $age--;
            }

            if ($age >= 18) {
                $date_nai = $_POST['naissance'];
            }

            if ($_POST['mail'] == $_POST['verif_mail']) {
                $mail = $_POST['mail'];
            }

            if ($_POST['mdp'] == $_POST['verif_mdp']) {
                $salt = hash('md5', $_SERVER['REQUEST_TIME']);
                $mdp = hash('sha512', $salt.$_POST['mdp']);
            }

            if ($_GET['form'] == 'dev') {
                $req = $dbh->prepare("INSERT INTO `usser` (`id`, `nom`, `prenom`, `date_naissance`, `date_creation`, `date_modif`, `derniere_connexion`, `mail`, `salt`, `mot_de_passe`, `img`, `verif`, `role`, `id_ville`) VALUES (NULL, :nom, :prenom, :date, :datecrea, :datemod, :dateco, :mail, :salt, :mdp, '', '0', '1', :id)");
                $date = date('Y-m-d H:i:s');

                if ($req->execute(array('nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'date' => $date_nai, 'datecrea' => $date, 'datemod' => $date, 'dateco' => $date, 'mail' => $mail, 'salt' => $salt, 'mdp' => $mdp, 'id' => $id_ville))) {
                    $_SESSION['user'] = ident($mail, $_POST['mdp']);
                    header('Location: dev.php');
                }
            }elseif ($_GET['form'] == 'pat' && $_POST['entreprise'] != '') {
                $req = $dbh->prepare("INSERT INTO `usser` (`id`, `nom`, `prenom`, `date_naissance`, `date_creation`, `date_modif`, `derniere_connexion`, `mail`, `salt`, `mot_de_passe`, `img`, `verif`, `role`, `id_ville`) VALUES (NULL, :nom, :prenom, :date, :datecrea, :datemod, :dateco, :mail, :salt, :mdp, '', '0', '2', :id)");
                $date = date('Y-m-d H:i:s');

                if ($req->execute(array('nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'date' => $date_nai, 'datecrea' => $date, 'datemod' => $date, 'dateco' => $date, 'mail' => $mail, 'salt' => $salt, 'mdp' => $mdp, 'id' => $id_ville))) {
                    $reqid = $dbh->prepare('SELECT id FROM usser WHERE salt = :salt AND mail = :mail');
                    $reqid->execute(array('salt' => $salt, 'mail' => $mail));
                    $reqid = $reqid->fetch();
                    $iduser = $reqid[0];

                    $req = $dbh->prepare("INSERT INTO `entreprise` (`id`, `nom`, `description`, `id_usser`, `id_ville`) VALUES (NULL, :nom, '', :iduser, :idville)");
                    
                    if ($req->execute(array('nom' => $_POST['entreprise'], 'iduser' => $iduser, 'idville' => $id_ville))) {
                        $_SESSION['user'] = ident($mail, $_POST['mdp']);
                        header('Location: pat.php');
                    }
                }
            }
        }else {
            echo 'false';

        }
    }
?>