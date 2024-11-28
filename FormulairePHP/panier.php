<?php
session_start();

// Initialisation du panier si nécessaire
if (!isset($_SESSION["panier"])) {
    $_SESSION["panier"] = [];
}

// Chargement des produits
$json = file_get_contents("product.json");
$produits = json_decode($json, true);

$idSelectionne = $_GET["id"] ?? "";
$quantite = intval($_GET["panier"] ?? 1);
$produitSelectionne = null;

// Vérification si un produit est sélectionné
if ($idSelectionne) {
    foreach ($produits as $produit) {
        if ($produit["id"] == $idSelectionne) {
            $produitSelectionne = $produit;
            $produitSelectionne["quantite"] = $quantite; // Quantité ajoutée

            // Recherche si le produit est déjà dans le panier
            $produitTrouve = false;
            foreach ($_SESSION["panier"] as &$item) {
                if ($item["id"] == $produitSelectionne["id"]) {
                    // Si le produit existe déjà, on ajoute la quantité
                    $item["quantite"] += $quantite;
                    $produitTrouve = true;
                    break;
                }
            }
            unset($item); // Déverrouiller la référence

            // Si le produit n'est pas encore dans le panier, on l'ajoute
            if (!$produitTrouve) {
                $_SESSION["panier"][] = $produitSelectionne;
            }
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
    <title>Panier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include("inc/templates/nav-bar.php"); ?>
    <h1>Mon Panier</h1>

    <h2>Total du panier : <?php echo htmlspecialchars(array_sum(array_map(function($item) { return $item["price"] * $item["quantite"]; }, $_SESSION["panier"]))); ?>€</h2>
    
    <!-- Produit récemment ajouté -->
    <?php if ($produitSelectionne): ?>
        <h2>Produit ajouté :</h2>
        <div class="contenu">
            <img src="img/<?php echo str_replace(" ", "", htmlspecialchars($produitSelectionne["title"])); ?>.png" alt="<?php echo htmlspecialchars($produitSelectionne["title"]); ?>">
            <div>
                <h3><?php echo htmlspecialchars($produitSelectionne["title"]); ?></h3>
                <p>Prix : <?php echo htmlspecialchars($produitSelectionne["price"]); ?>€</p>
                <p>Quantité : <?php echo htmlspecialchars($produitSelectionne["quantite"]); ?></p>
                <p>Total : <?php echo htmlspecialchars($produitSelectionne["price"] * $produitSelectionne["quantite"]); ?>€</p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Tous les produits du panier -->
    <h2>Produits dans le panier :</h2>
    <?php if (!empty($_SESSION["panier"])): ?>
        <?php foreach ($_SESSION["panier"] as $item): ?>
            <div class="contenu">
                <img src="img/<?php echo str_replace(" ", "", htmlspecialchars($item["title"])); ?>.png" alt="<?php echo htmlspecialchars($item["title"]); ?>">
                <div>
                    <h3><?php echo htmlspecialchars($item["title"]); ?></h3>
                    <p>Prix : <?php echo htmlspecialchars($item["price"]); ?>€</p>
                    <p>Quantité : <?php echo htmlspecialchars($item["quantite"]); ?></p>
                    <p>Total : <?php echo htmlspecialchars($item["price"] * $item["quantite"]); ?>€</p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Votre panier est vide.</p>
    <?php endif; ?>

    <?php if (!empty($_SESSION["panier"])): ?>
        <form method="post" action="vider_panier.php">
            <button type="submit">Vider le panier</button>
        </form>
    <?php endif; ?>
</body>
</html>
