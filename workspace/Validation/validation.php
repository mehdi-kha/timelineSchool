<form action="/Validation/validation_file.php" method="post" enctype="multipart/form-data" >
    Veuillez sélectionner les photos à valider:



		<?php
			$db = pg_connect("dbname=timelinephoto");
         		$query="SELECT nomevenement,id FROM evenement;"; //where non validé
			$result = pg_query($db,$query);
			
			while ($nomevenement = pg_fetch_row($result)) {
				
?>
		  <?php
		  $query="SELECT id,nomperiode,heuredebut FROM periode WHERE idevenement=$nomevenement[1] ORDER BY heuredebut;";			
              $periode = pg_query($db,$query);
               		               
	          while ($row_periode = pg_fetch_row($periode)) {	//parcours des periodes
	                 $query="SELECT urlphoto,id FROM photo WHERE idperiode=".$row_periode[0]." AND valide=false;";
			 $res = pg_query($db,$query);
			 while ($row = pg_fetch_row($res)) {
				  echo "<input type='checkbox' name='valide[]' value='$row[1]'  class='filled-in'  id='$row[1]' checked='checked' checked><label for='$row[1]'><img src=\"/Upload_Zip/Mini/$row[0]\" height='150'/></label> ";
         } ?>

			<?php }
			}
			?>


    <input type="submit" value="Valider" name="submit">