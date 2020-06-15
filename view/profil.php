<?php  
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=user__data', 'root', '');


if (isset($_GET['id']) AND $_GET['id'] > 0) 
{
    $get_id = intval($_GET['id']);
    $query = $bdd->prepare('SELECT * FROM user WHERE id = ?');
    $query->execute(array($get_id));
    $user = $query->fetch();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Twitter Clone</title>
        <meta name="viewport" content="width=device-width, initial-scaled=1">
    </head>

    <body>
        <div align="center">
            <h2>Votre profil <?php echo $user['pseudo']; ?></h2>
            <br/> <br/>
            Pseudo : <?php echo $user['pseudo']; ?>
            <br/>
            Mail : <?php echo $user['mail']; ?>
            <br/>
            <?php
            if(isset($_SESSION['id']) AND $user['id'] == $_SESSION['id'])
            {
            ?>
            <a href="#">Editer mon profil</a>
                <a href="deconnection.php">Se déconnecter</a>
            <?php
            }
            ?>
        </div>
            <div>
                <h2>Abonnés</h2>
                <ul>
                    <li></li>
                </ul>
            </div>
            <div>
                <h2>Abonnements</h2>
            </div>
        </div>
    </body>
</html>