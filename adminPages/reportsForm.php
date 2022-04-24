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
if (isset($_POST['Employees'])) {
  $ReportResults .= "<tr>
                      <th>Name</th>
                      <th>Phone Number</th>
                      <th>Office Address</th>
                    </tr>";
  $sql = "SELECT * FROM
          (SELECT Office_id, Name, Phone_number FROM DOCTOR
          UNION
          SELECT Office_id, Name, Phone_number FROM ADMIN) AS Employees
          LEFT JOIN (SELECT Office_id, Address FROM OFFICE) AS OF
          ON Employees.Office_id = OF.Office_id;";
  $result = mysqli_query($db, $sql);

  if ($result->num_rows > 0) {
    while($row = $result-> fetch_assoc()) {
      $ReportResults .= "<tr>" . 
                        "<td>" . $row["Name"] . "</td>" .
                        "<td>" . $row["Phone_number"] . "</td>" .
                        "<td>" . $row["Address"] . "</td>" . "<tr>";
    }
  }
}
else if (isset($_POST['test'])) {
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
else if (isset($_POST['Appointments'])) {
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
          ON A.Office_id = O.Office_id";
  if ($_POST["start"] != "" && $_POST["end"] != "") {
    $start = $_POST["start"];
    $end = $_POST["end"];
    $sql .= "\n WHERE Date BETWEEN '$start' AND '$end';";
  } else {
    $sql .= ";";
  }
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
else if (isset($_POST['Prescriptions'])) {
  $ReportResults = "<tr>
                    <th colspan='3'>Patient Information</th>
                    <th colspan='3'>Prescription Information</th>
                  </tr>";
  $ReportResults .= "<tr>
                    <th>Name</th>
                    <th>Phone number</th>
                    <th>Email</th>
                    <th>Medication</th>
                    <th>Test</th>
                    <th>Prescription Date</th>
                  </tr>";
  $sql = "SELECT Name, Phone_number, Email, Medication, Test, Prescription_date FROM PATIENT as PAT
          RIGHT JOIN PRESCRIPTION as PRE
          ON PAT.Patient_id = PRE.Patient_id;";
  $result = mysqli_query($db, $sql);

  if ($result->num_rows > 0) {
    while($row = $result-> fetch_assoc()) {
      $ReportResults .= "<tr>" . 
                        "<td>" . $row["Name"] . "</td>" .
                        "<td>" . $row["Phone_number"] . "</td>" .
                        "<td>" . $row["Email"] . "</td>" .
                        "<td>" . $row["Medication"] . "</td>" .
                        "<td>" . $row["Test"] . "</td>" .
                        "<td>" . $row["Prescription_date"] . "</td>" . "<tr>";
    }
  }
}
else if (isset($_POST['Specialist'])) {
  $ReportResults = "<tr>
                      <th colspan='3'>Office Information</th>
                      <th colspan='2'>Specialist Information</th>
                    </tr>";
  $ReportResults .= "<tr>
                      <th>Address</th>
                      <th>City</th>
                      <th>State</th>
                      <th>Num Of Specialist</th>
                      <th>Speciality</th>
                    </tr>";
  $sql = "SELECT COUNT(D.Doctor_id), O.Address, O.City, O.State, D.Speciality
          FROM DOCTOR AS D
          LEFT JOIN OFFICE AS O ON D.Office_id = O.Office_id
          GROUP BY O.Address, O.City, O.State, D.Speciality;";
  $result = mysqli_query($db, $sql);

  if ($result->num_rows > 0) {
    while($row = $result-> fetch_assoc()) {
      $speciality = $row["Speciality"];
      if ($speciality == "")
        $speciality = "none";
      $ReportResults .= "<tr>" . 
                        "<td>" . $row["Address"] . "</td>" .
                        "<td>" . $row["City"] . "</td>" .
                        "<td>" . $row["State"] . "</td>" .
                        "<td>" . $row["COUNT(D.Doctor_id)"] . "</td>" .
                        "<td>" . $speciality . "</td>" . "<tr>";
    }
  }
}
else if (isset($_POST['Employees'])) {
  $ReportResults .= "<tr>
                      <th>Name</th>
                      <th>Phone Number</th>
                      <th>Office Address</th>
                    </tr>";
  $sql = "SELECT * FROM
          (SELECT Office_id, Name, Phone_number FROM DOCTOR
          UNION
          SELECT Office_id, Name, Phone_number FROM ADMIN) AS Employees
          LEFT JOIN (SELECT Office_id, Address FROM OFFICE) AS OF
          ON Employees.Office_id = OF.Office_id;";
  $result = mysqli_query($db, $sql);

  if ($result->num_rows > 0) {
    while($row = $result-> fetch_assoc()) {
      $ReportResults .= "<tr>" . 
                        "<td>" . $row["Name"] . "</td>" .
                        "<td>" . $row["Phone_number"] . "</td>" .
                        "<td>" . $row["Address"] . "</td>" . "<tr>";
    }
  }
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

$start="2022-01-01T00:00";
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
      left:-16%;
      width: 900px;
      padding: 10px;
      position: relative;
      background-color: #fff;
      margin: 10px;
    }

    .navitem {
      display: inline-block;
      width: 220px;
      height: 70px;
      text-align: center;
      border: 1px red;
      background-color: #34568B;
      color: white;
      cursor: pointer;
      font-weight: bold;
      font-family: "Lucida Console", "Courier New", monospace;
    }

    .navitem :hover {
      color: #95a5a6;
    }

    .ct2{
      vertical-align: middle;
    }

    fieldset{
      vertical-align: middle;
    }

    table{
      left: 4%;
      width: 1200px; !important
    }


  </style>

</head>

<?php include_once("../php/header.php"); ?>

<nav class="floating-menu">
    </a>
        <a href="AdminPage.php">
            <div>
                Admin Page
            </div>
        </a>
</nav>

<!-- End Header -->
<!-- ======= reports Page ======= -->
<section id="reportsForm">

  <div class="reportF">
    <h1>Report Form</h1>
  </div>


  </div>

  <div class="data">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="input-group">
        <fieldset>
        <p class="ct2">
        <label for="starting_date">Begin:</label>
        <input type="datetime-local" id="StartDateid" name="start">
        </p>
        <br>
        <p class = "ct2">
        <label for="ending_date">End:</label>
        <input type="datetime-local" id="EndDateid" name="end">
        </p>
        </fieldset>
      </div>
      <div class="sidebyside">
        <fieldset>
        <button type="submit" class="navitem" id="Presid" name="Prescriptions">Prescriptions</a>
        <button type="submit" class="navitem" id="DocSpecialid" name="Specialist">Specialist</a>
        <button type="submit" class="navitem" id="Appid" name="Appointments">Appointments</a>
        <button type="submit" class="navitem" id="Empid" name="Employees">Employees</a>
        <fieldset>
      </div>
    </form>

    <br><br>

    <table class="table">
      <?php echo $ReportResults;?>
    </table>

  </div>


</section>
<!-- End Of Reports page -->



<!-- Footer-->

<script src="main.js"></script>
</body>

</html>