<?php
    require_once('./php/connect.php');

    function uploid($file,$type,$id=false) {
        if ($file['error'] > 0) {
            return false;
        }
        $dbh = connect();
        switch ($type) {
            case 'mail':
                $maxsize = 50000000;
                $extensions = array('pdf', 'PDF', 'jpg', 'jpeg', 'JPG', 'JPEG', 'gif', 'GIF', 'png', 'PNG');
                $chemin = 'src/mail/';
                $evoi_nom_img = $dbh->prepare("INSERT INTO `resource` (`id`, `lien`, `id_mail`) VALUES (NULL, :nom, :id)");
                if ($id == false) {
                    return false;
                }
                break;
            
            default:
                return false;
                break;
        }
        if ($file['size'] > $maxsize) {
            return false;
        }
        $extension_uplod = strtolower(substr(strrchr($file['name'], '.') ,1));
        if (in_array($extension_uplod, $extensions)) {
            $nom = md5(uniqid(rand(), true)). '.' .$extension_uplod;
            $chemin = $chemin.$nom;
            
            $result = move_uploaded_file($file['tmp_name'],$chemin);
            if ($result) {
                switch ($type) {
                    case 'mail':
                        if ($evoi_nom_img->execute(array(':nom' => $nom, ':id' => $id))) {
                            return true;
                        }else {
                            return false;
                        }
                        break;
                    
                    default:
                        return false;
                        break;
                }
            }else {
                return false;
            }
        }else {
            return false;
        }
    }
?>