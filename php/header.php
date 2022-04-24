<?php
require_once "config.php";

$href = "";
if (isset($_SESSION["href"])) {
  $href = $_SESSION["href"];
  $typ = $_SESSION["type"];
}
?>

<nav class="navbar navbar-expand-lg nav-back fixed-top" id="mainNav">
  <div class="container">
    <img src="./img/main_icon.png" class="mainicon" href="/localhost/cosc3380/index.php">
    <a class="navbar-brand" href="//localhost/cosc3380/index.php">Medimon</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
      data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
      aria-label="Toggle navigation"><i class="fas fa-syringe fa-2x"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <?php
          if (!isset($_SESSION['loggedin'])) {
            echo '<li class="nav-item"><a class="nav-link" href="//localhost/cosc3380/auth/login.php" id="login">Log in / Sign up</a></li>';
          } else {
            $typ = $_SESSION["type"];
            $name = $_SESSION["username"];
            echo '<li class="nav-item nav-link" style="color: #fff;"> Welcome! ' . $typ . ' ' . $name . '<li>';
            echo '<li class="nav-item"><a class="nav-link" href="//localhost/cosc3380/auth/logout.php" id="logout">Log out</a></li>';
          }
        ?>

        <?php if (isset($_SESSION['type'])) { ?>
            <li class="nav-item"><a class="nav-link" href=<?php echo $href?>>Manage Appointments</a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>