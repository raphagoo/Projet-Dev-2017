<?php require ("include/connectToDB.inc.php");
require ("include/admin_include/verifyAdminAccess.inc.php");
require ("include/admin_include/adminAlbumInTables.inc.php");?>
<!DOCTYPE html>
<html>
<head>
    <title>Albums - ADMINISTRATION</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
<div class="container">
    <h1>ADMINISTRATION - ALBUMS</h1>

    <div id="adminArtistSelect">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="selectArtists">Artistes :</label>
            <select name="selectArtist" id="selectArtist">
                <?php displaySelectArtist($dbh);?>
            </select>

            <input type="submit" name="subSelectArtist" />
        </form>
    </div>

    <div id="adminAlbumDivTable">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Identifiant</th>
                <th>Nom</th>
                <th>Disponibilite</th>
                <th>Nombre de titres</th>
                <th>Label</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>

            <tfoot>

            </tfoot>

            <tbody>
            <?php displayTable($dbh);?>
            </tbody>
        </table>
        <br/>
        <?php require ("include/admin_include/adminAlbumModification.inc.php"); ?>
    </div>
    <br/><a href="adminHome.php"><button class="btn btn-primary">Retour au panneau d'Administration</button></a>
</div>
</body>
</html>