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
if(array_key_exists('urlImage', $_FILES))
{
    if($_FILES['urlImage']['error'] == 0)
    {
        if(in_array(mime_content_type($_FILES['urlImage']['tmp_name']), ['image/png', 'image/jpeg']))
        {
            if($_FILES['urlImage']['size'] <= 3000000)
            {
                move_uploaded_file($_FILES['urlImage']['tmp_name'], 'uploads/'.uniqid().'.'.pathinfo($_FILES['urlImage']['name'], PATHINFO_EXTENSION));

                header('Location: ./');
                exit;
            }
            else
            {
                echo 'Le fichier est trop volumineux…';
            }
        }
        else
        {
            echo 'Le type mime du fichier est incorrect…';
        }
    }
    else
    {
        echo 'Le fichier n\'a pas pu être récupéré…';
    }
}

 
    session_start();
    //	Ajout d'une annonce
    $query = 'INSERT INTO annonces (titre, descriptif, prix, idutilisateur) VALUES (?, ?, ?, ?)';
    $sth = $dbh->prepare($query);
    $sth->bindValue(1, trim($_GET['titre']), PDO::PARAM_STR);
    $sth->bindValue(2, trim($_GET['descriptif']), PDO::PARAM_STR);
    $sth->bindValue(3, trim($_GET['prix']), PDO::PARAM_STR);
    $sth->bindValue(4, ($_SESSION['petitesannonces']), PDO::PARAM_INT);
    $sth->execute();
    // Ajout des images
    $query = 'INSERT INTO images (urlImage) VALUE (?)';
    $sth = $dbh->prepare($query);
    $sth->bindValue(1, trim($_POST['urlImage']), PDO::PARAM_STR);
    $sth->execute();

    // redirection vers l'affichage de la page annonces parues
    header('Location:tableaudebord.php');
    exit;
    
}
    //	Inclusion du HTML   
    include 'profil.phtml';

