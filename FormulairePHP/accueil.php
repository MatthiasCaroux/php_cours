<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Accueil</title>
</head>
<body>
    <?php 
    session_start();
    include("inc/templates/nav-bar.php"); 
    ?>
    <?php include("inc/templates/filtres.php"); ?>
    <div class="container">
        <?php
            $json = file_get_contents("product.json");
            $produits = json_decode($json, true);
            $marqueSelectionne = $_GET["brand"] ?? "";

            // Vérification si une marque est sélectionnée
            if ($marqueSelectionne) {
                foreach ($produits as $produit) {
                    if ($produit["brand"] === $marqueSelectionne) {
                        echo '<div class="contenu">';
                        echo '<img src="img/' . str_replace(" " , "",htmlspecialchars($produit["title"])) . '.png" alt="' . htmlspecialchars($produit["title"]) . '">';
                        echo '<div>';
                        echo '<h2>' . htmlspecialchars($produit["title"]) . '</h2>';
                        echo '<p>Prix : ' . htmlspecialchars($produit["price"]) . '€ </p>';
                        echo '<p>' . htmlspecialchars($produit["description"]) . '</p>';
                        echo '<a href="detail.php?id=' . htmlspecialchars($produit["id"]) . '">Voir le détail</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            } else {
                foreach ($produits as $produit) {
                    echo '<div class="contenu">';
                    echo '<img src="img/' . str_replace(" " , "",htmlspecialchars($produit["title"])) . '.png" alt="' . htmlspecialchars($produit["title"]) . '">';
                    echo '<div>';
                    echo '<h2>' . htmlspecialchars($produit["title"]) . '</h2>';
                    echo '<p>Prix : ' . htmlspecialchars($produit["price"]) . '€ </p>';
                    echo '<p>' . htmlspecialchars($produit["description"]) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        ?>
    </div>
</body>
</html>
