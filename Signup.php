<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/Signup.css">
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
