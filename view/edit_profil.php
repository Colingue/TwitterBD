<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=user__data', 'root', '');


if (isset($_SESSION['id'])) 
{
    $query = $bdd->prepare("SELECT * FROM user WHERE id = ?");
    $query->execute(array($_SESSION['id']));
    $user = $query->fetch();


    // Updat
    if (isset($_POST['new_pseudo']) AND !empty($_POST['new_pseudo']) AND $_POST['new_pseudo'] != $user['pseudo']) 
    {
        $new_pseudo = htmlspecialchars($_POST['new_pseudo']);
       
        $pseudo_lenght = strlen($new_pseudo);
        // On vérifie si le pseudo est déjà pris
        $verifiPseudo = $bdd->prepare("SELECT * FROM user WHERE pseudo = ? ");
        $verifiPseudo->execute(array($new_pseudo));
        $doublonPseudo = $verifiPseudo->rowCount();

        if ($doublonPseudo == 0)
        {
            if ($pseudo_lenght <= 255) 
            {
                // On update le pseudo
                $update_pseudo = $bdd->prepare("UPDATE user SET pseudo = ? WHERE id = ?");
                $update_pseudo->execute(array($new_pseudo, $_SESSION['id']));
                header('Location: profil_user.php?id='.$_SESSION['id']);
            }

            else 
            {
                $message = "Votre pseudo ne doit pas dépasser 255 caractères";
            }
        }
        else
        {
            $message = "Mince ! Ce pseudo est déjà pris";
        }
    }

    if (isset($_POST['new_password']) AND !empty($_POST['new_password']) AND $_POST['new_password'] != $user['motdepasse']) 
    {
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $update_password = $bdd->prepare("UPDATE user SET motdepasse = ? WHERE id = ?");
        $update_password->execute(array($new_password, $_SESSION['id']));
        header('Location: profil_user.php?id='.$_SESSION['id']);
    }

    if (isset($_POST['new_pseudo']) AND $_POST['new_pseudo'] == $user['pseudo']) 
    {
        header('Location: profil_user.php?id='.$_SESSION['id']);
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
            <h2>Edition de mon profil</h2>
            <form method="POST" action="">
                <input type="text" name="new_pseudo" placeholder="Pseudo" value="<?php echo $user['pseudo'];?>" /> </br></br>
                <input type="password" name="new_password" placeholder="Mot de passe" /> </br></br>
                <input type="submit" value="Mettre à jour mon profil" />
            </form>
            <?php if(isset($message)) { echo $message; } ?>
            </br></br>
            <a href="timeline.php?id=<?php echo $_SESSION['id'];?>">Revenir sur la page d'accueil</a>
        </div>
    </body>
</html>

<?php
}
else
{
    header("Location: index.php");
}