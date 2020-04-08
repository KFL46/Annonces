<?php

	session_start();

	//	Si l'utilisateur n'est pas authentifié
	if(!array_key_exists('petitesannonces', $_SESSION))
	{
		//	Redirection vers la page d'accueil
		header('Location: ./');
		exit;
	}
// //////////////////// RECUPERATION DES DONNEES DE LA BDD ////////////////////////////
// ///////////////////////////////////////////////////////////////////////////////////
	//On sélectionne les articles d'un id après authentification
	$query = 'INSERT INTO annonces (annonce, image, ) VALUES (?, ?)';
	$sth = $dbco->prepare($query);
	$sth->bindValue(1, trim($_GET['id']), PDO::PARAM_INT);
	$sth->bindValue(3, trim($_SESSION['petitesannonces']));
	var_dump($_SESSION);
	$sth-> execute();
   
	$resultat = $sth->fetchAll(PDO::FETCH_ASSOC);

	echo '<pre>';
	print_r($resultat);
	echo '</pre>';


	//	Inclusion du HTML
	include 'tableaudebord.phtml';