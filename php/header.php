<?php
require_once "./php/config.php";

$href = "";
if (isset($_SESSION["href"])) {
  $href = $_SESSION["href"];
}
?>

<nav class="navbar navbar-expand-lg nav-back fixed-top" id="mainNav">
  <div class="container">
    <img src="./img/main_icon.png" class="mainicon">
    <a class="navbar-brand" href="./index.php">Medimon</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
      data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
      aria-label="Toggle navigation"><i class="fas fa-syringe fa-2x"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <?php
          if (!isset($_SESSION['loggedin'])) {
            echo '<li class="nav-item"><a class="nav-link" href="./Login.php" id="login">Log in</a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="./signup.php">Sign up</a></li>';
          } else {
              echo '<li class="nav-item"><a class="nav-link" href="./Logout.php" id="logout">Log out</a></li>';
          }
        ?>
        <li class="nav-item"><a class="nav-link" href=<?php echo $href;?>>Manage Appointments</a></li>
      </ul>
    </div>
  </div>
</nav>