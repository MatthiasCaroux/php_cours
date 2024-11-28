<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include("inc/templates/nav-bar.php"); ?>
    <?php
        session_start();
        $json = file_get_contents("product.json");
        $produits = json_decode($json, true);
        $idSelectionne = $_GET["id"] ?? "";
        $produitSelectionne = null;

        // Vérification si un produit est sélectionné
        if ($idSelectionne) {
            foreach ($produits as $produit) {
                if ($produit["id"] == $idSelectionne) {
                    $produitSelectionne = $produit;
                    break;
                }
            }
        }

        if ($produitSelectionne) {
            echo '<div class="contenu">';
            echo '<img src="img/' . str_replace(" " , "",htmlspecialchars($produitSelectionne["title"])) . '.png" alt="' . htmlspecialchars($produitSelectionne["title"]) . '">';
            echo '<div>';
            echo '<h2>' . htmlspecialchars($produitSelectionne["title"]) . '</h2>';
            echo '<p>Prix : ' . htmlspecialchars($produitSelectionne["price"]) . '€ </p>';
            echo '<p>' . htmlspecialchars($produitSelectionne["description"]) . '</p>';
            echo '<p>Catégorie : '. htmlspecialchars($produitSelectionne["category"]) .'</p>';
            echo '<p>Nombre en stock : '. htmlspecialchars($produitSelectionne["stock"]) .'</p>';
            echo '<p>Note : '. htmlspecialchars($produitSelectionne["rating"]) .'</p>';
            echo '</div>';
            echo '</div>';
        } else {
            echo '<p>Produit non trouvé</p>';
        }
    ?>
    <form action="panier.php" method="GET">
        <label for="panier">Ajouter au panier : </label>
        <input type="number" name="panier" id="panier" value="1" min="1" max="<?php echo htmlspecialchars($produitSelectionne["stock"]); ?>">
        <input type="submit" value="Ajouter au panier">
        <?php echo '<input type="hidden" name="id" value="' . htmlspecialchars($idSelectionne) . '">'; ?>
    </form>
</body>
</html>