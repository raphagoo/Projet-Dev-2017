<?php
if (!empty($_POST['connect']))
{
    if(!empty($_POST['connectPseudo']) && !empty($_POST['connectPassword']))
    {
        $pseudo = $_POST['connectPseudo'];
        $password = $_POST['connectPassword'];
        $sth = $dbh->prepare('SELECT passwd FROM user WHERE pseudo="'.$pseudo.'"');
        $sth->execute();
        //$passwordFromTable = $sth->fetchAll()[0][0];
        $tab = $sth->fetchAll();
        $sth = $dbh->prepare('SELECT rank FROM userdetails WHERE user_id = (SELECT user_id FROM user WHERE pseudo="'.$pseudo.'")');
        $sth->execute();
        $rank = $sth->fetchAll();
        if(!empty($tab[0][0]))
        {
            $hash = $tab[0][0];
            if (password_verify($password, $hash)) {
                $_SESSION['pseudo'] = $pseudo;
                if ($rank[0]['rank'] == 'user')
                {
                    $_SESSION['rank'] = $rank[0]['rank'];
                }
                else if ($rank[0]['rank'] == 'admin')
                {
                    $_SESSION['rank'] = $rank[0]['rank'];
                }
                header('Location: index.php');
            }
        } else {
            echo "Indentifiants incorrects";
        }
    }
}
?>