<?php
    require_once('./php/user.php');
    session_start();

    require_once('./php/connect.php');
    require_once('./php/envoie_mail.php');

    $dbh = connect();
    $req = $dbh->prepare('SELECT * FROM mail WHERE id_usser_recoi = :id');
    $req->execute(array(':id' => 5));
    
    $notif = $dbh->prepare("INSERT INTO `notification` (`id`, `type`, `lien`, `date`, `id_usser`) VALUES (NULL, 'mail', 'machin', :date, :id)");
    foreach ($req->fetch() as $row) {
        $notif->execute(array(':date' => date('Y-m-d H:i:s'), ':id' => 5));
    }
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
        <meta name="theme-color" content="white">
        <?php include './content/header_base.html' ?>
        <title>dev</title>
    </head>
    <body>
       
    </body>
  </html>