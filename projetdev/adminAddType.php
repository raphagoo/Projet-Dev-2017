<?php
require ("include/connectToDB.inc.php");
require ("include/admin_include/adminAddType.inc.php");
require ("include/admin_include/verifyAdminAccess.inc.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Panneau d'administration - Ajout de categorie</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>ADMINISTRATION - Ajout de categorie</h1>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for="typename">Catégorie :</label>
                <input class='form-control' type="text" id="typename" name="Type_name" required />
            </div>
            <div class='form-group col-md-6'>
                <label for="addTypeSubmit">Validation :</label>
                <input class='form-control' id="addTypeSubmit" type="submit" name="addTypeSubmit" value="Valider" />
            </div>
        </div>
    </form>
    <br/><a href="adminHome.php"><button class="btn btn-primary">Retour au panneau d'Administration</button></a>
</div>
</body>
</html>
