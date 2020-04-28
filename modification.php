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
    if($_SESSION['petitesannonces'] == false){
        $query='SELECT * FROM annonces WHERE idutilisateur = ?';
        $sth = $dbh->prepare($sql);
        $sth -> bindValue(1,($_SESSION['petitesannonces']), PDO::PARAM_INT);
        $sth->execute();
        //$annonces = $sth->fetchAll();
        header('Location:tableaudebord.php').
    }
    else{
        $sql = "UPDATE annonces SET titre=?, descriptif=?, prix=? WHERE id = ?";
        $sth = $dbh->prepare($sql);
        $sth->bindValue(1, trim($_GET['titre']), PDO::PARAM_STR);
        $sth->bindValue(2, trim($_GET['descriptif']), PDO::PARAM_STR);
        $sth->bindValue(3, trim($_GET['prix']), PDO::PARAM_STR);
        $sth->bindValue(4,($_SESSION['petitesannonces']), PDO::PARAM_INT);
        $sth->bindValue(4,($_GET['key']), PDO::PARAM_INT);
        $sth->execute();
        $annonces = $sth->fetchAll();
    }
//	Inclusion du HTML   
include 'modification.phtml';