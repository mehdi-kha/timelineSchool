<?php
/*affiche l'en tete avec le titre*/
function enTete($titre)
{
    print "<!DOCTYPE html>\n";
    print "<html>\n";
    print "<head>\n";
    print "<meta charset=\"utf-8\" />\n";
    print "<title>$titre</title>\n";
    print "<link rel=\"stylesheet\" href=\"tpStyle.css\"/>\n";
    print "</head>\n";
  
    print "<body>\n";
    print "<h1> $titre </h1>\n";
}
/*ferme la page html*/
function pied(){

    print "</body>
</html>";
}

/*affiche les liens pour quitter notre page*/


function retourAuMenu() 
{ 
    echo '<a href="menu.php">Menu</a><br/><a href="quitter.php">Quitter</a>';
}

function vue_connection() {

    echo '<section>

  <br />

<p> formulaire pour vous connecter </p>

<br/>

  <form action="verificationmpd.php" method="post">
    <p>Entrez votre mot de passe : <input type="password" name="mdp" size="80"/></p>
    <p><input type="submit" value="Valider"/></p>
  </form>
</section>';

}

function affiche($str) {
    echo $str;
}

?>
