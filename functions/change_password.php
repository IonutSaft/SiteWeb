<?php
session_start();
require_once('db_connection.php');

$username = $_POST['username'];

// Check if username exists in the database
$sql_check_username = "SELECT * FROM player WHERE username = '$username'";
$result_check_username = $conn->query($sql_check_username);

if ($result_check_username->num_rows > 0) {
    // Username exists, allow password change
    $_SESSION['username_for_password_change'] = $username; // Store username in session
    header("Location: ../set_new_password.php");
    exit();
} else {
    // Username does not exist
    echo "<script>";
    echo "alert('Username not found. Please try again.');";
    echo "window.location.href = '../change_password_request.php';";
    echo "</script>";
    exit();
}
?>
