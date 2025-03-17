<?php
session_start();
include('includes/db_connect.php');

if (!isset($_SESSION['student_id'])) {
    echo "Unauthorized";
    exit;
}

$student_id = $_SESSION['student_id'];
$task_id = isset($_POST['task_id']) ? intval($_POST['task_id']) : 0;

// 1. Check if task already marked as done
$checkStmt = $conn->prepare("SELECT id FROM task_completions WHERE student_id = ? AND task_id = ?");
$checkStmt->bind_param("ii", $student_id, $task_id);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    echo "Task already marked as done.";
    exit;
}

// 2. Mark task as completed
$insertStmt = $conn->prepare("INSERT INTO task_completions (student_id, task_id, completed_at) VALUES (?, ?, NOW())");
$insertStmt->bind_param("ii", $student_id, $task_id);

if ($insertStmt->execute()) {
    // 3. Reward student with coins (e.g. 10 coins per task)
    $reward_coins = 10;

    $updateStmt = $conn->prepare("UPDATE students SET coin_balance = coin_balance + ? WHERE id = ?");
    $updateStmt->bind_param("ii", $reward_coins, $student_id);
    $updateStmt->execute();

    echo "Task completed! 🎉 You earned {$reward_coins} coins.";
} else {
    echo "Failed to mark task as done.";
}
?>
