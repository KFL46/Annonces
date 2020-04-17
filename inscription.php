
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
//	Ajout de l'utilisateur
$query = 'INSERT INTO utilisateurs (utilisateur, passwordhash) VALUES (?, ?)';
$sth = $dbh->prepare($query);
$sth->bindValue(1, trim($_GET['pseudo']), PDO::PARAM_STR);
$sth->bindValue(2, password_hash(trim($_GET['passwordhash']), PASSWORD_BCRYPT), PDO::PARAM_STR);
$sth->execute();
}
	//	Redirection vers la page d'accueil
	header('Location:./').
    exit;
?> 