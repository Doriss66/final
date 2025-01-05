<?php
include_once "../config/dbconnect.php";

if (!isset($_POST['project_id'], $_POST['p_title'], $_POST['p_desc'], $_POST['p_keywords'], $_POST['p_tech'], $_POST['p_status'])) {
    echo "Missing parameters.";
    exit;
}

$project_id = intval($_POST['project_id']);
$title = $_POST['p_title'];
$description = $_POST['p_desc'];
$keywords = $_POST['p_keywords'];
$technologies = $_POST['p_tech'];
$status = $_POST['p_status'];

$query = "UPDATE projects SET titre = ?, description = ?, mots_cles = ?, technologies = ?, statut = ? WHERE project_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssssi", $title, $description, $keywords, $technologies, $status, $project_id);

if ($stmt->execute()) {
    echo "true";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
?>

