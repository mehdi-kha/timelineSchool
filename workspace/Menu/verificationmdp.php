<?php

session_start();

//recuperer la valeur saisie dans les champs pseudo et mot de passe
$mdp = pg_escape_string($_POST['mdp']); 
$pseudo = pg_escape_string($_POST['pseudo']); //Eviter les problèmes d'apostrophe

/* verifie si la variable est différennte de NULL*/

if ((isset($mdp)) && (isset($pseudo)) ) {
    $db = pg_connect("dbname=timelinephoto");
    if($db){
        $req="SELECT pseudo,mdp FROM utilisateur WHERE pseudo LIKE '$pseudo';";
        $resultat = pg_query($db,$req);
        if(pg_num_rows($resultat)>0){ //L'utilisateur existe
            $infoUtilisateur = pg_fetch_row($resultat);
            if ($infoUtilisateur[1]==$mdp){
                $_SESSION['pseudo']=$pseudo;
                header('Location: /Menu/menu.php'); //Redirection vers le menu si la connexion a bien eu lieu
            }
            else{
                echo "Mot de passe invalide ! \nVous allez etre redirige vers la page d'accueil.";
                header('Refresh: 2; url=/index.php');
            }
            
        }   
        else{
            echo "Pseudo/Mot de passe incorrect ou utilisateur non existant. \nVous allez etre redirige vers la page d'accueil.\n";
            header('Refresh: 2; url=/index.php');
        }
    }
}else{
    header('Location: /quitter.php');
}

?>

