
       
       
        <ul class="collection">
        
             <?php
         $db = pg_connect("dbname=timelinephoto");
           $req = "SELECT * FROM evenement;"; //La connexion à la BD a déjà été faite dans verificationmdp.php
           $resultat = pg_query($db,$req);
           while($tab = pg_fetch_assoc($resultat)){
           ?>
    <li class="collection-item avatar">
         <?php 
         $queryUrlEv = "SELECT urlphoto FROM photo JOIN periode ON photo.idperiode = periode.id JOIN evenement ON periode.idevenement = evenement.id WHERE evenement.nomevenement LIKE '".$tab['nomevenement']."'";
         $resQuEv = pg_query($db,$queryUrlEv);
         $urlPhEv = pg_fetch_assoc($resQuEv);
         ?>
      <a href="/Timeline/Affiche.php?id=<?=$tab['id']?>"><img src="/Upload_Zip/Photo/<?=$urlPhEv['urlphoto']?>" alt="" class="circle">
      <span class="title"><?=$tab['nomevenement']?></span>
      <p><?=$tab['date']?>
      </p>
      </a>
      <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
    </li>
    <?php
           }
   ?>
  </ul>