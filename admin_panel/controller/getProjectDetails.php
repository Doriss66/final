<?php
include_once "../config/dbconnect.php";

if (isset($_POST['project_id'])) {
    $project_id = intval($_POST['project_id']); // Assurez-vous que l'ID est un entier

    $query = "SELECT * FROM projects WHERE project_id = $project_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $project = mysqli_fetch_assoc($result);
        echo json_encode($project); // Retourne les détails du projet au format JSON
    } else {
        echo json_encode(["error" => "Project not found"]);
    }
} else {
    echo json_encode(["error" => "No project ID provided"]);
}
?>
<form method="POST" action="http://localhost/admin_panel/controller/getProjectDetails.php">
    <label for="project_id">Project ID:</label>
    <input type="number" id="project_id" name="project_id" value="1"> <!-- Changez '1' par un ID valide -->
    <button type="submit">Test Get Project Details</button>
</form>
