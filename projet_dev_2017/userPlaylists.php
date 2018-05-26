<?php session_start(); require ("Include/connectToDB.inc.php"); require ("Include/userPlaylistsInTable.inc.php");?>
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
        </div>
    </body>
</html>