<form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data">
    <input type="text" name="sujet" placeholder="Sujet">
    <textarea name="text" placeholder="Text"></textarea>
    
        <label for="join"><i class="fas fa-file-upload"></i><span>Joindre un fichier</span></label>
        <input type="file" name="join[]" id="join" multiple class='hiden'>

    <input type="submit" value="Evoyer">
</form>