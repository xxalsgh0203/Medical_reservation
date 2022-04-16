<?php
require_once "../php/config.php";
  // Check if the user is logged in, if not then redirect them to login page
/*if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
  header("location: login.php");
  exit;

}*/
 
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
<form id="signup" method ="POST" action="requestAppointment.php">
  <!-- wrapper -->
  <div id="wrapper-request-appointment">
    <div class="col-sm-8 col-lg-8" >
      <p class="make-reservation-header">Make Your Reservation</p>
    </div>
    <!--div class="col-sm-8 col-lg-8">
      Choose your date
      <p><input type="date" value="today" class="form-control" name="date"></p>
    </div-->

    <!--div class="col-sm-8 col-lg-8">
      Choose Time
      <p><input type="time" id="time" class="form-control" step="3600000" name="time"></p>
    </div-->

        
    <!--div class="col-sm-8 col-lg-8">
      Symptoms
      <textarea id="symptoms" class="form-control" required name="symptons"></textarea>
    </div-->

    <div class="col-sm-8 col-lg-8">
      Choose Doctor Type
      <select id="choose-doctor" class="form-control" required name="doctor">
        <option value="Regular">Regular</option>
        <option value="Eye Doctor">Eye Doctor</option>
        <option value="Orthodontist">Orthodontist</option>
        <option value="Dermatologist">Dermatologist</option>
        <option value="Gynecologist">Gynecologist</option>
        <option value="Cardiologist">Cardiologist</option>
        <option value="Oncology">Oncologist</option>
        <option value="Gastroenterologist">Gastroenterologist</option>
      </select>
    </div>

    <div class="col-sm-8 col-lg-8">
      <br>
      <input class="form-control" type="submit" name="button" value="Next"/>
    </div>

  </div>

  <!-- wrapper -->
</form>
<?php
  if(isset($_POST['doctor'])) {
    $doctor = $_POST['doctor'];
    if ($doctor == "regular") {
      $doctor = null;
    }

    $query = "SELECT name, Days_in_office FROM DOCTOR WHERE Speciality = '$doctor';";
    $result   = mysqli_query($db, $query);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0) {
      echo "<p>Please select an avaiable Doctor<p><br>";
      echo "
      <form class='doctorSel' action='requestAppointment.php' method = 'POST';>";
      while ($row = mysqli_fetch_array($result)) {
        echo "
        <label for= '".$row['name']."'>".$row['name']."</label>
        <br>
        <label for= 'DaysAv'> Days Avaiable: </label>".$row['Days_in_office']."
        <input type='radio' name= '".$row['name']."' value='name'/>";
      }
    }
    echo "
    <input class='form-control' type='submit' name='button' value='Next'/>
    </form>";

    if (isset($_POST['name'])) {
      echo $_POST['name'];
    }
}
  ?>
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