<?php
session_start();
$pseudo = $_SESSION['pseudo'];

$amdp = pg_escape_string($_POST['amdp']);
$mdp1 = pg_escape_string($_POST['mdp1']);
$mdp2 = pg_escape_string($_POST['mdp2']);

if ((isset($amdp))) {//Le mdp existe
     $db = pg_connect("dbname=timelinephoto");
     if($db){
          $req="SELECT pseudo,mdp FROM utilisateur WHERE pseudo LIKE '$pseudo';";
          $resultat = pg_query($db,$req);
          if (pg_num_rows($resultat)>0){
               $infoUtilisateur = pg_fetch_row($resultat);
               if ($infoUtilisateur[1]==$amdp){
                    if ($mdp1==$mdp2){
                         $query="UPDATE utilisateur SET mdp='$mdp1' WHERE mdp='$amdp' AND pseudo like '$pseudo'";
                         pg_query($db,$query);
                         print("Changement de mot de passe effectue !");
                         header('Refresh: 1; url=/Menu/menu.php');
                    }
                    else{
                         print("Votre confirmation n'est pas bonne, vous allez etre redirige vers le menu.");
                         header('Refresh: 2; url=/Menu/menu.php');
                    }
               }
               else{
                    print("Vous n'avez pas tape le bon mot de passe, vous allez etre redirige vers le menu.");
                   header('Refresh: 2; url=/Menu/menu.php');
               }
          }  
           else{
                print("Vous n'avez pas tape le bon mdp, vous allez etre redirige vers le menu.");
                header('Refresh: 2; url=/Menu/menu.php');
           }
     }
     else{
          print("La connextion a la base de donnée a echoué, vous allez etre redirige vers le menu.");
          header('Refresh: 2; url=/Menu/menu.php');
     }
}
else{
     print('Tapez un mdp');
     header('Refresh: 2; url=/Menu/menu.php');
}

?>