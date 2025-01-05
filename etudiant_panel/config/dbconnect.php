<?php
$servername = "localhost";
$username = "root"; // Nom d'utilisateur pour la base de données
$password = ""; // Mot de passe pour la base de données
$dbname = "finaldatabase"; // Remplacez par le nom de votre base de données

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
