<?php
    function autoris_acces($role=0) {
        if (isset($_SESSION['user']) && $_SESSION['user']->get('role') != 0 && $_SESSION['user']->get('role') < 4 && $role == 0) {
            return true;
        }elseif (isset($_SESSION['user']) && $role != $_SESSION['user']->get('role')) {
            header('Location: index.php?action=deco');
        }elseif (isset($_SESSION['user']) == false) {
            header('Location: index.php?action=deco');
        }
    }
?>