<html>
     <form method="post" action="/modifProfil/changEff.php"><br/>
     mot de passe actuel: <input type="password" value="" name="amdp"/><br/>
     nouveau mot de passe <input type="password" value="" name="mdp1"/><br/>
     confirmation  <input type="password" value="" name="mdp2"/><br/>
     <input type="submit"/>

</form>
   
<?php
session_start();
$pseudo = $_SESSION['pseudo'];
echo "<p>Votre pseudo est $pseudo</p>";
?>
</html>

          