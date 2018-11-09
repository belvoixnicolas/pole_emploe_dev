<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/pole_emploe_dev/php/connect.php');

    function liste_reponse ($id, $val=NULL) {
        $dbh = connect();

        $sqlbase = 'SELECT entreprise.id_usser AS id, offre_emploie.date, titre, offre_emploie.description, temp, offre_emploie.id_entreprise, nom, ville, choix from postule INNER JOIN offre_emploie ON postule.id = offre_emploie.id INNER JOIN entreprise ON offre_emploie.id_entreprise = entreprise.id INNER JOIN ville ON entreprise.id_ville = ville.id WHERE postule.id_usser = :id';

        if ($val != NULL) {
            $sql = $sqlbase;
            $donner = array(':id' => $id);
            $i = 0;

            foreach ($val as $key => $value) {
                switch ($key) {
                    case 'ac':
                        if ($value) {
                            $condition = " postule.choix = '2'";
                        }else {
                            $condition = '';
                        }
                        break;
                    
                    case 'at':
                        if ($value) {
                            $condition = " postule.choix = '0'";
                        }else {
                            $condition = '';
                        }
                        break;

                    case 'refu':
                        if ($value) {
                            $condition = " postule.choix = '1'";
                        }else {
                            $condition = '';
                        }
                        break;
                    default:
                        $condition = '';
                        break;
                }

                if ($i == 0 && $condition != '') {
                    $sql .= ' AND' .$condition;
                }elseif ($i != 0 && $condition != '') {
                    $sql .= ' OR' . $condition;
                }else {
                    $sql .= $condition;
                }
                
                ++$i;
            }

            $req = $dbh->prepare($sql . ' ORDER BY postule.date DESC');

            $donner = array(':id' => $id);
        }else {
            $req = $dbh->prepare($sqlbase . ' ORDER BY postule.date DESC');

            $donner = array(':id' => $id);
        }

        $req->execute($donner);

        if ($reponses=$req->fetchAll()) {
            $reponseshtml = '';

            foreach ($reponses as $key => $reponse) {
                $titre = ucfirst($reponse['titre']);
                $nom = ucfirst($reponse['nom']);
                $ville = ucfirst(mb_strtolower($reponse['ville']));

                $datetime= explode('-', explode(' ', $reponse['date'])[0]);
                $date = $datetime[2] . ' / ' . $datetime[1] . ' / ' . $datetime[0];

                $reponseshtml .= "
                    <li class=\"rep{$reponse['choix']}\">
                        <h3>
                            {$titre}
                        </h3>
                        <p class=\"date\">
                            {$date}
                        </p>
                        <p class=\"entreprise\">
                            Entreprise: 
                            <a href=\"./profil.php?id={$reponse['id']}\" target=\"_blank\">
                                {$nom}
                            </a>
                        </p>
                        <a href=\"https://www.google.com/maps/place/08000+{$ville}\" class=\"ville\" target=\"_blank\">
                            {$ville}
                        </a>
                        <p class=\"description\">
                            {$reponse['description']}
                        </p>
                        <p class=\"periode\">
                            {$reponse['temp']}
                        </p>

                        <a class=<\"btn\" href=\"./boite_mail.php?section=envoie&id={$reponse['id']}\" target=\"_black\">
                            Contact
                        </a>
                    </li>
                ";
            }

            return $reponseshtml;
        }else {
            return '<li class="error">Il n\'y a auccune réponse</li>';
        }
    }
?>