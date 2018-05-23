<?php
require ("include/admin_include/verifyAdminAccess.inc.php");
require ("include/connectToDB.inc.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Panneau d'administration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>ADMINISTRATION DU SITE</h1>
        <div class="list-group">
            <h2>GESTION</h2>
            <a href="adminArtists.php" class="list-group-item">Gestion des Artistes</a>
            <a href="adminType.php" class="list-group-item">Gestion des Categories</a>
            <a href="adminMusic.php" class="list-group-item">Gestion des Musiques</a>
        </div>

        <div class="list-group">
            <h2>AJOUTS</h2>
            <a href="adminAddAdmin.php" class="list-group-item">Ajout d'administrateurs</a>
            <a href="adminAddArtist.php" class="list-group-item">Ajout d'Artistes</a>
            <a href="adminAddType.php" class="list-group-item">Ajout de categorie</a>
            <a href="adminAddAlbum.php" class="list-group-item">Ajout d'Album</a>
            <a href="adminAddMusic.php" class="list-group-item">Ajout de musique</a>
        </div>

        <?php
        function nbMusics(&$dbh)
        {
            $query = $dbh->prepare("SELECT COUNT(*) FROM music");
            $query->execute();
            $res = $query->fetchAll();

            echo $res[0][0];
        }

        function nbAlbums(&$dbh)
        {
            $query = $dbh->prepare("SELECT COUNT(*) FROM album");
            $query->execute();
            $res = $query->fetchAll();

            echo $res[0][0];
        }

        function nbUsers(&$dbh)
        {
            $query = $dbh->prepare("SELECT COUNT(*) FROM user");
            $query->execute();
            $res = $query->fetchAll();

            echo $res[0][0];
        }
        ?>

        <p><span class="label label-info">Nombre de musiques : <?php nbMusics($dbh)?></span></p>
        <p><span class="label label-info">Nombre d'albums : <?php nbAlbums($dbh)?></span></p>
        <p><span class="label label-info">Nombre de membres : <?php nbUsers($dbh)?></span></p>
    </div>
</body>
</html>
