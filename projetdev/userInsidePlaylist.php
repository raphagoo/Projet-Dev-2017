<?php $name = "Playlist"; require ('Include/header.php');require ("Include/userInsidePlaylist.inc.php");?>
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