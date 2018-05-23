<?php
function displayModificationForm()
{
    if (!empty($_GET['music_id']) && !empty($_GET['title']) && !empty($_GET['name']) && !empty($_GET['duration']) && !empty($_GET['album']) && !empty($_GET['artist'])) {

        $music_id = $_GET['music_id'];
        $musicTitle = $_GET['title'];
        $musicName = $_GET['name'];
        $musicDuration = $_GET['duration'];

        $album = $_GET['album'];
        $artist = $_GET['artist'];

        echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
        
        
        <input type='hidden' name='selectAlbum' value='$album'/>
        <input type='hidden' name='selectArtist' value='$artist'/>
        <input type='hidden' name='music_id' value='$music_id'>
        
        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='music_id'>Identifiant :</label>   
                <input class='form-control' type='text' id='music_id' name='music_idDisabled' value='$music_id' disabled>
            </div>
            <div class='form-group col-md-6'>
                <label for='musicTitle'>Titre :</label>
                <input class='form-control' id='musicTitle' type='text' name='musicTitle' value='$musicTitle'>
            </div>
        </div>
             
        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='musicName'>Nom :</label>   
                <input class='form-control' type='text' id='musicName' name='musicName' value='$musicName'>
            </div>
            <div class='form-group col-md-6'>
                <label for='musicDuration'>Duree :</label>
                <input class='form-control' id='musicDuration' type='text' name='musicDuration' value='$musicDuration'>
            </div>
        </div>     
             
        <br/>
        <div class='form-row'>
            <input class='form-control' type='submit' name='subValidate' value='Valider'>
        </div>
        </form>";
    }
}

function modifyType(&$dbh)
{
    if(!empty($_POST['subValidate']))
    {
        if(!empty($_POST['music_id']) && !empty($_POST['musicTitle']) && !empty($_POST['musicName']) && !empty($_POST['musicDuration']))
        {
            $music_id = $_POST['music_id'];
            $musicTitle = $_POST['musicTitle'];
            $musicName = $_POST['musicName'];
            $musicDuration = $_POST['musicDuration'];

            $query = $dbh->prepare("UPDATE music SET title = '$musicTitle', name='$musicName', duration='$musicDuration' WHERE music_id = '$music_id'");
            $query->execute();


            header("Refresh: 0, url=adminMusic.php?album=". $_POST['selectAlbum']."&artist=". $_POST['selectArtist']);
        }
    }
}

function delete(&$dbh)
{
    if(!empty($_GET['deleteid']) && !empty($_GET['album']) && !empty($_GET['artist']))
    {
        $idToDelete = $_GET['deleteid'];
        $query = $dbh->prepare("DELETE FROM music WHERE music_id = '$idToDelete'");
        $query->execute();

        header("Refresh: 0, url=adminMusic.php?album=". $_GET['album']."&artist=". $_GET['artist']);
    }
}

displayModificationForm();
modifyType($dbh);
delete($dbh);
?>