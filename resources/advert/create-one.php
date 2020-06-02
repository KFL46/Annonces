<?php
// on accède à la BDD
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

$title = trim($_POST['titre']);
$img = trim($_POST['image']);
$content = trim($_POST['descriptif']);
$price = trim($_POST['prix']);

$query = 'INSERT INTO utilisateurs (utilisateur, passwordhash) VALUES (?, ?)';
$sth = $dbh->prepare($query);
$sth->bindValue(1, trim($_POST['utilisateur']), PDO::PARAM_STR);
$sth->bindValue(2, password_hash(trim($_POST['passwordhash']), PASSWORD_BCRYPT), PDO::PARAM_STR);
$sth->execute();
$users=['nom'=>$utilisateur, 'MDP'=>$passwordhash];
//var_dump($_POST);

if($sth->rowCount() == 0)
{
    header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Utilisateur inexistant']);
    exit;
}

$user =
[
    'id' => $_GET['id'],
    'utilisateur' => $user
];

header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
header('Content-Type: application/json');
echo json_encode($user);
exit;
