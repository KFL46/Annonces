<?php

define('MIME_TYPES_ACCEPTED', ['image/png', 'image/jpeg']);
define('MAX_FILE_SIZE', 30000000);
define('UPLOADED_FILES_FOLDER_PATH', './images');
$dbh = new PDO(
    'mysql:host=localhost;dbname=petitesannonces;charset=utf8',
    'root',
    '',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]

);

if (!empty($_POST)) {





    if (array_key_exists('images', $_FILES)) {
        foreach (array_keys($_FILES['images']['name']) as $index) {
            if ($_FILES['images']['error'][$index] == 0) {
                if (in_array(mime_content_type($_FILES['images']['tmp_name'][$index]), MIME_TYPES_ACCEPTED)) {
                    if ($_FILES['images']['size'][$index] <= MAX_FILE_SIZE) {
                        do {
                            $filePath = UPLOADED_FILES_FOLDER_PATH . DIRECTORY_SEPARATOR . uniqid() . '.' . pathinfo($_FILES['images']['name'][$index], PATHINFO_EXTENSION);
                        } while (file_exists($filePath));

                        $filePaths[$index] = $filePath;
                    } else {
                        //	Erreur : Fichier trop volumineux
                        echo ("file to big");
                    }
                } else {
                    //	Erreur : Type mime du fichier incorrect
                    echo ("bad file");
                }
            } else {
                //	Erreur : Fichier non récupéré
                echo ("Error , not saved");
            }
        }

        //	Requête SQL pour insérer les chemins des fichiers le cas échéant
        $query = '  INSERT INTO 
                        images (urlImage) 
                    VALUES (:urlImage)';
        $sth = $dbh->prepare($query);
        $sth->bindValue(":urlImage", $filePaths[$index], PDO::PARAM_STR);
        $sth->execute();


        foreach ($filePaths as $index => $filePath) {
            move_uploaded_file($_FILES['images']['tmp_name'][$index], $filePath);
            var_dump($filePath);
        }
    }
    header("Location: insertion1.php");
    exit;
}

require 'insertion.phtml';
