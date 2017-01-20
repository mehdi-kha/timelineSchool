<?php
session_start();
if(!isset($_SESSION['pseudo']))
	header('Location: /index.php');
?>

<div class = "navbar-fixed">
       <nav>
    <div class="nav-wrapper #ff9800 orange">
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a class="drop_ajax" href="/Menu/menu.php">Voir les photos</a></li>
        <li><a href="/quitter.php">Log out</a></li>
        <li><a href="http://www.iiens.net" target="_blank" >iiens.net</a></li>
      </ul>
      
      </div>
  </nav>
  </div>