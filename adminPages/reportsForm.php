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

//Query to search for Reports
$sql = "SELECT  ofic.Office_id, COUNT(*) FROM OFFICE ofic LEFT JOIN APPOINTMENT aptment ON ofic.Office_id = aptment.Office_id GROUP BY ofic.Office_id";
$result = mysqli_query($db, $sql);

$ReportResults = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $ReportResults .= "<tr>" ."<td>" . $row["Office_id"] . "</td>" . "<td>" . $row["COUNT(*)"] . "</td>" ."<tr>";
  }
  
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
  .data 
  {
    width: 800px;
  padding: 100px;
  margin-top: 20px;
  
  }
  
  .table 
  {
    margin-top: 20px;
    border: 1px solid #ccc;
    clear: both;
  }

  
</style>

</head>

<?php include_once("../php/header.php"); ?>

<!-- End Header -->
<!-- ======= reports Page ======= -->
   <section id = "reportsForm">
      
        <div class = "center">
        <h1>Report Form</h1>
        </div>
        
        <div class = "data">
          <select name="Op1" style="border: 1px solid">
              <option>Select</option>
              <option id = "Office_id">Office id</option>
              <option >2 PUC</option>
          </select>
          <select name="Op2" style="border: 1px solid">
              <option >Select</option>
              <option>Appointmens</option>
              <option >2 PUC</option>
          </select>
         

          <button type="submit" class="btn btn-primary" name="Submit">Submit</button>
          <br><br>
          <table border = "2" class  = "table">
            <tr>
                <th>Office id</th>
                <th>Amount of appointments</th>
                <th>specialits Visits</th>
                <th>Total</th>
            </tr>
            <?php echo $ReportResults;?>
          </table>
         
        </div>


   </section>
<!-- End Of Reports page -->



<!-- Footer-->

<script src="main.js"></script>
</body>

</html>