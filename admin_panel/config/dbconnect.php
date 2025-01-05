<?php

$server = "localhost";
$user = "root";
$password = "";
$db = "finaldatabase";

// Activer les rapports d'erreur
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Créer une connexion
$conn = mysqli_connect($server, $user, $password, $db);

// Requête SQL pour récupérer les projets
$sql = "SELECT * FROM projects";
$result = $conn->query($sql);



//$conn->close();


// Vérifier si le fichier dbconnect.php existe avec un chemin relatif approprié
$file = __DIR__ . '/../config/dbconnect.php'; // Utilisation de __DIR__ pour générer un chemin relatif

?>
