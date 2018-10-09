<?php
        require_once('./php/user.php');
        session_start();

        require_once('./php/offre.php');

   if (isset($_GET['test'])) {
       $offre->engage($_SESSION['user']->get('id'), 5);
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
        <a href="?test=5">Click ici</a>
    </body>
  </html>