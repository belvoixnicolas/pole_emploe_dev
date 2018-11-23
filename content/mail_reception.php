<?php
    require_once('./php/connect.php');
    require_once('./php/liste_mail.php');

    if (isset($_GET['id']) && $_GET['id'] != '') {
        $_SESSION['idMail'] = $_GET['id'];
        header('Location: ./mail.php');
        exit();
    }

    $dbh = connect();
    $vuemail = $dbh->prepare('UPDATE notification SET vu = 1 WHERE type = "mail" AND id_usser = :id');
    $vuemail->execute(array(':id' => $_SESSION['user']->get('id')));
?>
<main id="reception">
    <section>
        <ul class="listeMail">
            <?php 
                if ($mails=liste_mail($_SESSION['user']->get('id'))) {
                    echo $mails;
                }else {
                    echo '<li class="error">Une erreur c\'est produit</li>';
                } 
            ?>
        </ul>
    </section>
</main>
<script src="./js/ajax/sup_mail.js"></script>