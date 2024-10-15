<?php
  session_start();
  require_once('db_connection.php');

  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Check if username already exists
  $sql_check_username = "SELECT * FROM player WHERE username = '$username'";
  $result_check_username = $conn->query($sql_check_username);

  if ($result_check_username->num_rows > 0) {
    echo "<script>";
    echo "alert('Username already exists. Please choose a different username.');";
    echo "window.location.href = '../signup.php';";
    echo "</script>";
    exit();
  }

  // Validate password (only letters and numbers allowed)
  if (!preg_match("/^[a-zA-Z0-9]+$/", $password)) {
    echo "<script>";
    echo "alert('Password can only contain letters and numbers.');";
    echo "window.location.href = '../signup.php';";
    echo "</script>";
    exit();
  }

  if ($password !== $confirm_password) {
    echo "<script>";
    echo "alert('Passwords do not match.');";
    echo "window.location.href = '../signup.php';";
    echo "</script>";
    exit();
  }

  // Insert user into database
  $sql = "INSERT INTO player (username, password) VALUES ('$username', '$password')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>";
    echo "alert('Account created successfully. Please log in.');";
    echo "window.location.href = '../login.php';";
    echo "</script>";
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
?>
