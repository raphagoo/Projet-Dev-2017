<?php require ('Include/header.php');
require ("Include/playlistPopup.inc.php"); ?>
<div class='containeralbum'>
<?php
$request = $dbh->prepare('SELECT a.name, a.picturePath,a.labelName, m.duration, m.title, m.file,m.music_id, art.nickname FROM album a, music m, artist art WHERE a.name = "'.$_GET['album'].'" AND a.artiste_id = art.artiste_id AND a.album_id = m.album_id');
$request->execute();
$requestfetch = $request->fetchAll();
$compteur = count($requestfetch);
$nomalbum = $requestfetch[0][0];
$nomartist = $requestfetch[0][7];
$label = $requestfetch[0][2];
$chemin = $requestfetch[0][1];
$tableaufile = Array();
echo "<div class='containerinfoalbum'><div class='albumphoto'><img src='$chemin' alt='photo album'></div>";
echo "<div class='nomalbum'>$nomalbum</div>";
echo "<div class='nomartist'>$nomartist</div>";
echo "<div class='label'>$label</div></div><div class='containermusique'><div class='row'> ";
for($j = 0; $j < $compteur;$j++) {
    $duree[$j] = $requestfetch[$j][3];
    $idmusic[$j] = $requestfetch[$j][6];
    $nommusique[$j] = $requestfetch[$j][4];
    $file[$j] = $requestfetch[$j][5];
    //array_push($tableaufile, array("file" => $file[$j],"nom" => $nommusique[$j],"duration" => $duree[$j]));
    array_push($tableaufile, $file[$j]);
    echo "<div class='musique'> <button type=\"button\" class=\"btn\" data-toggle=\"modal\" data-target=\"#myModal\" onclick=\"setCurrentSong(" .$file[$j]. ");\">Play</button>  $nommusique[$j] - $duree[$j]     <button type=\"button\" class=\"btn  btnAddToPlaylist\" data-toggle=\"modal\" data-target=\"#myModal\" onclick=\"setMusicToAddId(" .$idmusic[$j]. ");\"><span class=\"glyphicon glyphicon-plus\"></span></button></div><div class='w-100'></div>";
}
echo "</div></div>"
    ?>
     <script type="text/javascript">var data = ( <?php echo json_encode($tableaufile) ?> );</script>
    <?php
    addMusicToPlaylist($dbh);
    $ecouterecente = $dbh->prepare('SELECT recenttype FROM user WHERE pseudo = "'.$_SESSION['pseudo'].'"');
    $ecouterecente->execute();
    $ecouterecentefetch = $ecouterecente->fetchAll();
    if ($ecouterecentefetch[0][0] == null){
        $tableauecoute = array();
        array_push($tableauecoute,$nomalbum);
    }
    else{
        $tableauecoute = unserialize($ecouterecentefetch[0][0]);
    }
    for($k = 0;$k<=count($tableauecoute)-1;$k++){
            if($tableauecoute[$k] == $nomalbum) {
                $verif = 1;
                break;
            }
            else{
                $verif = 0;
            }
        }
        if($verif == 0){
            if(count($tableauecoute) >= 5){
                array_pop($tableauecoute);
            }
            array_unshift($tableauecoute,$nomalbum);
    }
    $tableaubdd = serialize($tableauecoute);
    $sessionpseudo = $_SESSION['pseudo'];
    $update = $dbh->prepare("UPDATE user SET recenttype ='$tableaubdd' WHERE pseudo = '$sessionpseudo' ");
    $update->execute();
    ?>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Ajouter le titre à une playlist</h2>
                </div>

                <div class="modal-body">
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="hidden" id="musicToAddId" value="" name="musicToAddId">
                        <?php popupListPlaylists($dbh) ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <?php include ("Include/player.inc.php"); ?>
</div>

<script src="Assets/Scripts/playlistPopupScript.js"></script>
</body>
</html>
