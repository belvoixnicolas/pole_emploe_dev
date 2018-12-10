<?php
//require_once($_SERVER['DOCUMENT_ROOT'] . '/pole_emploe_dev/php/connect.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/connect.php');

    function noter($note, $par, $pour, $comment=false) {
        if ($note != '' && $par > 0 && $pour >0) {
            $dbh = connect();
            $noter = $dbh->prepare('INSERT INTO `note` (`note`, `description`, `date`, `noter_par`, `id_usser`) VALUES (:note, :comment, :date, :par, :pour)');

            if (is_numeric($note) && $note <= 5) {
                if ($comment == false) {
                    $comment = '';
                }

                $date = date('d-m-Y');

                $noter->execute(array(
                    ':note' => $note,
                    ':comment' => nl2br(htmlspecialchars($comment)),
                    ':date' => $date,
                    ':par' => $par,
                    ':pour' => $pour
                ));

                return true;
            }else {
                return false;
            }
        }
    }
?>