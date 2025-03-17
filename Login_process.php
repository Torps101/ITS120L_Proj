<?php
session_start();
include 'includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM students WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['student_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['fullname'] = $user['fullname']; // ✅ matches your database column
            header("Location: student_dashboard.php");
            exit();
        }   else {
            echo "<script>alert('Incorrect password'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Username not found'); window.location.href='login.php';</script>";
    }
}
?>
