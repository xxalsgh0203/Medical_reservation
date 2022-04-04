<?php
require_once "../php/config.php";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
        
  $sql = "INSERT INTO PATIENT (Name, Password, Phone_number, Email, Age, Medical_allergy) VALUES (?, ?, ?, ?, ?, ?)";
    
  if($stmt = mysqli_prepare($db, $sql)){
    mysqli_stmt_bind_param($stmt, "ssisii", $param_name, $param_password, $param_phone, $param_email, $param_age, $param_medical_allergy);
    
    $param_name = mysqli_real_escape_string($db, $_POST['name']);
    $param_password = mysqli_real_escape_string($db, $_POST['password']);
    $param_phone = mysqli_real_escape_string($db, $_POST['phone']);
    $param_email = mysqli_real_escape_string($db, $_POST['email']);
    $param_age = mysqli_real_escape_string($db, $_POST['age']);
    $param_medical_allergy = mysqli_real_escape_string($db, $_POST['allergy'] || false);
    
    if(mysqli_stmt_execute($stmt)){
      header("location: login.php");
    } else{
      echo "Oops! Something went wrong. Please try again later.";
    }

    mysqli_stmt_close($stmt);
  }
  
  mysqli_close($db);
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
    <a class="navbar-brand" href="./main.php">Medimon</a>
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
<section id="signup">
  <!-- wrapper -->
  <div id="wrapper">
    
    <div class="text-center" id="signup-header">
      Create your Account
    </div>

    <!-- content-->
    <form id="content" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

      <!-- NAME -->
      <div>
        <h3 class="join_title"><label for="fname">Name</label></h3>
        <span class="box int_name">
          <input type="text" id="name" class="int" maxlength="20" name="name">
        </span>
        <span class="error_next_box"></span>
      </div>

      <!-- PW1 -->
      <div>
        <h3 class="join_title"><label for="pswd1">Password</label></h3>
        <span class="box int_pass">
          <input type="password" id="pswd1" class="int" maxlength="20" name="password">
          <span id="alertTxt">Unavailabe. Try another one</span>
          <img src="../icon/m_icon_pass.png" id="pswd1_img1" class="pswdImg">
        </span>
        <span class="error_next_box"></span>
      </div>

      <!-- PW2 -->
      <div>
        <h3 class="join_title"><label for="pswd2">Re-enter password</label></h3>
        <span class="box int_pass_check">
          <input type="text" id="pswd2" class="int" maxlength="20" name="rePassword">
          <img src="../icon/m_icon_check_disable.png" id="pswd2_img1" class="pswdImg">
        </span>
        <span class="error_next_box"></span>
      </div>

      <!-- MOBILE -->
      <div>
        <h3 class="join_title"><label for="phoneNo">Phone number</label></h3>
        <span class="box int_mobile">
          <input type="tel" id="mobile" class="int" maxlength="16" placeholder="Enter Phone number" name="phone">
        </span>
        <span class="error_next_box"></span>
      </div>

      <!-- Email -->
      <div>
        <h3 class="join_title"><label for="email">Email</label></h3>
        <span class="box int_email">
          <input type="text" id="email" class="int" maxlength="20" name="email">
        </span>
        <span class="error_next_box"></span>
      </div>

      <!-- AGE -->
      <div>
        <h3 class="join_title"><label for="age">Age</label></h3>
        <span class="box int_age">
          <input type="number" id="age" class="int" min="1" max="120" name="age">
        </span>
        <span class="error_next_box"></span>
      </div>

      <!-- MEDICAL ALLERGY -->
      <div>
        <h3 class="join_title"><label for="mallergy">Do you have any allergies?</label></h3>
        <span class="box int_name">
          <input type="checkbox" id="name" class="int" maxlength="20" name="allergy">
        </span>
        <span class="error_next_box"></span>
      </div>

      <!-- JOIN BTN-->
      <div class="btn_area">
        <input type="submit" id="btnJoin">
        </button>
      </div>

    </form>
    <!-- content-->

  </div>
  <!-- wrapper -->
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


</html>