<?php
session_start();
include('includes/db_connect.php');

$student_id = $_SESSION['student_id'];

// ✅ Fetch student info (fullname and coin_balance) from the students table
$studentStmt = $conn->prepare("SELECT fullname, coin_balance FROM students WHERE id = ?");
$studentStmt->bind_param("i", $student_id);
$studentStmt->execute();
$studentResult = $studentStmt->get_result();

if ($studentRow = $studentResult->fetch_assoc()) {
    $fullname = $studentRow['fullname'];
    $coin_balance = $studentRow['coin_balance'];
} else {
    echo "Student not found.";
    exit;
}

// ✅ Fetch tasks assigned specifically to this student or tasks assigned to all
$sql = "SELECT * FROM tasks WHERE assigned_to_student_id IS NULL OR assigned_to_student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

// ✅ Fetch which tasks this student has completed
$completedStmt = $conn->prepare("SELECT task_id FROM task_completions WHERE student_id = ?");
$completedStmt->bind_param("i", $student_id);
$completedStmt->execute();
$completedResult = $completedStmt->get_result();

$completedTasks = [];
while ($row = $completedResult->fetch_assoc()) {
    $completedTasks[] = $row['task_id'];
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="css/student_dashboard.css">

        
</head>
<body>

    <!-- TOP CONTAINER (Header + Nav/Controls) -->
    <div class="top-container">
        <div class="top-nav">
            <div class="logo">CoinQuest <span class="subtitle">Student's Dashboard</span></div>
            <div class="icons">
                <span class="bell">&#128276;</span>
                <span class="profile">&#128100;</span>
                <a href="logout.php" style="color: #EF4444; text-decoration: none; font-weight: bold;">Logout</a>
            </div>
        </div>
        <div class="nav-controls">
            <button class="active">Tasks</button>
            <input type="text" placeholder="Search">
        </div>
    </div>

    <!-- MAIN CONTAINER (Content Area) -->
    <div class="main-container">
        <div class="dashboard-container">
            <div class="student-info">
                <h2>Welcome, <?php echo htmlspecialchars($fullname); ?>!</h2>
                <span class="coins"><?php echo $coin_balance; ?> &#x1F4B0;</span>
            </div>

            <h3>My Tasks</h3>
            <div class="tasks">
                <?php while($task = $result->fetch_assoc()): ?>
                    <?php if (!in_array($task['id'], $completedTasks)): ?>
                        <li>
                            <div>
                                <strong><?php echo htmlspecialchars($task['title']); ?></strong><br>
                                <?php echo nl2br(htmlspecialchars($task['description'])); ?>
                            </div>
                            <button onclick="markAsDone(<?php echo $task['id']; ?>, this)">Mark as Done</button>
                        </li>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <script>
function markAsDone(taskId, btn) {
    fetch('mark_done.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'task_id=' + taskId
    })
    .then(res => res.text())
    .then(data => {
        alert(data);
        btn.disabled = true;
        btn.innerText = "Completed ✅";
    });
}
</script>

</body>
</html>