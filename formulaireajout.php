
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ajouter/Supprimer une musique</title>
</head>
<body>
    <?php
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=projet_dev_2017', 'root', '');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth = $dbh->prepare('SELECT * FROM artist');
        $sth->execute();
        $data = $sth->fetchAll();
    }
    catch (PDOException $e) {
        print "Erreur! " . "<br>" . $e->getMessage();
        die();
    }
    ?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <input type="text" name="nom" placeholder="Nom de l'artiste">
    <input type="text" name="type" placeholder="genre de l'artiste">
   <input type="text" name="nickname" placeholder="Prénom de l'artiste">
    <input type="submit" name='envoi' value="upload">
</form>
<?php
if (isset($_POST['envoi'])){
$nom = $_POST['nom'];
var_dump($nom);
$type = $_POST['type'];
$nickname = $_POST['nickname'];
$insert_file=$dbh->prepare('INSERT INTO artist(name, type1, nickname) VALUES("'.$nom.'","'.$type.'","'.$nickname.'")');
    $insert_file->bindParam(':nom', $nom);
    $insert_file->bindParam(':type', $type);
    $insert_file->bindParam(':nickname', $nickname);
$insert_file->execute();
}
?>
<?php $dbh = null; ?>
</body>
</html>