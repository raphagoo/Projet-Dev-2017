<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter/Supprimer une musique</title>
</head>
<body>
<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=projet_dev_2017', 'root', '');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print "Erreur! " . "<br>" . $e->getMessage();
    die();
}
?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Nom de la musique">
    <input type="text" name="namealbum" placeholder="Nom de l'album">
    <input type="text" name="nameartist" placeholder="Nom de l'artiste">
    <input type="text" name="duration" placeholder="Durée du morceau">
    <!-- On limite le fichier à 10Mo -->
    <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
    Fichier : <input type="file" name="fichiermusique">
    <input type="submit" name='envoi' value="Upload">
</form>
<?php
include ("ajoutmusic.php");
include ('creationauto.php');
    if(isset($_POST['name'])) {
        $chemin = 'musiques/';
        $namemusic = $_POST['name'];
        $namealbum = $_POST['namealbum'];
        $nameartist = $_POST['nameartist'];
        $duration = $_POST['duration'];
        $fichiermusique = $_POST['fichiermusique'];
        $idartist = $dbh->query('SELECT artist_id FROM artist WHERE name= "'.$nameartist.'"');
        $idartistfetch = $idartist->fetch(PDO::FETCH_NUM);
        $idartistfinal = implode('',$idartistfetch);
        $idalbum = $dbh->query('SELECT album_id FROM album WHERE name= "'.$namealbum.'"');
        $idalbumfetch = $idalbum->fetch(PDO::FETCH_NUM);
        $idalbumfinal = implode('',$idalbumfetch);
        $insert_file=$dbh->prepare('INSERT INTO music(title, album_id, artist_id, duration, fichier) VALUES("'.$namemusic.'","'.$idalbumfinal.'","'.$idartistfinal.'","'.$duration.'","'.$chemin.($_FILES['fichiermusique']['name']).'")');
        $insert_file->execute();
        $musiques = ajouterMusique($namemusic, $duration, $nameartist, $namealbum, $fichiermusique);
        var_dump($musiques);
    }
?>
    <?php $dbh = null; ?>
</body>
</html>
