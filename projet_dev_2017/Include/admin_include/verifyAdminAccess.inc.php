<?php
function verifyAccessAdmin()
{
    session_start();
    if (empty($_SESSION['pseudo']) || $_SESSION['rank'] != 'admin')
    {
        header('Location: forbidden.php');
    }
}

verifyAccessAdmin();
?>