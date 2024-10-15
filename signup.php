<!-- signup.php -->
<?php
session_start();

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
  <title>Signup</title>
  <link rel="stylesheet" href="style/signup.css">
</head>
<body>
  <div class="container">
    <h2>Signup</h2>
    <form action="functions/register.php" method="post">
      <input placeholder="Username" type="text" name="username" required><br>
      <input placeholder="Password" type="password" name="password" required><br>
      <input placeholder="Confirm Password" type="password" name="confirm_password" required><br>
      <button type="submit">Register</button>
      <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>

    <button id="themeToggle" onclick="toggleTheme()" class="theme-toggle-btn">
        🌙 Dark Mode
      </button>
  </div>
  
  <script src="scripts/script.js"></script>
</body>
</html>
