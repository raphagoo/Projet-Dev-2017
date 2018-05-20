<?php
require ("include/connectToDB.inc.php");
require ("include/admin_include/adminAddAlbum.inc.php");
require ("include/admin_include/verifyAdminAccess.inc.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Panneau d'administration - Ajout d'album</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>ADMINISTRATION - Ajout d'album</h1>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for="albumname">Nom :</label>
                <input class='form-control' type="text" id="albumname" name="Album_name" required />
            </div>
            <div class='form-group col-md-6'>
                <label for="albumReleaseDate">Date de sortie : </label>
                <input class="form-control" type="date" id="albumReleaseDate" name="albumReleaseDate">
            </div>
        </div>

        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for="albumDisponibility">Disponibilite :</label>
                <select id="albumDisponibility" name="albumDisponibility">
                    <option value="1">Disponible</option>
                    <option value="2">Indisponible</option>
                </select>
            </div>
            <div class='form-group col-md-6'>
                <label for="albumLabel">Label :</label>
                <input class='form-control' id="albumLabel" type="text" name="albumLabel" />
            </div>
        </div>

        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for="albumArtist">Artiste :</label>
                <select id="albumArtist" name="albumArtist">
                    <?php
                    $sth = $dbh->prepare("SELECT name, artiste_id FROM artist");
                    $sth->execute();
                    $types = $sth->fetchAll();

                    for ($i = 0; $i < count($types); $i++)
                    {
                        echo "<option value='" . $types[$i]['artiste_id'] . "'>" . $types[$i]['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class='form-group col-md-6'>
                <label for="albumImage">Image de l'album :</label>
                <input  type="hidden" name="MAX_FILE_SIZE" value="10000000">
                <input class='form-control' id="albumImage" type="file" name="albumImage" accept='image/*' required>
            </div>
        </div>


        <label for="addAlbumSubmit">Validation :</label>
        <input class='form-control' id="addAlbumSubmit" type="submit" name="addAlbumSubmit" value="Valider" />
    </form>
    <br/><a href="adminHome.php"><button class="btn btn-primary">Retour au panneau d'Administration</button></a>
</div>
</body>
</html>