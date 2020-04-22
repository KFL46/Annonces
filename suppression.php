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
        $sql = "DELETE FROM annonces WHERE id = idutilisateur";
        $sth = $dbh->prepare($sql);
        $sth->bindValue(1,($_SESSION['petitesannonces']), PDO::PARAM_INT);
        $sth->execute();
        
        $count = $sth->rowCount();
        print('Effacement de ' .$count. ' entrées.');
    var_dump($_GET);







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
 
?>
