<?php require("include/connectToDB.php");?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Panneau d'administration - ProjetDev</title>
  </head>
  <body>
    <h1>Panneau d'administration</h1>

    <h2>Supprimer un membre : </h2>

    <table border="1">
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>Nom</th>
                <th>Email</th>
                <!-- <th>Premium</th> -->
                <th>Rôle</th>
                <th>Date de création</th>
                <th>Option</th>
            </tr>
        </thead>

        <tbody>
            <?php require("include/deleteUser.php");?>
        </tbody>
    </table>



  </body>
</html>
