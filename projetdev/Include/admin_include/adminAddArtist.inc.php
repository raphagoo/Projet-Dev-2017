<?php

function addArtist(&$dbh)
{
    if (!empty($_POST['Artist_name']) && !empty($_POST['type_name']))
    {
        $Artist_name = $_POST['Artist_name'];
        $type_name = $_POST['type_name'];
        if (!empty($_POST['nickname']))
        {
            $nickname = $_POST['nickname'];
            $query = $dbh->prepare("INSERT INTO artist(name, nickname, type_name) VALUE ('$Artist_name', '$nickname', '$type_name')");
            $query->execute();
        }
        else {
            $query = $dbh->prepare("INSERT INTO artist(name, type_name) VALUE ('$Artist_name', '$type_name')");
            $query->execute();
        }
    }

}


addArtist($dbh);
?>