<?php
    function section ($lien) {
        $url = explode('/', $_SERVER['PHP_SELF']);
        $i = count($url);

        $fichier = explode('.', $url[--$i]);
        $fichier = $fichier[0];
        
        switch ($fichier) {
            case 'offre':
                $page = 'recherche';
                break;

            case 'offre_attente':
                $page = 'attend';
                break;

            case 'offre_accepter':
                $page = 'accepter';
                break;
            
            default:
                $page = '';
                break;
        }

        if ($page == $lien) {
            return 'class="focus"';
        }else {
            return 'ok';
        } 
    }
?>
<nav class="sousnavoffre">
    <ul>
        <li <?php echo section('recherche') ?>>
            <a href="./offre.php">
                <i class="fas fa-search"></i>
                <span>
                    Recherche
                </span>
            </a>
        </li>
        <li <?php echo section('attend') ?>>
            <a href="./offre_attente.php">
                <i class="far fa-clock"></i>
                <span>
                    On attente
                </span>
            </a>
        </li>
        <li <?php echo section('accepter') ?>>
            <a href="./offre_accepter.php">
                <i class="far fa-check-circle"></i>
                <span>
                    Accepter
                </span>
            </a>
        </li>
    </ul>
</nav>