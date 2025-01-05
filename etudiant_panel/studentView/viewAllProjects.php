<?php
include_once "../config/dbconnect.php";  // Connexion à la base de données
session_start();

// Récupérer uniquement les projets avec le statut "open"
$sql = "SELECT * FROM projects WHERE status = 'Open'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Projects</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
      
    <?php include "../studentHeader.php"; ?>  <!-- Inclure l'en-tête -->
    <?php include "../sidebar.php"; ?>
    <div id="main-content" class="container py-4">
        <div>
            <h2>Available Projects</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">S.N.</th>
                        <th class="text-center">Project Title</th>
                        <th class="text-center">Project Description</th>
                        <th class="text-center">Keywords</th>
                        <th class="text-center">Technologies</th>
                        <th class="text-center">Domain</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $count = 1;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td class="text-center"><?= $count ?></td>
                        <td class="text-center"><?= htmlspecialchars($row["title"]) ?></td>
                        <td class="text-center"><?= htmlspecialchars($row["description"]) ?></td>      
                        <td class="text-center"><?= htmlspecialchars($row["keywords"]) ?></td> 
                        <td class="text-center"><?= htmlspecialchars($row["technologies"]) ?></td>     
                        <td class="text-center"><?= htmlspecialchars($row["category_id"]) ?></td>
                        <td class="text-center"><?= htmlspecialchars($row["status"]) ?></td>
                        <td class="text-center">
                            <!-- Bouton pour postuler -->
                            <form method="GET" action="applyProject.php">
                                <input type="hidden" name="project_id" value="<?= htmlspecialchars($row['project_id']) ?>">
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </form>
                        </td>
                    </tr>
                <?php
                        $count++;
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="8" class="text-center">No open projects available at the moment.</td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>
</html>
