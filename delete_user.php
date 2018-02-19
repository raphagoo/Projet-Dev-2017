<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un utilisateur</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <?php
    $dbh = new PDO('mysql:host=localhost;dbname=projet_dev', 'root', '');
    $sth = $dbh->prepare('select User_pseudo From user');
    $sth->execute();
    $data = $sth->fetchAll();
    ?>
    <select name="listuser" id="list_user" title="listuser">
        <option value="Username">Username</option>
        <?php foreach ($data as $row): ?>
            <option value="<?=$row["User_pseudo"];?>"><?=$row["User_pseudo"];?></option>
        <?php endforeach ?>
    </select>
    <input type="submit" onclick="function user(){
        var e = document.getElementById('list_user');
    var strUser = e.options[e.selectedIndex].value;
    return confirm('Etes vous sur de vouloir supprimer' +' '+ strUser)}
user()">
    <table>
        <tr>
            <td></td>
        </tr>
    </table>
</form>
<?php
if (isset( $_POST['listuser'])){
$user= $_POST['listuser'];
$sql = "DELETE FROM user WHERE User_pseudo ='$user'";
echo $user;
$delete = $dbh->exec($sql);
print_r("effacement de $user");
header("refresh:0");
}

?>
</body>
</html>