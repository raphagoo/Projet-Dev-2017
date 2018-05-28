<?php

function displayModificationForm()
{
    if (!empty($_GET['user_id']) && !empty($_GET['pseudo']) && !empty($_GET['rank']))
    {
        $user_id = $_GET['user_id'];
        $pseudo = $_GET['pseudo'];
        $rank = $_GET['rank'];

        if (!empty($_GET['email']))
        {
            $email = $_GET['email'];
        }
        else {
            $email = "";
        }

        if ($rank == "admin")
        {
            $rankOptions = "<option value='user'>User</option><option value='admin' selected>Admin</option>";
        }
        else {
            $rankOptions = "<option value='user' selected>User</option><option value='admin'>Admin</option>";
        }

        echo "<div id='form'><form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
        <div class='form-row'>
            <label for='disabledUser_id'>Identifiant :</label>
            <input class='form-control' type='text' id='disabledUser_id' name='disabledUser_id' value='$user_id' disabled>
            <input class='form-control' type='hidden' name='user_id' value='$user_id'>
        </div>
        <br/>
        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='pseudo'>Nom d'utilisateur :</label>
                <input class='form-control' type='text' id='pseudo' name='pseudo' value='$pseudo'>
            </div>
            <div class='form-group col-md-6'>
                <label for='email'>Email :</label>
                <input class='form-control' type='email' id='email' name='email' value='$email'>
            </div>
        </div>
        
        <div class='form-row'>   
            <select name='rank' class='form-control'>
                " . $rankOptions . "
            </select>     
        </div>
        <br/>
        <div class='form-row'>   
            <input class='form-control' type='submit' name='subValidate' value='Valider'>      
        </div>
        </form></div>";
    }
}

function modifyUser(&$dbh)
{
    if(!empty($_POST['subValidate']))
    {
        if(!empty($_POST['user_id']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['rank']))
        {
            $user_id = $_POST['user_id'];
            $pseudo = $_POST['pseudo'];
            $rank = $_POST['rank'];
            $email = $_POST['email'];

            $sth = $dbh->prepare("SELECT pseudo FROM user WHERE user_id != $user_id");
            $sth->execute();
            $verifyUniquePseudo = $sth->fetchAll();

            $sth = $dbh->prepare("SELECT email FROM userdetails WHERE user_id != $user_id");
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

            $query = $dbh->prepare("UPDATE user SET pseudo = '$pseudo' WHERE user_id = $user_id");
            $query->execute();

            $query = $dbh->prepare("UPDATE userdetails SET email = '$email', rank = '$rank' WHERE user_id = $user_id");
            $query->execute();

            header("Refresh: 0");
        }
    }
}

function delete(&$dbh)
{
    if(!empty($_GET['deleteid']))
    {
        $idToDelete = $_GET['deleteid'];
        $query = $dbh->prepare("DELETE FROM user WHERE user_id = $idToDelete");
        $query->execute();

        header("Refresh: 0, url=adminUsers.php");
    }
}

displayModificationForm();
modifyUser($dbh);
delete($dbh);
?>