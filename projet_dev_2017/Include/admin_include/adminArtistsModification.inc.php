<?php

function generateTypeSelect(&$dbh)
{
    $sth = $dbh->prepare("SELECT * FROM type");
    $sth->execute();
    $types = $sth->fetchAll();

    $str = "";
    for ($i = 0; $i < count($types); $i++)
    {
        $str .= "<option value='" . $types[$i][0] . "'>" . $types[$i][0] . "</option>";
    }

    return $str;
}

function displayModificationForm(&$dbh)
{
    if (!empty($_GET['artist']))
    {
        $artistId = $_GET['artistId'];
        $artist = $_GET['artist'];
        $artistNickname = $_GET['nickname'];
        $artistType = $_GET['type_name'];
        //$previousName = $artist;

        echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
        
        
        <div class='form-row'>
            <label for='artistId'>Identifiant :</label>
            <input type='hidden' name='artistId' value='$artistId'>
            <input class='form-control' type='text' id='artistId' name='artistId' value='$artistId' disabled>
        </div>
        
        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='artist'>Nom de l'artiste :</label>   
                <input class='form-control' type='text' id='artist' name='artist' value='$artist'>
            </div>
            <div class='form-group col-md-6'>
                <label for='artistNickname'>Pseudo :</label>
                <input class='form-control' id='artistNickname' type='text' name='artistNickname' value='$artistNickname'>
            </div>
        </div>
        
        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='type_name'>Categorie : </label>
                <select id='type_name' name='type_name'>" . generateTypeSelect($dbh) . "</select>
            </div>
        </div>
        
        <br/>
        <div class='form-row'>
            <input class='form-control' type='submit' name='subValidate' value='Valider'>
        </div>
        </form>";
    }
}

function modifyUser(&$dbh)
{
    if(!empty($_POST['subValidate']))
    {
        if(!empty($_POST['artistId']) && !empty($_POST['artist']) && !empty($_POST['type_name']))
        {
            $artistId = $_POST['artistId'];
            $artist = $_POST['artist'];
            $type_name = $_POST['type_name'];

            if (!empty($_POST['artistNickname']))
            {
                $nickname = $_POST['artistNickname'];
            } else {
                $nickname = null;
            }

            $query = $dbh->prepare("UPDATE artist SET name = '$artist', nickname = '$nickname', type_name = '$type_name' WHERE artiste_id = '$artistId'");
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
        $query = $dbh->prepare("DELETE FROM artist WHERE Artiste_id = '$idToDelete'");
        $query->execute();

        header("Refresh: 0, url=adminArtists.php");
    }
}

displayModificationForm($dbh);
modifyUser($dbh);
delete($dbh);
?>