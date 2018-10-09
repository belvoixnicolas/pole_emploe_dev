<?php
    require_once('./php/user.php');
    session_start();

    require_once('./php/noter.php');

    if (isset($_POST['note']) && isset($_POST['text'])) {
        noter($_POST['note'], $_POST['text'], $_SESSION['user']->get('id'), 5);
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
        <?php 
            include './content/form_note.php';
        ?>
    </body>
  </html>