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
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail Produit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include("inc/templates/nav-bar.php"); ?>
    <div class="container-detail">
        <?php if ($produitSelectionne): ?>
            <div class="detail-header">
                <div class="breadcrumb">
                    <a href="index.php">Accueil</a> &gt; <a href="accueil.php">Produits</a> &gt; <?php echo htmlspecialchars($produitSelectionne["title"]); ?>
                </div>
            </div>
            <div class="detail-produit">
                <div class="image-section">
                    <img src="img/<?php echo str_replace(" ", "", htmlspecialchars($produitSelectionne["title"])); ?>.png" alt="<?php echo htmlspecialchars($produitSelectionne["title"]); ?>">
                </div>
                <div class="details-section">
                    <h1><?php echo htmlspecialchars($produitSelectionne["title"]); ?></h1>
                    <p class="prix">Prix : <strong><?php echo htmlspecialchars($produitSelectionne["price"]); ?>€</strong></p>
                    <p class="description"><?php echo htmlspecialchars($produitSelectionne["description"]); ?></p>
                    <p class="categorie">Catégorie : <strong><?php echo htmlspecialchars($produitSelectionne["category"]); ?></strong></p>
                    <p class="stock">Nombre en stock : <strong><?php echo htmlspecialchars($produitSelectionne["stock"]); ?></strong></p>
                    <p class="note">Note : <strong><?php echo htmlspecialchars($produitSelectionne["rating"]); ?>/10</strong></p>
                    <form action="panier.php" method="GET" class="form-panier">
                        <label for="panier">Quantité : </label>
                        <input type="number" name="panier" id="panier" value="1" min="1" max="<?php echo htmlspecialchars($produitSelectionne["stock"]); ?>">
                        <input type="text" name="code-promo" id="code-promo" placeholder="Code promo">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($idSelectionne); ?>">
                        <button type="submit" class="btn-ajouter-panier">Ajouter au panier</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <p class="produit-non-trouve">Produit non trouvé</p>
        <?php endif; ?>
    </div>
</body>
</html>
