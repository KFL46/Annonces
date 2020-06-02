<?php
	//	Traitement de l'authentification s'il a été soumis
	if(!empty($_GET))
	{
		//	Connexion à la base de données
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
		//	Connexion de l'utilisateur
		$query = 'SELECT id, passwordhash FROM utilisateurs WHERE email = :email';
		$sth = $dbh->prepare($query);
		$sth->bindValue(':email', trim($_GET['email']), PDO::PARAM_STR);
		$sth->execute();
		$user = $sth->fetch();
        //var_dump($query); // vérification de la connexion de l'utilisateur
		//	Si l'authentification est réussie…
		if($user !== false AND password_verify(trim($_GET['passwordhash']), $user['passwordhash']))
		{
			session_start();
			$_SESSION['petitesannonces'] = intval($user['id']);
            //var_dump($_SESSION);
			//	Redirection vers la page privée
			header('Location: ./tableaudebord.php');
		}
		//	Sinon…
		else
		{
			//Redirection vers la page d'accueil
			header('Location: ./');
			exit;
		}
	}
