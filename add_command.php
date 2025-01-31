<?php
// db.php connection
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $command = mysqli_real_escape_string($conn, $_POST['command']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Insert new command with status 'pending'
    $sql = "INSERT INTO commands (command, description, status) VALUES ('$command', '$description', 'pending')";
    if (mysqli_query($conn, $sql)) {
        echo "Command added successfully, awaiting admin approval.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form method="POST" action="add_command.php">
    <div class="form-group">
        <label for="command">Git Command:</label>
        <input type="text" class="form-control" id="command" name="command" required>
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit Command</button>
</form>
