<?php
session_start();

// je vide le panier existant si il est bien instancié
if (isset($_SESSION["panier"])) {
    $_SESSION["panier"] = [];
}

// Redirection vers la page du panier après avoir vidé le panier
header("Location: panier.php");
exit();
?>
