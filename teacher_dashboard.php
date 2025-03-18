<?php
session_start();
include 'includes/db_connect.php';

if (!isset($_SESSION['teacher_id'])) {
    header("Location: teacher_login.php");
    exit();
}
$beginner_students = mysqli_query($conn, "SELECT * FROM students WHERE category='Beginner'");
$intermediate_students = mysqli_query($conn, "SELECT * FROM students WHERE category='Intermediate'");
$experienced_students = mysqli_query($conn, "SELECT * FROM students WHERE category='Experienced'");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
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
            color:rgb(255, 255, 255);
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
        }
        .container {
            display: flex;
            justify-content: space-between;
        }
        .category {
            width: 30%;
            background: #22D3EE;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .category h3 {
            text-align: center;
            cursor: pointer;
            background: #0EA5E9;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
        .student-list {
            display: none;
            margin-top: 10px;
        }
        .student-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .student-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            background: #22D3EE;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .task-coins {
            font-weight: bold;
            color: #FACC15;
        }
        .add-task, .add-task-level {
            background: #22D3EE;
            border: none;
            padding: 8px 12px;
            color: white;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
            display: block;
            width: 100%;
            text-align: center;
        }
        h2 {
  color: white;
}
    </style>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const categories = document.querySelectorAll(".category h3");

    categories.forEach(header => {
        header.addEventListener("click", function () {
            // Close all other dropdowns
            document.querySelectorAll(".student-list").forEach(list => {
                if (list !== this.nextElementSibling) {
                    list.style.display = "none"; // Hide others
                }
            });

            // Toggle only the clicked section
            const currentList = this.nextElementSibling;
            currentList.style.display = (currentList.style.display === "block") ? "none" : "block";
        });
    });

    // Add Task button functionality for each level
    document.querySelectorAll(".add-task-level").forEach(button => {
        button.addEventListener("click", function () {
            const level = this.dataset.level;
            const studentList = document.querySelector(`#${level} .student-card .tasks ul`);

            if (!studentList) {
                alert("No students available in this category.");
                return;
            }

            const taskName = prompt("Enter the task name:");
            const taskDesc = prompt("Enter the task description (optional):");

            if (taskName) {
                fetch('add_task.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `title=${encodeURIComponent(taskName)}&description=${encodeURIComponent(taskDesc)}&level=${level}`
                })
                .then(res => res.text())
                .then(data => {
                    alert(data);
                })
                .catch(err => {
                    console.error(err);
                    alert("Error adding task");
                });
            }


        });
    });
});

    </script>
</head>
<body>
    <header>
        <div class="logo">CoinQuest <span class="subtitle">Teacher's Dashboard</span></div>
        <div class="icons">
    <span class="bell">&#128276;</span>
    <span class="profile">&#128100;</span>
    <a href="teacher_logout.php" style="margin-left: 20px; color: #EF4444; text-decoration: none; font-weight: bold;">Logout</a>
</div>

    </header>
    <nav>
        <button class="active">Students</button>
        <input type="text" placeholder="Search">
    </nav>
    <main>
        <h2>My Students</h2>
        <div class="container">
            <div class="category">
                <h3>Beginner</h3>
                <!-- BEGINNER -->
                <div class="student-list" id="beginner">
                    <button class="add-task-level" data-level="beginner">Add Task for Beginner Level Students</button>

                    <?php while($student = mysqli_fetch_assoc($beginner_students)) { ?>
                        <div class="student-card">
                            <div class="student-info">
                                <h3><?php echo htmlspecialchars($student['fullname']); ?></h3>
                                <span class="coins"><?php echo $student['coin_balance']; ?> &#x1F4B0;</span>
                            </div>
                            <div class="tasks">
                                <ul></ul> <!-- You’ll dynamically load tasks here later -->
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
            <div class="category">
                <h3>Intermediate</h3>
                <!-- Intermediate -->
                <div class="student-list" id="Intermediate">
                    <button class="add-task-level" data-level="Intermediate">Add Task for Intermediate Level Students</button>

                    <?php while($student = mysqli_fetch_assoc($intermediate_students)) { ?>
                        <div class="student-card">
                            <div class="student-info">
                                <h3><?php echo htmlspecialchars($student['fullname']); ?></h3>
                                <span class="coins"><?php echo $student['coin_balance']; ?> &#x1F4B0;</span>
                            </div>
                            <div class="tasks">
                                <ul></ul> <!-- You’ll dynamically load tasks here later -->
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
            <div class="category">
                <h3>Experienced</h3>
                <!-- Experienced -->
                <div class="student-list" id="Experienced">
                    <button class="add-task-level" data-level="Experienced">Add Task for Experienced Level Students</button>

                    <?php while($student = mysqli_fetch_assoc($experienced_students)) { ?>
                        <div class="student-card">
                            <div class="student-info">
                                <h3><?php echo htmlspecialchars($student['fullname']); ?></h3>
                                <span class="coins"><?php echo $student['coin_balance']; ?> &#x1F4B0;</span>
                            </div>
                            <div class="tasks">
                                <ul></ul> <!-- You’ll dynamically load tasks here later -->
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </main>
</body>
</html>
