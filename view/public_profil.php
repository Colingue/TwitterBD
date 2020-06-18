<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=user__data', 'root', '');


if (isset($_GET['id']) AND $_GET['id'] > 0)
{
    $get_id = intval($_GET['public_id']);
    $query = $bdd->prepare('SELECT id, pseudo, motdepasse FROM user WHERE id = ?');
    $query->execute(array($get_id));
    $user = $query->fetch();

    $query = $bdd->prepare('SELECT COUNT(s.subscriptions_follower_id) AS follower FROM subscriptions AS s WHERE s.subscriptions_follow_ups_id = ?');
    $query->execute(array($get_id));
    $follower_count=$query->fetch();

    $query = $bdd->prepare('SELECT COUNT(s.subscriptions_follow_ups_id) AS follow_ups FROM subscriptions AS s WHERE s.subscriptions_follower_id = ?');
    $query->execute(array($get_id));
    $follower_ups_count=$query->fetch();

    $query = $bdd->prepare('SELECT COUNT(s.subscriptions_id) AS follow FROM subscriptions AS s WHERE s.subscriptions_follow_ups_id = ? AND s.subscriptions_follower_id = ?');
    $query->execute(array($get_id, $_GET['id']));
    $follow_type = $query->fetchall();
}

if(isset($_POST['follow_form']) AND $follow_type[0]['follow'] == 0)
{
    $query = $bdd->prepare('INSERT INTO subscriptions (subscriptions_follow_ups_id, subscriptions_follower_id) VALUES(?, ?)');
    $query->execute(array($get_id, $_GET['id']));
    $message = "Vous vous êtes abonné";
}
if(isset($_POST['unfollow_form']) AND $follow_type[0]['follow'] > 0)
{
    $query = $bdd->prepare('DELETE FROM subscriptions WHERE subscriptions_follow_ups_id = ? AND subscriptions_follower_id = ?');
    $query->execute(array($get_id, $_GET['id']));
    $message = "Vous vous êtes désabonné";
}

$tweets = $bdd->prepare('SELECT tweet_id, tweet_user_id, tweet_like, tweet_date, tweet_message FROM tweet WHERE tweet_user_id = ? ORDER BY tweet_date DESC');
$tweets->execute(array($get_id));

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
    </div>
    </br>
    </br>
    <div align = "center">
            <p>Abonnées : <?php echo $follower_count['follower'];?></p>
            <p>Abonnements : <?php echo $follower_ups_count['follow_ups']; ?></p>
    </div>
    </br>
    <div align="center">
        <form method="POST" action ="">
            <?php if($follow_type[0]['follow'] > 0)
            {
                $follow_button = 'Se désabonner';
                ?>
                <input type="submit" name="unfollow_form" value="<?php echo $follow_button; ?>" />
                <?php
            }
            elseif($_GET['id'] != $get_id)
            {
                $follow_button = 'Suivre';
                ?>
                <input type="submit" name="follow_form" value="<?php echo $follow_button; ?>" />
                <?php
            }
            ?>
        </form>
    </div>
    </br>
    <div align = "center">
        <?php if(isset($message)) { echo $message; } ?>
    </div>
    </br>
    <div align = "center">
        <a href="timeline.php?id=<?php echo $_SESSION['id'];?>">Retourner sur la page d'accueil</a>
    </div>
    <div align ="center">
        </br>
        <?php while($tweet_affiche = $tweets->fetch()) { ?>
            <b><a href="public_profil.php?id=<?php echo $_SESSION['id'];?>&public_id=<?php echo $tweet_affiche['tweet_user_id']; ?>"><?= $user['pseudo'] ?>:</a></b> <?= $tweet_affiche['tweet_message'] ?></br>
    <?php
    }
    ?>
    </div>
</body>
</html>