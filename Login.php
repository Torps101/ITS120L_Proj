<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/Login.css">
</head>
<body>

    <div class="login-container">
        <h2>Student Login</h2>
        <form action="login_process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="login-btn">Log In</button>
        </form>
        <div class="links">
            <a href="teacher_login.php">Are You A Teacher?</a>
            <a href="signup.php">Create A New Account?</a>
        </div>
    </div>

</body>
</html>
