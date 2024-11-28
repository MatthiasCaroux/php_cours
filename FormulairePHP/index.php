<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Formulaire de connexion</title>
</head>
<body>
    <?php
        session_start();
        if (!isset($_SESSION["panier"])) {
            $_SESSION["panier"] = [];
        }
    ?>

    <?php include("inc/templates/nav-bar.php"); ?>
    <?php include("inc/templates/filtres.php"); ?>
</body>
</html>
