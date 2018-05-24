<?php
function uploadMusic($uploadPath){
    if (isset($_FILES['musicFile'])){
        //$uploadPath = "Assets/IMG/";
        $upload = $uploadPath . basename($_FILES['musicFile']['name']);

        if (move_uploaded_file($_FILES['musicFile']['tmp_name'], $upload)) {

            return "La photo a été ajouté à la galerie.";
        } else {
            return "Fichier non valide! Code d'erreur : " . $_FILES['musicFile']['error'];
        }
    }
}

function uploadLyrics($uploadPath){
    if (isset($_FILES['lyricsFile'])){
        //$uploadPath = "Assets/IMG/";
        $upload = $uploadPath . basename($_FILES['lyricsFile']['name']);

        if (move_uploaded_file($_FILES['lyricsFile']['tmp_name'], $upload)) {

            return "La photo a été ajouté à la galerie.";
        } else {
            return "Fichier non valide! Code d'erreur : " . $_FILES['lyricsFile']['error'];
        }
    }
}

function addArtist(&$dbh)
{
    if (!empty($_POST['musicTitle']) && !empty($_POST['musicAlbum']) && !empty($_POST['musicDurationMin']) && !empty($_POST['musicDurationSec']) && !empty($_FILES['musicFile']))
    {
        $musicTitle = $_POST['musicTitle'];
        $musicAlbum = $_POST['musicAlbum'];
        $musicDuration = $_POST['musicDurationMin'] . " : " . $_POST['musicDurationSec'];
        $musicFile = $_FILES['musicFile']['name'];

        if (!empty($_FILES['lyricsFile']['name']))
        {
            $lyricsFile = $_FILES['lyricsFile']['name'];
            $lyricsPath = 'Assets/Lyrics/';
            uploadLyrics($lyricsPath);

            $lyricsFilePath = $lyricsPath . $lyricsFile;
        } else {
            $lyricsFilePath = null;
        }

        if (!empty($_POST['musicName']))
        {
            $musicName = $_POST['musicName'];
        } else {
            $musicName = null;
        }

        $musicPath = 'Assets/Music/';
        uploadMusic($musicPath);



        $query = $dbh->prepare("INSERT INTO music(title, name, duration, lyricsPath, file, album_id) VALUE ('$musicTitle', '$musicName', '$musicDuration', '$lyricsFilePath', '" . $musicPath . $musicFile . "', $musicAlbum)");
        $query->execute();
    }
}


addArtist($dbh);
?>