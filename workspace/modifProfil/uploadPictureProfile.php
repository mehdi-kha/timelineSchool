<!DOCTYPE html>
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
     
     <?php
     include ("../navbar2.php");
     ?>
          <div class="center-align">
               <form enctype="multipart/form-data" action="savePictureProfile.php" method="post">
                    <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
                    <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                    <!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->

                    <p class="center-align">Sélectionnez un fichier à partir de votre ordinateur</p>

                    <div class="file-field input-field row">
                         <div class="btn col s2 offset-s5 orange">
                              <span>Parcourir</span>
                              <input name="userfile" type="file" id="userfile" />
                         </div>
                    </div>
                    
                    
                    <div class="row">
                         <img class="responsive-img" id="blah" width="100" src="interrogation.png" alt="your image" />
                    </div>
                    

                    <input class="waves-effect waves-light btn row orange" type="submit" value="Envoyer le fichier" />


               </form>
          </div>

</body>

<script>
     function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#userfile").change(function(){
    readURL(this);
});
</script>

</html>