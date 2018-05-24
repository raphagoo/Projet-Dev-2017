<?php require ('Include/header.php') ?>
<?php require ('Include/connectToDB.inc.php'); require ("Include/registration.inc.php"); require ("Include/connexion.inc.php"); ?>
<div id="app">
    <div v-if="inscription == 1" id="inscription">
        <div class="inscconn" @click="inscription = 0;connexion = 1;"><h1><span class="glyphicon glyphicon-chevron-left"></span> Inscription -></h1></div>
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
    </div>
    <div v-if="connexion == 1" id="connexion">
        <div class="inscconn" @click="inscription = 1;connexion = 0;"><h1><- Connexion -></h1></div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="idPseudo">Pseudo : </label>
            <input type="text" name="connectPseudo" id="idPseudo" />
            <br />
            <label for="idPasswd">Mot de passe : </label>
            <input type="password" name="connectPassword" id="idPasswd" />

            <input type="submit" name="connect" value="Se connecter">
        </form>
    </div>
</div>
<script src="Assets/js/page.js"></script>
</body>
</html>