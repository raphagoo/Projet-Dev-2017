<?php session_start(); require ('include/connectToDB.php'); require ("include/registration.inc.php"); require ("include/connexion.inc.php"); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inscription - ProjetDev</title>
  </head>
  <body>
    <h1>Identification :</h1>
    <h2>Inscription :</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <label for="idPseudo">Pseudo : </label>
      <input type="text" name="pseudo" id="idPseudo" />
      <br />
      <label for="idPasswd">Mot de passe : </label>
      <input type="password" name="password" id="idPasswd" />
      <br />
      <label for="">Nom : </label>
      <input type="text" name="name" />
      <br />
      <label for="idMail">Adresse email : </label>
      <input type="email" name="email" id="idMail">
      <br />
      <label for="">Sexe : </label>
      <label for="genderMale">Homme : </label>
      <input type="radio" name="gender" value="1" id="genderMale"/>
      <label for="genderFemale">Femme : </label>
      <input type="radio" name="gender" value="2" id="genderFemale"/>
      <label for="genderOther">Autre : </label>
      <input type="radio" name="gender" value="3" id="genderOther"/>
      <br />
      <label for="idBirthdate">Date de naissance : </label>
      <input type="date" name="birthdate" id="idBirthdate"/>
      <br />
      <input type="submit" name="registration" value="S'inscrire">
    </form>



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
