<?php

var_dump($_FILES);

define('MIME_TYPES_ACCEPTED', ['image/png', 'image/jpeg']);
define('MAX_FILE_SIZE', 30000000);
define('UPLOADED_FILES_FOLDER_PATH', 'uploaded-files');

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
   if(array_key_exists('images', $_FILES))
   {
       foreach(array_keys($_FILES['images']['name']) as $index)
       {
           if($_FILES['images']['error'][$index] == 0)
           {
               if(in_array(mime_content_type($_FILES['images']['tmp_name'][$index]), MIME_TYPES_ACCEPTED))
               {
                   if($_FILES['images']['size'][$index] <= MAX_FILE_SIZE)
                   {
                       do
                       {
                           $filePath = UPLOADED_FILES_FOLDER_PATH.DIRECTORY_SEPARATOR.uniqid().'.'.pathinfo($_FILES['images']['name'][$index], PATHINFO_EXTENSION);
                       }
                       while(file_exists($filePath));

                       $filePaths[$index] = $filePath;
                   }
                   else
                   {
                       //	Erreur : Fichier trop volumineux
                   }
               }
               else
               {
                   //	Erreur : Type mime du fichier incorrect
               }
           }
           else
           {
               //	Erreur : Fichier non récupéré
           }
       }

       //	Requête SQL pour insérer les chemins des fichiers le cas échéant
       
       foreach($filePaths as $index => $filePath)
        {
           move_uploaded_file($_FILES['images']['tmp_name'][$index], $filePath);
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
    $query = 'INSERT INTO images (urlImage) VALUE (:urlImage)';
    $sth = $dbh->prepare($query);
    $sth->bindValue(":urlImage", $filePaths[$index], PDO::PARAM_STR);
    $sth->execute();
    foreach ($filePaths as $index => $filePath) {
        move_uploaded_file($_FILES['images']['tmp_name'][$index], $filePath);
        var_dump($filePath);
    }

    var_dump($_FILES);
    
    // redirection vers l'affichage de la page annonces parues
    header('Location:tableaudebord.php');
    exit;
}
}
    //	Inclusion du HTML   
    include 'profil.phtml';

