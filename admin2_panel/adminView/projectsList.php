<?php
session_start();
include_once "../config/dbconnect.php"; // Connexion à la base de données
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects List</title>
    <link rel="stylesheet" href="/admin2_panel/assets/css/style.css">
    <script src="/admin2_panel/assets/js/script.js"></script>
</head>
<body>
    <?php
        include "../dashboard.php";
        include "../sidebar.php";  // Inclure le sidebar de l'admin
    ?>

    <div id="main-content" class="container py-4">
        <h2>List of Projects</h2>
        <!-- Table to display projects -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP code to fetch and display projects from the database -->
                <?php
                    // Connexion à la base de données
                    $conn = new mysqli('localhost', 'root', '', 'finaldatabase'); // Remplace avec tes vrais identifiants
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM projects";  // Exemple de requête pour récupérer les projets
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['project_id']}</td>
                                    <td>{$row['title']}</td>
                                    <td>{$row['description']}</td>
                                    
                                    <td>{$row['status']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No projects found</td></tr>";
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="/admin2_panel/assets/js/script.js"></script>
</body>
</html>

