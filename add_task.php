<?php
session_start();
require 'includes/db_connect.php'; // adjust path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $level = $_POST['level'] ?? '';
    $teacher_id = $_SESSION['teacher_id'];

    if (!empty($title) && !empty($level) && $teacher_id) {
        $stmt = $conn->prepare("INSERT INTO tasks (title, description, created_by_teacher_id, assigned_to_student_id) VALUES (?, ?, ?, NULL)");
        $stmt->bind_param("ssi", $title, $description, $teacher_id);

        if ($stmt->execute()) {
            echo "Task added successfully";
        } else {
            echo "Error adding task: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Missing required fields.";
    }
} else {
    echo "Invalid request.";
}
?>
