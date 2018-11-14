<?php
    function section ($lien) {
        $url = explode('/', $_SERVER['PHP_SELF']);
        $i = count($url);

        $fichier = explode('.', $url[--$i]);
        $fichier = $fichier[0];
        
        switch ($fichier) {
            case 'emploie':
                $page = 'emploie';
                break;

            case 'emploie_pris':
                $page = 'pris';
                break;
            
            default:
                $page = '';
                break;
        }

        if ($page == $lien) {
            return 'class="focus"';
        }else {
            return '';
        } 
    }
?>
<nav class="sousnavemploie">
    <ul>
        <li <?php echo section('emploie') ?>>
            <a href="./emploie.php">
                <i class="fas fa-building"></i>
                <span>
                    Mes offre
                </span>
            </a>
        </li>

        <li <?php echo section('pris') ?>>
            <a href="./emploie_pris.php">
                <i class="fas fa-user-check"></i>
                <span>
                    Machin
                </span>
            </a>
        </li>
    </ul>
</nav>