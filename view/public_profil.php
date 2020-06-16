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
    $query->execute(array($_GET['public_id']));
    $follower_count=$query->fetch();

    $query = $bdd->prepare('SELECT COUNT(s.subscriptions_follow_ups_id) AS follow_ups FROM subscriptions AS s WHERE s.subscriptions_follower_id = ?');
    $query->execute(array($_GET['public_id']));
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
    </div>
    </br>
    </br>
    <div align = "center">
            Abonnées : <?php echo $follower_count['follower'];?>
            Abonnements : <?php echo $follower_ups_count['follow_ups']; ?>
    </div>
    </br>
    <div align = "center">
        <a href="timeline.php?id=<?php echo $_SESSION['id'];?>">Retourner sur la page d'accueil</a>
    </div>
</body>
</html>