
<?php
    if(!empty($_POST))
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
    $query = 'INSERT INTO utilisateurs (utilisateur, email, passwordhash) VALUES (:utilisateur, :email, :passwordhash)';
    $sth = $dbh->prepare($query);
    $sth->bindValue(':utilisateur' , trim($_POST['pseudo']), PDO::PARAM_STR);
    $sth->bindValue(':email', trim($_POST['email']), PDO::PARAM_STR);
    $sth->bindValue(':passwordhash', password_hash(trim($_POST['passwordhash']), PASSWORD_BCRYPT), PDO::PARAM_STR);
    $sth->execute();
}
	//	Redirection vers la page d'accueil
	header('Location:./');
    
?> 