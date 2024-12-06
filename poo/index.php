<?php
    require_once 'Utilisateur.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <form action="accueil_utilisateur.php" method="post">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>