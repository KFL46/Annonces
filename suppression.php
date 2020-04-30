<?php
 
 $dbh = new PDO
 (
     'mysql:host=localhost;dbname=petitesannonces;charset=utf8',
     'root',
     '',
     [
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
     ]
 );
        session_start();
        $sql = "DELETE FROM annonces WHERE id = ?";
        $sth = $dbh->prepare($sql);
        $sth->bindValue(1,($_GET['key']), PDO::PARAM_INT);
        $sth->execute();
        header('Location:tableaudebord.php').

        $count = $sth->rowCount();
        print('Effacement de ' .$count. ' entrées.');