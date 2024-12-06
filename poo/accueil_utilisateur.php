<?php
require_once 'Utilisateur.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($nom) && !empty($email) && !empty($password)) {
        $utilisateur = new Utilisateur($nom, $email, password_hash($password, PASSWORD_DEFAULT));
        echo "Utilisateur créé avec succès : " . $utilisateur->getNom();
    } else {
        echo "Veuillez remplir tous les champs.";
    }
} else {
    echo "Méthode de requête non valide.";
}
?>