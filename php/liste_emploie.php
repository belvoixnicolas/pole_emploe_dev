<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/pole_emploe_dev/php/connect.php');

    function liste_emploie($id=false) {
        if ($id) {
            $dbh = connect();

            $liste = $dbh->prepare('SELECT offre_emploie.id AS idoffre, offre_emploie.id, titre, offre_emploie.description, temp, date FROM offre_emploie INNER JOIN entreprise ON offre_emploie.id_entreprise = entreprise.id WHERE offre_emploie.sup = 0 AND entreprise.id_usser = :id AND offre_emploie.id_usser IS NULL ORDER BY offre_emploie.date DESC');

            $liste->execute(array(':id' => $id));

            if ($liste=$liste->fetchAll()) {
                $listehtml = '';

                foreach ($liste as $key => $offre) {
                    $propo = $dbh->prepare('SELECT * FROM postule WHERE id = :identreprise AND choix = 0');
                    $propo->execute(array(':identreprise' => $offre['idoffre']));

                    if ($propo=$propo->fetchAll()) {
                        $nbpropo = count($propo);
                        $anim = 'animated infinite pulse';
                    } else {
                        $nbpropo = 0;
                        $anim = '';
                    }

                    $date = explode('-', explode(' ', $offre['date'])[0]);
                    $date = $date[2] . ' / ' . $date[1] . ' / ' . $date[0];

                    $titre = ucfirst($offre['titre']);
                    
                    
                    $listehtml .= "
                        <li>
                            <h2>{$titre}</h2>
                            <span class=\"date\">{$date}</span>
                            <p>{$offre['description']}</p>
                            <span class=\"temp\">{$offre['temp']}</span>
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
                return '<li class="error">Il n\'y a aucune offre on cours</li>';
            }
        }else {
            return '<li class="error">Une erreur c\'est produit</li>';
        }
    }
?>