<?php

if(isset($_SESSION['pseudo'])){
    echo "<p>Bonjour <a href='memberPage.php'>". $_SESSION['pseudo'] ."</a> !</p>";
    echo "<form action='". $_SERVER['PHP_SELF'] ."' method='post'><input type='submit' name='signOut' value='Se deconnecter' /></form>";
}else{
    session_unset();
    session_destroy();

    echo "<form action='". $_SERVER['PHP_SELF'] ."' method='post'>
    <input type='text' name='connectPseudo' placeholder='Pseudo'/>
    <input type='password' name='connectPassword' placeholder='Mot de passe'/>
    <input type='submit' name='connect' value='Se connecter' /></form>";
    include ("include/connexion.inc.php");
}

if (isset($_POST['signOut'])){
    if (!isset($_SESSION['pseudo'])){
        echo "Vous n'etes pas connecte";
    }else{
        session_unset();
        session_destroy();
        header('refresh:0');
    }
}
