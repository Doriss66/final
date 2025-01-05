<?php
session_start();
include_once "../config/dbconnect.php"; // Connexion à la base de données

// Vérification si le project_id est passé dans l'URL
$project_id = isset($_GET['project_id']) ? $_GET['project_id'] : null;
if ($project_id) {
    // Traitez le cas où project_id est défini
    echo "Processing project with ID: " . htmlspecialchars($project_id ?? 0);
} else {
    // Affichez un message ou une action par défaut
    echo "No specific project selected.";
}





// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "Error: You need to be logged in to apply.";
    exit;
}

$student_id = $_SESSION['user_id']; // ID de l'utilisateur connecté

// Traitement de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "INSERT INTO applications (student_id, project_id, application_status) 
            VALUES (?, ?, 'Pending')";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Erreur de préparation de la requête SQL : ' . $conn->error);
    }

    $stmt->bind_param("ii", $student_id, $project_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Application submitted successfully.";
    } else {
        echo "Failed to submit the application.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
   
    <?php include_once '../studentHeader.php'; ?>

    <div class="container mt-5">
        <h3>Apply for Project</h3>
        <h5 class="card-title"><?= htmlspecialchars($application['title'] ?? 'Unknown Project'); ?></h5>

       

        <form method="POST" action="applyProject.php?project_id=<?= htmlspecialchars($project_id ?? 0); ?>">

            <div class="form-group">
                <label for="message">Message (optional):</label>
                <textarea class="form-control" id="message" name="message" rows="4" placeholder="Write a message (optional)"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

