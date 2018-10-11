<?php 
    require_once('./php/user.php');
    session_start();

    require_once('./php/connect.php');
    require_once('./php/secu_acces.php');
    require_once('./php/notif_error.php');

    autoris_acces();

    if (isset($_GET['id']) == false) {
        header('Location: index.php');
    }

    $dbh = connect();

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

    if ($user['img'] == '') {
        $user['img'] = 'default.jpg';
    }elseif (file_exists('./src/profil/' . $user['img']) == false) {
        $user['img'] = 'default.jpg';
    }
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
        <meta name="theme-color" content="white">
        <?php include './content/header_base.html' ?>
        <title>Profil</title>
    </head>
    <body id="profil">
    <?php echo notif_error($errors); ?>
        <!-- nav --> 
            <?php include './content/nav.php' ?>
        <!-- nav -->

        <article class="identite">
            <section class="photo">
                <img src="./src/profil/<?php echo $user['img']; ?>" alt="Photo de <?php echo $user['nom'] . ' ' . $user['prenom']; ?>">
            </section>
        </article>
        
        <!-- FOOTER -->
        <?php include './content/footer.html' ?>
        <!-- FOOTER -->
    </body>
  </html>