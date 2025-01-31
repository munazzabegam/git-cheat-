<?php
// db.php connection
require_once 'db.php';

// Fetch all approved commands from the database
$sql = "SELECT * FROM commands WHERE status = 'approved'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Git Cheat Sheet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> <!-- Link to external stylesheet -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container">
    <h2 class="text-center">Git Cheat Sheet</h2>

    <!-- Displaying approved Git commands -->
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($row['description']); ?></h5>
            <pre class="command-text">
                <?php
                    // Convert < > content to editable spans, removing < > visually
                    $command = htmlspecialchars($row['command']);
                    $command = preg_replace_callback('/&lt;(.*?)&gt;/', function ($matches) {
                        return '<span class="editable" contenteditable="true">' . htmlspecialchars($matches[1]) . '</span>';
                    }, $command);
                    echo $command;
                ?>
            </pre>
            <button class="copy-btn">Copy</button>
        </div>
    </div>
    <?php endwhile; ?>

    <!-- Link to add a new command -->
    <div class="btn-add">
        <a href="add_command.php" class="btn btn-primary">Add Your Own Command</a>
    </div>
</div>

<script src="script.js"></script> <!-- Link to external JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
