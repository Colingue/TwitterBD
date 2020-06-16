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
$tweets = $bdd->prepare('SELECT tweet_id, tweet_user_id, tweet_like, tweet_date, tweet_message FROM tweet ORDER BY tweet_date DESC');
$tweets->execute();
$tweet_all = $tweets->fetch();
$user_id = $tweet_all['tweet_user_id'];

$user = $bdd->prepare('SELECT id, pseudo FROM user WHERE id = ?');
$user->execute(array($user_id));
$user_info = $user->fetch();



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
                    <?php while($tweet_affiche = $tweets->fetch()) { ?>
                    <b><?= $user_info['pseudo'] ?>:</b> <?= $tweet_affiche['tweet_message'] ?></br>
                    </div>
                    <?php
                    }
                    ?>
            </div>
        </div>
        
    </body>
</html>