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

        if(!empty($tab[0][0]))
        {
            $hash = $tab[0][0];

            if (password_verify($password, $hash)) {
                $_SESSION['pseudo'] = $pseudo;
                header('refresh:0');
            }
        } else {
            echo "Indentifiants incorrects";
        }
    }
}

?>