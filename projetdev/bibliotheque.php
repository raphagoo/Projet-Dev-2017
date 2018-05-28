<?php require ('Include/header.php');?>
<div id="containerrecherche">
    <div id="titrebibli"><h1>Bibliothèque</h1></div>
    <div id="titrenouveaute"><h2>Nouveautés</h2></div>
<?php
$request = $dbh->prepare('SELECT a.name, a.labelName, a.picturePath, art.nickname FROM album a, artist art WHERE a.artiste_id = art.artiste_id ORDER BY a.releaseDate DESC LIMIT 5');
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
<div id="titrerecent"><h2>Ecoutés récemment</h2></div>
    <?php
    if(isset ($_SESSION['pseudo'])) {
        $ecouterecente = $dbh->prepare('SELECT recenttype FROM user WHERE pseudo = "' . $_SESSION['pseudo'] . '"');
        $ecouterecente->execute();
        $ecouterecentefetch = $ecouterecente->fetchAll();
        $tableauecoute = unserialize($ecouterecentefetch[0][0]);
        for ($k = 0; $k <= count($tableauecoute) - 1; $k++) {
            $request1 = $dbh->prepare('SELECT a.name, a.labelName, a.picturePath, art.nickname FROM album a, artist art WHERE a.name = "' . $tableauecoute[$k] . '" AND a.artiste_id = art.artiste_id');
            $request1->execute();
            $request1fetch = $request1->fetchAll();
            $nomalbum2[$k] = $request1fetch[0][0];
            $nomartist2[$k] = $request1fetch[0][3];
            $label2[$k] = $request1fetch[0][1];
            $chemin2[$k] = $request1fetch[0][2];
            echo "<a href='album.php?album=$nomalbum2[$k]'><div class='album'><img src='$chemin2[$k]' alt='photo album'>";
            echo "<h2>$nomalbum2[$k]</h2>";
            echo "<h3>$nomartist2[$k]</h3>";
            echo "$label2[$k]</div></a>";
        }
    }
    else{
        echo 'Vous devez être connecté pour accéder aux écoutes récentes';
    }
    ?>
    <div id="titrecategorie"><h2>Catégories</h2></div>
    <a href="recherche.php?recherche=rap"><div class="album"><img src="Assets/IMG/rap.png" alt="categorie rap"></div></a>
    <a href="recherche.php?recherche=electro"><div class="album"><img src="Assets/IMG/electro.png" alt="categorie rap"></div></a>
    <a href="recherche.php?recherche=pop"><div class="album"><img src="Assets/IMG/pop.png" alt="categorie rap"></div></a>
    <a href="recherche.php?recherche=rock"><div class="album"><img src="Assets/IMG/rock.png" alt="categorie rap"></div></a>
    <a href="recherche.php?recherche=mc"><div class="album"><img src="Assets/IMG/mc.png" alt="categorie rap"></div></a>
</div>

</body>
</html>

