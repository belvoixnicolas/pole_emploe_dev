<?php
    require('user.php');

    if (isset($_POST['mail']) && isset($_POST['mdp']) && isset($_GET['form']) && $_GET['form'] == 'ident') {
        $_SESSION['user'] = ident($_POST['mail'], $_POST['mdp']);
        
        $dbh = connect();
        $req = $dbh->prepare('UPDATE usser SET derniere_connexion = :date WHERE id = :id');

        if ($req->execute(array(':date' => date('Y-m-d H:i:s'), ':id' => $_SESSION['user']->get('id')))) {
            switch ($_SESSION['user']->get('role')) {
                case '1':
                    header('Location: dev.php');
                    break;

                case '2':
                    header('Location: pat.php');
                    break;
            }
        }
    }

    function ident($mail, $mdp) {
        $dbh = connect();

        $req = $dbh->prepare('SELECT id, mail, salt, mot_de_passe, role FROM usser WHERE mail = :mail');
        $req->execute(array('mail' => $mail));

        foreach ($req as $user) {
            $mdp_secu = hash('sha512', $user['salt'].$mdp);

            if ($user['mot_de_passe'] == $mdp_secu) {
                $id = $user['id'];
                $role = $user['role'];
            }else{
                return 'Compte inexistant';
            }
        }

        if (isset($id) && isset($role)) {
            $utilisateur = new Utilisateur;
            $utilisateur->init($id);

            return $utilisateur;
        }
    }
?>