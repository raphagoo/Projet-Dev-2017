<?php require ("include/connectToDB.inc.php");
require ("include/admin_include/verifyAdminAccess.inc.php");?>
<!DOCTYPE html>
<html>
<head>
    <title>Artistes - ADMINISTRATION</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
<div class="container">
    <h1>ADMINISTRATION - ARTISTES</h1>
    <div id="adminUsersDivTable">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Identifiant</th>
                <th>Nom</th>
                <th>Pseudo</th>
                <th>Categorie</th>
                <th>Liste des albums</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>

            <tfoot>

            </tfoot>

            <tbody>
            <?php require ("include/admin_include/adminArtistsInTables.inc.php"); ?>
            </tbody>
        </table>
        <br/>
        <?php require ("include/admin_include/adminArtistsModification.inc.php"); ?>
    </div>
    <br/><a href="adminHome.php"><button class="btn btn-primary">Retour au panneau d'Administration</button></a>
</div>
</body>
</html>