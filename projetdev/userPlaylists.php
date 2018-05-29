
<?php
$name = "Playlist";
require ('Include/header.php'); require ("Include/userPlaylistsInTable.inc.php");?>
<body class="containerplaylist">
<div class="container">
    <h1>Mes playlists</h1>
    <div id="userPlaylistsTableDiv">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Créée le </th>
                <th>Modification</th>
                <th>Suppression</th>
            </tr>
            </thead>

            <tfoot>

            </tfoot>

            <tbody>
            <?php displayTable($dbh); ?>
            </tbody>
        </table>
        <br/>
    </div>
    <a href="index.php"><button class="btn btn-primary">Retour à l'accueil</button></a>
</div>
</body>
</html>