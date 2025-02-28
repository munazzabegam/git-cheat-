<?php
session_start();
require_once 'db.php';

// Redirect if not logged in or not admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Handling approval & rejection of commands
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']); // Prevent SQL injection
    $action = $_GET['action'];

    if ($action === 'approve') {
        $sql = "UPDATE commands SET status = 'approved' WHERE id = $id";
    } elseif ($action === 'reject') {
        $sql = "DELETE FROM commands WHERE id = $id";
    }

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Command $action successfully.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($conn);
        $_SESSION['message_type'] = "danger";
    }
    header("Location: admin.php");
    exit();
}

// Fetch pending commands
$sql = "SELECT * FROM commands WHERE status = 'pending'";
$result = mysqli_query($conn, $sql);

// Fetch pending commands2
$sql2 = "SELECT * FROM commands2 WHERE status = 'pending'";
$result2 = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
        <h2 class="text-center">Admin Panel</h2>
        <a href="logout.php" class="btn btn-danger logout-btn">Logout</a>

        <!-- Success/Error Message -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['message_type']; ?>">
                <?php echo $_SESSION['message']; unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
            </div>
        <?php endif; ?>

        <h3>Pending Git Commands</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Command</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['command']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <a href="admin.php?action=approve&id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Approve</a>
                        <a href="admin.php?action=reject&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Reject</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3>Pending Git Commands 2</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Command</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result2)): ?>
                <tr>
                    <td><?php echo $row['command']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <a href="admin.php?action=approve&id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Approve</a>
                        <a href="admin.php?action=reject&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Reject</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
