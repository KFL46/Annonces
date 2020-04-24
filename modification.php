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
        $sql = "UPDATE annonces SET titre=?, descriptif=?, prix=? WHERE id = ?";
        $sth = $dbh->prepare($sql);
        $sth->bindValue(1, trim($_GET['titre']), PDO::PARAM_STR);
        $sth->bindValue(2, trim($_GET['descriptif']), PDO::PARAM_STR);
        $sth->bindValue(3, trim($_GET['prix']), PDO::PARAM_STR);
        $sth->bindValue(4,($_SESSION['petitesannonces']), PDO::PARAM_INT);
        $sth->bindValue(4,($_GET['key']), PDO::PARAM_INT);
        $sth->execute();
        $annonces = $sth->fetchAll();

    var_dump($_GET);

    //header('Location:tableaudebord.php').
    exit;
    //	Inclusion du HTML   
    include 'modification.phtml';

    //catch(PDOException $e){
    //echo "Erreur : " . $e->getMessage();
    //}
       // Supression des variables de session et de la session
       // $_SESSION = array();
        //session_destroy();
 
        // Supression des cookies de connexion automatique
        //setcookie('utilisateur', '');
        //setcookie('passwordhache', '');
         
        //header('Location: index.php');
 
    //}
    //else{ // Dans le cas contraire on t'empêche d'accéder à cette page en te redirigeant vers la page que tu veux.
 
    // header('Location: authentification.php');
 