<?php session_start(); require ('include/connectToDB.inc.php'); require ("include/registration.inc.php"); require ("include/connexion.inc.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Connexion - ProjetDev</title>
</head>
<body>
<h1>Identification :</h1>

<?php include ("include/SignOut.php") ?>

<h2>Connexion : </h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="idPseudo">Pseudo : </label>
    <input type="text" name="connectPseudo" id="idPseudo" />
    <br />
    <label for="idPasswd">Mot de passe : </label>
    <input type="password" name="connectPassword" id="idPasswd" />

    <input type="submit" name="connect" value="Se connecter">
</form>

<?php if(!empty($_SESSION['pseudo'])){echo $_SESSION['pseudo'];} ?>

</body>
</html>
