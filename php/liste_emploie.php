<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/pole_emploe_dev/php/connect.php');

    function liste_emploie($id=false) {
        if ($id) {
            $dbh = connect();

            $liste = $dbh->prepare('SELECT entreprise.id AS identr, offre_emploie.id, titre, offre_emploie.description, temp, date FROM offre_emploie INNER JOIN entreprise ON offre_emploie.id_entreprise = entreprise.id WHERE entreprise.id_usser = :id AND offre_emploie.id_usser IS NULL');

            $liste->execute(array(':id' => $id));

            if ($liste=$liste->fetchAll()) {
                $listehtml = '';

                foreach ($liste as $key => $offre) {
                    $propo = $dbh->prepare('SELECT * FROM postule WHERE id = :identreprise');
                    $propo->execute(array(':identreprise' => $offre['identr']));

                    if ($propo=$propo->fetchAll()) {
                        $nbpropo = count($propo);
                        $anim = 'animated infinite pulse';
                    } else {
                        $nbpropo = 0;
                        $anim = '';
                    }
                    
                    
                    $listehtml .= "
                        <li>
                            <h2>{$offre['titre']}</h2>
                            <span class=\"date\">{$offre['date']}</span>
                            <p>{$offre['description']}</p>
                            <span clas=\"temp\">{$offre['temp']}</span>
                            <button class=\"sup\" value=\"{$offre['id']}\">
                                Suprimer
                            </button>
                            <div>
                                <p class=\"{$anim}\">{$nbpropo}</p>
                                <button class=\"choix\" value=\"{$offre['id']}\">
                                    Choisire
                                </button>
                            </div>
                        </li>
                    ";
                }

                return $listehtml;
            }else {
                return '<li class="error">Il n\y a aucune offre on cours</li>';
            }
        }else {
            return '<li class="error">Une erreur c\'est produit</li>';
        }
    }
?>