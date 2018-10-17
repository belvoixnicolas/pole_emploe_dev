<?php
require_once('./php/connect.php');

function liste_code($id) {
    $dbh = connect();

    $codes = $dbh->prepare('SELECT code, img, note FROM savoir INNER JOIN code ON savoir.id = code.id WHERE id_usser = :id ORDER BY note DESC, code');
    $codes->execute(array(':id' => $id));

    if ($codes=$codes->fetchAll()) {
        $liste_code = "";

        foreach ($codes as $key => $value) {
            $liste_code .= 
            '<li>
                <div>
                    <img src="./src/langague/' . $value['img'] . '" alt="Logo de ' . $value['code'] . '" />
                    <span>' . $value['note'] . '/10</span>
                </div>

                <span>' . $value['code'] . '</span>
            </li>';
        }

        return $liste_code;
    }else {
        return '<li class="nocode">Je n\'est pas encore renseigner mes niveaux de code</li>';
    }
}
?>