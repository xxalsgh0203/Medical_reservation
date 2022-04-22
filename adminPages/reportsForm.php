<!-- 

Purpose: Allow admin to request and view reports

Implemented Features:

TODO: 
  Add buttons to view various reports
  implement report+display for each report

 -->

<?php
session_start();

require_once "../php/config.php";
 
// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}

$ReportResults = "";
if (isset($_GET['report'])) {
  $reportType = $_GET['report'];

  if ($reportType == 'test') {
    $ReportResults = "<tr>
                        <th>Office id</th>
                        <th>Amount of appointments</th>
                        <th>specialits Visits</th>
                        <th>Total</th>
                      </tr>";
    $sql = "SELECT  ofic.Office_id, COUNT(*) FROM OFFICE ofic LEFT JOIN APPOINTMENT aptment ON ofic.Office_id = aptment.Office_id GROUP BY ofic.Office_id";
    $result = mysqli_query($db, $sql);
  
    if ($result->num_rows > 0) {
      while($row = $result-> fetch_assoc()) {
        $ReportResults .= "<tr>" ."<td>" . $row["Office_id"] . "</td>" . "<td>" . $row["COUNT(*)"] . "</td>" ."<tr>";
      }
    }
  }

  if ($reportType == 'Appointments') {
    $ReportResults = "<tr>
                      <th colspan='3'>Office Information</th>
                      <th colspan='3'>Appointment Information</th>
                      <th colspan='3'>Patient Information</th>
                    </tr>";
    $ReportResults .= "<tr>
                      <th>Address</th>
                      <th>City</th>
                      <th>State</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Status</th>
                      <th>Name</th>
                      <th>Age</th>
                      <th>Has Allergies?</th>
                    </tr>";
    $sql = "SELECT O.Address, O.City, O.State, A.Date, A.Slotted_time, P.name, P.Age, P.Medical_allergy, A.Appointment_status FROM APPOINTMENT
            as A
            LEFT JOIN PATIENT as P
            ON A.Patient_id = P.Patient_id
            LEFT JOIN DOCTOR as D
            ON A.Doctor_id = D.Doctor_id
            LEFT JOIN OFFICE as O
            ON A.Office_id = O.Office_id;";
    $result = mysqli_query($db, $sql);

    if ($result->num_rows > 0) {
      while($row = $result-> fetch_assoc()) {
        $ReportResults .= "<tr>" . 
                          "<td>" . $row["Address"] . "</td>" .
                          "<td>" . $row["City"] . "</td>" .
                          "<td>" . $row["State"] . "</td>" .
                          "<td>" . $row["Date"] . "</td>" .
                          "<td>" . $row["Slotted_time"] . "</td>" .
                          "<td>" . $row["Appointment_status"] . "</td>" .
                          "<td>" . $row["name"] . "</td>" .
                          "<td>" . $row["Age"] . "</td>" .
                          "<td>" . $row["Medical_allergy"] . "</td>" . "<tr>";
      }
    }
  }

  //header('location: reportsForm.php');
}

$id = $_SESSION["id"];
$sql = "SELECT Office_id, Name, Phone_number, Email FROM ADMIN WHERE Admin_id = '$id'";
$result = mysqli_query($db, $sql);

$tableResult = "";
if ($result->num_rows > 0) {
  $tableResult = "<tr>";
  while($row = $result-> fetch_assoc()) {
    $tableResult .= "<td>" . $row["Office_id"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["Phone_number"] . "</td><td>" . $row["Email"] . "</td>";
  }
  $tableResult .= "</tr>";
}

//Query to retrieve appointments for doctor
$sql = "SELECT Patient_id, Office_id, Appointment_status_id, Slotted_time, Specialist_status FROM APPOINTMENT WHERE Doctor_id = '$id'";
$result = mysqli_query($db, $sql);

//table results for appointments
$APtableResult = "";
if ($result->num_rows > 0) {
  $APtableResult = "<tr>";
  while($row = $result-> fetch_assoc()) {
    $APtableResult .= "<td>" . $row["Patient_id"] . "</td><td>"  . $row["Office_id"] . "</td><td>" . $row["Appointment_status_id"] . "</td><td>" . $row["Slotted_time"] . "</td><td>" . $row["Specialist_status"] . "</td> <a href='.php?'Delete</a> <td>" . "</td>";
  }
  $APtableResult .= "</tr>"; 
}
/*
$sql = "SHOW COLUMNS FROM OFFICE";
$dbres = mysqli_query($db, $sql);
while($row = mysqli_fetch_array($dbres))
{
  echo $row['Field']."<br>";
}*/

?>

<!doctype html>
<html lang="en">

<head>
  <title>GROUP 5</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../css/style.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <style>
    .data {
      width: 800px;
      padding: 100px;
      margin-top: 20px;

    }

    .table {
      margin-top: 20px;
      border: 1px solid #ccc;
      clear: both;
    }

    .sidebyside {
      padding: 10px;
      position: relative;
      background-color: #fff;
      margin: 10px;
    }

    .navitem {
      display: inline-block;
      width: 150px;
      height: 30px;
      text-align: center;
      border: gray;
      background-color: #E8562A;
      color: #fff;
      cursor: pointer;
      font-weight: bold;
    }
  </style>

</head>

<?php include_once("../php/header.php"); ?>




<!-- End Header -->
<!-- ======= reports Page ======= -->
<section id="reportsForm">

  <div class="reportF">
    <h1>Report Form</h1>
  </div>


  </div>

  <div class="data">

    <div class="input-group">
      <label for="starting_date">Begin:</label>
      <input type="datetime-local" id="StartDateid">
      <br>
      <label for="ending_date">End:</label>
      <input type="datetime-local" id="EndDateid">
    </div>




    <div class="sidebyside">
      <a class="navitem" id="Presid" href="./reportsForm.php?report=Prescriptions">Prescriptions(todo)</a>
      <a class="navitem" id="DocSpecialid" href="./reportsForm.php?report=Specialist">Specialist(todo)</a>
      <a class="navitem" id="Appid" href="./reportsForm.php?report=Appointments">Appointments(done)</a>

    </div>

    <br><br>

    <table border="2" class="table">
      <?php echo $ReportResults;?>
    </table>

  </div>


</section>
<!-- End Of Reports page -->



<!-- Footer-->

<script src="main.js"></script>
</body>

</html>