<?php
function selectAllMusics(&$dbh, $albumId)
{
    $query = $dbh->prepare("SELECT * FROM music WHERE album_id=$albumId");
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

function displayTable(&$dbh)
{
    if ((!empty($_POST['selectAlbum']) && !empty($_POST['selectArtist'])) || (!empty($_GET['album']) && !empty($_GET['artist'])))
    {
        if (!empty($_POST['selectArtist']) && !empty($_POST['selectAlbum']))
        {
            $album = $_POST['selectAlbum'];
            $artist = $_POST['selectArtist'];
            $allMusics = selectAllMusics($dbh, $_POST['selectAlbum']);
        }
        else
        {
            $album = $_GET['album'];
            $artist = $_GET['artist'];
            $allMusics = selectAllMusics($dbh, $_GET['album']);
        }

        for ($i = 0; $i < count($allMusics); $i++)
        {
            $urlModif = "adminMusic.php?music_id=". $allMusics[$i]['music_id'] ."&title=". $allMusics[$i]['title']."&name=". $allMusics[$i]['name']."&duration=". $allMusics[$i]['duration']
                ."&album=". $album."&artist=". $artist;

            //Boutons modifier et supprimer
            $links = "<td><a href='$urlModif'>Modifier</a></td><td><a href='adminMusic.php?deleteid=" . $allMusics[$i]['music_id'] . "&album=$album&artist=$artist'>Supprimer</a></td>";

            echo "<tr><td>" . $allMusics[$i]['music_id'] . "</td>
                  <td>" . $allMusics[$i]['title'] . "</td>
                  <td>" . $allMusics[$i]['name'] . "</td>
                  <td>" . $allMusics[$i]['duration'] . "</td>
                  $links</tr>";
        }
    }
}

displayTable($dbh);
?>