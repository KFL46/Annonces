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

	//	Si l'utilisateur n'est pas authentifié
	if(!array_key_exists('petitesannonces', $_SESSION)){
				//Redirection vers la page d'accueil
		header('Location: ./');
			exit;
	}
// //////////////////// RECUPERATION DES DONNEES DE LA BDD ////////////////////////////
//On sélectionne les annonces 
	$query='SELECT * FROM annonces WHERE idutilisateur = ?';
	$sth = $dbh->prepare($query);
	$sth -> bindValue(1,($_SESSION['petitesannonces']), PDO::PARAM_INT);
	$sth -> execute();
	$annonces = $sth->fetchAll();
	//var_dump($annonces); // vérification affichage annonce

	//	Inclusion du HTML
	include 'tableaudebord.phtml';
	