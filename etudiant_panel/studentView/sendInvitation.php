<?php

include_once "../config/dbconnect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the keys exist in $_POST before using them
    if (isset($_POST['receiver_id']) && isset($_POST['group_id'])) {
        $sender_id = $_SESSION['user_id'];
        $receiver_id = $_POST['receiver_id'];
        $group_id = $_POST['group_id'];

        // Check if the group belongs to the leader
        $check_leader_sql = "SELECT leader_id FROM student_groups WHERE group_id = ?";
        $stmt = $conn->prepare($check_leader_sql);
        $stmt->bind_param("i", $group_id);
        $stmt->execute();
        $group = $stmt->get_result()->fetch_assoc();

        if ($group && $group['leader_id'] == $sender_id) {
            // Add an invitation
            $invite_sql = "INSERT INTO invitations (group_id, sender_id, receiver_id, status) VALUES (?, ?, ?, 'pending')";
            $stmt = $conn->prepare($invite_sql);
            $stmt->bind_param("iii", $group_id, $sender_id, $receiver_id);
            $stmt->execute();

            echo "<script>alert('Invitation sent successfully.');</script>";
        } else {
            echo "<script>alert('Unauthorized action.');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invite a Student</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Send an Invitation</h2>
        <form method="POST">
            <div class="form-group">
                <label for="receiver_id">Student to Invite (ID):</label>
                <input type="number" name="receiver_id" id="receiver_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="group_id">Your Group (ID):</label>
                <input type="number" name="group_id" id="group_id" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Send Invitation</button>
        </form>
    </div>
</body>
</html>

