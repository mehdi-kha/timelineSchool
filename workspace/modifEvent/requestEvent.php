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
          <form action="attEvent.php">
          <div class="input-field col s12">
    <select name="selected">
      <option value="" disabled selected>Choose your option</option>
      <?php
          $db = pg_connect("dbname=timelinephoto");
          $query = "SELECT * FROM evenement;";
          $resultat = pg_query($db,$query);
          while($tab = pg_fetch_assoc($resultat)){
      ?>
      <option value="1"><?=$tab['nomevenement']?></option>
      <?php
          }
      
      ?>
    </select>
    <label>Materialize Select</label>
  </div>
  <div class="row">
           <div class="col s2">
                <input class="waves-effect waves-light btn row center-align #607d8b blue-grey" type="submit" value="Valider" />
          </div>
     </div>
     </form>
     </body>
     
     <script>
          $(document).ready(function() {
    $('select').material_select();
  });
     </script>
</html>