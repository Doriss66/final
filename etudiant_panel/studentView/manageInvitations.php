<?php
include_once "../config/dbconnect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'invitation_id' exists before using it
    if (isset($_POST['invitation_id']) && isset($_POST['action'])) {
        $invitation_id = $_POST['invitation_id'];
        $action = $_POST['action']; // 'accept' or 'decline'

        if ($action === 'accept') {
            // Accept the invitation
            $accept_sql = "UPDATE invitations SET status = 'accepted' WHERE invitation_id = ?";
            $stmt = $conn->prepare($accept_sql);
            $stmt->bind_param("i", $invitation_id);
            $stmt->execute();

            echo "<script>alert('Invitation accepted.');</script>";
        } elseif ($action === 'decline') {
            // Decline the invitation
            $decline_sql = "UPDATE invitations SET status = 'declined' WHERE invitation_id = ?";
            $stmt = $conn->prepare($decline_sql);
            $stmt->bind_param("i", $invitation_id);
            $stmt->execute();

            echo "<script>alert('Invitation declined.');</script>";
        }
    }
}

// Fetch the invitations
$sql = "SELECT * FROM invitations WHERE receiver_id = ? AND status = 'pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$invitations = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Invitations</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Received Invitations</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Invitation ID</th>
                    <th>Group</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $invitations->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['invitation_id'] ?></td>
                        <td><?= $row['group_id'] ?></td>
                        <td>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="invitation_id" value="<?= $row['invitation_id'] ?>">
                                <button type="submit" name="action" value="accept" class="btn btn-success">Accept</button>
                            </form>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="invitation_id" value="<?= $row['invitation_id'] ?>">
                                <button type="submit" name="action" value="decline" class="btn btn-danger">Decline</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>


