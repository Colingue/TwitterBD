<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=user__data', 'root', '');

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
                <a href="profil_user.php?id=<?php echo $_SESSION['id'];?>">Voir mon profil</a> 
            </div>
            <div align="center">
                <h2>Home</h2>
                <form method="POST" action="">
                    <textarea width=500 name="tweet" placeholder="Avez vous quelque chose à dire ?"></textarea></br></br>
                    <input type="submit" value="Tweeter !" />
                </form>
                <?php if(isset($message)) { echo $message; } ?>
            </div>
        </div>
        
    </body>
</html>