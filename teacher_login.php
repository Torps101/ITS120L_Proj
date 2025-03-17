<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Login</title>
    <style>
        body {
            background-color: #111827;
            color: #E0F2FE;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #0EA5E9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.5);
            width: 350px;
            text-align: center;
        }
        h2 {
            color: white;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
            background-color: #E0F2FE;
            color: #111827;
        }
        .login-btn {
            padding: 12px;
            background-color: #22D3EE;
            color: #111827;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-weight: bold;
            cursor: pointer;
        }
        .login-btn:hover {
            background-color: #0EA5E9;
        }
        .student-link {
            margin-top: 15px;
            display: block;
            color: white;
            text-decoration: underline;
            font-size: 0.9em;
        }
        .student-link:hover {
            color: #D1FAE5;
        }
    </style>
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
    </div>

</body>
</html>
