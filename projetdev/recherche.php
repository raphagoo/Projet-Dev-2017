<?php require ('Include/header.php'); ?>
<div id="titrerecherche">
<h1>Résultats de la recherche</h1>
</div>
<?php
$resultat = $dbh->prepare('SELECT a.name, a.labelName, a.picturePath, art.nickname FROM album a, artist art WHERE a.name = "'.$_POST['recherche'].'" OR art.nickname = "'.$_POST['recherche'].'"');
$resultat->execute();
$resultatfetch = $resultat->fetchAll();
$compteur1 = count($resultatfetch);
for($j = 0;$j<=$compteur1-1;$j++){
    $nomalbum[$j] = $resultatfetch[$j][0];
    $nomartist[$j] = $resultatfetch[$j][3];
    $label[$j] = $resultatfetch[$j][1];
    $chemin[$j] = $resultatfetch[$j][2];
    echo "<a href='album.php?album=$nomalbum[$j]'><div class='album'><img src='$chemin[$j]' alt='photo album'>";
    echo "<h2>$nomalbum[$j]</h2>";
    echo "<h3>$nomartist[$j]</h3>";
    echo "$label[$j]</div></a>";
}
?>
</body>
</html>