
<form action="/Upload_Zip/upload.php" method="post" enctype="multipart/form-data" >
    Select zip to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" accept=".zip">

        <select class="browser-default" name="evenement">
    <?php
            $db = pg_connect("dbname=timelinephoto");
            $req = "SELECT * FROM evenement;";
            $resultat = pg_query($db,$req);
            while($tab = pg_fetch_assoc($resultat)){
    ?>
        
                <option value="<?=$tab['id']?>"><?=$tab['nomevenement']?></option>

    <?php
           }
   ?>
    </select>
    <input type="submit" value="Upload Image" name="submit">

</form>

