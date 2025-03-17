<?php
include 'includes/db_connect.php'; // adjust path if needed

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$category = $_POST['category'];

// Insert into students table (add the category column here)
$sql = "INSERT INTO students (fullname, username, password, category) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $fullname, $username, $password, $category);

if ($stmt->execute()) {
    header("Location: login.php?signup=success");
    exit();
} else {
    echo "Error: " . $stmt->error;
}
?>
