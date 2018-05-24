<?php
session_start();
require ("Include/connectToDB.inc.php");
require ("Include/playlistPopup.inc.php");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="Assets/CSS/playlistBtnStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Modal Example</h2>
    <!-- Trigger the modal with a button -->
<!--    <div>-->
<!--        <span>Темная ночь </span>-->
<!--        <button type="button" class="btn  btnAddToPlaylist" data-toggle="modal" data-target="#myModal" onclick="setMusicToAddId();"><span class="glyphicon glyphicon-plus"></span></button>-->
<!--    </div>-->

    <?php
        print_r($_POST);
        addMusicToPlaylist($dbh);

        for ($i = 1; $i <= 10; $i++)
        {
            echo "<div>
        <span>Темная ночь </span>
        <button type=\"button\" class=\"btn  btnAddToPlaylist\" data-toggle=\"modal\" data-target=\"#myModal\" onclick=\"setMusicToAddId(" . $i . ");\"><span class=\"glyphicon glyphicon-plus\"></span></button>
    </div>";
        }
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
</div>
<script src="Assets/Scripts/playlistPopupScript.js"></script>
</body>
</html>
