<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/pole_emploe_dev/php/connect.php');

function liste_code($id, $id_co = null) {
    $dbh = connect();

    $codes = $dbh->prepare('SELECT savoir.id, code, img, note FROM savoir INNER JOIN code ON savoir.id = code.id WHERE savoir.id_usser = :id ORDER BY note DESC, code');
    $codes->execute(array(':id' => $id));

    if ($codes=$codes->fetchAll()) {
        $liste_code = "";

        foreach ($codes as $key => $value) {
            if ($id_co == $id) {
                $liste_code .= '<li class="element_code">
                                    <span id="supCode" class="' . $value['id'] . '">
                                        <i class="fas fa-times"></i>
                                    </span>

                                    <div>
                                        <img src="./src/langague/' . $value['img'] . '" alt="Logo de ' . $value['code'] . '" />
                                        <span>' . $value['note'] . '/10</span>
                                    </div>

                                    <span>' . $value['code'] . '</span>
                                </li>';
            }else {
                $liste_code .= '<li class="element_code">
                                    <div>
                                        <img src="./src/langague/' . $value['img'] . '" alt="Logo de ' . $value['code'] . '" />
                                        <span>' . $value['note'] . '/10</span>
                                    </div>

                                    <span>' . $value['code'] . '</span>
                                </li>';
            }
            
        }

        return $liste_code;
    }elseif ($id_co == null || $id_co != $id) {
        return '<li class="nocode">Je n\'est pas encore renseigner mes niveaux de code</li>';
    }
}
?>