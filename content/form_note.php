<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <fieldset>
                <label class="start">
                    <i class="far fa-star"></i>
                    <input type="radio" name="note" value="1" checked>
                </label>

                <label class="start">
                    <i class="far fa-star"></i>
                    <input type="radio" name="note" value="2">
                </label>

                <label class="start">
                    <i class="far fa-star"></i>
                    <input type="radio" name="note" value="3">
                </label>

                <label class="start">
                    <i class="far fa-star"></i>
                    <input type="radio" name="note" value="4">
                </label>

                <label class="start">
                    <i class="far fa-star"></i>
                    <input type="radio" name="note" value="5">
                </label>
            </fieldset>

            <textarea name="text" placeholder="commentaire"></textarea>

            <input type="submit" value="envoyer">
        </form>

        <script src="./js/note.js"></script>