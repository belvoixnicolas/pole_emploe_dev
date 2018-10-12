<?php
function note_etoil($note) {
    $i = 0;
    $etoile = '';
    while ($i != $note) {
        $etoile .= '<i class="fas fa-star"></i>';
        $i++;
    }

    while ($i != 5) {
        $etoile .= '<i class="far fa-star"></i>';
        $i++;
    }

    return $etoile;
}
?>