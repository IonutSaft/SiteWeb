<?php
  session_start();  
  require_once('db_connection.php');


  // Check if user is logged in
  if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
  }

  // Handle profile picture upload
  if (isset($_POST['upload_profile'])) {
    $uploadDir = '../profile_picture/';
    $showDir = 'profile_picture/';
    
    // Check if file was uploaded without errors
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
      $tempFile = $_FILES['profile_picture']['tmp_name'];
      $fileName = $_FILES['profile_picture']['name'];
      $targetFile = $uploadDir . $_SESSION['username'] . '_' . $_FILES['profile_picture']['name'];
      $showTargetFile = $showDir . $_SESSION['username'] . '_' . $_FILES['profile_picture']['name'];
      
      // Move uploaded file to target location
      if (move_uploaded_file($tempFile, $targetFile)) {
        $username = $_SESSION['username'];
        $profilePicturePath = $targetFile;
        
        $stmt = $pdo->prepare("UPDATE player SET profile_picture_path = :profile_picture WHERE username = :username");  
        $stmt->bindParam(':profile_picture', $showTargetFile);
        $stmt->bindParam(':username', $username);
        
        if ($stmt->execute()) {
          $_SESSION['profile_picture'] = $showTargetFile;
          header("Location: ../profile.php"); // Redirect to refresh profile page
          exit;
        } else {
          echo "<script>";
          echo "alert('Failed to upload profile picture.');";
          echo "window.location.href = '../profile.php';";
          echo "</script>";
        }
      } else {
        echo "<script>";
        echo "alert('Failed to upload profile picture.');";
        echo "window.location.href = '../profile.php';";
        echo "</script>";
      }
    } else {
      echo "<script>";
      echo "alert('Error uploading profile picture.');";
      echo "window.location.href = '../profile.php';";
      echo "</script>";
    }
  }
  header("Location: ../profile.php");
  exit;
  
?>