<?php
function verifyType(&$dbh, $Type_name)
{
    $verified = true;


    $query = $dbh->prepare('SELECT * FROM type');
    $query->execute();
    $verifyUniqueName = $query->fetchAll();

    for ($i = 0; $i < count($verifyUniqueName); $i++){
        if($Type_name == $verifyUniqueName[$i][0]){
            echo "Cette categorie existe déjà.";
            $verified = false;
        }
    }

    return $verified;
}

function addType(&$dbh)
{
    if (!empty($_POST['Type_name']))
    {
        $Type_name = $_POST['Type_name'];
        if (verifyType($dbh, $Type_name))
        {
            $query = $dbh->prepare("INSERT INTO type VALUE ('$Type_name')");
            $query->execute();
        }
    }

}


addType($dbh);

?>