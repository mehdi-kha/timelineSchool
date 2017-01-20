<?php

/*si il y a des truc qui sont pas sécurisé faites des changements*/
ini_set('display_errors',1);
error_reporting(E_ALL);

if(!isset($_POST['evenement'])){
    header('Location: /error.php?er=1');
}

$target_dir = '../Upload_Zip/UploadFolder/';
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if($imageFileType != "zip") {
    echo "Sorry, only Zip files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$zip = new ZipArchive;
$res = $zip->open($target_file);
if ($res === TRUE) {
     $zip->extractTo($target_dir);
     $zip->close();
     unlink($target_file);
    $db = pg_connect("dbname=timelinephoto");
    if(!$db){
        header('Location: /error.php?er=1');
    }
    $result = pg_prepare($db, "my_query", 'SELECT id FROM periode WHERE nomperiode=$1  and idevenement=$2');
    $result = pg_prepare($db, "my_query2", 'INSERT INTO photo (urlphoto,idperiode,valide) VALUES ($1,$2,false)');
    
    $zip = scandir($target_dir);
    if($folder = scandir($target_dir.$zip[2])){
     
        foreach($folder as $dir){                     //parcours du dossier zip pour obtenir les sous dossier
            if(  $dir!='.' && $dir!='..'){
                if($files = scandir($target_dir.$zip[2]."/".$dir)){
                    $periode = pg_execute($db, "my_query", array($dir,$_POST['evenement']));
                    //$query="SELECT id FROM periode WHERE nomperiode='".$dir."' and idevenement=".$_POST['evenement'].";";
                    //$periode=pg_query($db,$query);
                    if(0>pg_num_rows($periode)){

                        //$query="INSERT INTO periode (nomperiode,idevenement) VALUES ('".$dir."',".$_POST['evenement'].")";
                        //pg_query($db,$query);
                        //INIORATION DU DOSSIER

                    }else{
                        
                        $row = pg_fetch_row($periode);
                        $id_periode=$row[0];
                    
                        foreach ($files as $value) {
                    
                            if(  $value!='.' && $value!='..'){
                                rename($target_dir.$zip[2]."/".$dir.'/'.$value,'../Upload_Zip/Photo/'.$value);
                                list($width, $height) = getimagesize('../Upload_Zip/Photo/'.$value);
                                $new_width = $width*(150/$height);
                                $image_p = imagecreatetruecolor($new_width, 150);
                                $image = imagecreatefromjpeg('../Upload_Zip/Photo/'.$value);                                              //TODO FOR PNG CAUSE ERROR
                                imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, 150, $width, $height); 
                                imagejpeg($image_p,'../Upload_Zip/Mini/'.$value);
                
               //$exif_data = exif_read_data ('Photo/'.$value);                                               //Pour lire les métadonnées
               //$date= DateTime::createFromFormat( 'U' , $exif_data['FileDateTime']);
              // $date= $date->format('d/m/y H:i:s');
               //echo $date;
                                $periode = pg_execute($db, "my_query2", array($value,$id_periode));
                                //$query="INSERT INTO photo (urlphoto,idperiode) VALUES ('".$value."','".$id_periode."')";
                                //pg_query($db,$query);
                            }
                        }
                    }
                }else{
                    if(exif_imagetype ( $target_dir.$zip[2]."/".$dir )) //test if it is an image
                        ;
                }
                rmdir($target_dir.$zip[2]."/".$dir);
                
            }
        }
        rmdir($target_dir.$zip[2]);
    }
    pg_close($db);
} else {
    echo 'échec, code:' . $res;
}
  	header('Location: /Menu/menu.php');
?>