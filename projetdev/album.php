<?php require ('Include/header.php');?>
<div class='containeralbum'>
<?php
//setcookie($_GET['album'] ,$_GET['album'], 10600);
$request = $dbh->prepare('SELECT a.name, a.picturePath,a.labelName, m.duration, m.title, m.file,m.music_id, art.nickname FROM album a, music m, artist art WHERE a.name = "'.$_GET['album'].'"');
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
    array_push($tableaufile, $file[$j]);
    echo "<div class='musique'>$nommusique[$j] - $duree[$j]      <button type=\"button\" class=\"btn  btnAddToPlaylist\" data-toggle=\"modal\" data-target=\"#myModal\"><span class=\"glyphicon glyphicon-plus white\"></span></button></div><div class='w-100'></div>";
}
    ?>
    <script type="text/javascript">var data = ( '<?php echo json_encode($tableaufile) ?>' ); if(typeof data !== 'undefined'){alert(data);}</script>
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
</div>
</div>
</div>
</body>
</html>
