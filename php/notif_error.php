<?php
    require_once('./content/notif_error_html.php');

    if (isset($_SESSION['error'])) {
        $errors = $_SESSION['error'];
    }else {
        $errors = null;
    }

    $_SESSION['error'] = array();

    function notif_error($error=false) {
        if ($error != false) {
            $error_mat_html = '';
            foreach ($error as $row) {
                $error_mat_html .= notif_error_html($row);
            }

            $error_html = '<div id="error">' . $error_mat_html . '</div>';

            return $error_html;
        }
    }
?>