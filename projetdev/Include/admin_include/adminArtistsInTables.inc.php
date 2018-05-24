<?php
function selectAllArtists(&$dbh)
{
    $query = $dbh->prepare("SELECT * FROM artist");
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

function selectListAlbum(&$dbh, $artistName)
{
    $query = $dbh->prepare("SELECT name FROM album WHERE artiste_id = (SELECT artiste_id FROM artist WHERE name='$artistName')");
    $query->execute();
    $albums = $query->fetchAll();

    $str = "";

    for ($i = 0; $i < count($albums); $i++)
    {
        $str .= "<option>" . $albums[$i]['name'] . "</option>";
    }

    return $str;
}

function displayTable(&$dbh)
{
    $allArtists = selectAllArtists($dbh);

    for ($i = 0; $i < count($allArtists); $i++)
    {
        $urlModif = "adminArtists.php?artistId=". $allArtists[$i]['artiste_id'] ."&artist=". $allArtists[$i]['name']."&nickname=". $allArtists[$i]['nickname'] ."&type_name=". $allArtists[$i]['type_name'];

        //Boutons modifier et supprimer
        $links = "<td><a href='$urlModif'>Modifier</a></td><td><a href='adminArtists.php?deleteid=" . $allArtists[$i]['artiste_id'] . "'>Supprimer</a></td>";

        echo "<tr><td>" . $allArtists[$i]['artiste_id'] . "</td>
                  <td>" . $allArtists[$i]['name'] . "</td>
                  <td>" . $allArtists[$i]['nickname'] . "</td>
                  <td>" . $allArtists[$i]['type_name'] . "</td>
                  <td><select>" . selectListAlbum($dbh, $allArtists[$i]['name']) . "</select></td>
                  $links</tr>";
    }
}

displayTable($dbh);
?>