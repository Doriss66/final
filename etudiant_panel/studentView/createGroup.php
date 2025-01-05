<?php

include_once "../config/dbconnect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];

    // Check if the student already has a group
    $check_sql = "SELECT * FROM student_groups WHERE leader_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $existing_group = $stmt->get_result()->fetch_assoc();

    if ($existing_group) {
        echo "<script>alert('You have already created a group.');</script>";
    } else {
        // Create a group
        $create_group_sql = "INSERT INTO student_groups (leader_id, max_members) VALUES (?, 3)";
        $stmt = $conn->prepare($create_group_sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $group_id = $stmt->insert_id;

        // Add the leader as a member
        $add_member_sql = "INSERT INTO group_members (group_id, student_id, role) VALUES (?, ?, 'Leader')";
        $stmt = $conn->prepare($add_member_sql);
        $stmt->bind_param("ii", $group_id, $user_id);
        $stmt->execute();

        echo "<script>alert('Group created successfully!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a Group</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Create a Group</h2>
        <form method="POST">
            <button type="submit" class="btn btn-primary">Create My Group</button>
        </form>
    </div>
</body>
</html>
