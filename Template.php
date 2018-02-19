<?php
    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> '.$album .'</title>
</head>
<body>
<div id="container">
<h1> '.$album.'</h1>
<h3> '.$artiste.'</h3>
<h6> '.$releasedate.'</h6>
<img src="'.$path.'" alt="'.$album.'">';

    $titlenb = 16;
for ($j= 0; $j < $titlenb;){
    $titre = $titre[$j];
    echo '<p class="title">'.++$j.' '.$titre.' </p>';
}
echo '</div>
</body>
</html>';
