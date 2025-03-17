<?php
session_start();
require_once 'includes/db_connect.php';

// Get and sanitize inputs
$username = trim($_POST['username']);
$password = $_POST['password'];

// Check for empty fields
if (empty($username) || empty($password)) {
    die("Both fields are required.");
}

// Look for the teacher in the database
$sql = "SELECT * FROM teachers WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $teacher = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $teacher['password'])) {
        // Set session
        $_SESSION['teacher_id'] = $teacher['id'];
        $_SESSION['teacher_name'] = $teacher['fullname'];

        // Redirect to dashboard
        header("Location: teacher_dashboard.php");
        exit();
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "No account found with that username.";
}
?>
