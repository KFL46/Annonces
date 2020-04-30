<?php
    if(!empty($_GET))
{

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
    //	Ajout d'une annonce
    $query = 'INSERT INTO annonces (titre, descriptif, prix, idutilisateur) VALUES (?, ?, ?, ?)';
    $sth = $dbh->prepare($query);
    $sth->bindValue(1, trim($_GET['titre']), PDO::PARAM_STR);
    $sth->bindValue(2, trim($_GET['descriptif']), PDO::PARAM_STR);
    $sth->bindValue(3, trim($_GET['prix']), PDO::PARAM_STR);
    $sth->bindValue(4, ($_SESSION['petitesannonces']), PDO::PARAM_INT);
    $sth->execute();
    // redirection vers l'affichage de la page annonces parues
    header('Location:tableaudebord.php');
    exit;
    
}
    //	Inclusion du HTML   
    include 'profil.phtml';

