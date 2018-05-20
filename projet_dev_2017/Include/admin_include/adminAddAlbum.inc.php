<?php
function uploadPicture($uploadPath){
    if (isset($_FILES['albumImage'])){
        //$uploadPath = "Assets/IMG/";
        $upload = $uploadPath . basename($_FILES['albumImage']['name']);

        if (move_uploaded_file($_FILES['albumImage']['tmp_name'], $upload)) {

            return "La photo a été ajouté à la galerie.";
        } else {
            return "Fichier non valide! Code d'erreur : " . $_FILES['albumImage']['error'];
        }
    }
}

function addArtist(&$dbh)
{
    if (!empty($_POST['Album_name']) && !empty($_POST['albumDisponibility']) && !empty($_POST['albumArtist']))
    {
        $Album_name = $_POST['Album_name'];
        $dispo = $_POST['albumDisponibility'];
        $albumArtist = $_POST['albumArtist'];
        $albumImage = $_FILES['albumImage']['name'];
        $albumReleaseDate = null;
        $albumLabel = null;

        if (!empty($_POST['albumReleaseDate']))
        {
            $albumReleaseDate = $_POST['albumReleaseDate'];
        }

        if (!empty($_POST['albumLabel']))
        {
            $albumLabel = $_POST['albumLabel'];
        }

        $path = 'Assets/IMG/';
        uploadPicture($path);

        $query = $dbh->prepare("INSERT INTO album(name, disponibility, labelName, releaseDate, picturePath, artiste_id) VALUE ('$Album_name', '$dispo', '$albumLabel' , '$albumReleaseDate', '" . $path . $albumImage . "', $albumArtist)");
        $query->execute();
    }
}


addArtist($dbh);
?>