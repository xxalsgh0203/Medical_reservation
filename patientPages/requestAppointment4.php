<?php
    session_start();
    require_once "../php/config.php";

    if(isset($_POST['time']) || isset($_POST['date'])) {
        $patientID = $_SESSION['id'];
        $doctorID = $_SESSION['name'];
        $doctor = $_SESSION['doctor'];
        $time = $_POST['time'];
        $date = $_POST['date'];
        $day = strtotime($date);
        $day = date('l', $day);
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

        if ($doctorID == 2) {
          $error = "You do not have permission to schedule an appointment with a specialist";
        } else {
          try {
            $query = "INSERT INTO `APPOINTMENT`(Patient_id, Doctor_id, Office_id, Appointment_status, Slotted_time, Specialist_status, Date, Day) VALUES
            ('$patientID', '$doctorID', '$officeID', '$appointmentStatus', '$time', '$specialistStatus', '$date', '$day');";
            $result = mysqli_query($db, $query);
          } catch  (Exception $e) {
            //$errortxt = mysqli_error();
            //echo "$errortext";
            //$error = $e;
          }
        }
        
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
        <li class="nav-item"><a class="nav-link" href="../auth/login.php">Log Out</a></li>
        <li class="nav-item"><a class="nav-link" href="./patientPage.php">Manage Reservation</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- End Header -->
<!-- ======= signup Section ======= -->
<body>
    <div class="container">
        <div class="ra-final">

          <?php if(isset($error) && !empty($error)) { ?>
            <h1 class="ra-h"><?= $error; ?></span>
          <?php } else { ?>
            <h1 id="result" class="ra-h"> Appoinmtent has been Requested </h1>
          <?php } ?>

            <br>
            <br>
            <p class= "ra-p"><a href="patientPage.php">Click here to return to the Patient Page</a></p>
        </div>
    </div>
</body>
<!-- Footer-->

<script src="main.js"></script>


</html-->