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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">


    <?php
    print_r($_POST);
    addMusicToPlaylist($dbh);

    for ($i = 1; $i <= 10; $i++)
    {
        echo "<div>
        <span>Темная ночь </span>
        <button type=\"button\" class=\"btn  btnAddToPlaylist\" data-toggle=\"modal\" data-target=\"#myModal\" onclick=\"setMusicToAddId(" . $i . ");\"><i class=\"fas fa-plus\"></i></button>
    </div>";
    }
    ?>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h2 class="modal-title">Ajouter le titre à une playlist</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="hidden" id="musicToAddId" value="" name="musicToAddId">
                        <?php popupListPlaylists($dbh) ?>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>

            </div>
        </div>
    </div>

</div>

</body>
</html>
