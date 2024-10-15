<?php
session_start();
require_once('db_connection.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM player WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if ($password === $user['password']) {
        // Login successful
        $_SESSION['username'] = $username; // Store username in session
        header("Location: ../welcome.php");
        exit();
    } else {
        echo "<script>";
        echo "alert('Invalid password. Please try again.');";
        echo "window.location.href = '../login.php';";
        echo "</script>";
        exit();
    }
} else {
    echo "<script>";
    echo "alert('Username not found. Please try again.');";
    echo "window.location.href = '../login.php';";
    echo "</script>";
    exit();
}

$conn->close();
?>
