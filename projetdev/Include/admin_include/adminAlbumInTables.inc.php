<?php
function selectAllAlbums(&$dbh, $artist)
{
    $query = $dbh->prepare("SELECT * FROM album WHERE artiste_id=$artist");
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

function displaySelectArtist(&$dbh)
{
    $sth = $dbh->prepare("SELECT name, artiste_id FROM artist");
    $sth->execute();
    $types = $sth->fetchAll();

    for ($i = 0; $i < count($types); $i++)
    {
        if (!empty($_POST['selectArtist']) || !empty($_GET['selectArtist']))
        {
            if (!empty($_POST['selectArtist']))
            {
                $selectArtist = $_POST['selectArtist'];
            }
            else {
                $selectArtist = $_GET['selectArtist'];
            }


            if ($selectArtist == $types[$i]['artiste_id'])
            {
                echo "<option value='" . $types[$i]['artiste_id'] . "' selected>" . $types[$i]['name'] . "</option>";
            }
            else {
                echo "<option value='" . $types[$i]['artiste_id'] . "'>" . $types[$i]['name'] . "</option>";
            }
        }
        else {
            echo "<option value='" . $types[$i]['artiste_id'] . "'>" . $types[$i]['name'] . "</option>";
        }

    }
}

function countNbTracks(&$dbh, $album_id)
{
    $sth = $dbh->prepare("SELECT COUNT(*) FROM music WHERE album_id=$album_id");
    $sth->execute();
    $nbTracks = $sth->fetchAll();

    return $nbTracks[0][0];
}

function displayTable(&$dbh)
{
    if (!empty($_POST['selectArtist']) || !empty($_GET['selectArtist']))
    {
        if (!empty($_POST['selectArtist']))
        {
            $artist = $_POST['selectArtist'];
        }
        else {
            $artist = $_GET['selectArtist'];
        }
        $allAlbums = selectAllAlbums($dbh, $artist);




        for ($i = 0; $i < count($allAlbums); $i++) {
            $urlModif = "adminAlbum.php?albumId=" . $allAlbums[$i]['album_id'] . "&album_name=" . $allAlbums[$i]['name'] . "&disponibility=" . $allAlbums[$i]['disponibility'] . "&label=" . $allAlbums[$i]['labelName'] . "&selectArtist=" . $artist;

            //Boutons modifier et supprimer
            $links = "<td><a href='$urlModif'>Modifier</a></td><td><a href='adminAlbum.php?deleteid=" . $allAlbums[$i]['album_id'] . "&selectArtist=" . $artist . "'>Supprimer</a></td>";

            $nbTracks = countNbTracks($dbh, $allAlbums[$i]['album_id']);

            echo "<tr><td>" . $allAlbums[$i]['album_id'] . "</td>
                      <td>" . $allAlbums[$i]['name'] . "</td>
                      <td>" . $allAlbums[$i]['disponibility'] . "</td>
                      <td>" . $nbTracks . "</td>
                      <td>" . $allAlbums[$i]['labelName'] . "</td>
                      $links</tr>";
        }
    }
}
?>