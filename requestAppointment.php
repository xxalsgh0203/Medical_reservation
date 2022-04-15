<?php
session_start();

require_once "./php/config.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
        
  $sql = "INSERT INTO APPOINTMENT (Doctor_id, Patient_id, Office_id, Appointment_status_id, Specialist_status, Slotted_time) VALUES (?, ?, ?, ?, ?, ?);";
    
  if($stmt = mysqli_prepare($db, $sql)){
    mysqli_stmt_bind_param($stmt, "iiiiis", $doctor, $id, $office, $Appointment_status_id, $status, $time);
    
    $doctor = mysqli_real_escape_string($db, $_POST['doctor']);
    $office = mysqli_real_escape_string($db, $_POST['office']);
    $Appointment_status_id = 1;
    $status = true;
    $time = mysqli_real_escape_string($db, $_POST['time']);

    if(mysqli_stmt_execute($stmt)) {
      header("location: patientPage.php");
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
  <link rel="stylesheet" href="./css/style.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<?php include_once("./php/header.php"); ?>

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
<?php include_once("./php/footer.php"); ?>

<script src="main.js"></script>


</html>