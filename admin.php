<?php
require_once 'db.php';

// Only admin should access this page
// You can add session checks here for authentication

// Approve or reject the command
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'approve') {
        $sql = "UPDATE commands SET status = 'approved' WHERE id = $id";
    } elseif ($action == 'reject') {
        $sql = "DELETE FROM commands WHERE id = $id";
    }

    if (mysqli_query($conn, $sql)) {
        echo "Command $action successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch all pending commands
$sql = "SELECT * FROM commands WHERE status = 'pending'";
$result = mysqli_query($conn, $sql);
?>

<h2>Pending Git Commands</h2>
<table class="table">
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
                <a href="admin.php?action=approve&id=<?php echo $row['id']; ?>" class="btn btn-success">Approve</a>
                <a href="admin.php?action=reject&id=<?php echo $row['id']; ?>" class="btn btn-danger">Reject</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
