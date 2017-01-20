<div class = "navbar-fixed">
       <nav>
    <div class="nav-wrapper #ff9800 orange">
         
         <?php
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
               echo"<a href=\"/\" class=\"brand-logo \"><img src=\"modifProfil/profilePicture/$nomFichier\" class=\"logo-img responsive-img circle\" alt=\"\" style=\"max-height:50px; vertical-align: middle; padding-left: 10px;\"/></a>";
         }
         else{
               echo"<a href=\"/\" class=\"brand-logo \"><img src=\"imagesDuSite/Icon-user.png\" class=\"logo-img responsive-img circle\" alt=\"\" style=\"max-height:50px; vertical-align: middle; padding-left: 10px;\"/></a>";
         }
         ?>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="http://www.iiens.net" target="_blank" >iiens.net</a></li>
      </ul>
      
      </div>
  </nav>
  </div>