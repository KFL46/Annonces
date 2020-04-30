<?php
         session_start();
         //session_destroy();
         unset($_SESSION["petitesannonces"]);
         header('Location: index.php');
        exit;
 
?>