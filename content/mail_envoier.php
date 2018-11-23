<?php
    if (isset($_POST['sujet']) && isset($_POST['text']) && isset($_GET['id'])) {
        if (envoie_mail($_POST['sujet'], $_POST['text'], $_GET['id'])) {
            header('Location: ./boite_mail.php');
            exit();
        }
    }
?>
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

                        <ul class="dev">

                        </ul>
                    </div>
                    
                    <div>
                        <h3>Porteur de projet</h3>

                        <ul class="pat">

                        </ul>
                    </div>
                    
                    <div>
                        <h3>Projet et entreprise</h3>

                        <ul class="entre">

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