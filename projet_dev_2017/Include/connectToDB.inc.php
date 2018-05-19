<?php
$dsn = 'mysql:dbname=projet_dev_2017;host=localhost';
$DBuser = 'root';
$DBpassword = '';

try {
    $dbh = new PDO($dsn, $DBuser, $DBpassword);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e){
    echo 'FAIL : ' . $e->getMessage();
}
