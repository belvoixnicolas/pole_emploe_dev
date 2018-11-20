<?php 
    require_once($_SERVER['DOCUMENT_ROOT'] . '/pole_emploe_dev/php/connect.php');

    function liste_pris($id) {
        $dbh = connect();

        $liste = $dbh->prepare('SELECT offre_emploie.id AS idoffre, offre_emploie.titre, offre_emploie.temp, offre_emploie.date, usser.id AS iduser, usser.nom, usser.prenom, usser.img FROM offre_emploie INNER JOIN entreprise ON offre_emploie.id_entreprise = entreprise.id INNER JOIN usser ON offre_emploie.id_usser = usser.id WHERE offre_emploie.id_usser IS NOT NULL AND entreprise.id_usser = :id');

        $liste->execute(array(
            ':id' => $id
        ));

        if ($liste=$liste->fetchAll()) {
            $listeHTML = '';

            foreach ($liste as $key => $projetv) {
                $listeHTML .= "
                    <li>
                        <h2>
                            {$projetv['titre']}
                        </h2>
                        <span class=\"date\">
                            {$projetv['date']}
                        </span>
                        <a class=\"ident\" href=\"./profil.php?id={$projetv['iduser']}\" target=\"_blanck\">
                            <img src=\"./src/profil/{$projetv['img']}\" alt=\"Photo de {$projetv['nom']} {$projetv['prenom']}\" />
                            <p>
                                {$projetv['nom']} {$projetv['prenom']}
                            </p>
                        </a>
                        <a class=\"btn\" href=\"./boite_mail.php?section=envoie&id={$projetv['iduser']}\" target=\"_blanck\" >
                            Envoyer un mail
                        </a>
                    </li>
                ";
            }

            return $listeHTML;
        }else {
            return "<li class=\"error\">Il n'y a aucun project valider</li>";
        }
    }
?>