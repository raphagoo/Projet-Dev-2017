<?php
function selectAllTypes(&$dbh)
{
    $query = $dbh->prepare("SELECT * FROM type");
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

function displayTable(&$dbh)
{
    $allTypes = selectAllTypes($dbh);

    for ($i = 0; $i < count($allTypes); $i++)
    {
        $urlModif = "adminType.php?type_name=". $allTypes[$i]['type_name'];

        //Boutons modifier et supprimer
        $links = "<td><a href='$urlModif'>Modifier</a></td><td><a href='adminType.php?deleteid=" . $allTypes[$i]['type_name'] . "'>Supprimer</a></td>";

        echo "<tr><td>" . $allTypes[$i]['type_name'] . "</td>
                  $links</tr>";
    }
}

displayTable($dbh);
?>