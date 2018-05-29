<?php $name = "Premium";
 require ('Include/header.php');?>
 <div id="containerpremium">
 <?php if(isset($_SESSION['pseudo'])) {
     echo '<div id="formulairepremium">
Choisissez combien de temps vous voulez vous abonner :
<form method="post" action="';
     echo $_SERVER['PHP_SELF'];
     echo '">
    <label for="duree">Durée du premium : </label>
    <input type="number" id="duree" name="duree"> heures<br>
    <input type="submit" name="bouton" value="S\'abonner au premium">
</form>
    </div>';
 }
 else{
     echo "<div id='formulairepremium'>Vous devez être connecté pour avoir accès au premium<br><a href=\"connexion.php\"><button class=\"btn btn-primary\">Se connecter</button></a> </div>";
 }
 ?> </div>
<?php if(isset($_POST['bouton'])){
    $duree = $_POST['duree'];
    date_default_timezone_set('Europe/Paris');
    $date = date('d-m-Y H:i:s',strtotime("+$duree hour"));
    $request1 = $dbh->prepare('UPDATE user SET premium = 1 WHERE pseudo = "'.$_SESSION['pseudo'].'" ');
    $request2 = $dbh->prepare('UPDATE user SET premium_duration = "'.$date.'" WHERE pseudo = "'.$_SESSION['pseudo'].'"');
    $request1->execute();
    $request2->execute();
}
?>
</body>
</html>
