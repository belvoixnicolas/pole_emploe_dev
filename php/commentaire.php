<?php
require_once('./php/connect.php');
require_once('./php/verif_img.php');
require_once('./php/note_etoil.php');

function commentaire($id) {
    $dbh = connect();

    $req=$dbh->prepare('SELECT note, description, date, nom, prenom, img FROM note INNER JOIN usser ON note.noter_par = usser.id WHERE note.id_usser = :id');
    $req->execute(array(':id' => $id));

    if ($req=$req->fetchAll()) {
        $liste = '';

        foreach ($req as $key => $value) {
            $liste .= 
            '<li>
                <div class=ident>
                    <img src="./src/profil/' . verif_img($value['img']) . '" alt="photo de ' . $value['nom'] . ' ' . $value['prenom'] . '" />
                    <span class="nom">' . $value['nom'] . ' ' . $value['prenom'] . '</span>
                    <span class="date">' . $value['date'] . '</span>
                </div>
                <div class="note">
                    <span>' . note_etoil($value['note']) . '</span>
                    <p>
                        ' . $value['description'] . '
                    </p>
                </div>
            </li>';
        }

        return $liste;
    }else {
        return '<li class="nocomment">Il n\'y a pas de commentaire disponible</li>';
    }
}
?>