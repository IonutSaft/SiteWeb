<?php
session_start();
require_once('functions/db_connection.php');

// Check for and display error messages
if (isset($_SESSION['error'])) {
    echo "<p style='color: red;'>{$_SESSION['error']}</p>";
    unset($_SESSION['error']); // Clear the error message after displaying
}

$username = $_SESSION['username'];
$stmt = $pdo->prepare("SELECT profile_picture_path FROM player WHERE username = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Set profile picture path in session if found in database
if ($user && isset($user['profile_picture_path'])) {
  $_SESSION['profile_picture'] = $user['profile_picture_path'];
} else {
  // If no custom profile picture is found, use default profile picture
  $_SESSION['profile_picture'] = 'images/default_pfp.jpg';
}

if (isset($_POST['logout'])) {
  // Unset all session variables
  session_unset();
  // Destroy the session
  session_destroy();
  // Redirect to login page
  header("Location: login.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/profile.css">
  </head>
    <body>
    <header class="bg-dark text-light py-3 d-flex align-items-center">
      <div class="title" onclick="goHome()">AnimeQuizGame</div>
      <div class="d-flex align-items-center">
        <div class="header-btn me-3" data-bs-toggle="tooltip" data-bs-placement="bottom"
          data-bs-title="Click here if you need more information about how the website works or need help.">
          <a href="info.html" class="btn text-light btn-sm" role="button">Help</a>
        </div>
        <form action="" method="post">
            <button class="logout-btn btn btn-danger btn-" type="submit" name="logout">Logout</button>
        </form>
      </div>
    </header>

    <div class="container mt-5">
      <a href="welcome.php" class="btn btn-dark btn-sm mb-3">Back</a>

      <h1 class="mb-4">User Profile</h1>
      <?php
        // Display error message if set
        if (isset($_SESSION['error'])) {
        echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
        unset($_SESSION['error']); // Clear the error message
        }
      ?>
      <p>Looking good today, <?php echo $_SESSION['username']; ?>!</p>

      <div class="profile-picture mb-4">
        <?php
          // Display profile picture from session variable
          echo '<img src="' . $_SESSION['profile_picture'] . '" alt="Profile Picture" class="img-fluid rounded-circle">';
        ?>
      </div>
      <!-- Form to Upload Profile Picture -->
      <form action="functions/profile_backend.php" method="post" enctype="multipart/form-data" class="mb-4">
        <div class="mb-3" style="margin:auto; width:50%">
          <label for="profilePicture" class="form-label">Upload Profile Picture:</label>
          <input type="file" class="form-control" id="profilePicture" name="profile_picture" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-dark btn-sm" name="upload_profile" data-bs-toggle="tooltip" data-bs-placement="bottom"
          data-bs-title="Upload your new profile picture">Upload</button>
      </form>
        
      <!-- Button to Change Password -->
      <a href="set_new_password.php" class="btn btn-secondary btn-sm">Change Password</a>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
      var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
      );
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    </script>
    <script src="scripts/profile.js"></script>
  </body>
</html>
