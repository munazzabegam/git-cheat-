<?php
require_once 'db.php';

$query = "SELECT COUNT(*) AS count FROM admins WHERE username='admin'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($row['count'] == 0) {
    $password = password_hash('admin123', PASSWORD_BCRYPT);
    $sql = "INSERT INTO admins (username, password) VALUES ('admin', '$password')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Admin account created successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Admin account already exists!";
}
?>
