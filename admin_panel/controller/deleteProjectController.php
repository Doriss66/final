<?php
include_once "../config/dbconnect.php";

if (isset($_POST['project_id'])) {
    $project_id = intval($_POST['project_id']); // Assurez-vous que l'ID est un entier

    if ($project_id > 0) {
        $query = "DELETE FROM projects WHERE project_id = $project_id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Project deleted successfully.";
        } else {
            echo "Failed to delete project: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid project ID.";
    }
} else {
    echo "No project ID provided.";
}
?>
<form method="POST" action="http://localhost/admin_panel/controller/deleteProjectController.php">
    <label for="project_id">Project ID:</label>
    <input type="number" id="project_id" name="project_id" value="1"> <!-- Changez '1' par un ID valide -->
    <button type="submit">Test Delete Project</button>
</form>


