<?php
         session_start();
         session_destroy();
         header('Location: index.phtml');

    // On démarre la session
 
   // if (isset($_SESSION['petitesannonces']) { // Si tu es connecté on te déconnecte et on te redirige vers une page.
 
        // Supression des variables de session et de la session
       // $_SESSION = array();
 
        // Supression des cookies de connexion automatique
        //setcookie('utilisateur', '');
        //setcookie('passwordhache', '');
         
 
    //}else{ // Dans le cas contraire on t'empêche d'accéder à cette page en te redirigeant vers la page que tu veux.
 
 
  //  });
 
?>