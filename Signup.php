<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #111827; /* Dark Navy */
            color: #E0F2FE; /* Soft Cyan */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .signup-container {
            background-color: #0EA5E9; /* Neon Blue */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(14, 165, 233, 0.5);
            width: 350px;
            text-align: center;
            position: relative;
        }
        h2 {
            color: white; /* Bright Gold */
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
        input::placeholder {
            color: #666;
        }
        .signup-btn {
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
        .signup-btn:hover {
            background-color: #0EA5E9; /* Neon Blue */
            transform: scale(1.05);
        }
        .links {
            text-align: left;
            margin-top: 20px; /* Added space below the button */
        }
        .links a {
            color: white; /* Bright Gold */
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            display: block;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="signup-container">
        <h2>Sign Up</h2>
        <form action="signup_process.php" method="POST">
    <input type="text" name="fullname" placeholder="Full Name" required>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>

    <!-- Add Category Dropdown -->
    <label for="category" style="color: white;">Select Experience Level:</label>
    <select name="category" id="category" required>
        <option value="Beginner">Beginner</option>
        <option value="Intermediate">Intermediate</option>
        <option value="Experienced">Experienced</option>
    </select>

    <button type="submit">Sign Up</button>
</form>


        <div class="links">
            <a href="login.php">Already have an account?</a>
        </div>
    </div>

</body>
</html>
