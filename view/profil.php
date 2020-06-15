<?php  
session_start();

if (isset($_GET['id']) AND $_GET['id'] > 0) 
{
    $get_id = intval($_GET['id']);
    $query = $bdd->prepare('SELECT * FROM user WHERE id = ?');
    $query->execute(array($get_id));
    $user = $query->fetch();
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
            <h2>Votre profil <?php echo $user['pseudo']; ?></h2>
            <br/> <br/>
            
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