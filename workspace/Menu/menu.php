<?php
session_start();
if(!isset($_SESSION['pseudo']))
	header('Location: /index.php');
?>
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
     
     <div class = "navbar-fixed">
       <nav>
    <div class="nav-wrapper #ff9800 orange">
         
         <?php
         $pseudo = $_SESSION['pseudo'];
         if (isset($pseudo)){ //Afficher la photo de profil de la personne si elle s'est loggué.
               $db = pg_connect("dbname=timelinephoto");
               $queryIdUser = "SELECT id FROM utilisateur WHERE pseudo LIKE '$pseudo'"; //Requête d'obtention de l'ID de l'utilisateur pour renommer l'image avec cet ID
               $resultat = pg_query($db,$queryIdUser);
    
               if($resultat)
                    $newName = pg_fetch_row($resultat); //$newName[0] est alors l'ID de l'utilisateur
               else
                    echo "Probleme lors de l'execution de la requete... :/\n";
                    
               $queryUrlPhoto = "SELECT urlphoto FROM photoprofil WHERE idutilisateur=$newName[0]";
               $resultat2 = pg_query($db,$queryUrlPhoto);
               
               if($resultat2)
                    $urlphoto = pg_fetch_row($resultat2); //$urlphoto[0] est alors l'url de la photo de profil de l'utilisateur
               else
                    echo "Problème lors de l'execution de la requete... :/ \n";
               $urlphoto = $urlphoto[0]; //Rename pour simplifier
               $nomFichier = basename("$urlphoto"); //Permet de garder le nom de l'image avec son extension. On est à la racine, on connait le chemin
               $_SESSION['profil'] = $nomFichier;
               ?>
               
               
    <a class="btn-floating white dropdown-button btn" data-activates='dropdown1' style="bottom: -14px; left: 15px;">
         <img src="/modifProfil/profilePicture/<?=$nomFichier?>" class="logo-img responsive-img circle" alt="Photo de profil" style="max-height:50px; vertical-align: middle;"/>
    </a>
    
    <!-- Dropdown Structure -->
  <ul id='dropdown1' class='dropdown-content left'>
    <li><a class="drop_ajax" href="/Upload_Zip/ToUpload.php">Proposer des photos</a></li>
    <li class="divider"></li>
    <li><a class="drop_ajax" href="/modifProfil/changementmdp.php">Changer mon mot de passe</a></li>
    <?php
        $queryUrlPhoto = "SELECT creationevenement FROM administrateur WHERE id=$newName[0]";
        $resa = pg_query($db,$queryUrlPhoto);
        if(0<pg_num_rows($resa)){
            $droit=pg_fetch_row($resa);
            if($droit[0]==true){
                echo '<li><a class="drop_ajax" href="/Creation_evenements/formulaire.html">Creer un événement</a></li>';
                echo '<li><a class="drop_ajax" href="/Validation/validation.php">Valider des photos</a></li>';
            }
    
    ?>
    
    <?php
        }
    ?>
    <li><a href="/modifProfil/uploadPictureProfile.php">Changer ma photo de profil</a></li>
  </ul>
         
         <?php
         }
         else{
              ?>
              <div class="fixed-action-btn horizontal click-to-toggle" style="bottom: 45px; right: 24px;">
               <a href="/" class="brand-logo btn-floating btn-large">
                    <img src="imagesDuSite/Icon-user.png" class="logo-img responsive-img circle" alt="" style="max-height:50px; vertical-align: middle; padding-left: 10px;"/>
               </a>
         <?php
         }
         ?>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a class="drop_ajax" href="liste.php">Voir les photos</a></li>
        <li><a href="/quitter.php">Log out</a></li>
        <li><a href="http://www.iiens.net" target="_blank" >iiens.net</a></li>
      </ul>
      
      </div>
  </nav>
  </div>
  
  
  
<div class="container">
     <?php include("liste.php"); ?>
</div>
  
     
</body>

<script>
     $('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrain_width: false, // Does not change width of dropdown to that of the activator
      hover: true, // Activate on hover
      gutter: 0, // Spacing from edge
      belowOrigin: false, // Displays dropdown below the button
      alignment: 'left' // Displays dropdown with edge aligned to the left of button
    }
  );
  $('.drop_ajax').click(function(e){
       e.preventDefault();
       $.ajax({url: $(this).attr('href'), success: function(result){
            $('.container').html(result);
       }});
  });
</script>

</html>