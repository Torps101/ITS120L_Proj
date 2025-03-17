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
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #111827;
            margin: 0;
            padding: 0;
        }
        header {
            background: #111827;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
        }
        .subtitle {
            color: white;
            font-size: 14px;
        }
        .icons span {
            margin-left: 15px;
            cursor: pointer;
            font-size: 20px;
        }
        nav {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            background: #111827;
        }
        nav button {
            background: #22D3EE;
            border: none;
            padding: 10px 20px;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        nav input {
            padding: 8px;
            border: 1px solid #CBD5E1;
            border-radius: 5px;
            font-size: 16px;
        }
        main {
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .dashboard-container {
            background: #0EA5E9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 60%;
            max-width: 800px;
        }
        .student-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .coins {
            font-weight: bold;
            color: #FACC15;
        }
        .tasks {
            margin-top: 10px;
        }
        .tasks ul {
            list-style: none;
            padding: 0;
        }
        .tasks li {
            background: #111827;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color:white;
        }
        .task-coins {
            font-weight: bold;
            color: #FACC15;
        }

        h2{
            color: white;
        }
        h3{
            color: white;
        }
    </style>


</head>
<body>
    <header>
        <div class="logo">CoinQuest <span class="subtitle">Student's Dashboard</span></div>
        <div class="icons">
            <span class="bell">&#128276;</span>
            <span class="profile">&#128100;</span>
            <a href="logout.php" style="margin-right: 20px; color: #EF4444; text-decoration: none; font-weight: bold;">Logout</a>
        </div>
    </header>
    <nav>
        <button class="active">Tasks</button>
        <input type="text" placeholder="Search">
    </nav>
    <main>
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
    </main>
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