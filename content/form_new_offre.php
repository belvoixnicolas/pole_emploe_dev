<form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data">
    <input type="text" name="titre" placeholder="Titre">
    <textarea name="descript"></textarea>
    <input type="number" name="temp" placeholder="temp">
    <input type="number" name="prix" placeholder="prix">
    
    <input type="submit" value="Poster">
</form>