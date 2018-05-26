<?php
function selectAllUsers(&$dbh)
{
    $query = $dbh->prepare("SELECT u.user_id, u.pseudo, u.premium, d.email, d.rank FROM user u, userdetails d WHERE u.userdetails_id=d.userdetails_id");
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

function displayTable(&$dbh)
{
    $allUsers = selectAllUsers($dbh);
    for ($i = 0; $i < count($allUsers); $i++)
    {
        $urlModif = "adminUsers.php?user_id=".$allUsers[$i]['user_id'] . "&pseudo=" . $allUsers[$i]['pseudo'] . "&email=" . $allUsers[$i]['email']. "&rank=" . $allUsers[$i]['rank']. "&premium=" . $allUsers[$i]['premium'];

        $links = "<td><a href='$urlModif'>Modifier</a></td><td><a href='adminUsers.php?deleteid=" . $allUsers[$i]['user_id'] . "'>Supprimer</a></td>";

        if ($allUsers[$i]['premium'] == 0)
        {
            $premium = "Non";
        }
        else {
            $premium = "Oui";
        }

        echo "<tr><td>" . $allUsers[$i]['user_id'] . "</td>
                <td>" . $allUsers[$i]['pseudo'] . "</td>
                <td>" . $allUsers[$i]['email'] . "</td>
                <td>" . $allUsers[$i]['rank'] . "</td>
                <td>" . $premium . "</td>
                $links</tr>";
    }
}

displayTable($dbh);
?>