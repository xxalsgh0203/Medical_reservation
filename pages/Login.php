<?php
session_start();

// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//   header("location: patientPage.php");
//   exit;
// }

require_once "../php/config.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  // username and password sent from form
  
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']); 
  
  $sql = "SELECT patient_id FROM PATIENT WHERE name = '$username' AND password = '$password'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  
  $count = mysqli_num_rows($result);
      
  if($count == 1) {
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $username; 
    
    header("location: patientPage.php");
  }else {
    echo(" Log in failed");
  }
}
?>


<!doctype html>
<html lang="en">

<head>
  <title>Consultation</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../css/style.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<nav class="navbar navbar-expand-lg nav-back fixed-top" id="mainNav">
  <div class="container">
    <img src="../img/main_icon.png" class="mainicon">
    <a class="navbar-brand" href="./main.html">Medimon</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
      data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
      aria-label="Toggle navigation"><i class="fas fa-syringe fa-2x"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="./login.php">Log in</a></li>
        <li class="nav-item"><a class="nav-link" href="./signup.php">Sign up</a></li>
        <li class="nav-item"><a class="nav-link" href="./patientPage.php">Manage Reservation</a></li>
      </ul>
    </div>
  </div>
</nav>

  <!-- End Header -->
  <!-- ======= signup Section ======= -->
  <section id="signin">
    <div class="main-container">
            <div class="main-wrap">

            <div class="text-center" id="login-header">Sign in</div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-input-section-wrap">
                <div class="login-input-wrap">	
                    <input placeholder="Username" type="text" name="username"></input>
                </div>
                <div class="login-input-wrap password-wrap">	
                    <input placeholder="Password" type="password" name="password"></input>
                </div>
                <div class="login-button-wrap">
                    <input type="submit" value="Sign in">
                </div>
                <div class="login-stay-sign-in">
                    <i class="far fa-check-circle"></i>
                    <span>Stay Signed in</span>
                </div>
              </form>
            <footer>
                <div class="copyright-wrap">
                </div>
            </footer>
            </div>
        </div>
    </section>
  <!-- End signup -->

  <!-- Footer-->
  <footer class="footer py-4 mt-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-4 text-lg-left">COSC3380 Group Project</div>
        <div class="col-lg-4 my-3 my-lg-0">
          <a class="btn btn-back btn-social mx-2" href="#!">
            <i class="fab fa-twitter"></i></a>
          <a class="btn btn-back btn-social mx-2" href="#!">
            <i class="fab fa-facebook-f"></i></a>
          <a class="btn btn-back btn-social mx-2" href="#!">
            <i class="fab fa-linkedin-in"></i></a>
        </div>
        <div class="col-lg-4 text-lg-right">
          <a class="mr-3 text" href="#!">Privacy Policy</a>
          <a href="#!" class="text">Terms of Use</a></div>
      </div>
    </div>
  </footer>

  <script src="main.js"></script>
</body>

</html>