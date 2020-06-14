<?php  

$bdd = new PDO('mysql:host=127.0.0.1;dbname=user__data', 'root', '');

if(isset($_POST['form_connection']))
{
    $pseudo_connect = htmlspecialchars($_POST['pseudo_connect']);
    $password_connect = password_hash($_POST['password_connect'], PASSWORD_DEFAULT);

    // Si les champs sont complétés
    if(!empty($_POST['pseudo_connect']) AND !empty($_POST['password_connect']))
    {
        // Verification que l'user existe
        $verif = $bdd->prepare("SELECT * FROM user u WHERE u.pseudo = ? AND u.motdepasse = ?");
        $verif->execute(array($pseudo_connect, $password_connect));
        $user_exist = $verif->rowCount();
        if($user_exist == 1)
        {
            $user_info = $verif->fetch();
            
        }
        else 
        {
            $message = "Les identifiants sont incorrects...";
        }
    }
    else
    {
        $message = "Tous les champs n'ont pas été complétés...";
    }
}
// OSKUR COLIN
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
            <h2>Connectez vous</h2>
            <br/> <br/>
            <form method="POST" action="">
                <input type="text" name="pseudo_connect" placeholder="Pseudo" />
                <input type="password" name="password_connect" placeholder="Mot de passe" />
                <input type="submit" name="form_connection" value="Se connecter" />
            </form>
            <br/>
            <?php
            if(isset($message)) 
            {
                echo $message;
            }
            ?>
        </div>
    </body>
</html>