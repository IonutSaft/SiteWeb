<!-- change_password_request.php -->

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
    <title>Change Password Request</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
    <div class="container">
    <h2>Change Password Request</h2>
      <form action="functions/change_password.php" method="post">
        Enter your Username:<br> <input placeholder="Username" type="text" name="username" required><br>
        <button type="submit">Submit</button>
      </form>
      <a href="login.php"><button class="cancel-button">Cancel</button></a>
      <button id="themeToggle" onclick="toggleTheme()" class="theme-toggle-btn">
        🌙 Dark Mode
      </button>
    </div>
    <script src="scripts/script.js"></script>
</body>
</html>
