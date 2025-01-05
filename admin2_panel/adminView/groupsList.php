<?php
session_start();
include_once "../config/dbconnect.php"; // Connexion à la base de données
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groups List</title>
    <link rel="stylesheet" href="/admin2_panel/assets/css/style.css">
    <script src="/admin2_panel/assets/js/script.js"></script>
</head>
<body>
    <?php
        include "../dashboard.php";
        include "../sidebar.php";  // Inclure le sidebar de l'admin
    ?>

    <div id="main-content" class="container py-4">
        <h2>List of Student Groups</h2>
        <!-- Table to display groups -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Group ID</th>
                    <th>Leader Name</th>
                    <th>Members Count</th>
                    <th>Max Members</th>
                    <th>Created At</th>
                    <th>Group Members</th> <!-- Nouvelle colonne -->
                </tr>
            </thead>
            <tbody>
                <!-- PHP code to fetch and display groups from the database -->
                <?php
                    // Connexion à la base de données
                    $conn = new mysqli('localhost', 'root', '', 'finaldatabase'); // Remplace par tes vrais identifiants
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Requête modifiée avec jointures pour récupérer les membres du groupe
                    $sql = "
                    SELECT sg.group_id, 
                           IFNULL(u.name, 'No Leader') AS leader_name, 
                           sg.members_count, 
                           sg.max_members, 
                           sg.created_at,
                           GROUP_CONCAT(u2.name SEPARATOR ', ') AS group_members
                    FROM student_groups sg
                    LEFT JOIN users u ON sg.leader_id = u.id AND u.role = 'student'
                    LEFT JOIN group_members gm ON sg.group_id = gm.group_id
                    LEFT JOIN users u2 ON gm.student_id = u2.id AND u2.role = 'student'
                    GROUP BY sg.group_id;
                ";
                

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['group_id']}</td>
                                    <td>{$row['leader_name']}</td>
                                    <td>{$row['members_count']}</td>
                                    <td>{$row['max_members']}</td>
                                    <td>{$row['created_at']}</td>
                                    <td>{$row['group_members']}</td> <!-- Affichage des membres du groupe -->
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No groups found</td></tr>";
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="/admin2_panel/assets/js/script.js"></script>
</body>
</html>
