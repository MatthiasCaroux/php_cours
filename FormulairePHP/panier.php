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
$codePromo = $_GET["code-promo"] ?? ""; // Récupération du code promo
$produitSelectionne = null;
$reduction = 0;

// Si un produit est sélectionné donc si on vient de l'ajouter au panier
if ($idSelectionne) {
    foreach ($produits as $produit) {
        if ($produit["id"] == $idSelectionne) {
            $produitSelectionne = $produit;
            $produitSelectionne["quantite"] = $quantite;

            // Application du code promo si valide
            if (strtolower($codePromo) == "iuto") {
                $reduction = 0.10; // Réduction de 10%
                $produitSelectionne["reduction"] = $reduction;
            } else {
                $produitSelectionne["reduction"] = 0; // Pas de réduction
            }

            // Recherche si le produit est déjà dans le panier
            $produitTrouve = false;
            foreach ($_SESSION["panier"] as &$item) {
                if ($item["id"] == $produitSelectionne["id"]) {
                    // Si le produit existe déjà, on ajoute la quantité
                    $item["quantite"] += $quantite;
                    // Si un code promo est appliqué, mettre à jour la réduction
                    if ($reduction > 0) {
                        $item["reduction"] = $reduction;
                    }
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
    <title>Mon Panier</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="panier.css">
</head>
<body>
    <?php include("inc/templates/nav-bar.php"); ?>

    <div class="container-panier">
        <h1>Mon Panier</h1>

        <?php if (!empty($_SESSION["panier"])): ?>
            <div class="panier-details">
                <h2>Résumé de votre panier</h2>
                <table class="table-panier">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Produit</th>
                            <th>Prix unitaire</th>
                            <th>Quantité</th>
                            <th>Réduction</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION["panier"] as $item): ?>
                            <?php
                            $prixUnitaire = $item["price"];
                            $reduction = $item["reduction"] ?? 0;
                            $prixAvecReduction = $prixUnitaire * (1 - $reduction);
                            $total = $prixAvecReduction * $item["quantite"];
                            ?>
                            <tr>
                                <td><img src="img/<?php echo str_replace(" ", "", htmlspecialchars($item["title"])); ?>.png" alt="<?php echo htmlspecialchars($item["title"]); ?>" class="img-panier"></td>
                                <td><?php echo htmlspecialchars($item["title"]); ?></td>
                                <td><?php echo number_format($prixUnitaire, 2); ?>€</td>
                                <td><?php echo htmlspecialchars($item["quantite"]); ?></td>
                                <td><?php echo $reduction > 0 ? '10% de réduction' : 'Aucune'; ?></td>
                                <td><?php echo number_format($total, 2); ?>€</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <div class="panier-total">
                    <h2>Total du panier : 
                        <?php 
                        $totalPanier = array_sum(array_map(function($item) {
                            $reduction = $item["reduction"] ?? 0;
                            return ($item["price"] * (1 - $reduction)) * $item["quantite"];
                        }, $_SESSION["panier"]));
                        echo number_format($totalPanier, 2);
                        ?>€
                    </h2>
                </div>

                <div class="actions-panier">
                    <form method="post" action="vider_panier.php">
                        <button type="submit" class="btn-vider-panier">Vider le panier</button>
                    </form>
                    <button class="btn-commande">Passer la commande</button>
                </div>
            </div>
        <?php else: ?>
            <p class="panier-vide">Votre panier est vide. Rendez-vous sur la page des produits pour ajouter des articles à votre panier.</p>
        <?php endif; ?>
    </div>
</body>
</html>
