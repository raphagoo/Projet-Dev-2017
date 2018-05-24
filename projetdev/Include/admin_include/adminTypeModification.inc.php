<?php
function displayModificationForm()
{
    if (!empty($_GET['type_name'])) {

        $type_name = $_GET['type_name'];

        echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
        
        
        <div class='form-row'>
            <label for='type_name'>Categorie :</label>
            <input type='hidden' name='previousType_name' value='$type_name'>
            <input class='form-control' type='text' id='type_name' name='type_name' value='$type_name'>
        </div>
             
        <br/>
        <div class='form-row'>
            <input class='form-control' type='submit' name='subValidate' value='Valider'>
        </div>
        </form>";
    }
}

function modifyType(&$dbh)
{
    if(!empty($_POST['subValidate']))
    {
        if(!empty($_POST['previousType_name']) && !empty($_POST['type_name']))
        {
            $type_name = $_POST['type_name'];
            $previousType_name = $_POST['previousType_name'];

            $query = $dbh->prepare("UPDATE type SET type_name = '$type_name' WHERE type_name = '$previousType_name'");
            $query->execute();


            header("Refresh: 0");
        }
    }
}

function delete(&$dbh)
{
    if(!empty($_GET['deleteid']))
    {
        $idToDelete = $_GET['deleteid'];
        $query = $dbh->prepare("DELETE FROM type WHERE type_name = '$idToDelete'");
        $query->execute();

        header("Refresh: 0, url=adminType.php");
    }
}

displayModificationForm();
modifyType($dbh);
delete($dbh);
?>