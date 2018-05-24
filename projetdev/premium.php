<?php require ('Include/header.php'); ?>
Cliquez sur le bouton pour avoir accès au premium durant une heure.
<form method='post' action="<?php echo $_SERVER['PHP_SELF']?>">
    <input type="submit" name="bouton" value="S'abonner 1 heure au premium">
</form>
<?php
if(isset($_POST['bouton'])){

    $request1 = $dbh->prepare('UPDATE user SET premium = 1 WHERE pseudo = "'.$_SESSION['pseudo'].'" ');
    $request2 = $dbh->prepare('UPDATE user SET premium_duration = ');
}
?>
</body>
</html>
