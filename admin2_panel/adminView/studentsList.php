<?php
session_start();
include_once "../config/dbconnect.php"; // Connexion à la base de données
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
    <link rel="stylesheet" href="/admin2_panel/assets/css/style.css">
    <script src="/admin2_panel/assets/js/script.js"></script>
</head>
<body>
    <?php
        include "../dashboard.php";  // Inclure le header de l'admin
        include "../sidebar.php";    // Inclure le sidebar de l'admin
    ?>

    <div id="main-content" class="container py-4">
        <h2>List of Students</h2>
        <!-- Table to display students -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP code to fetch and display students from the database -->
                <?php
                    // Connexion à la base de données avec les informations définies dans config.php
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Requête SQL pour récupérer les étudiants
                // Requête SQL pour récupérer les utilisateurs ayant le rôle 'student'
$sql = "SELECT id, name, email, status FROM users WHERE role = 'student'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['status']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No students found</td></tr>";
}



                    // Fermer la connexion à la base de données
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="/admin2_panel/assets/js/script.js"></script>
</body>
</html>

