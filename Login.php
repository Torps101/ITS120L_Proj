<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #111827 ; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #0EA5E9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(14, 165, 233, 0.5);
            width: 350px;
            text-align: center;
            position: relative;
        }
        h2 {
            color: white;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #E0F2FE; /* Soft Cyan */
            color: #111827; /* Dark Navy for contrast */
            font-size: 16px;
        }
        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #22D3EE; /* Glowing Cyan */
            color: #111827; /* Dark Navy */
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            margin-top: 15px; /* Added margin to prevent merging */
        }
        .login-btn:hover {
            background-color: #22D3EE ;
            transform: scale(1.05);
        }
        .links {
            margin-top: 10px;
            text-align:left;
        }
        .links a {
            display: block;
            color: white;
            text-decoration: none;
            font-size: 14px;
            margin-top: 5px;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
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
