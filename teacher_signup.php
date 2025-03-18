<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Sign Up</title>
    <link rel="stylesheet" href="css/teacher_signup.css">
</head>
<body>

    <div class="signup-container">
        <h2>Teacher Sign Up</h2>
        <form action="teacher_signup_process.php" method="POST">
            <input type="text" name="fullname" placeholder="Full Name" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="school" placeholder="School Name" required>
            <input type="text" name="teacher_id" placeholder="Teacher ID" required>
            <button type="submit" class="signup-btn">Create Teacher Account</button>
        </form>
        <div class="links">
            <a href="teacher_login.php">Already a teacher?</a>
        </div>
    </div>

</body>
</html>
