<?php 
    require_once('./php/connect.php');

    function liste_ville() {
        $dbh = connect();
        
        $villes = array();
        foreach ($dbh->query('SELECT ville, id FROM ville ORDER BY ville ASC') as $row) {
            $villes[] = htmlentities($row['ville']) . '/' . $row['id'];
        }

        $dbh = '';
        return $villes;
    }
?>