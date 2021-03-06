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

            case 'emploie_cree':
                $page = 'cree';
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
                <i class="fas fa-clipboard"></i>
                <span>
                    Mes projets
                </span>
            </a>
        </li>

        <li <?php echo section('pris') ?>>
            <a href="./emploie_pris.php">
                <i class="fas fa-user-check"></i>
                <span>
                    Projet valider
                </span>
            </a>
        </li>

        <li <?php echo section('cree') ?>>
            <a href="./emploie_cree.php">
                <i class="fas fa-plus"></i>
                <span>
                    Crée un projet
                </span>
            </a>
        </li>
    </ul>
</nav>