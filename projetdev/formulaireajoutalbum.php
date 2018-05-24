
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter/Supprimer une album</title>
    <script type="text/javascript"></script>
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
    <input type="text" name="namealbum" placeholder="Nom de l'album">
    <input type="text" name="nameartist" placeholder="Nom de l'artiste">
   <input type="date" name="releasedate" placeholder="Date de sortie">
    <!-- On limite le fichier à 10Mo -->
    <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
    Fichier : <input type="file" name="fichieralbum"><br>
    Combien de musiques voulez-vous ajoutez ? <input type="number" id="valeur" name="nbmusiques" onchange="nombreMusiques()">
    <div id="musiques"></div>
    <input type="submit" name='envoi' value="Upload">
<script>
    function nombreMusiques(){
        var nombre;
        nombre = document.getElementById('valeur').value;

        for(i=1;i<=nombre;i++){
            document.getElementById('musiques').innerHTML += "Musique"+i+" :\n" +
                "    <input type=\"text\" name=\"namemusic"+i+"\" placeholder=\"Nom de la musique\">\n" +
                "    <input type=\"text\" name=\"duration"+i+"\" placeholder=\"Durée du morceau\">\n" +
                "      <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"10000000\">\n" +
                "    Fichier : <input type=\"file\" name=\"fichiermusique"+i+"\"><br>";
        }
    }
</script>
</form>
<?php
include('creationauto.php');
    if (isset($_POST['envoi'])) {
        $namealbum = $_POST['namealbum'];
        $nameartist = $_POST['nameartist'];
        $chemin = 'img/';
        $cheminmusic = 'musiques/';
        $fichieralbum = $_FILES['fichieralbum']['name'];
        $fichierfinal = $chemin . $fichieralbum;
        $releasedate = $_POST['releasedate'];

        $idartist = $dbh->query('SELECT artist_id FROM artist WHERE name= "' . $nameartist . '"');
        $idartistfetch = $idartist->fetch(PDO::FETCH_NUM);
        $idartistfinal = implode('', $idartistfetch);
        $insert_file = $dbh->prepare('INSERT INTO album(name, releasedate, artist_id, image, titlenumber) VALUES("' . $namealbum . '","' . $releasedate . '","' . $idartistfinal . '","' . $chemin . ($_FILES['fichieralbum']['name']) . '","'.$_POST['nbmusiques'].'")');
        $insert_file->execute();
        $idalbum = $dbh->query('SELECT album_id FROM album WHERE name= "' . $namealbum . '"');
        $idalbumfetch = $idalbum->fetch(PDO::FETCH_NUM);
        $idalbumfinal = implode('', $idalbumfetch);
        for ($i = 1; $i <= $_POST['nbmusiques']; $i++) {
            try {
                 $insert_file = $dbh->query('INSERT INTO music(title, album_id, artist_id, duration, fichier) VALUES
            ("' . $_POST["namemusic$i"] . '","' . $idalbumfinal . '","' . $idartistfinal . '","' . $_POST["duration$i"] . '","' . $cheminmusic . ($_FILES["fichiermusique$i"]['name']) . '")');
                $premium = $dbh->query('INSERT INTO userpremium(premium,duration,pseudo) VALUES(1,3600,"'.$_SESSION[qqchose].'")');
             }catch(PDOException $e){
                 print "Erreur! " . "<br>" . $e->getMessage();
                 die();
             }
        }
        genererTemplate($namealbum, $nameartist, $fichierfinal, $idartistfinal, $idalbumfinal);
    }

?>
    <?php $dbh = null; ?>
</body>
</html>