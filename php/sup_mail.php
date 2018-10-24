<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/pole_emploe_dev/php/connect.php');

    function sup_mail($idMail = null, $iduser = null) {
        if ($idMail != null && $iduser != null) {
            $dbh = connect();

            $verif = $dbh->prepare('SELECT * FROM mail WHERE id = :idmail AND id_usser_recoi = :iduser');
            $verif->execute(array(':idmail' => $idMail, ':iduser' => $iduser));

            if ($verif=$verif->fetch()) {
                $supMail = $dbh->prepare('INSERT INTO suprimer (id, id_usser, date) VALUES (:idmail, :iduser, :date)');

                $donner = array(
                    ':idmail' => $idMail,
                    ':iduser' => $iduser,
                    ':date' => date('Y-m-d H:i:s')
                );

                if ($supMail->execute($donner)) {
                    return true;
                }else {
                    return false;
                }
            } else {
                return false;
            }
            
        } else {
            return false;
        }
        
    }
?>