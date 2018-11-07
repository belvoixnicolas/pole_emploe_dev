<?php
    function section ($lien) {
        if (isset($_GET['section'])) {
            $section = $_GET['section'];
        } else {
            $section = null;
        }
        
        if ($lien == $section) {
            return 'class="focus"';
        } else {
            return false;
        }
    }
?>

<nav class="sousnavmail">
    <ul>
        <li <?php echo section('reception') ?>>
            <a href="./boite_mail.php?section=reception">
                <i class="fas fa-inbox"></i>
                <span>
                    Boite de reception
                </span>
            </a>
        </li>
        <li <?php echo section('envoie') ?>>
            <a href="./boite_mail.php?section=envoie">
                <i class="fas fa-pencil-alt"></i>
                <span>
                    Envoyer un message
                </span>
            </a>
        </li>
    </ul>
</nav>