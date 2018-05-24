<?php
if(isset($_SESSION['pseudo'])){
    echo "Bonjour &nbsp;<a href='memberPage.php'>".$_SESSION['pseudo']."&nbsp;</a>!&nbsp;";
    echo "<form action='". $_SERVER['PHP_SELF'] ."' method='post'><input type='submit' name='signOut' value='Se deconnecter' /></form>&nbsp;";
}else{
}
if (isset($_POST['signOut'])){
    if (!isset($_SESSION['pseudo'])){
        echo "Vous n'êtes pas connecté";
    }else{
        session_unset();
        session_destroy();
        header('Location: connexion.php');
    }
}