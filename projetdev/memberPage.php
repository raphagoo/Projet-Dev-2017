<?php require ('Include/header.php');
$requete = $dbh->prepare('SELECT name, email, birthdate FROM userdetails WHERE user_id = (SELECT user_id FROM user WHERE pseudo  = "'.$_SESSION['pseudo'].'")');
$requete->execute();
$requetefetch = $requete->fetchAll();
$requete2 = $dbh->prepare('SELECT premium FROM user WHERE pseudo = "'.$_SESSION['pseudo'].'"');
$requete2->execute();
$requete2fetch = $requete2->fetchAll();
?>
<div class="containerr">
<h1>Mon profil</h1>
   Pseudo :  <?php echo $_SESSION['pseudo']; ?><br>
   Nom : <?php echo $requetefetch[0][0]; ?><br>
   Email : <?php echo $requetefetch[0][1]; ?><br>
   Date de naissance : <?php echo $requetefetch[0][2] ?><br>
   Premium : <?php if($requete2fetch[0][0] == 1){
       echo "Activé";
   }
   else{
       echo "Non activé";
   } ?>
</div>

