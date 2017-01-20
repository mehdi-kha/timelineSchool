<?php

  $db = pg_connect("dbname=timelinephoto");
  
  $count=count($_POST['valide']);
  for($i = 0; $i < $count; $i++){
     $id=$_POST['valide'][$i];
     
     $query="UPDATE photo SET valide='true' WHERE id=$id;";
     pg_query($db,$query);
  }
     $query="SELECT urlphoto,id FROM photo WHERE valide='false';";
     $resu=pg_query($db,$query);
     while ($row = pg_fetch_row($resu)) {
          unlink ( "../Upload_Zip/Mini/".$row[0] );
          unlink ( "../Upload_Zip/Photo/".$row[0] );
          $query="DELETE FROM photo WHERE id=$row[1]";
          pg_query($db,$query);
     }
     
       	header('Refresh: 0; url=/Menu/menu.php');
  
?>
