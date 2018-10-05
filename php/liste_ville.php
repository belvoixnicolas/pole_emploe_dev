<?php 
    require_once('./php/connect.php');

    function liste_ville() {
        $dbh = connect();
        
        $villes = array();
        foreach ($dbh->query('SELECT ville FROM ville ORDER BY ville ASC') as $row) {
            $villes[] = htmlentities($row[0]);
        }

        $dbh = '';
        return $villes;
    }
?>