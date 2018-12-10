<?php
    require_once('./php/connect.php');
    require_once('./php/uploid.php');

    function envoie_mail($sujet, $text='', $idrecois) {
        if ($sujet != '' && $idrecois != '') {
            $dbh = connect();
            $envoie = $dbh->prepare('INSERT INTO `mail` (`sujet`, `text`, `date`, `id_usser`, `id_usser_recoi`) VALUES (:sujet, :text, :date, :idenvoie, :idrecoi)');
            
            if ($envoie->execute(array(':sujet' => $sujet, ':text' => nl2br(htmlspecialchars($text)), ':date' => date('Y-m-d H:i:s'), ':idenvoie' => $_SESSION['user']->get('id'), ':idrecoi' => $idrecois))) {
                $notif = $dbh->prepare("INSERT INTO `notification` (`type`, `date`, `id_usser`) VALUES ('mail', :date, :id)");
                $notif->execute(array(':date' => date('Y-m-d H:i:s'), ':id' => $idrecois));


                if (isset($_FILES['join']) && $_FILES['join']['name'][0] != '') {
                    $id_mail = $dbh->prepare('SELECT id FROM mail WHERE id_usser = :idenvoie AND id_usser_recoi = :idrecoi');
                    $id_mail->execute(array(':idenvoie' => $_SESSION['user']->get('id'), ':idrecoi' => $_GET['id']));
                    if ($id_mail = $id_mail->fetchAll()) {
                        $id_mail = $id_mail[count($id_mail) - 1]['id'];

                        $er = 0;
                        for ($i=0; $i < count($_FILES['join']['name']); $i++) { 
                            $fichier = array(
                                'name' => $_FILES['join']['name'][$i],
                                'type' => $_FILES['join']['type'][$i],
                                'tmp_name' => $_FILES['join']['tmp_name'][$i],
                                'error' => $_FILES['join']['error'][$i],
                                'size' => $_FILES['join']['size'][$i]
                            );
                    
                            if (uploid($fichier, 'mail', $id_mail) == false) {
                                $er++;
                            }
                        }

                        if ($er == 0) {
                            return true;
                        } else {
                            return false;
                        }
                        
                    }else {
                        return false;
                    }
                }else {
                    return true;
                }
            }else {
                return false;
            }
        }else {
            return false;
        }
    }
?>