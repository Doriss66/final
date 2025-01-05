<?php
session_start();
include_once "../config/dbconnect.php";  // Connexion à la base de données

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "Error: You need to be logged in to delete your application.";
    exit;
}

$student_id = $_SESSION['user_id']; // ID de l'utilisateur connecté

// Vérification si l'application_id est passée via la méthode POST
if (isset($_POST['id'])) {
    $application_id = $_POST['id'];

    // Requête SQL pour supprimer la candidature
    $sql = "DELETE FROM applications WHERE id = ? AND student_id = ?";
    $stmt = $conn->prepare($sql);
    
    // Lier les paramètres et exécuter la requête
    $stmt->bind_param("ii", $application_id, $student_id);
    
    if ($stmt->execute()) {
        // Rediriger l'utilisateur vers la page des candidatures après la suppression
        header("Location: myApplications.php?success=1");
    } else {
        echo "Error: Unable to delete application.";
    }

    $stmt->close();
} else {
    echo "Error: Application ID is missing.";
}

$conn->close();
?>
