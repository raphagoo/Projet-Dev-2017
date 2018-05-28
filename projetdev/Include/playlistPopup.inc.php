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

function addMusicToPlaylist(&$dbh)
{
    if (!empty($_POST['validateAddToPlaylist']))
    {
        if (!empty($_POST['playlists']) && !empty($_POST['musicToAddId']))
        {
            $playlists = $_POST['playlists'];
            $music_id = $_POST['musicToAddId'];

            for ($i = 0; $i < count($playlists); $i++)
            {
                $sth = $dbh->prepare("INSERT INTO music_playlist (music_id, playlist_id) VALUES ($music_id, " . $playlists[$i] . ")");
                $sth->execute();
                print_r($sth->errorInfo());
            }
        }
    }
}

function popupListPlaylists(&$dbh)
{
    if (notEmptyPseudo())
    {
        $userId = getUserId($dbh, $_SESSION['pseudo']);
        $userPlaylists = getUserPlaylists($dbh, $userId);

        $nbPlaylists = count($userPlaylists);

        if ($nbPlaylists != 0)
        {
            for ($i = 0; $i < $nbPlaylists; $i++)
            {
                echo "
                <div class='form-group'>
                    <div class='checkbox'>
                        <label>
                            <input type='checkbox' name='playlists[]' value='" . $userPlaylists[$i]['playlist_id'] . "'/>" . $userPlaylists[$i]['name'] . "
                        </label>
                    </div>
                </div>
                ";
            }
            echo '<input class="btn btn-secondary" id="validateAddToPlaylist" name="validateAddToPlaylist" value="Ajouter" type="submit" />';
        }
        else {
            echo "<a href='userPlaylists.php' class='btn btn-info'>Creer une nouvelle playlist</a>";
        }
    }
}
?>