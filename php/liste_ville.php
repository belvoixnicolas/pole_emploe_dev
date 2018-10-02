<?php 
    function liste_ville() {
        $dbh = connect();
        
        $villes = array();
        foreach ($dbh->query('SELECT ville FROM ville') as $row) {
            $villes[] = htmlentities($row[0]);
        }

        $dbh = '';
        return $villes;
    }
?>