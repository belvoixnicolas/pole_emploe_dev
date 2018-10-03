<?php
    function autoris_acces($role) {
        if (isset($_SESSION['user']) && $role != $_SESSION['user']->get('role')) {
            header('Location: index.php?action=deco');
        }else {
            header('Location: index.php?action=deco');
        }
    }
?>