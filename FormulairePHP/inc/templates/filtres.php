<?php 
    // Lecture du fichier JSON
    $json         = file_get_contents("product.json");
    $produits     = json_decode($json, true);
    $marques      = [];

    // Extraction des marques sans doublons
    foreach ($produits as $prod) {
        $marques[] = $prod["brand"];
    }
    $marques = array_unique($marques); // Suppression des doublons
?>


<form action="accueil.php" method="GET">
    <label for="marque">Choisissez la marque du produit à afficher : </label>
    <select name="brand" id="marque">
        <option value="">-- Sélectionnez une marque --</option>
        <?php foreach ($marques as $marque): ?>
            <option value="<?php echo htmlspecialchars($marque); ?>">
                <?php echo htmlspecialchars($marque); ?>
            </option>
        <?php endforeach;?>
    </select>
    <input type="submit" value="Rechercher">
</form>