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
    $sth = $dbh->prepare('select Artiste_Nom From artiste');
    $sth->execute();
    $data = $sth->fetchAll();
    ?>
    <select name="listartist" id="list_user" title="listartist">
        <option value="" disabled selected >Choisissez un artiste</option>
        <?php foreach ($data as $row): ?>
            <option value="<?=$row["Artiste_Nom"];?>"><?=$row["Artiste_Nom"];?></option>
        <?php endforeach ?>
    </select>
    <input type="submit">
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