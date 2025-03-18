<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Login</title>
    <link rel="stylesheet" href="css/teacher_login.css">
</head>
<body>

    <div class="login-container">
        <h2>Teacher Login</h2>
        <?php if (isset($_GET['signup']) && $_GET['signup'] === 'success'): ?>
            <p style="color: #D1FAE5; font-weight: bold;">Account created successfully! Please log in.</p>
        <?php endif; ?>

        <form action="teacher_login_process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Log In</button>
        </form>

        <p style="margin-top: 15px;">
            <a href="login.php" style="color: #fff; text-decoration: underline;">Not a teacher? Log in as student</a>
        </p>

        <!-- Link to create a new teacher account -->
        <p style="margin-top: 10px;">
            <a href="teacher_signup.php" style="color: #fff; text-decoration: underline;">New teacher? Create an account</a>
        </p>
    </div>

</body>
</html>

