<?php
session_start();

require_once "./php/config.php";
 
// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
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
  <title>Data Entry Page</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="./css/style.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

 
  <style>
     /* Used to center the title*/
    h1 {text-align: center;}
  /* used to center inputs*/
    form { 
          margin: 0 auto; 
          width:1000px;
          }
  </style>
</head>

<?php include_once("./php/header.php"); ?>

<!-- End Header -->
<!-- ======= DataEntry Page ======= -->
<section id="signup">

<!-- Header of the page-->
<h1>Data Entry Form</h1>

<form action="">
  <h2>  <b>Add patient</b>  </h2>
  <label for="PPname">Primary physician:</label>
  <input type="text" id="PPname" name="PPname">
  <label for="name">Patient Name:</label>
  <input type="text" id="name" name="name">
  <label for="SPApproved">Specialist approval:</label>
  <input type="number" id="AprNum" name="AprNum"> 
  <br>
  <label for="lname">Last Name:</label>
  <input type="text" id="lname" name="lname">
  <input type="submit" value="Submit">
  <!--Used to separate inputs-->
  <br>
  
</form>

</section>

<!-- End Of Data Entry -->



<!-- Footer-->
<?php include_once("./php/footer.php"); ?>

<script src="main.js"></script>
</body>

</html>