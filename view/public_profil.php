<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=user__data', 'root', '');


if (isset($_GET['id']) AND $_GET['id'] > 0)
{
    $get_id = intval($_GET['id']);
    $query = $bdd->prepare('SELECT id, pseudo, motdepasse FROM user WHERE id = ?');
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
    <h2><?php echo $user['pseudo']; ?></h2>
</div>
</body>
</html>