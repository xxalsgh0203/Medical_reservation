<?php
    session_start();
    require_once "../php/config.php";

    if(isset($_POST['time'])) {
        $patientID = $_SESSION['id'];
        $doctorID = $_SESSION['name'];
        $doctor = $_SESSION['doctor'];
        $time = $_POST['time'];
        $appointmentStatus = "Pending";

        $query = "Select Office_id from DOCTOR where Doctor_id = '$doctorID';";
        $result = mysqli_query($db, $query);
        $data= mysqli_fetch_assoc($result);

        $officeID = $data['Office_id'];

        $query = "select Speciality from DOCTOR where Doctor_id = '$doctorID';";
        $result = mysqli_query($db, $query);
        $data = mysqli_fetch_assoc($result);

        $specialistStatus = 0;
        if (!is_null($data['Speciality'])) {
            $specialistStatus = 1;
        }

        /*$query = "Select * from DOCTOR;";
        $result = mysqli_query($db, $query);
        $resultCheck= mysqli_num_rows($result);


        if($resultCheck > 0) {
            while ($row = mysqli_fetch_array($result)) {
                if(is_null($row['Speciality'])) {//checks to see if it 
                    echo $row['Name']." ".$row['Speciality'].'<br>';
                }
                //echo $row['Name']." ".$row['Speciality'].'<br>';

            }
        }*/


        /*$query = "INSERT INTO `APPOINTMENT`(Patient_id, Doctor_id, Office_id, Appointment_status, Slotted_time, Specialist_status) VALUES
        ('$patientID', '$doctorID', '$officeID', '$appointmentStatus', '$time', '$specialistStatus');";
        $result   = mysqli_query($db, $query);*/
    }


?>

<?php
  // Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
  header("location: login.php");
  exit;

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
<body>
    <div class="container">
        <p>Appointment has been requested</p>
    </div>
</body>
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


</html-->