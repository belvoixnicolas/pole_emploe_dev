<?php
    require_once('./php/connect.php');

    $dbh = connect();

    $listeMail = $dbh->prepare('SELECT mail.id, sujet, mail.date, mail.id_usser, lu.date FROM mail LEFT JOIN lu ON mail.id = lu.id WHERE id_usser_recoi = :id');

    $listeMail->execute(array(':id' => $_SESSION['user']->get('id')));

    if ($listeMail=$listeMail->fetchAll()) {
        $listeMailHtml = '';

        foreach ($listeMail as $row => $mail) {
            $listeMailHtml .= '<li>' . $row . ' | ' . $mail['date'] . '</li>';
        }
    }
?>
<main id="reception">
    <h1>Boite de reception</h1>

    <ul class="listeMail">
        <?php echo $listeMailHtml; ?>
    </ul>
</main>