<?php
    function form_code($codes) {
        return '<div id="formcode">
                    <div>
                        <i class="fas fa-times"></i>
                        <p>On sélectionnant un langage déjà mis à niveau, vous pourriez redéfinir votre niveau</p>
                        <form action="#" id="form_code">
                            <select name="code">' . $codes . '</select>
                            <select name="note">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            <button type="button" class="submit">
                                Ajouter
                            </button>
                        </form>
                    </div>
                </div>';
    }
?>