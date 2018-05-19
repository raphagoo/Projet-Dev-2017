<?php
function verifyPassword($password)
{
    if (preg_match("((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{8,20}) ", $password) && !preg_match("((?=.*" . $_POST['username'] . "))", $password))
    {
        return true;
    }
    else {
        return false;
    }
}

function verifyName(&$dbh, $username, $password)
{
    $verified = true;

    $query = $dbh->prepare('SELECT pseudo FROM user');
    $query->execute();
    $verifyUniqueName = $query->fetchAll();

    for ($i = 0; $i < count($verifyUniqueName); $i++){
        if($username == $verifyUniqueName[$i][0]){
            echo "Ce nom d'utilisateur existe déjà.";
            $verified = false;
        }
    }

    if ($verified)
    {
        $verified = verifyPassword($password);
    }

    return $verified;
}

function addAdmin(&$dbh)
{
    if (!empty($_POST['addAdminSubmit']))
    {
        $username = $_POST['username'];
        $password = $_POST['adminPassword'];
        $creationDate = date("Y/m/d");

        if (verifyName($dbh, $username, $password))
        {
            $password = password_hash($password, PASSWORD_ARGON2I);

            $query = $dbh->prepare("INSERT INTO user (pseudo, passwd, premium) VALUE ('$username', '$password', 1)");
            $query->execute();

            $query = $dbh->prepare("SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1;");
            $query->execute();
            $lastAdmin_id = intval($query->fetchAll()[0][0]);

            $query = $dbh->prepare("INSERT INTO userdetails (user_id, rank, creationDate) VALUES ($lastAdmin_id, 'admin', '$creationDate')");
            $query->execute();

            $query = $dbh->prepare("SELECT userdetails_id FROM userdetails ORDER BY userdetails_id DESC LIMIT 1;");
            $query->execute();
            $lastDetails_id = $query->fetchAll()[0][0];

            $query = $dbh->prepare("UPDATE user SET userdetails_id = $lastDetails_id WHERE user_id = $lastAdmin_id");
            $query->execute();
        }
    }
}


addAdmin($dbh);

?>