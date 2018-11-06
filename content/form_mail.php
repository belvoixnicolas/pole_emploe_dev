<form id="form_mail" action="<?php echo $_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data">
    <h3>Envoyer un message</h3>

    <input type="text" name="sujet" placeholder="Sujet">
    <textarea name="text" placeholder="Text"></textarea>
    
        <label for="join">
            <div class="add">
                <i class="fas fa-file-upload"></i>
                <span>Joindre un fichier</span>
            </div>
        </label>
        <input type="file" name="join[]" id="join" multiple class='hiden'>

    <input type="submit" value="Evoyer">
</form>
<script src="./js/file_mail.js"></script>