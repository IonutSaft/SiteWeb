<?php
// Start session to access session variables
session_start();

// Check if user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    // User is logged in, redirect to welcome.php
    header("Location: welcome.php");
    exit;
} else {
    // User is not logged in, redirect to login.php
    header("Location: login.php");
    exit;
}
?>
