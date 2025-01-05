<?php
session_start();
include_once "../config/dbconnect.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to the login page
    exit;
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Management</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
   
    <?php include "../studentHeader.php"; ?> <!-- Include header -->
    <?php include "../sidebar.php"; ?> <!-- Include sidebar -->

    <div class="container mt-5">
        <h2>Group Management</h2>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#createGroup" data-toggle="tab">Create a Group</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#sendInvitation" data-toggle="tab">Send an Invitation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#manageInvitations" data-toggle="tab">Manage Invitations</a>
            </li>
        </ul>

        <div class="tab-content mt-4">
            <!-- Section: Create a Group -->
            <div class="tab-pane fade show active" id="createGroup">
                <?php include "createGroup.php"; ?> <!-- Include the code to create a group -->
            </div>

            <!-- Section: Send an Invitation -->
            <div class="tab-pane fade" id="sendInvitation">
                <?php include "sendInvitation.php"; ?> <!-- Include the code to send an invitation -->
            </div>

            <!-- Section: Manage Invitations -->
            <div class="tab-pane fade" id="manageInvitations">
                <?php include "manageInvitations.php"; ?> <!-- Include the code to manage invitations -->
            </div>
        </div>
    </div>
    <script src="../assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
