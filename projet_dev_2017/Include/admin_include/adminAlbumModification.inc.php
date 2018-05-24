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
    if (!empty($_GET['albumId']) && !empty($_GET['album_name']) && !empty($_GET['disponibility']) && !empty($_GET['selectArtist']))
    {
        $artistId = $_GET['selectArtist'];
        $album_id = $_GET['albumId'];
        $album_name = $_GET['album_name'];
        $disponibility = $_GET['disponibility'];

        if (!empty($_GET['label']))
        {
            $label = $_GET['label'];
        }
        else {
            $label = "";
        }

        if ($disponibility == 1)
        {
            $str_disponibility = "<option value='1' selected>Disponible</option><option value='2'>Indisponible</option>";
        }
        else {
            $str_disponibility = "<option value='1'>Disponible</option><option value='2' selected>Indisponible</option>";
        }

        echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
        
        
        <div class='form-row'>
            <input type='hidden' name='selectArtist' value='$artistId'>
            <label for='album_id'>Identifiant :</label>
            <input type='hidden' name='album_id' value='$album_id'>
            <input class='form-control' type='text' id='album_id' name='album_id' value='$album_id' disabled>
        </div>
        
        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='album_name'>Nom de l'album :</label>   
                <input class='form-control' type='text' id='album_name' name='album_name' value='$album_name'>
            </div>
            <div class='form-group col-md-6'>
                <label for='disponibility'>Disponibilité :</label>
                <select class='form-control' id='disponibility' name='disponibility'>
                    " . $str_disponibility . "
                </select>
            </div>
        </div>
        
        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='labelName'>Label : </label>
                <input class='form-control' id='labelName' type='text' name='labelName' value='$label'>
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
        if(!empty($_POST['album_id']) && !empty($_POST['album_name']) && !empty($_POST['disponibility']) && !empty($_POST['selectArtist']))
        {
            $artistId = $_POST['selectArtist'];
            $album_id = $_POST['album_id'];
            $album_name = $_POST['album_name'];
            $disponibility = $_POST['disponibility'];

            if (!empty($_POST['labelName']))
            {
                $label = $_POST['labelName'];
            }
            else {
                $label = null;
            }

            $query = $dbh->prepare("UPDATE album SET name = '$album_name', disponibility = '$disponibility', labelName = '$label' WHERE album_id=$album_id");
            $query->execute();

            header("Refresh: 0, url=adminAlbum.php?selectArtist=$artistId");
        }
    }
}

function delete(&$dbh)
{
    if(!empty($_GET['deleteid']) && !empty($_GET['selectArtist']))
    {
        $selectArtist = $_GET['selectArtist'];
        $idToDelete = $_GET['deleteid'];
        $query = $dbh->prepare("DELETE FROM album WHERE album_id = '$idToDelete'");
        $query->execute();

        header("Refresh: 0, url=adminAlbum.php?selectArtist=$selectArtist");
    }
}

displayModificationForm($dbh);
modifyUser($dbh);
delete($dbh);
?>