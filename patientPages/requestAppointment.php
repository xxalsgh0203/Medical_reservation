<!-- 

Purpose: Allow patients the ability to request appointments

Implemented Features:

TODO: 
  debug then fill in implemented features/todo

 -->
 
<?php
require_once "php/config.php";
  // Check if the user is logged in, if not then redirect them to login page
/*if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
  header("location: login.php");
  exit;

<<<<<<< HEAD:requestAppointment.php
}*/
=======
require_once "../php/config.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../auth/login.php");
  exit;
}
>>>>>>> 4fcc20711b9f7a4b272f7e214b8b09277fa8ea52:patientPages/requestAppointment.php
 
?>
<!doctype html>
<html lang="en">

<head>
  <title>GROUP 5</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<<<<<<< HEAD:requestAppointment.php
  <link rel="stylesheet" href="css/style.css">
=======
  <link rel="stylesheet" href="../css/style.css">
>>>>>>> 4fcc20711b9f7a4b272f7e214b8b09277fa8ea52:patientPages/requestAppointment.php

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<<<<<<< HEAD:requestAppointment.php
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
=======
<?php include_once("../php/header.php"); ?>
>>>>>>> 4fcc20711b9f7a4b272f7e214b8b09277fa8ea52:patientPages/requestAppointment.php

<!-- End Header -->
<!-- ======= signup Section ======= -->
<form id="signup" method ="POST" action="requestAppointment2.php">
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
      <select id="choose-doctor" class="form-control" required name="doctor" required>
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
<!-- End signup -->

<!-- Footer-->
<<<<<<< HEAD:requestAppointment.php
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
=======
<?php include_once("../php/footer.php"); ?>
>>>>>>> 4fcc20711b9f7a4b272f7e214b8b09277fa8ea52:patientPages/requestAppointment.php

<script src="main.js"></script>


</html>