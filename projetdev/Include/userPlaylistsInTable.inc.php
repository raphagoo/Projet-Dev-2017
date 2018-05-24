<?php

function notEmptyPseudo()
{
    if (empty($_SESSION['pseudo']))
    {
        echo "<p>Vous devez etre connecte</p><div class=''><a href='connexion.php' class='btn btn-info'>Connection</a> <a href='registration.php' class='btn btn-info'>Inscription</a></div>";
        return false;
    }
    else {
        return true;
    }
}

function getUserId(&$dbh, $pseudo)
{
    $sth = $dbh->prepare("SELECT user_id FROM user WHERE pseudo='$pseudo'");
    $sth->execute();
    $userId = $sth->fetchAll();

    return $userId[0]['user_id'];
}

function getUserPlaylists(&$dbh, $userId)
{
    $sth = $dbh->prepare("SELECT * FROM playlist WHERE user_id='$userId'");
    $sth->execute();
    $userPlaylists = $sth->fetchAll();

    return $userPlaylists;
}

function createPlaylist(&$dbh)
{
    if (notEmptyPseudo() && !empty($_POST['subCreatePlaylist']))
    {
        if (!empty($_POST['playlistName']))
        {
            $userId = getUserId($dbh, $_SESSION['pseudo']);
            $playlistName = $_POST['playlistName'];
            $creationDate = date("Y/m/d");

            $sth = $dbh->prepare("INSERT INTO playlist (name, creationDate, user_id) VALUES ('$playlistName', '$creationDate', $userId)");
            $sth->execute();

            header("Refresh: 0");
        }
    }
}

function modifyPlaylist(&$dbh)
{
    if (notEmptyPseudo() && !empty($_POST['subModPlaylist']))
    {
        if (!empty($_POST['modPlaylist_id']) && !empty($_POST['modPlaylistName']))
        {

            $playlistName = $_POST['modPlaylistName'];
            $playlist_id = $_POST['modPlaylist_id'];

            $sth = $dbh->prepare("UPDATE playlist SET name='$playlistName' WHERE playlist_id=$playlist_id");
            $sth->execute();

            header("Refresh: 0");
        }
    }
}

function deletePlaylist(&$dbh)
{
    if (notEmptyPseudo() && !empty($_POST['subDelPlaylist']))
    {
        if (!empty($_POST['playlist_id']))
        {
            $playlist_id = $_POST['playlist_id'];

            $sth = $dbh->prepare("DELETE FROM playlist WHERE playlist_id=$playlist_id");
            $sth->execute();

            header("Refresh: 0");
        }
    }
}

function displayTable(&$dbh)
{
    if (notEmptyPseudo())
    {
        $userId = getUserId($dbh, $_SESSION['pseudo']);
        $userPlaylists = getUserPlaylists($dbh, $userId);

        $nbPlaylists = count($userPlaylists);

        if (!empty($_POST['subPlaylistMod']))
        {
            for ($i = 0; $i < $nbPlaylists; $i++)
            {
                if ($_POST['playlist_id'] == $userPlaylists[$i]['playlist_id'])
                {
                    //Modification <td>
                    echo "<tr><form action='" . $_SERVER['PHP_SELF'] . "' method='post'><input type='hidden' value='" . $userPlaylists[$i]['playlist_id'] . "' name='modPlaylist_id'><td><input type='text' name='modPlaylistName' value='" . $userPlaylists[$i]['name'] . "'></td><td>" . $userPlaylists[$i]['creationDate'] . "</td><td colspan='2'><input type='submit' name='subModPlaylist' value='Valider'></td></form></tr>";
                }

                else {
                    //Normal <td>
                    echo "<tr><form action='" . $_SERVER['PHP_SELF'] . "' method='post'><input type='hidden' value='" . $userPlaylists[$i]['playlist_id'] . "' name='playlist_id'><td>" . $userPlaylists[$i]['name'] . "</td><td>" . $userPlaylists[$i]['creationDate'] . "</td><td><input type='submit' name='subPlaylistMod' value='Modifier'></td><td><input type='submit' name='subDelPlaylist' value='Supprimer'></td></form></tr>";
                }
            }
            //Creation <td>
            echo "<tr><form action='" . $_SERVER['PHP_SELF'] . "' method='post'><td colspan='3'><input type='text' name='playlistName' required></td><td><input type='submit' name='subCreatePlaylist' value='Ajouter'></td></form></tr>";
        }
        else {
            for ($i = 0; $i < $nbPlaylists; $i++) {
                //Normal <td>
                echo "<tr><form action='" . $_SERVER['PHP_SELF'] . "' method='post'><input type='hidden' value='" . $userPlaylists[$i]['playlist_id'] . "' name='playlist_id'><td>" . $userPlaylists[$i]['name'] . "</td><td>" . $userPlaylists[$i]['creationDate'] . "</td><td><input type='submit' name='subPlaylistMod' value='Modifier'></td><td><input type='submit' name='subDelPlaylist' value='Supprimer'></td></form></tr>";
            }
            //Creation <td>
            echo "<tr><form action='" . $_SERVER['PHP_SELF'] . "' method='post'><td colspan='3'><input type='text' name='playlistName' required></td><td><input type='submit' name='subCreatePlaylist' value='Ajouter'></td></form></tr>";
        }
    }
}

createPlaylist($dbh);
modifyPlaylist($dbh);
deletePlaylist($dbh);
?>