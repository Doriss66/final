<?php
include_once "../config/dbconnect.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<div class='alert alert-success'>Your application has been successfully deleted.</div>";
} elseif (isset($_GET['error'])) {
    echo "<div class='alert alert-danger'>There was an error deleting your application.</div>";
}



$student_id = $_SESSION['user_id'];

// Requête pour récupérer les candidatures uniquement pour les projets "open"
$sql = "SELECT applications.*, projects.title, projects.status 
        FROM applications 
        JOIN projects ON applications.project_id = projects.project_id 
        WHERE applications.student_id = ? AND projects.status = 'Open'";  // Filtre sur le statut "open"
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    
    <?php include "../studentHeader.php"; ?>
    <?php include "../sidebar.php"; ?>

    <div id="main-content" class="container py-4">
        <h2>My Applications</h2>

        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($application = $result->fetch_assoc()): ?>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($application['title'] ?? 'Unknown Project'); ?></h5>
<p class="card-text">Status: <?= htmlspecialchars($application['application_status'] ?? 'Unknown Status'); ?></p>
<p class="card-text">Applied On: <?= htmlspecialchars($application['submitted_at'] ?? 'Unknown Date'); ?></p>
  <!-- Bouton de suppression -->
  <form method="POST" action="deleteApplication.php">
                <input type="hidden" name="id" value="<?= $application['id']; ?>">
                <button type="submit" class="btn btn-danger">Delete Application</button>
            </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>You haven't applied to any open projects yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>
</html>

