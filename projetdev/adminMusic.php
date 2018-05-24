<?php require ("include/connectToDB.inc.php");
require ("include/admin_include/verifyAdminAccess.inc.php");

function genSelectArtist(&$dbh)
{
    $sth = $dbh->prepare("SELECT name, artiste_id FROM artist");
    $sth->execute();
    $types = $sth->fetchAll();

    if (!empty($_POST['selectArtist']))
    {
        for ($i = 0; $i < count($types); $i++)
        {
            if ($_POST['selectArtist'] == $types[$i]['artiste_id'])
            {
                echo "<option value='" . $types[$i]['artiste_id'] . "' selected>" . $types[$i]['name'] . "</option>";
            }
            else {
                echo "<option value='" . $types[$i]['artiste_id'] . "'>" . $types[$i]['name'] . "</option>";
            }
        }
    }
    else if ($_GET['artist'])
    {
        for ($i = 0; $i < count($types); $i++)
        {
            if ($_GET['artist'] == $types[$i]['artiste_id'])
            {
                echo "<option value='" . $types[$i]['artiste_id'] . "' selected>" . $types[$i]['name'] . "</option>";
            }
            else {
                echo "<option value='" . $types[$i]['artiste_id'] . "'>" . $types[$i]['name'] . "</option>";
            }
        }
    }
    else {
        for ($i = 0; $i < count($types); $i++)
        {
            echo "<option value='" . $types[$i]['artiste_id'] . "'>" . $types[$i]['name'] . "</option>";
        }
    }
}

function genSelectAlbum(&$dbh)
{
    if (!empty($_POST['selectArtist']) || !empty($_GET['artist']))
    {
        if (!empty($_POST['selectArtist']))
        {
            $artist = $_POST['selectArtist'];
        }
        else {
            $artist = $_GET['artist'];
        }

        $sth = $dbh->prepare("SELECT name, album_id FROM album WHERE artiste_id=$artist");
        $sth->execute();
        $types = $sth->fetchAll();

        if (!empty($_POST['selectAlbum']))
        {
            for ($i = 0; $i < count($types); $i++)
            {
                if ($_POST['selectAlbum'] == $types[$i]['album_id'])
                {
                    echo "<option value='" . $types[$i]['album_id'] . "' selected>" . $types[$i]['name'] . "</option>";
                }
                else {
                    echo "<option value='" . $types[$i]['album_id'] . "'>" . $types[$i]['name'] . "</option>";
                }
            }
        }
        else if ($_GET['album'])
        {
            for ($i = 0; $i < count($types); $i++)
            {
                if ($_GET['album'] == $types[$i]['album_id'])
                {
                    echo "<option value='" . $types[$i]['album_id'] . "' selected>" . $types[$i]['name'] . "</option>";
                }
                else {
                    echo "<option value='" . $types[$i]['album_id'] . "'>" . $types[$i]['name'] . "</option>";
                }
            }
        }
        else {
            for ($i = 0; $i < count($types); $i++)
            {
                echo "<option value='" . $types[$i]['album_id'] . "'>" . $types[$i]['name'] . "</option>";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Musique - ADMINISTRATION</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
<div class="container">
    <h1>ADMINISTRATION - MUSIQUE</h1>

    <div>
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
            <label for="selectArtist">Selectionner un artiste : </label>
            <select id="selectArtist" name="selectArtist">
                <?php genSelectArtist($dbh); ?>
            </select>

            <label for="subArtist">Valider : </label>
            <input type="submit" id="subArtist" name="subArtist" />
        </form>
    </div>

    <div>
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">

            <input type="hidden" name="selectArtist" value="<?php if (!empty($_POST['selectArtist'])){echo $_POST['selectArtist'];}  ?>">

            <label for="selectAlbum">Selectionner un album : </label>
            <select id="selectAlbum" name="selectAlbum">
                <?php genSelectAlbum($dbh); ?>
            </select>

            <label for="subAlbum">Valider : </label>
            <input type="submit" id="subAlbum" name="subAlbum" />
        </form>
    </div>

    <div id="adminUsersDivTable">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Identifiant</th>
                <th>Titre</th>
                <th>Nom</th>
                <th>Duree</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>

            <tfoot>

            </tfoot>

            <tbody>
            <?php require ("include/admin_include/adminMusicInTables.inc.php"); ?>
            </tbody>
        </table>
        <br/>
        <?php require ("include/admin_include/adminMusicModification.inc.php"); ?>
    </div>
    <br/><a href="adminHome.php"><button class="btn btn-primary">Retour au panneau d'Administration</button></a>
</div>
</body>
</html>
