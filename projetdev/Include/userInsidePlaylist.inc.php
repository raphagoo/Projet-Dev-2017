<?php
function getPlaylistMusics(&$dbh, $playlist_id)
{
    $sth = $dbh->prepare("SELECT * FROM music WHERE music_id IN (SELECT music_id FROM music_playlist WHERE playlist_id = $playlist_id)");
    $sth->execute();
    $result = $sth->fetchAll();
    return $result;
}
function getMusicAlbum(&$dbh, $music_id)
{
    $sth = $dbh->prepare("SELECT name FROM album WHERE album_id = (SELECT album_id FROM music WHERE music_id=$music_id)");
    $sth->execute();
    $result = $sth->fetchAll();
    return $result[0]['name'];
}
function getAlbumArtist(&$dbh, $music_id)
{
    $sth = $dbh->prepare("SELECT a.name FROM artist a, album alb, music m WHERE a.artiste_id = alb.artiste_id AND alb.album_id = m.album_id AND m.music_id = $music_id");
    $sth->execute();
    $result = $sth->fetchAll();
    return $result[0]['name'];
}
function displayInsidePlaylist(&$dbh)
{
    if (!empty($_GET['playlist_id']))
    {
        $playlist_id = $_GET['playlist_id'];
        $playlistMusics = getPlaylistMusics($dbh, $playlist_id);
        for ($i = 0; $i < count($playlistMusics); $i++)
        {
            echo "
            <tr><td>" . $playlistMusics[$i]['title'] . "</td>
            <td>" . getMusicAlbum($dbh, $playlistMusics[$i]['music_id']) . "</td>
            <td>" . getAlbumArtist($dbh, $playlistMusics[$i]['music_id']) . "</td>
            <td><a href='userInsidePlaylist?playlist_id=$playlist_id&delete_id=" . $playlistMusics[$i]['music_id'] . "'>supprimer</a></td>
            </tr>
            ";
        }
    }
}
function deleteFromPlaylist(&$dbh)
{
    if (!empty($_GET['delete_id']) && !empty($_GET['playlist_id']))
    {
        $playlist_id = $_GET['playlist_id'];
        $delete_id = $_GET['delete_id'];
        $sth = $dbh->prepare("DELETE FROM music_playlist WHERE playlist_id=$playlist_id AND music_id=$delete_id");
        $sth->execute();
    }
}
deleteFromPlaylist($dbh);
?>