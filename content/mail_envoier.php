<main id="envoier">
    <?php
        if (isset($_GET['id']) == false) { ?>
            <article class="recherche">
                <section class="bar_rech">
                    <input type="text" name="rech" id="" placeholder="Recherche">
                </section>

                <section class="resultat">
                    <div>
                        <h3>Developpeur</h3>

                        <ul clas="dev">

                        </ul>
                    </div>
                    
                    <div>
                        <h3>Particulier</h3>

                        <ul clas="pat">

                        </ul>
                    </div>
                    
                    <div>
                        <h3>Entreprise</h3>

                        <ul clas="entre">

                        </ul>
                    </div>
                </section>
            </article>
       <?php }else {
           include './content/form_mail.php';
       }
    ?>
</main>
<script src="./js/ajax/resultat.js"></script>