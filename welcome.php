<?php
session_start();
require_once('functions/db_connection.php');

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$stmt = $pdo->prepare("SELECT profile_picture_path FROM player WHERE username = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Logout logic
if (isset($_POST['logout'])) {
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to login page
    header("Location: login.php");
    exit();
}

// Set profile picture path in session if found in database
if ($user && isset($user['profile_picture_path'])) {
  $_SESSION['profile_picture'] = $user['profile_picture_path'];
} else {
  // If no custom profile picture is found, use default profile picture
  $_SESSION['profile_picture'] = 'images/default_pfp.jpg';
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HomePage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/welcome.css">
  </head>
  <body>
    <header class="bg-dark text-light py-2 d-flex align-items-center">
      <div class="title" onclick="goHome()">AnimeQuizGame</div>
      <div class="d-flex align-items-center">
        <div class="header-btn me-3" data-bs-toggle="tooltip" data-bs-placement="bottom"
          data-bs-title="Click here if you need more information about how the website works or need help.">
          <a href="info.html" class="btn text-light btn-sm" role="button">Help</a>
        </div>
        <div class="user-section d-flex align-items-center bg-dark rounded me-3"
          type="button" data-bs-toggle="tooltip" data-bs-placement="bottom"
          data-bs-title="View Profile" onclick="openProfile()">
          <img src="<?php echo $_SESSION['profile_picture']; ?>" alt="Profile Picture" class="img-fluid rounded-circle me-2" style="width: 40px; height: 40px;">
          <span class="text-light "><?php echo $_SESSION['username']; ?></span>
        </div>
        <button class="logout-btn btn btn-danger btn-" type="button" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button>
        
      </div>
    </header>
    
    <div class="container mt-3 main-container" id="mainContainer">

        <h1>Welcome, Challanger!</h1>
        <p>This is a quiz created to test your knowledge about anime.
          It contains 10 questions, each with 4 possible answers.
          Prove your knowledge by getting all the answers right!
        </p>
        <p><strong>Good luck!</strong></p>
  

        <p>How to play: Choose your answer and click on it. The answer will turn green/red
          depending on whether it is correct or not. You can only choose one answer per question.
          If you chose wrong, the correct answer will be highlighted in green.
          After you finish the quiz, you will be able to see your score.
        </p>
        <label for="customRange3" class="form-label">Change the font size</label>
        <input class="accent-color" type="range" min="12" max="36" value="20">
        <p>Click below to begin the quiz:</p>
        <button onclick="startQuiz()" class="button-49" role="button">START</button>
      
    </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to log out?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form action="" method="post" id="logoutForm" style="display: inline;">
                        <button type="submit" class="btn btn-danger" name="logout">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="scripts/welcome.js"></script>
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
  </body>
</html>