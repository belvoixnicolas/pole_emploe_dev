<?php 
    //require_once($_SERVER['DOCUMENT_ROOT'] . '/pole_emploe_dev/php/connect.php');
    //require_once($_SERVER['DOCUMENT_ROOT'] . '/pole_emploe_dev/php/verif_img.php');

    require_once($_SERVER['DOCUMENT_ROOT'] . '/php/connect.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/php/verif_img.php');

    function liste_pris($id) {
        $dbh = connect();

        $liste = $dbh->prepare('SELECT offre_emploie.id AS idoffre, offre_emploie.titre, offre_emploie.temp, offre_emploie.date, offre_emploie.noter_dev, usser.id AS iduser, usser.nom, usser.prenom, usser.img FROM offre_emploie INNER JOIN entreprise ON offre_emploie.id_entreprise = entreprise.id INNER JOIN usser ON offre_emploie.id_usser = usser.id WHERE offre_emploie.id_usser IS NOT NULL AND entreprise.id_usser = :id ORDER BY offre_emploie.date DESC');

        $liste->execute(array(
            ':id' => $id
        ));

        if ($liste=$liste->fetchAll()) {
            $listeHTML = '';

            foreach ($liste as $key => $projetv) {
                $titre = ucfirst($projetv['titre']);
                $datetime= explode('-', explode(' ', $projetv['date'])[0]);
                $date = $datetime[2] . ' / ' . $datetime[1] . ' / ' . $datetime[0];
                $img = verif_img($projetv['img']);
                $nom = ucfirst($projetv['nom']);
                $prenom = ucfirst($projetv['prenom']);

                if ($projetv['noter_dev'] == 1) {
                    $disa = 'disabled';
                } else {
                    $disa = '';
                }
                

                $listeHTML .= "
                    <li>
                        <h2>
                            {$titre}
                        </h2>
                        <span class=\"date\">
                            {$date}
                        </span>
                        <a class=\"ident\" href=\"./profil.php?id={$projetv['iduser']}\" target=\"_blanck\">
                            <img src=\"./src/profil/{$img}\" alt=\"Photo de {$projetv['nom']} {$projetv['prenom']}\" />
                            <p>
                                {$nom} {$prenom}
                            </p>
                        </a>
                        <a class=\"btn\" href=\"./boite_mail.php?section=envoie&id={$projetv['iduser']}\" target=\"_blanck\" >
                            <i class=\"far fa-envelope\"></i>
                            <span>
                                Le contacter
                            </span>
                        </a>
                        <button id=\"noter\" value=\"{$projetv['idoffre']}\" {$disa}>
                            <i class=\"fas fa-star\"></i>
                            <span>
                                Noter
                            </span>
                        </button>
                    </li>
                ";
            }

            return $listeHTML;
        }else {
            return "<li class=\"error\">Il n'y a aucun project valider</li>";
        }
    }
?>