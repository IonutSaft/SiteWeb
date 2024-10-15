<?php
session_start();
require_once('db_connection.php');

if (isset($_SESSION['username_for_password_change'])) {
    $username = $_SESSION['username_for_password_change'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    if ($new_password !== $confirm_new_password) {
      echo "<script>";
      echo "alert('Passwords do not match.');";
      echo "window.location.href = '../set_new_password.php';";
      echo "</script>";
      exit();
    }

    // Update password in the database
    $sql_update_password = "UPDATE player SET password = '$new_password' WHERE username = '$username'";
    if ($conn->query($sql_update_password) === TRUE) {
      echo "<script>";
      echo "alert('Password updated successfully.');";
      echo "window.location.href = '../login.php';";
      echo "</script>";
        exit();
    } else {
        echo "Error updating password: " . $conn->error;
    }
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../change_password_request.php");
    exit();
}
?>
