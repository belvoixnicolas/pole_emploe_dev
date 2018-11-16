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

        $sql = 'SELECT offre_emploie.id AS idoffre, entreprise.id_usser AS id, titre, offre_emploie.description, temp, offre_emploie.date, nom, ville FROM offre_emploie INNER JOIN entreprise ON offre_emploie.id_entreprise = entreprise.id INNER JOIN ville ON entreprise.id_ville = ville.id WHERE offre_emploie.id_usser IS NULL' . $sqlville . ' AND offre_emploie.sup = 0 ORDER BY offre_emploie.date DESC';

        $listeoffre = $dbh->prepare($sql);

        $listeoffre->execute($donner);

        if ($listeoffre = $listeoffre->fetchAll()) {
            $listeoffrehtml = '';

            foreach ($listeoffre as $row => $offre) {
                $titre = ucfirst($offre['titre']);
                $nom = ucfirst($offre['nom']);
                $ville = ucfirst(mb_strtolower($offre['ville']));

                $datetime= explode('-', explode(' ', $offre['date'])[0]);
                $date = $datetime[2] . ' / ' . $datetime[1] . ' / ' . $datetime[0];

                $verif = $dbh->prepare('SELECT * FROM postule WHERE id = :idoffre AND id_usser = :iduser');
                $verif->execute(array(
                    ':idoffre' => $offre['idoffre'],
                    ':iduser' => $id
                ));

                if ($verif->fetchAll()) {
                    $listeoffrehtml .= '';
                }else {
                    $listeoffrehtml .= "
                        <li>
                            <h3>
                                {$titre}
                            </h3>
                            <p class=\"date\">
                                {$date}
                            </p>
                            <p class=\"entreprise\">
                                Entreprise: 
                                <a href=\"./profil.php?id={$offre['id']}\" target=\"_blank\">
                                    {$nom}
                                </a>
                            </p>
                            <a href=\"https://www.google.com/maps/place/08000+{$ville}\" class=\"ville\" target=\"_blank\">
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
                return '<li class="error"><spans>Il n\'y a aucune offre</span></li>';
            }else {
                return $listeoffrehtml;
            }
        }else {
            return '<li class="error"><span>Il n\'y a aucune offre</span></li>';
        }
    }
?>