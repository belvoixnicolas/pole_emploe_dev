<?php
     
    session_start();

    require_once('connect.php');
    require_once('user.php');

    if (isset($_POST['nom'], $_POST['prenom'], $_POST['naissance'], $_POST['ville'], $_POST['mail'], $_POST['verif_mail'], $_POST['mdp'], $_POST['verif_mdp']) && $_POST['nom'] != '' && $_POST['prenom'] != '' && $_POST['naissance'] != '' && $_POST['ville'] != '' && $_POST['mail'] != '' && $_POST['verif_mail'] != '' && $_POST['mdp'] != '' && $_POST['verif_mdp'] != '') {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $naissance = $_POST['naissance'];
        $ville = $_POST['ville'];
        $mail = $_POST['mail'];
        $verifmail = $_POST['verif_mail'];
        $mdp = $_POST['mdp'];
        $verifmdp = $_POST['verif_mdp'];

        if ($mail != $verifmail) {
            $_SESSION['error'][] = 'adresse mail ne sont pas identique'; 
            header('Location: ../index.php');
            exit();
        }

        if ($mdp != $verifmdp) {
            $_SESSION['error'][] = 'Les mots de passe ne sont pas identique'; 
            header('Location: ../index.php');
            exit();
        }

        $date = explode('-', $naissance);
        $date = $date[0] . $date[1] . $date[2];
        $dateactu = date('Ymd');

        $age = str_split($dateactu - $date, 2)[0];

        if ($age < 18) {
            $_SESSION['error'][] = 'Vous éte trop jeune pour vous inscrire, vous pouver revenir quand vous serai majeur'; 
            header('Location: ../index.php');
            exit();
        }

        if (strlen($nom) > 50) {
            $_SESSION['error'][] = 'Nous sommes désoler mais votre nom est trop long pour rentrer dans notre base de donner'; 
            header('Location: ../index.php');
            exit();
        }

        if (strlen($prenom) > 50) {
            $_SESSION['error'][] = 'Nous sommes désoler mais votre prénom est trop long pour rentrer dans notre base de donner'; 
            header('Location: ../index.php');
            exit();
        }

        if (strlen($mail) > 50) {
            $_SESSION['error'][] = 'Votre address mail est trop long'; 
            header('Location: ../index.php');
            exit();
        }

        $dbh = connect();
        $inscription = $dbh->prepare('INSERT INTO usser (nom, prenom, date_naissance, date_creation, date_modif, derniere_connexion, mail, salt, mot_de_passe, img, verif, role, id_ville) VALUES (:nom, :prenom, :naissance, :inscri, NULL, NULL, :mail, :salt, :mdp, NULL, 0, :role, :ville)');

        $salt = password_hash(time(), PASSWORD_DEFAULT);
        $mdp = hash('sha512', $salt.$mdp);

        if (isset($_GET['form']) && $_GET['form'] == 'pat') {
            if (isset($_POST['entreprise']) && $_POST['entreprise'] != '') {
                $projet = $_POST['entreprise'];

                if (strlen($projet) > 50) {
                    $_SESSION['error'][] = 'Le nom du projet ou de l\'entreprise est trop long'; 
                    header('Location: ../index.php');
                    exit();
                }
                
                $donner = array(
                    ':nom' => $nom,
                    ':prenom' => $prenom,
                    ':naissance' => $naissance,
                    ':inscri' => date('Y-m-d H:i:s'),
                    ':mail' => $mail,
                    ':salt' => $salt,
                    ':mdp' => $mdp,
                    ':role' => 2,
                    ':ville' => $ville
                );
    
                if ($inscription->execute($donner)) {
                    $lastid = $dbh->lastInsertId();
                    
                    $entreprise = $dbh->prepare('INSERT INTO entreprise (nom, description, img, id_usser, id_ville) VALUES (:projet, NULL, NULL, :id, :ville)');

                    $donner = array(
                        ':projet' => $projet,
                        ':id' => $lastid,
                        ':ville' => $ville
                    );

                    if ($entreprise->execute($donner)) {
                        $_SESSION['user'] = new Utilisateur;
                        $_SESSION['user']->init($lastid);

                        $req = $dbh->prepare('UPDATE usser SET derniere_connexion = :date WHERE id = :id');

                        if ($req->execute(array(':date' => date('Y-m-d H:i:s'), ':id' => $_SESSION['user']->get('id')))) {
                            header('Location: ../pat.php');
                        }
                    } else {
                        $_SESSION['error'][] = 'Le project n\'est pas creer, vous pourais le modifier dans votre profile'; 

                        $_SESSION['user'] = new Utilisateur;
                        $_SESSION['user']->init($lastid);

                        $req = $dbh->prepare('UPDATE usser SET derniere_connexion = :date WHERE id = :id');

                        if ($req->execute(array(':date' => date('Y-m-d H:i:s'), ':id' => $_SESSION['user']->get('id')))) {
                            header('Location: ../pat.php');
                        }
                    }
                    
                }else {
                    $_SESSION['error'][] = 'L\'inscription n\'a pas aboutie, merci de nous cantacter si le probléme persiste.'; 
                    header('Location: ../index.php');
                    exit();
                }
            }else {
                $_SESSION['error'][] = 'Vous aver oublier de nous renseigner le nom de votre projet'; 
                header('Location: ../index.php');
                exit();
            }
        }elseif (isset($_GET['form']) && $_GET['form'] == 'dev') {
            $donner = array(
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':naissance' => $naissance,
                ':inscri' => date('Y-m-d H:i:s'),
                ':mail' => $mail,
                ':salt' => $salt,
                ':mdp' => $mdp,
                ':role' => 1,
                ':ville' => $ville
            );

            if ($inscription->execute($donner)) {
                $lastid = $dbh->lastInsertId();
                
                $_SESSION['user'] = new Utilisateur;
                $_SESSION['user']->init($lastid);

                $req = $dbh->prepare('UPDATE usser SET derniere_connexion = :date WHERE id = :id');

                if ($req->execute(array(':date' => date('Y-m-d H:i:s'), ':id' => $_SESSION['user']->get('id')))) {
                    header('Location: ../dev.php');
                }
            }else {
                $_SESSION['error'][] = 'L\'inscription n\'a pas aboutie, merci de nous cantacter si le probléme persiste.'; 
                header('Location: ../index.php');
                exit();
            }
        }else {
            $_SESSION['error'][] = 'Vous utiliser un formulaire qui est buger, merci de me cantacter via le formulaire de cantact situer a la fin de la page'; 
            header('Location: ../index.php');
            exit();
        }
    }else {
        $_SESSION['error'][] = 'Des informations ont etait oublier'; 
        header('Location: ../index.php');
        exit();
    }
?>