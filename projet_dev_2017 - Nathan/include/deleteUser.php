<?php
/**
 * Created by PhpStorm.
 * User: Nathan
 * Date: 2/12/2018
 * Time: 9:59 AM
 */


$sth = $dbh->prepare("SELECT user_id, pseudo FROM user;");
$sth->execute();
$resultFromUser = $sth->fetchAll();

$sth = $dbh->prepare("SELECT name, mail, rank, creationdate FROM userdetails");
$sth->execute();
$resultFromUserdetails = $sth->fetchAll();

for($i = 0; $i < count($resultFromUser); $i++) {

    echo "<form action='". $_SERVER['PHP_SELF'] ."' method='post'>";
    echo "<tr>";


    echo "<td>" . $resultFromUser[$i]['pseudo'] . "</td>";
    echo "<input type='hidden' name='userToRemoveID' value='" . $resultFromUser[$i]['user_id'] . "'/>";
    echo "<td>" . $resultFromUserdetails[$i]['name'] . "</td>";
    echo "<td>" . $resultFromUserdetails[$i]['mail'] . "</td>";
    echo "<td>" . $resultFromUserdetails[$i]['rank'] . "</td>";
    echo "<td>" . $resultFromUserdetails[$i]['creationdate'] . "</td>";
    echo "<td><input type='submit' onclick='return confirm(\"Etes vous sur de vouloir supprimer ". $resultFromUser[$i]['pseudo'] ." \" );' value='Supprimer'></td>";


    echo "</tr>";
    echo "</form>";

}

//var_dump($_POST['userToRemoveID']);

if(!empty($_POST['userToRemoveID'])){

    $sth = $dbh->prepare("DELETE FROM user WHERE user_id=".intval($_POST['userToRemoveID']).";");
    $sth->execute();

    $sth = $dbh->prepare("DELETE FROM userdetails WHERE userdetails_id=".intval($_POST['userToRemoveID']).";");
    $sth->execute();
    echo "<meta http-equiv='refresh' content='0'>";

    
}
