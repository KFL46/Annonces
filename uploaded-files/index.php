<?php

	/*
		Le dossier « uploads » doit être créé en amont ;
		Un message de succès devrait être affiché ;
		Les erreurs devraient être mieux gérées.
	*/

	if(array_key_exists('monFichier', $_FILES))
	{
		if($_FILES['monFichier']['error'] == 0)
		{
			if(in_array(mime_content_type($_FILES['monFichier']['tmp_name']), ['image/png', 'image/jpeg']))
			{
				if($_FILES['monFichier']['size'] <= 3000000)
				{
					move_uploaded_file($_FILES['monFichier']['tmp_name'], 'uploads/'.uniqid().'.'.pathinfo($_FILES['monFichier']['name'], PATHINFO_EXTENSION));

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
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Envoyer un fichier</title>
	</head>
	<body>
		<form action="./" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
			<input type="file" name="monFichier" accept="image/png, image/jpeg">
			<button type="submit">Envoyer</button>
		</form>
	</body>
</html>