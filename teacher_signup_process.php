<?php
session_start();
require_once 'includes/db_connect.php';

// Sanitize inputs
$fullname   = trim($_POST['fullname']);
$username   = trim($_POST['username']);
$email      = trim($_POST['email']);
$password   = $_POST['password'];
$school     = trim($_POST['school']);
$teacher_id = trim($_POST['teacher_id']);

// Check for empty fields (shouldn't happen with 'required', but extra safety)
if (empty($fullname) || empty($username) || empty($email) || empty($password) || empty($school) || empty($teacher_id)) {
    die("All fields are required.");
}

// Check if username or email or teacher_id already exists
$sql = "SELECT * FROM teachers WHERE username=? OR email=? OR teacher_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $email, $teacher_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Username, email, or teacher ID already in use.";
    exit();
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert into database
$insert_sql = "INSERT INTO teachers (fullname, username, email, password, school, teacher_id)
               VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insert_sql);
$stmt->bind_param("ssssss", $fullname, $username, $email, $hashed_password, $school, $teacher_id);

if ($stmt->execute()) {
    // Redirect to login or success page
    header("Location: teacher_login.php?signup=success");
    exit();
} else {
    echo "Error: " . $stmt->error;
}
?>
