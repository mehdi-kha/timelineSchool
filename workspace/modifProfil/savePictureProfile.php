
<?php

/* Récupération du pseudo de la personne qui upload*/
session_start();
//$pseudo = "wadidi"; //Pour le test 
$pseudo = $_SESSION['pseudo']; //A changer si le nom de la variable globale change

$currentDir = getcwd(); //Dossier courant

$uploaddir = "$currentDir/profilePicture/"; //Directoire où les photos de profil sont enregistrées
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']); //Obtenir le nom de l'image avec son suffixe

$extension = pathinfo($uploadfile, PATHINFO_EXTENSION); //Extension de l'image

//Vérification que le fichier uploadé est bien une image

$infosize = getimagesize($_FILES['userfile']['tmp_name']);

echo '<!DOCTYPE html>
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
<p>';

if ($infosize!=0 && move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) { //upload ssi c'est bien une image
    
    //Connexion, renommage du fichier et enregistrement dans la BD
    $db = pg_connect("dbname=timelinephoto");
    $queryIdUser = "SELECT id FROM utilisateur WHERE pseudo LIKE '$pseudo'"; //Requête d'obtention de l'ID de l'utilisateur pour renommer l'image avec cet ID
    $resultat = pg_query($db,$queryIdUser);
    
    if($resultat)
        $newName = pg_fetch_row($resultat); //$newName[0] est alors l'ID de l'utilisateur
    else
        echo "Probleme lors de l'execution de la requete... :/\n";
    rename($uploadfile,$uploaddir.$newName[0]); //Pas d'extension pour éviter les conflits si un fichier téléchargé n'a pas la meme extension que l'ancienne photo
    
    //Recherche si l'utilisateur a une photo de profil
    $queryRecherche = "SELECT idutilisateur FROM photoprofil WHERE idutilisateur = $newName[0];";
    $resultatRechercheId = pg_query($db,$queryRecherche);
    if(pg_num_rows($resultatRechercheId)==0){ //Si l'utilisateur n'avait pas de photo de profil
         $queryNewPic = "INSERT INTO photoprofil(idutilisateur,urlphoto) VALUES ('$newName[0]','$uploaddir$newName[0]');";
         $res = pg_query($db, $queryNewPic);
         if($res){
             echo "Le fichier est valide, et a été téléchargé
           avec succès.\nVous allez être redirigé vers le Menu";
    header('Refresh: 2; url=/Menu/menu.php');
         }
         else{
             echo "Problème lors du téléchargement, vous allez être redirigé vers le menu.\n";
             header('Refresh: 2; url=/Menu/menu.php');
         }
         
    }
    else{
        $queryUpdate = "UPDATE photoprofil SET urlphoto='$uploaddir$newName[0]' WHERE idutilisateur = $newName[0];";
        $res = pg_query($db, $queryUpdate);
        if($res){
            echo "Le fichier est valide, et a été téléchargé
           avec succès.\nVous allez être redirigé vers le Menu";
            header('Refresh: 2; url=/Menu/menu.php');
            
            }
        else{
        echo "Problème lors du téléchargement, vous allez être redirigé vers le menu.\n";
             header('Refresh: 2; url=/Menu/menu.php');
        }
    }
    pg_close();
           
} 

else { //Traitement des erreurs

if ($_FILES['userfile']['error'] > 0) $erreur = "Erreur lors du transfert, vous allez être redirigé vers le menu. \n";
if ($_FILES['userfile']['error'] = 2) $erreur = "Le fichier est trop gros, vous allez être redirigé vers le menu. \n";
if ($infosize == 0) $erreur = "Le fichier que vous essayez de transférer n'est pas une image, vous allez être redirigé vers le menu. \n";
header('Refresh: 2; url=/Menu/menu.php');

echo $erreur;

}

/*
echo 'Voici quelques informations de débogage :';
print_r($_FILES);
*/

echo '</p></body></html>';

?>