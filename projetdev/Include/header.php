<?php error_reporting(0); session_start(); require ('Include/connectToDB.inc.php')?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Eskeezik - <?php echo $name; ?></title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link rel="stylesheet" href="Assets/css/style.css">
    <link rel="stylesheet" href="Assets/css/bootstrap.css">
    <script src="Assets/Scripts/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>
<body>
<header>
<!-- Grey with black text -->
<nav class="navbar navbar-expand-sm navbar-light" style="background: rgb(2,0,36);background: linear-gradient(90deg, rgba(2,0,36,0) 0%, rgba(72,255,241,0.742734593837535) 0%, rgba(152,8,208,0.8015581232492998) 100%);">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="index.php"><img src="Assets/IMG/logo.png" alt="logo"></a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="bibliotheque.php">Bibliothèque</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="premium.php">Premium</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ml.php">Mentions légales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>
            <?php
            if(isset($_SESSION['rank'])) {
                if ($_SESSION['rank'] == 'admin') {
                    echo '<li class="nav-item">
                <a class="nav-link" href="AdminHome.php">Administration</a>
            </li>';
                } else {

                }
            }
            ?>
            <?php if(!isset($_SESSION['pseudo'])){
                echo '<li class="nav-item"><a class="nav-link" href="connexion.php">Inscription/Connexion</a></li>';
                }
                else{
                echo '<li class="nav-item">
                <a class="nav-link" href="userPlaylists.php">Playlist</a>
            </li>';
                $premium = $dbh->prepare('SELECT premium_duration FROM user WHERE pseudo = "'.$_SESSION['pseudo'].'"');
                $premium->execute();
                $premiumfetch = $premium->fetchAll();
                $dateaverif = strtotime($premiumfetch[0][0]);
                $datenow = strtotime(date('d-m-Y H:i:s'));
                if($dateaverif<$datenow){
                    $enleverpremium = $dbh->prepare('UPDATE user SET premium = 0 WHERE pseudo = "'.$_SESSION['pseudo'].'"');
                    $enleverpremium->execute();
                }
            } ?>
        </ul>
        <?php include("Include/signOut.php"); ?>
        <form action="recherche.php?search=<?php echo $_GET['recherche'] ?>" method="get" class="form-inline my-2 my-lg-0" id="recherche">
            <input class="form-control mr-sm-2" type="search" name="recherche"  aria-label="Search">
            <button type="submit" form="recherche" class="btn btn-outline-light">Recherche</button>
        </form>
    </div>
</nav>
</header>