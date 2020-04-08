<?php

session_start();
//	Si l'utilisateur n'est pas authentifié
if(!array_key_exists('petitesannonces', $_SESSION))
{
	//	Redirection vers la page d'accueil
	echo("Le nom d'utilisateur ou le mot de passe est incorrect !");
	header('Location: ./');
	exit;
}
//	Inclusion du HTML
include 'tableaudebord.phtml';