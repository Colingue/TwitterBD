<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=user__data', 'root', '');
$connect = mysqli_connect('localhost', 'root', '', 'user__data');

if(isset($_POST['form_connection']))
{
    $pseudo_connect = htmlspecialchars($_POST['pseudo_connect']);
    $password_connect = htmlspecialchars($_POST['password_connect']);

    $pseudo_connect = strip_tags(mysqli_real_escape_string($connect, trim($pseudo_connect)));
    $password_connect = strip_tags(mysqli_real_escape_string($connect, trim($password_connect)));
    // Si les champs sont complétés
    if(!empty($_POST['pseudo_connect']) AND !empty($_POST['password_connect']))
    {
        $find_user = $bdd->prepare("SELECT * FROM user WHERE pseudo = ?");
        $find_user->execute(array($pseudo_connect));

        // Verification que l'user existe
        $query = "SELECT * FROM user WHERE pseudo = '".$pseudo_connect."'";
        $execution = mysqli_query($connect, $query);
        if(mysqli_num_rows($execution)>0)
        {
            $row = mysqli_fetch_array($execution);
            $password_hash = $row['motdepasse'];
            if(password_verify($password_connect, $password_hash))
            {

                $user_info = $find_user->fetch();
                $_SESSION['id'] = $user_info['id'];
                $_SESSION['pseudo'] = $user_info['pseudo'];
                header("Location: timeline.php?id=".$_SESSION['id']); 
            }
            else 
            {
                $message = "Les identifiants sont incorrects...";
            }
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
            <img id="logo-connect" src="css/css/twitter-logo.jpg">
            <h2>Connectez vous</h2>
                <form method="POST" action="">
                    <div class="form-div">
                        <div>
                            <label for="input" class="Input-label">Pseudo</label>
                            <input id="input" class="Input-text" type="text" name="pseudo_connect" placeholder="Pseudo" />
                        </div>
                        </br>
                        <div>
                            <label for="input" class="Input-label">Mot de passe</label>
                            <input id="input" class="Input-text" type="password" name="password_connect" placeholder="Mot de passe" />
                        </div>
                        </br>
                        <input type="submit" name="form_connection" value="Se connecter" />
                    </div>                  
                </form>
            </div>
        </div>

            
            <br/>
            <div align="center">
                <?php
                if(isset($message)) 
                {
                    echo $message;
                }
                ?>
            </div>
        </div>
        <div align="center">
            <a href="register.php">Créer un compte</a>
        </div>
    </body>
</html>