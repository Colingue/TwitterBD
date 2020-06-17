<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=user__data', 'root', '');

if(isset($_POST['tweet_form']))
{
    if(isset($_POST['tweet']) AND !empty($_POST['tweet']))
    {
        $tweet = htmlspecialchars($_POST['tweet']);

        if(strlen($tweet) <= 140)
        {
            //Prends la date Now
            $queryDate = $bdd->prepare('SELECT NOW()');
            $queryDate->execute();
            $date = $queryDate->fetch();
            
            // Insert un nouveau tweet dans le base de données
            $query = $bdd->prepare('INSERT INTO tweet (tweet_user_id, tweet_like , tweet_date, tweet_message) VALUES (?, ?, now(), ?)');
            $query->execute(array($_GET['id'], 0, $tweet));

            $message = "Votre tweet a bien été publié !";
        }
    }
}

// Recherche de l'utilisateur qui a ecrit le tweet
$tweet = $bdd->prepare('SELECT t.tweet_id, t.tweet_user_id, t.tweet_like, t.tweet_date, t.tweet_message FROM tweet AS t
                        INNER JOIN subscriptions AS s ON t.tweet_user_id = s.subscriptions_follow_ups_id WHERE s.subscriptions_follower_id = 5
                        UNION
                        SELECT t.tweet_id, t.tweet_user_id, t.tweet_like, t.tweet_date, t.tweet_message FROM tweet AS t WHERE t.tweet_user_id = 5');
$tweet->execute(array($_GET['id']));
$tweet_tl = $tweet->fetchall();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Twitter Clone</title>
        <meta name="viewport" content="width=device-width, initial-scaled=1">
    </head>

    <body>
        <div>
            <div>
                <a href="edit_profil.php?id=<?php echo $_SESSION['id'];?>">Editer mon profil</a>
                <a href="private_profil.php?id=<?php echo $_SESSION['id'];?>">Voir mon profil</a> 
            </div>
            <div align="center">
                <h2>Home</h2>
                <form method="POST" action="">
                    <textarea width=500 name="tweet" placeholder="Avez vous quelque chose à dire ?"></textarea></br></br>
                    <input type="submit" value="Tweeter !" name="tweet_form" />
                </form>
                </br>
                <?php if(isset($message)) { echo $message; } ?>

                <div>
                    </br>
                    <?php for ($lign = 0; $lign < count($tweet_tl); $lign++) {
                    $tweet_info = $bdd->prepare('SELECT u.pseudo FROM user AS u INNER JOIN tweet AS t ON u.id = t.tweet_user_id WHERE t.tweet_user_id = ? GROUP BY u.pseudo');
                    $tweet_info->execute(array($tweet_tl[$lign]['tweet_user_id']));
                    $pseudo = $tweet_info->fetch(); ?>
                    <b><?= $pseudo['pseudo']?>:</b><?= $tweet_tl[$lign]['tweet_message'] ?></br>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        
    </body>
</html>