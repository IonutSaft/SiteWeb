<!-- set_new_password.php -->

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
    <title>Set New Password</title>
    <link rel="stylesheet" href="style/setpass.css">
</head>
<body>
  <div class="container">
    <h2>Set New Password</h2>
      <form action="functions/update_password.php" method="post">
      New Password:<br> <input placeholder="New Password" type="password" name="new_password" required><br>
      Confirm New Password: <input placeholder="Confirm New Password" type="password" name="confirm_new_password" required><br>
      <button type="submit">Confirm</button>        
      <button type="button" onclick="cancel()">Cancel</button>
    </form>
    <button id="themeToggle" onclick="toggleTheme()" class="theme-toggle-btn">
        🌙 Dark Mode
      </button>
  </div>
  <script src="scripts/script.js"></script>
</body>
</html>
