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

            case 'offre_reponse':
                $page = 'reponse';
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
        <li <?php echo section('reponse') ?>>
            <a href="./offre_reponse.php">
                <i class="far fa-clock"></i>
                <span>
                    Réponse
                </span>
            </a>
        </li>
    </ul>
</nav>