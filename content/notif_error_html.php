<?php
    function notif_error_html($error=false) {
        if ($error != false) {
            return '
                <section>
                    <span class="icon error">
                        <i class="fas fa-times-circle"></i>
                    </span>
                    <p>
                        ' . $error . '
                    </p>
                    <span class="croix error">
                        <i class="fas fa-times"></i>
                    </span>
                </section>
            ' ;
        }
    }
?>
