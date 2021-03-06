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
    <a class="navbar-brand" href="../index.php">Medimon</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
      data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
      aria-label="Toggle navigation"><i class="fas fa-syringe fa-2x"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="../auth/login.php">Log Out</a></li>
        <li class="nav-item"><a class="nav-link" href="./patientPage.php">Manage Reservation</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- End Header -->
<!-- ======= signup Section ======= -->
<form id="ra" class="ra" method ="POST" action="requestAppointment2.php">
  <!-- wrapper -->
  <div id="wrapper-request-appointment">
      <h3 class="ra-header">Make Your Reservation</h3>    
    <div class="ra-form">
      Choose Doctor Type
      <select id="choose-doctor" class="form-control" required name="doctor" required>
        <option value="Regular">Regular</option>
        <option value="Anesthesiology">Anesthesiology</option>
        <option value="Eye Doctor">Eye Doctor</option>
        <option value="Orthodontist">Orthodontist</option>
        <option value="Dermatologist">Dermatologist</option>
        <option value="Gynecologist">Gynecologist</option>
        <option value="Cardiologist">Cardiologist</option>
        <option value="Oncology">Oncologist</option>
        <option value="Gastroenterologist">Gastroenterologist</option>
      </select>
    </div>

    <div class="ra-form">
      <br>
      <input class="ra-form" type="submit" name="button" value="Next"/>
    </div>

  </div>

  <!-- wrapper -->
</form>
<!-- End signup -->

<!-- Footer-->


<script src="main.js"></script>


</html>