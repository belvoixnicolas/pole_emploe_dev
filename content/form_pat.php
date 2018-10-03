<?php 
    $viles = liste_ville();
    $content = '';
    foreach ($viles as $row) {
        $content .= '<option value="' . $row . '">' . $row . '</option>';
    }
?>
<form id="form_pat" action="<?php echo $_SERVER['PHP_SELF']?>?form=pat" method="post">
    <input type="text" name="entreprise" placeholder="Raison social">
    <input type="text" name="nom" placeholder="Nom">
    <input type="text" name="prenom" placeholder="Prénom">
    <input type="date" name="naissance" id="" placeholder="Date de naissance">
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