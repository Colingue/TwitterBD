<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=user__data', 'root', '');


if (isset($_GET['id']) AND $_GET['id'] > 0) 
{
    $get_id = intval($_GET['id']);
    $query = $bdd->prepare('SELECT id, pseudo, motdepasse FROM user WHERE id = ?');
    $query->execute(array($get_id));
    $user = $query->fetch();

    $query = $bdd->prepare('SELECT COUNT(s.subscriptions_follower_id) AS follower FROM subscriptions AS s WHERE s.subscriptions_follow_ups_id = ?');
    $query->execute(array($get_id));
    $follower_count=$query->fetch();

    $query = $bdd->prepare('SELECT COUNT(s.subscriptions_follow_ups_id) AS follow_ups FROM subscriptions AS s WHERE s.subscriptions_follower_id = ?');
    $query->execute(array($get_id));
    $follower_ups_count=$query->fetch();
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
            <h2><?php echo $user['pseudo']; ?></h2>
            <br/> <br/>
            <div>
                <div align = "center">
                    Abonnées : <?php echo $follower_count['follower'];?>
                    Abonnements : <?php echo $follower_ups_count['follow_ups']; ?>
                </div>
            </div>
            <br/>
            <?php
            if(isset($_SESSION['id']) AND $user['id'] == $_SESSION['id'])
            {
            ?>  
                <a href="edit_profil.php?id=<?php echo $_SESSION['id'];?>">Editer mon profil</a>
                <a href="deconnection.php">Se déconnecter</a>
                <a href="timeline.php?id=<?php echo $_SESSION['id'];?>">Retourner sur la page d'accueil</a>
            <?php
            }
            ?>
        </div>
        <div align = "center">
            <div>
                <h2>Abonnés</h2>
                <?php
                $query = $bdd->prepare('SELECT u.pseudo, u.id FROM user AS u INNER JOIN subscriptions AS s ON u.id = s.subscriptions_follower_id WHERE s.subscriptions_follow_ups_id = ?');
                $query->execute(array($get_id));
                $followers = $query->fetchall();
                ?>
                <table width="630" align="left" bgcolor="#EEEEEE">
                    <?php
                    for ($lign = 0; $lign < count($followers); $lign++)
                    {
                        ?>
                        <a href="public_profil.php?id=<?php echo $_SESSION['id'];?>&public_id=<?php echo $followers[$lign]['id']; ?>"><?php echo $followers[$lign]['pseudo']; ?></a>
                        </br>
                        <?php
                    }
                    ?>
                </br>
                </table>
            </div>
            <div>
                <h2>Abonnements</h2>
                <?php
                $query = $bdd->prepare('SELECT u.pseudo, u.id FROM user AS u INNER JOIN subscriptions AS s ON u.id = s.subscriptions_follow_ups_id WHERE s.subscriptions_follower_id = ?');
                $query->execute(array($get_id));
                $followers = $query->fetchall();
                ?>
                <table width="630" align="left" bgcolor="#EE88EE">
                    <?php
                    for ($lign = 0; $lign < count($followers); $lign++)
                    {
                        ?>
                        <a href="public_profil.php?id=<?php echo $_SESSION['id'];?>&public_id=<?php echo $followers[$lign]['id']; ?>"><?php echo $followers[$lign]['pseudo']; ?></a>
                        </br>
                        <?php
                    }
                    ?>
                    </br>
                </table>
            </div>
        </div>
    </body>
</html>