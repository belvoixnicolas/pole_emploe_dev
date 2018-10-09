<?php
require_once('./php/connect.php');

class offre {
    public function creat($titre, $descript=false, $temp=false, $prix=false, $id) {   
        $dbh = connect();

        $id_entre = $dbh->prepare('SELECT id FROM entreprise WHERE id_usser = :id');
        
        if ($id_entre->execute(array(':id' => $id))) {

            $id_entre = $id_entre->fetch();

            $ajout = $dbh->prepare('INSERT INTO `offre_emploie` (`id`, `titre`, `description`, `temp`, `date`, `id_entreprise`, `id_usser`, `prix`) VALUES (NULL, :titre, :text, :temp, :date, :entreprise, NULL, :prix)');

            if ($descript == false) {
                $descript = '';
            }

            if ($temp == false) {
                $temp = '';
            }

            if ($prix == false) {
                $prix = '';
            }

            $date = date('Y-m-d H:i:s');

            $ajout->execute(array(
                ':titre' => $titre,
                ':text' => $descript,
                ':temp' => $temp,
                ':date' => $date,
                ':entreprise' => $id_entre[0],
                ':prix' => $prix
            ));
        }else {
            return false;
        }
    }

    public function postule($id_user, $id_offre) {
        $dbh = connect();
        $postule = $dbh->prepare('INSERT INTO `postule` (`id`, `id_usser`) VALUES (:idoffre, :idusser)');

        if ($postule->execute(array(':idoffre' => $id_offre, ':idusser' => $id_user))) {
            return true;
        }else {
            return false;
        }
    }

    public function engage($id_user, $id_offre) {
        $dbh = connect();

        $engage = $dbh->prepare('UPDATE offre_emploie SET id_usser = :id_usser WHERE id = :id_offre');

        if ($engage->execute(array(':id_usser' => $id_user, ':id_offre' => $id_offre))) {
            return TRUE;
        } else {
            return false;
        }
        
    }
}

$offre = new offre;
?>