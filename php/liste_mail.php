<?php 
    require_once($_SERVER['DOCUMENT_ROOT'] . '/pole_emploe_dev/php/connect.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/pole_emploe_dev/php/verif_img.php');

    function liste_mail($id = null) {
        if ($id != null) {
            $dbh = connect();

            $listeMail = $dbh->prepare('SELECT suprimer.date AS test, usser.id AS userId, nom, prenom, img, mail.id, sujet, mail.date AS mailDate, mail.id_usser, lu.date AS luDate FROM mail LEFT JOIN lu ON mail.id = lu.id INNER JOIN usser ON mail.id_usser = usser.id LEFT JOIN suprimer ON mail.id = suprimer.id WHERE id_usser_recoi = :id AND suprimer.date IS NULL ORDER BY mail.date DESC');

            $listeMail->execute(array(':id' => $id));

            if ($listeMail=$listeMail->fetchAll()) {
                $listeMailHtml = '';

                foreach ($listeMail as $row => $mail) {
                    if ($mail['luDate'] == null) {
                        $class = 'class="new"';
                    }else {
                        $class = '';
                    }

                    $img = verif_img($mail['img']);
                    $date = explode('-', explode(' ', $mail['mailDate'])[0]);
                    $date = $date[2] . ' / ' . $date[1] . ' / ' .$date[0];

                    $listeMailHtml .= "
                        <li {$class}>
                            <div class=\"ident\">
                                <a href=\"./profil.php?id={$mail['userId']}\">
                                    <img src=\"./src/profil/{$img}\" alt=\"Photo de {$mail['nom']} {$mail['prenom']}\" />
                                    <span class=\"nom\">
                                        {$mail['nom']} {$mail['prenom']}
                                    </span>
                                </a>
                            </div>
                            <div class=\"sujet\">
                                <a href=\"./boite_mail.php?section=reception&id={$mail['id']}\">
                                    <span>
                                        {$mail['sujet']}
                                    </span>
                                </a> 
                            </div>
                            <div class=\"date_sup\">
                                <span class=\"date\">
                                    {$date}
                                </span>
                                <span class=\"poubelle\" id=\"{$mail['id']}\">
                                    <i class=\"fas fa-trash\"></i>
                                </span>
                            </div>
                        </li>";
                }

                return $listeMailHtml;
            }else {
                return false;
            }
        }else {
            return false;
        }
    }
?>