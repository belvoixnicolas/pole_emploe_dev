<?php
function verif_img($img) {
    if ($img == '') {
        return 'default.jpg';
    }elseif (file_exists('./src/profil/' . $img) == false) {
        return 'default.jpg';
    }else {
        return $img;
    }
}
?>