<?php
require_once('./php/connect.php');
require_once('./php/verif_img.php');
require_once('./php/note_etoil.php');

function commentaire($id) {
    $dbh = connect();

    $req=$dbh->prepare('SELECT note, description, date, nom, prenom, img FROM note INNER JOIN usser ON note.noter_par = usser.id WHERE note.id_usser = :id ORDER BY note.id DESC');
    $req->execute(array(':id' => $id));

    if ($req=$req->fetchAll()) {
        $liste = '';

        foreach ($req as $key => $value) {
            $liste .= 
            '<li>
                <img src="./src/profil/' . verif_img($value['img']) . '" alt="photo de ' . $value['nom'] . ' ' . $value['prenom'] . '" />
                <span class="nom">' . $value['nom'] . ' ' . $value['prenom'] . '</span>
                <span class="date">' . str_replace('-', ' / ', $value['date']) . '</span>
                <span class="note">' . note_etoil($value['note']) . '</span>
                <p class="com">
                    ' . $value['description'] . '
                </p>
            </li>';
        }

        return $liste;
    }else {
        return '<li class="nocomment">Il n\'y a pas de commentaire disponible</li>';
    }
}
?>