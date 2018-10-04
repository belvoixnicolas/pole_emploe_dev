<?php
    require('./php/user.php');
    session_start();

    require('./php/connect.php');

    for ($i=0; $i < count($_FILES['join']['name']); $i++) { 
        $fichier = array(
            'name' => $_FILES['join']['name'][$i],
            'type' => $_FILES['join']['type'][$i],
            'tmp_name' => $_FILES['join']['tmp_name'][$i],
            'error' => $_FILES['join']['error'][$i],
            'size' => $_FILES['join']['size'][$i]
        );

        echo uploid($fichier, 'mail');
    }

    function uploid($file,$type,$id=false) {
        if ($file['error'] > 0) {
            return 'Erreur lors du transfert';
        }
        $dbh = connect();
        switch ($type) {
            case 'mail':
                $maxsize = 26214400;
                $extensions = array('pdf');
                $chemin = 'src/mail/';
                $evoi_nom_img = $dbh->prepare("INSERT INTO `resource` (`id`, `lien`, `id_mail`) VALUES (NULL, :nom, :id)");
                if ($id) {
                    return 'il manque une variable';
                }
                break;
            
            default:
                return 'le chemin est invalid';
                break;
        }
        if ($file['size'] > $maxsize) {
            return 'Le fichier est trop volumineu';
        }
        $extension_uplod = strtolower(substr(strrchr($file['name'], '.') ,1));
        if (in_array($extension_uplod, $extensions)) {
            $nom = md5(uniqid(rand(), true)). '.' .$extension_uplod;
            $chemin = $chemin.$nom;
            
            $result = move_uploaded_file($file['tmp_name'],$chemin);
            if ($result) {
                if ($evoi_nom_img->execute(array(':nom' => $nom, ':id' => $id))) {
                    return 'Le(s) fichier(s) sont envoier';
                }
            }else {
                return 'Le fichier n\'a pas étais envoier';
            }
        }else {
            return 'L\'extension n\'est pas autoriser';
        }
    }


    if (isset($_POST['sujet']) && isset($_POST['text']) && isset($_GET['id'])) {
        if ($_POST['sujet'] != '' && $_POST['text'] != '') {
            $dbh = connect();
            $envoie = $dbh->prepare('INSERT INTO `mail` (`id`, `sujet`, `text`, `date`, `id_usser`, `id_usser_recoi`) VALUES (NULL, :sujet, :text, :date, :idenvoie, :idrecoi)');
            
            if ($envoie->execute(array(':sujet' => $_POST['sujet'], ':text' => $_POST['text'], ':date' => date('Y-m-d H:i:s'), ':idenvoie' => $_SESSION['user']->get('id'), ':idrecoi' => $_GET['id']))) {
                if (isset($_POST['join']) && $_POST['join'] != '') {
                    $id_mail = $dbh->prepare('SELECT id MAX(date) FROM mail WHERE id_user = :idenvoie AND id_usser_recoi = :idrecoi');
                    
                }
            }
        }
    }
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
        <meta name="theme-color" content="white">
        <?php include './content/header_base.html' ?>
        <title>dev</title>
    </head>
    <body>
        <form action="<?php echo $_SERVER['REQUEST_URI']?>?id=5" method="post" enctype="multipart/form-data">
            <input type="text" name="sujet" placeholder="Sujet">
            <textarea name="text" placeholder="Text"></textarea>
            
                <label for="join"><i class="fas fa-file-upload"></i><span>Joindre un fichier</span></label>
                <input type="file" name="join[]" id="join" multiple class='hiden'>
            

            <input type="submit" value="Evoyer">
        </form>

        <script>
            
        </script>
    </body>
  </html>