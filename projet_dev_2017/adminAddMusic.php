<?php
require ("include/connectToDB.inc.php");
require ("include/admin_include/adminAddMusic.inc.php");
require ("include/admin_include/verifyAdminAccess.inc.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Panneau d'administration - Ajout de musique</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>ADMINISTRATION - Ajout de musique</h1>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for="musicTitle">Titre :</label>
                <input class='form-control' type="text" id="musicTitle" name="musicTitle" required />
            </div>
            <div class='form-group col-md-6'>
                <label for="musicName">Nom : </label>
                <input class="form-control" type="text" id="musicName" name="musicName">
            </div>
        </div>

        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for="musicAlbum">Album :</label>
                <select id="musicAlbum" name="musicAlbum">
                    <?php
                    $sth = $dbh->prepare("SELECT name, album_id FROM album");
                    $sth->execute();
                    $albums = $sth->fetchAll();

                    for ($i = 0; $i < count($albums); $i++)
                    {
                        echo "<option value='" . $albums[$i]['album_id'] . "'>" . $albums[$i]['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class='form-group col-md-6'>
                <label for="musicDurationMin">Minutes :</label>
                <input class='form-control' id="musicDurationMin" type="text" name="musicDurationMin" />

                <label for="musicDurationSec">Secondes :</label>
                <input class='form-control' id="musicDurationSec" type="text" name="musicDurationSec" />
            </div>
        </div>

        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for="musicFile">Fichier musique :</label>
                <input  type="hidden" name="MAX_FILE_SIZE" value="220000000">
                <input class='form-control' id="musicFile" type="file" name="musicFile" required>
            </div>
            <div class='form-group col-md-6'>
                <label for="lyricsFile">Fichier lyrics :</label>
                <input  type="hidden" name="MAX_FILE_SIZE" value="20000000">
                <input class='form-control' id="lyricsFile" type="file" name="lyricsFile">
            </div>
        </div>


        <label for="addAlbumSubmit">Validation :</label>
        <input class='form-control' id="addAlbumSubmit" type="submit" name="addAlbumSubmit" value="Valider" />
    </form>
    <br/><a href="adminHome.php"><button class="btn btn-primary">Retour au panneau d'Administration</button></a>
</div>
</body>
</html>