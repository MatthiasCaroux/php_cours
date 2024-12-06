<?php
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Arthur et ses camos</h1>
    <?php
        $text = new Text("name", true, "le texte à afficher");
        echo $text;
    ?>
</body>
</html>