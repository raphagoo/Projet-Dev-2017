<?php session_start(); require ("Include/connectToDB.inc.php"); require ("Include/userInsidePlaylist.inc.php");?>
<!DOCTYPE html>
<html>
<head>
    <title>Mes playlists</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>

<body>
<div class="container">
    <h1>Mes playlists</h1>
    <div id="userPlaylistsTableDiv">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Album</th>
                <th>Artiste</th>
                <th>Supprimer</th>
            </tr>
            </thead>

            <tfoot>

            </tfoot>

            <tbody>
            <?php displayInsidePlaylist($dbh); ?>
            </tbody>
        </table>
        <br/>
    </div>
    <br/><a href="userPlaylists.php"><button class="btn btn-primary">Mes playlists</button></a>
</div>
</body>
</html>