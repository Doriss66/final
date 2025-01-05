<?php
session_start();
include_once "../config/dbconnect.php";  // Connexion à la base de données
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers List</title>
    <link rel="stylesheet" href="/admin2_panel/assets/css/style.css">
    <script src="/admin2_panel/assets/js/script.js"></script>
</head>
<body>
    <?php
        include "../dashboard.php";  // Inclure le header de l'admin
        include "../sidebar.php";  // Inclure le sidebar de l'admin
    ?>

    <div id="main-content" class="container py-4">
        <h2>List of Teachers</h2>
        <!-- Table to display teachers -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th> Name</th>
                   
                    <th>Email</th>
                    <th>Department</th>
                    <th>Subjects Proposed</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP code to fetch and display teachers from the database -->
                <?php
                   // Requête SQL pour récupérer les utilisateurs ayant le rôle 'teacher'
$sql = "SELECT id, name, email, department, subjects_proposed FROM users WHERE role = 'teacher'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['department']}</td>
                <td>{$row['subjects_proposed']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No teachers found</td></tr>";
}



                    $conn->close();  // Ferme la connexion à la base de données
                ?>
            </tbody>
        </table>
    </div>

    <script src="/admin2_panel/assets/js/script.js"></script>
</body>
</html>
