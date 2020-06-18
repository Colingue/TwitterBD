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
        
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Twitter Clone</title>
        <meta name="viewport" content="width=device-width, initial-scaled=1">
        <link rel='stylesheet' type='text/css' href='css/style.css'>
        <link rel='stylesheet' type='text/css' href='css/css/all.min.css'>
    </head>

    <body>
        <div class="page-accueil">
            <nav class="section-accueil">
                <ul class="list-profil">
                    <li class="li-profil-lien"><img id="logo" src="css/css/twitter-logo.jpg"></li>
                    <li class="li-profil-lien"><a class="profil-lien" href="timeline.php?id=<?php echo $_SESSION['id'];?>"><i class="fas fa-home"></i>Retourner sur la page d'accueil</a></li>
                </ul>
            </nav>
            
            <section class="section-accueil" id="tl-defilement">
                <h2><?php echo $user['pseudo']; ?></h2>
                <div class="subscribe">
                    <p><b><?php echo $follower_count['follower'];?></b> Abonnés</p>
                    <p><b><?php echo $follower_ups_count['follow_ups']; ?></b> Abonnements</p>
                </div>
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
                <div id="all-tweet">
                    <?php while($tweet_affiche = $tweets->fetch()) { ?>
                        <div class="each-tweet">
                            <div class="tweet-info">
                                <a id="pseudo-tweet" href="public_profil.php?id=<?php echo $_SESSION['id'];?>&public_id=<?php echo $tweet_affiche['tweet_user_id']; ?>"><?= $user['pseudo'] ?></a>
                                <p class="date-tweet"><?= $tweet_affiche['tweet_date'] ?></p>
                            </div>
                            <p class="message-tweet" ><?= $tweet_affiche['tweet_message'] ?></p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </section>
            
            <nav class="section-accueil">
                <div class="sub-div">
                    <div class="part">
                        <h2>Abonnés</h2>
                        <?php
                        $query = $bdd->prepare('SELECT u.pseudo, u.id FROM user AS u INNER JOIN subscriptions AS s ON u.id = s.subscriptions_follower_id WHERE s.subscriptions_follow_ups_id = ?');
                        $query->execute(array($get_id));
                        $followers = $query->fetchall();
                        ?>
                        <table>
                            <?php
                            for ($lign = 0; $lign < count($followers); $lign++)
                            {
                                ?>
                                <a class="link-sub" href="public_profil.php?id=<?php echo $_SESSION['id'];?>&public_id=<?php echo $followers[$lign]['id']; ?>"><?php echo $followers[$lign]['pseudo']; ?></a>
                                </br>
                                <?php
                            }
                            ?>
                        </br>
                        </table>
                    </div>
                    <div class="part">
                        <h2>Abonnements</h2>
                        <?php
                        $query = $bdd->prepare('SELECT u.pseudo, u.id FROM user AS u INNER JOIN subscriptions AS s ON u.id = s.subscriptions_follow_ups_id WHERE s.subscriptions_follower_id = ?');
                        $query->execute(array($get_id));
                        $followers = $query->fetchall();
                        ?>
                        <table>
                            <?php
                            for ($lign = 0; $lign < count($followers); $lign++)
                            {
                                ?>
                                <a class="link-sub" href="public_profil.php?id=<?php echo $_SESSION['id'];?>&public_id=<?php echo $followers[$lign]['id']; ?>"><?php echo $followers[$lign]['pseudo']; ?></a>
                                </br>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>    
            </nav>
        </div>
    </body>
</html>