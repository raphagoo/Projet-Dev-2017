<?php require ('Include/header.php');?>
<h1>Bibliothèque</h1>
    <div id="titrenouveaute"><h2>Nouveautés</h2></div>
<?php
$request = $dbh->prepare('SELECT a.name, a.labelName, a.picturePath, art.nickname FROM album a, artist art ORDER BY a.releaseDate ASC LIMIT 5');
$request->execute();
$requestfetch = $request->fetchAll();
$compteur1 = count($requestfetch);
for($j = 0;$j<=$compteur1-1;$j++){
    $nomalbum[$j] = $requestfetch[$j][0];
    $nomartist[$j] = $requestfetch[$j][3];
    $label[$j] = $requestfetch[$j][1];
    $chemin[$j] = $requestfetch[$j][2];
    echo "<a href='album.php?album=$nomalbum[$j]'><div class='album'><img src='$chemin[$j]' alt='photo album'>";
    echo "<h2>$nomalbum[$j]</h2>";
    echo "<h3>$nomartist[$j]</h3>";
    echo "$label[$j]</div></a>";
}
?>
<div id="titrerecent"><h2>Ecouté récemment</h2></div>

