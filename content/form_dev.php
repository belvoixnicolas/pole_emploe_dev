<?php 
    $viles = liste_ville();
    $content = '';
    foreach ($viles as $row) {
        $row = explode('/', $row);
        $ville = $row[0];
        $id = $row[1];

        $content .= '<option value="' . $id . '">' . $ville . '</option>';
    }
?>
<form id="form_dev" action="./php/inscription.php?form=dev" method="post">
    <input type="text" name="nom" placeholder="Nom">
    <input type="text" name="prenom" placeholder="Prénom">
    <input type="date" name="naissance">
    <select name="ville">
        <option value="none">Ville</option>
        <?php echo $content ?>
    </select>
    <input type="email" name="mail" placeholder="Email">
    <input type="email" name="verif_mail" placeholder="Email">
    <input type="password" name="mdp" placeholder="Mot de passe">
    <input type="password" name="verif_mdp" placeholder="Mot de passe">
    <input type="submit" value="Envoyer">
</form>