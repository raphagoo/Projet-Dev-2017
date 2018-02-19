<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter/Supprimer une musique</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <?php
    $dbh = new PDO('mysql:host=localhost;dbname=projet_dev', 'root', '');
    $sth = $dbh->prepare('select name From music');
    $sth->execute();
    $data = $sth->fetchAll();
    ?>
    <select name="listmusic" id="list_user" title="listmusic">
        <option value="" disabled selected>Choisissez une musique</option>
        <?php foreach ($data as $row): ?>
            <option value="<?=$row["name"];?>"><?=$row["name"];?></option>
        <?php endforeach ?>
    </select>
    <input type="submit">
</form>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <input type="text" title="titre" placeholder="Titre de la musique">
   <input type="text" title="Artiste" placeholder="Artiste">
   <input type="text" title="Album" placeholder="Album">
   <input type="text" title="Genre" placeholder="Genre">
    <input type="file" name="fichier">
    <input type="submit" value="upload">
</form>
<?php
$filename=$_FILES["fichier"]["name"];
var_dump($filename);
//Get the content of the image and then add slashes to it
$file=addslashes (file_get_contents($_FILES['fichier']['tmp_name']));
var_dump($file);
//Insert the image name and image content in image_table
$insert_file=$dbh->prepare('INSERT INTO musique(musiquef, path) VALUES("$file","$filename")');
$insert_file->execute();

?>
<?php $dbh = null; ?>
</body>
</html>