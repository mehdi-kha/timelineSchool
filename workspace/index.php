<?php
session_start();
$pseudo = $_SESSION['pseudo'];
     if (isset($pseudo))
     header('Location: /Menu/menu.php');  //si tu es connecté par besoin d'étre là.
?>

<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8">
     <title>Timeline iienne</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
     <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
</head>

<body>

<?php
include ("navbar.php");
?>
  
  
<div class="parallax-container" style="height: 170px;">
    <div class="parallax"><img src="imagesDuSite/party1.jpg"></div>
  </div>
  
  <div class="section white">
    <div class="row container">
      <h2 class="header center-align">Connexion</h2>
      <p class="grey-text text-darken-3 lighten-3 center-align">Veuillez rentrer vos identifiants</p>
      <form enctype="multipart/form-data" action="Menu/verificationmdp.php" method="post">
      <div class="row">
           
         <div class="input-field col s6">
           <input value="" id="pseudo" type="text" class="validate" name="pseudo">
           <label class="active" for="pseudo">Pseudo</label>
         </div>
         <div class="input-field col s6">
           <input value="" id="mdp" type="password" class="validate" name="mdp">
           <label class="active" for="mdp">Mot de passe</label>
         </div>
         
         
      </div>
      <div class="row">
           <div class="col s2">
                <input class="waves-effect waves-light btn row center-align #607d8b blue-grey" type="submit" value="Valider" />
          </div>
     </div>
     
      </form>
    </div>
  </div>
  
  <div class="parallax-container" style="height: 200px;">
    <div class="parallax"><img src="imagesDuSite/party1.jpg"></div>
  </div>
  
  
        <footer class="page-footer #ff9800 orange">
          <div class="container">
            <div class="row">
              <div class="col l4 s12">
                <h5 class="white-text">Timeline photo IIENNE</h5>
                <p class="grey-text text-lighten-4">Let's bring people together!</p>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
           Qiuhao QIAN - Damien MARCHAND - Mehdi KHADIR - Pierre-Olivier GENDREAU
            </div>
          </div>
        </footer>
            
  
    <script>
        $(document).ready(function(){
      $('.parallax').parallax();
    });
  </script>
  

  
  </body>
  
  </html>
  

  