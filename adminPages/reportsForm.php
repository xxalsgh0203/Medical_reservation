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
</head>

<?php include_once("../php/header.php"); ?>

<!-- End Header -->
<!-- ======= reports Page ======= -->
   <section id = "reportsForm">
      
        <div class = "wrapper">
        <h1>Report Form</h1>
        </div>



   </section>
<!-- End Of Reports page -->



<!-- Footer-->
<?php include_once("../php/footer.php"); ?>

<script src="main.js"></script>
</body>

</html>