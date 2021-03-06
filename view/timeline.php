<?php

session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=user__data', 'root', '');

if(isset($_POST['tweet_form']))
{
    if(isset($_POST['tweet']) AND !empty($_POST['tweet']))
    {
        $tweet = htmlspecialchars($_POST['tweet']);
        $tweet_count = strlen($tweet);
        if($tweet_count <= 140)
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
        else
        {
            $message = "Votre tweet ne doit pas contenir plus de 140 caractères";
        }
    }
}

// Recherche de l'utilisateur qui a ecrit le tweet
$tweet = $bdd->prepare('SELECT t.tweet_id, t.tweet_user_id, t.tweet_like, t.tweet_date, t.tweet_message FROM tweet AS t
                        INNER JOIN subscriptions AS s ON t.tweet_user_id = s.subscriptions_follow_ups_id WHERE s.subscriptions_follower_id = ?
                        UNION
                        SELECT t.tweet_id, t.tweet_user_id, t.tweet_like, t.tweet_date, t.tweet_message FROM tweet AS t WHERE t.tweet_user_id = ?
                        ORDER BY tweet_date DESC');
$tweet->execute(array($_GET['id'], $_GET['id']));
$tweet_tl = $tweet->fetchall();

$tweet = $bdd->prepare('SELECT t.tweet_id, t.tweet_user_id, t.tweet_like, t.tweet_date, t.tweet_message FROM tweet AS t
                        INNER JOIN subscriptions AS s ON t.tweet_user_id = s.subscriptions_follow_ups_id WHERE s.subscriptions_follower_id = ?
                        UNION
                        SELECT t.tweet_id, t.tweet_user_id, t.tweet_like, t.tweet_date, t.tweet_message FROM tweet AS t WHERE t.tweet_user_id = ?
                        ORDER BY tweet_date DESC');
$tweet->execute(array($_GET['id'], $_GET['id']));
$tweet_tl = $tweet->fetchall();

?>
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
                    <li class="li-profil-lien"><a class="profil-lien" href="private_profil.php?id=<?php echo $_SESSION['id'];?>"><i class="fas fa-user-alt"></i>Voir mon profil</a></li>
                    <li class="li-profil-lien"><a class="profil-lien" href="edit_profil.php?id=<?php echo $_SESSION['id'];?>"><i class="fas fa-pencil-alt"></i>Editer mon profil</a></li>
                </ul>
            </nav>
            
            <section class="section-accueil" id="tl-defilement">
                <h2>Accueil</h2>
                <form id="form-write-tweet" method="POST" action="">
                    <textarea name="tweet" placeholder="Quoi de neuf ?"></textarea></br>
                    <div id="the-count">
                        <span id="current">0</span>
                        <span id="maximum">/ 140</span>
                    </div>
                    </br><input type="submit" value="Tweeter !" name="tweet_form" /></br> 
                </form>
                <?php if(isset($message)) { echo $message; } ?>

                <div id="all-tweet">
                    <?php for ($lign = 0; $lign < count($tweet_tl); $lign++) {
                    $tweet_info = $bdd->prepare('SELECT u.pseudo, u.id FROM user AS u INNER JOIN tweet AS t ON u.id = t.tweet_user_id WHERE t.tweet_user_id = ? GROUP BY u.pseudo');
                    $tweet_info->execute(array($tweet_tl[$lign]['tweet_user_id']));
                    $pseudo = $tweet_info->fetch(); ?>
                        <div class="each-tweet">
                            <div class="tweet-info">
                                <a id="pseudo-tweet" href="public_profil.php?id=<?php echo $_SESSION['id'];?>&public_id=<?php echo $pseudo['id']; ?>"><?= $pseudo['pseudo']?></a>
                                <p class="date-tweet"><?= $tweet_tl[$lign]['tweet_date'] ?></p>
                            </div>
                            <p class="message-tweet" ><?= $tweet_tl[$lign]['tweet_message'] ?></br></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </section>
            
            <nav class="section-accueil">
                <div class="sub-div">
                    <div class="part">
                        <h2>Suggestions</h2>
                        <a id="pseudo-tweet" href="public_profil.php?id=<?php echo $_SESSION['id'];?>&public_id=6">test2</a></br>

                        </table>
                    </div>
                </div>    
            </nav>
        </div>
    </body>
</html>