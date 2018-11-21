<section id="formprojet">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="titre" placeholder="Titre">
        <textarea name="descript" placeholder="Description"></textarea>
        <input type="number" name="temp" min="1" placeholder="temp">
        <select name="temp_mesure">
            <option value="jour">Jour</option>
            <option value="semaine">Semaine</option>
            <option value="mois">Mois</option>
            <option value="anner">Anner</option>
        </select>
        
        <button id="envoyer" type="button">Poster</button>
    </form>
</section>

<script src="./js/ajax/ajout_projet.js"></script>