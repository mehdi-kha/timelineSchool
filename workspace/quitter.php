<?php

//detruire_session();
session_start();
session_destroy();
header('Location: /index.php');

   //affiche("<p>Et maintenant <br/>Au revoir </p>
  //<p><a href='tpInit.php'>Retour à l'accueil</a></p>");
?>
