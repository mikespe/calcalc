<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="home.php">Weight Loss App</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="calcalc.php">Calorie Calculator</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="calorie-log.php">Calorie Log</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="weightlog.php">Weight Log</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="nutrition-search.php">Nutrition Search</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="my-account.php">My Account</a>
      </li>
    </ul>
  </div>
</nav>
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
} ?>
