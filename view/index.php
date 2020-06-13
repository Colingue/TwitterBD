<?php  

$bdd = new PDO('mysql:host=127.0.0.1;dbname=user__data', 'root', '');

if(isset($_POST['form_inscription']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if(!empty($_POST['pseudo']) AND !empty($_POST['password']))
    {
        $pseudo_lenght = strlen($pseudo);

        if ($pseudo_lenght <= 255) 
        {
            $insert_user = $bdd->prepare("INSERT INTO user(pseudo, motdepasse) VALUES(?, ?)");
            $insert_user->execute(array($pseudo, $password));
            $message = "Votre compte a bien été crée !";
        }
        else 
        {
            $message = "Votre pseudo ne doit pas dépasser 255 caractères";
        }
    }
    else
    {
        $message = "Tous les champs n'ont pas été complétés...";
    }
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
            <h2>Creer un compte</h2>
            <br/> <br/>
            <form method="POST" action="">
                <table>
                    <tr>
                        <td>
                            <label for="pseudo"> Pseudo : </label>
                        </td>
                        <td>
                            <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo;} ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="password"> Mot de Passe : </label>
                        </td>
                        <td>
                            <input type="password" placeholder="Votre mot de passe" id="password" name="password"/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="form_inscription" value="Je m'inscris" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php
            if(isset($message)) 
            {
                echo $message;
            }
            ?>
        </div>
    </body>
</html>