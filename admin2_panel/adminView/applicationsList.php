<?php
session_start();
include_once "../config/dbconnect.php"; // Connexion à la base de données
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications List</title>
    <link rel="stylesheet" href="/admin2_panel/assets/css/style.css">
    <script src="/admin2_panel/assets/js/script.js"></script>
</head>
<body>
    <?php
        include "../dashboard.php";
        include "../sidebar.php";  // Inclure le sidebar de l'admin
    ?>

    <div id="main-content" class="container py-4">
        <h2>List of Applications</h2>
        <!-- Table to display applications -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Project Title</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP code to fetch and display applications from the database -->
                <?php
                    // Connexion à la base de données
                    $conn = new mysqli('localhost', 'root', '', 'finaldatabase'); // Remplace par tes vrais identifiants
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Requête modifiée pour afficher les noms d'étudiants et titres de projets
                    $sql = "
                    SELECT 
                        a.id, 
                        IFNULL(u.name, 'No Name Available') AS student_name,  -- Afficher le name de l'utilisateur
                        a.project_id, 
                        a.application_status, 
                        IFNULL(p.title, 'No Project Title') AS project_title
                    FROM 
                        applications a
                    LEFT JOIN 
                        users u ON a.student_id = u.id AND u.role = 'etudiant'  -- Jointure avec users pour récupérer le nom
                    LEFT JOIN 
                        projects p ON a.project_id = p.project_id
                ";
                
                
                
                
                
                

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['student_name']}</td>
                                    <td>{$row['project_title']}</td>
                                    <td>{$row['application_status']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No applications found</td></tr>";
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="/admin2_panel/assets/js/script.js"></script>
</body>
</html>
