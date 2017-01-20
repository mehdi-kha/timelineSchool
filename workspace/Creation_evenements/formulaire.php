<?php

  $db = pg_connect("dbname=timelinephoto");
  $evenement=$_POST['evenement'];
  $date=$_POST['date'];
  
  $query="INSERT INTO evenement (nomevenement,date) values ('$evenement','$date');";
  pg_query($db,$query);
  $query="SELECT id from evenement where nomevenement='$evenement' and date='$date';";
  $result=pg_query($db,$query);
  $row = pg_fetch_row($result);
  $id = $row[0];
  $count=count($_POST['periode']);
  for($i = 0; $i < $count; $i++){
     $nom=$_POST['periode'][$i];
     $debut=$date." ".$_POST['debut'][$i];
     $fin=$date." ".$_POST['fin'][$i];
     $query="INSERT INTO periode (nomperiode,heuredebut,heurefin,idevenement) values ('$nom','$debut','$fin','$id');";
     pg_query($db,$query);
  }
  	header('Location: /Menu/menu.php');
?>

