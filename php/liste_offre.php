<?php 
    require_once($_SERVER['DOCUMENT_ROOT'] . '/pole_emploe_dev/php/connect.php');

    function liste_offre ($id, $ville=NULL) {
        $dbh = connect();

        $donner = array();

        if ($ville != NULL) {
            $sqlville = ' AND ville.ville = :ville';
            $donner[':ville'] = $ville; 
        }else {
            $sqlville = '';
        }

        $sql = 'SELECT postule.id_usser AS verif, offre_emploie.id AS idoffre, entreprise.id_usser AS id, titre, offre_emploie.description, temp, date, nom, ville FROM offre_emploie INNER JOIN entreprise ON offre_emploie.id_entreprise = entreprise.id INNER JOIN ville ON entreprise.id_ville = ville.id LEFT JOIN postule ON offre_emploie.id = postule.id WHERE offre_emploie.id_usser IS NULL' . $sqlville . ' ORDER BY offre_emploie.date DESC';

        $listeoffre = $dbh->prepare($sql);

        $listeoffre->execute($donner);

        if ($listeoffre = $listeoffre->fetchAll()) {
            $listeoffrehtml = '';

            foreach ($listeoffre as $row => $offre) {
                $ville = mb_strtolower($offre['ville']);

                if ($id != $offre['verif']) {
                    $listeoffrehtml .= "
                        <li>
                            <h3>
                                {$offre['titre']}
                            </h3>
                            <p class=\"date\">
                                {$offre['date']}
                            </p>
                            <p class=\"entreprise\">
                                Entreprise: 
                                <a href=\"./profil.php?id={$offre['id']}\" target=\"_blank\">
                                    {$offre['nom']}
                                </a>
                            </p>
                            <a href=\"https://www.google.com/maps/place/08000+{$ville}\" target=\"_blank\">
                                {$ville}
                            </a>
                            <p class=\"description\">
                                {$offre['description']}
                            </p>
                            <p class=\"periode\">
                                {$offre['temp']}
                            </p>

                            <button type=\"button\" value=\"{$offre['idoffre']}\">
                                Proposer ces service
                            </button>
                        </li>
                    ";
                }
            }

            if ($listeoffrehtml == '') {
                return '<li class="error">Il n\'y a aucune offre</li>';
            }else {
                return $listeoffrehtml;
            }
        }else {
            return '<li class="error">Il n\'y a aucune offre</li>';
        }
    }
?>