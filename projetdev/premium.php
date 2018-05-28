<?php require ('Include/header.php'); ?>
Choisissez combien de temps vous voulez vous abonner :
<form method='post' action="<?php echo $_SERVER['PHP_SELF']?>">
    <label for="duree">Durée du premium</label>
    <input type="number" id="duree" name="duree">
    <input type="submit" name="bouton" value="S'abonner au premium">
</form>
<?php
if(isset($_POST['bouton'])){
    $duree = $_POST['duree'];
    date_default_timezone_set('Europe/Paris');
    $date = date('H:i:s',strtotime("+$duree hour"));
    $date2 = date('H:i:s');
    $request1 = $dbh->prepare('UPDATE user SET premium = 1 WHERE pseudo = "'.$_SESSION['pseudo'].'" ');
    $request2 = $dbh->prepare('UPDATE user SET premium_duration = "'.$date.'" WHERE pseudo = "'.$_SESSION['pseudo'].'"');
    $request1->execute();
    $request2->execute();
}
?>
</body>
</html>
