<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=user__data', 'root', '');


if (isset($_GET['id']) AND $_GET['id'] > 0) 
{
    $get_id = intval($_GET['id']);
    $query = $bdd->prepare('SELECT id, pseudo, motdepasse FROM user WHERE id = ?');
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
            <?php
            if(isset($_SESSION['id']) AND $user['id'] == $_SESSION['id'])
            {
            ?>
            <a href="edit_profil.php">Editer mon profil</a>
                <a href="deconnection.php">Se déconnecter</a>
            <?php
            }
            ?>
        </div>
            <div>
                <h2>Abonnés</h2>
                <?php
                $query = $bdd->prepare('SELECT u.pseudo FROM user AS u INNER JOIN subscriptions AS s ON u.id = s.subscriptions_follower_id WHERE s.subscriptions_follow_ups_id = ?');
                $query->execute(array($get_id));
                $followers = $query->fetchall();
                ?>
                <br/>
                Ceci est un test : <?php echo $followers[0]['pseudo'];?>
            </div>
            <div>
                <h2>Abonnements</h2>
            </div>
        </div>
    </body>
</html>