<?php
session_start();
require 'includes/db_connect.php'; // Adjust path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $category = $_POST['level'] ?? '';  // Get the selected category (Beginner, Intermediate, Experienced)
    $teacher_id = $_SESSION['teacher_id'];

    if (!empty($title) && !empty($category) && $teacher_id) {
        // Fetch student IDs based on selected category
        $student_query = "SELECT id FROM students WHERE category = ?";
        $stmt_students = $conn->prepare($student_query);
        $stmt_students->bind_param("s", $category);
        $stmt_students->execute();
        $result = $stmt_students->get_result();

        if ($result->num_rows > 0) {
            // Prepare the INSERT statement for tasks
            $stmt_task = $conn->prepare("INSERT INTO tasks (title, description, created_by_teacher_id, assigned_to_student_id) VALUES (?, ?, ?, ?)");
            $stmt_task->bind_param("ssii", $title, $description, $teacher_id, $student_id);

            // Loop through all student IDs and assign the task
            while ($row = $result->fetch_assoc()) {
                $student_id = $row['id'];

                if ($stmt_task->execute()) {
                    echo "Task assigned to student ID: $student_id<br>";
                } else {
                    echo "Error assigning task to student ID: $student_id - " . $stmt_task->error . "<br>";
                }
            }

            $stmt_task->close();
        } else {
            echo "No students found in the '$category' category.";
        }

        $stmt_students->close();
    } else {
        echo "Missing required fields.";
    }
} else {
    echo "Invalid request.";
}
?>