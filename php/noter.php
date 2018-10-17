<?php
require_once('./php/connect.php');

    function noter($note, $comment=false, $par, $pour) {
        if ($note != '' && $par > 0 && $pour >0) {
            $dbh = connect();
            $noter = $dbh->prepare('INSERT INTO `note` (`id`, `note`, `description`, `date`, `noter_par`, `id_usser`) VALUES (NULL, :note, :comment, :date, :par, :pour)');

            if (is_numeric($note)) {
                if ($comment == false) {
                    $comment = '';
                }

                $date = date('d-m-Y');

                $noter->execute(array(
                    ':note' => $note,
                    ':comment' => $comment,
                    ':date' => $date,
                    ':par' => $par,
                    ':pour' => $pour
                ));
            }else {
                return false;
            }
        }
    }
?>