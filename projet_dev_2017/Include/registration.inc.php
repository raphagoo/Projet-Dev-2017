<?php

function verifyPassword($password)
{
    if (preg_match("((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{8,20}) ", $password) && !preg_match("((?=.*" . $_POST['pseudo'] . "))", $password))
    {
        return true;
    }
    else {
        return false;
    }
}

 if (isset($_POST["registration"]))
 {
     if (!empty($_POST["pseudo"])
         && !empty($_POST["email"])
         && !empty($_POST["password"])
         && !empty($_POST["name"])
         && !empty($_POST["gender"])
         && !empty($_POST["birthdate"]))
     {
         if (verifyPassword($_POST['password'])) {


             $pseudo = $_POST["pseudo"];
             $email = $_POST["email"];
             $name = $_POST["name"];
             $gender = $_POST["gender"];
             $birthdate = $_POST["birthdate"];

             $creationDate = date("Y/m/d");

             $lastUser_id = null;

             $sth = $dbh->prepare('SELECT pseudo FROM user;');
             $sth->execute();
             $verifyUniquePseudo = $sth->fetchAll();

             $sth = $dbh->prepare('SELECT email FROM userdetails;');
             $sth->execute();
             $verifyUniqueMail = $sth->fetchAll();

             //var_dump($verifyUniqueMail);

             for ($i = 0; $i < count($verifyUniqueMail); $i++) {
                 if ($email == $verifyUniqueMail[$i][0]) {
                     die("Cette adresse mail existe deja");
                 }
             }

             for ($i = 0; $i < count($verifyUniquePseudo); $i++) {
                 if ($pseudo == $verifyUniquePseudo[$i][0]) {
                     die("Ce pseudo existe deja");
                 }
             }

             $password = $_POST["password"];
             $password = password_hash($password, PASSWORD_ARGON2I);
             var_dump($password);

             $query = $dbh->prepare("INSERT INTO user (pseudo, passwd, premium) VALUES ('" . $pseudo . "', '" . $password . "', 0)");
             $query->execute();
             print_r($query->errorInfo());

             $query = $dbh->prepare("SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1;");
             $query->execute();
             print_r($query->errorInfo());
             $lastUser_id = intval($query->fetchAll()[0][0]);

             $query = $dbh->prepare("INSERT INTO userdetails (user_id, email, name, gender, birthdate, creationDate, rank) VALUES ($lastUser_id,
        '" . $email . "',
        '" . $name . "',
        '" . $gender . "',
        '" . $birthdate . "',
        '" . $creationDate . "',
        'user')");
             $query->execute();


             $query = $dbh->prepare("SELECT userdetails_id FROM userdetails ORDER BY userdetails_id DESC LIMIT 1;");
             $query->execute();
             $lastUserDetails_id = $query->fetchAll()[0][0];

             $query = $dbh->prepare("UPDATE user SET userdetails_id = $lastUserDetails_id WHERE user_id = $lastUser_id");
             $query->execute();


         }
         else {
             echo "Le mot de passe ne repond pas aux exigences";
         }

     }
     else {
        echo "NON";
     }
 }
?>