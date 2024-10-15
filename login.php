<!-- login.php -->
<?php
session_start();

// Redirect to welcome page if user is already logged in
if (isset($_SESSION['username'])) {
  header("Location: welcome.php");
  exit();
}

// Check for and display error messages
if (isset($_SESSION['error'])) {
    echo "<p style='color: red;'>{$_SESSION['error']}</p>";
    unset($_SESSION['error']); // Clear the error message after displaying
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body> 
    <div class="container">
      <h2>Login</h2>
      <form action="functions/authenticate.php" method="post">
        <input placeholder="Username" type="text" name="username" required><br>
        <input placeholder="Password" type="password" name="password" required><br>
        <button type="submit">Login</button>
      </form>
      <p>Don't have an account? <a href="signup.php">Register here</a></p>
      <p><a href="change_password_request.php">Forgot password? Click here to reset.</a></p>
      <button id="themeToggle" onclick="toggleTheme()" class="theme-toggle-btn">
        🌙 Dark Mode
      </button>
    </div>

    <script src="scripts/script.js"></script>
</body>
</html>
