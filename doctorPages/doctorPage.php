<!-- 

Purpose: Display doctor information and allow them to edit appointments

Implemented Features:
  Display logged in doctor information
  display assigned patients
  display upcomming appoitnemtns with delete
  display schedule for different offices

TODO: 
  finalize design
  finalize attributes displayed
 -->
 
<?php
session_start();

require_once "../php/config.php";

// Check if the user is logged in, if not then redirect them to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
// {
//   header("location: login.php");
//   exit;
// }

$id = $_SESSION["id"];
$sql = "SELECT O.Address, O.City, O.State, D.Name, D.Speciality, D.Phone_number FROM DOCTOR AS D LEFT JOIN OFFICE AS O ON D.Office_id = O.Office_id WHERE Doctor_id = '$id'";
$result = mysqli_query($db, $sql);

$tableResult = "";
if ($result->num_rows > 0) {
  $tableResult = "<tr>";
  while($row = $result-> fetch_assoc()) {
    $spec = $row['Speciality'];
    if (is_null($row['Speciality'])) {
      $spec = "Regular";
    }
    $tableResult .= "<td>" . $row["Address"] . "</td><td>" . $row["City"] . "</td><td>" . $row["State"] . "</td><td>" . $row["Name"] . "</td><td>" . $spec .  "</td><td>" . $row["Phone_number"] . "</td>";
  }
  $tableResult .= "</tr>";
}

//Querie to retrieve patients for said id
$sql = "SELECT P.Name, P.Age, P.Medical_allergy, P.Email, P.Phone_number, D.Name AS Doctor_name, P.Specialist_approved FROM PATIENT AS P
LEFT JOIN DOCTOR AS D
ON P.Primary_physician_id = D.Doctor_id;";
$result = mysqli_query($db, $sql);

$PtableResult = "";
if ($result->num_rows > 0) {
 
  while($row = $result-> fetch_assoc()) {
    $PtableResult .= "<tr>". "<td>" . $row["Name"] . "</td><td>"  . $row["Age"] . "</td><td>" . $row["Medical_allergy"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["Phone_number"] . "</td><td>" . $row["Doctor_name"] . "</td><td>" . $row["Specialist_approved"] . "</td>". "<tr>";
  }
  
}

//Query to retrieve appointments for doctor
$sql = "SELECT P.Name AS Patient_name, A.Appointment_id, A.Date, A.Slotted_time, O.Address, A.Appointment_status, Specialist_status FROM APPOINTMENT AS A
LEFt JOIN OFFICE AS O ON A.Office_id = O.Office_id
LEFT JOIN PATIENT AS P ON P.Patient_id = A.Patient_id
LEFT JOIN DOCTOR AS D ON D.Doctor_id = A.Doctor_id
WHERE A.Doctor_id = '$id';";
$result = mysqli_query($db, $sql);

//table results for appointments
$APtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $approved = 'No';
    if ($row['Specialist_status'] == 1) {
      $approved = 'Yes';
    }
    $APtableResult .= "<tr>". "<td>" . $row["Patient_name"] . "</td><td>"  . $row["Date"] . "</td><td>" . $row["Slotted_time"] . "</td><td>" . $row["Address"] . "</td><td>" . $row["Appointment_status"] . "</td><td>" . $approved . "</td><td> 
    <a href='../doctorPages/doctorPage.php?delete_id=" . $row["Appointment_id"] . "'>X</a>
    </td>". "</tr>";
  }
}

//Query to retrieve schedule for doctor

//table results for schedule
$SPtableResult = "";
$weekdays = [
  "Monday",
  "Tuesday",
  "Wednesday",
  "Thursday",
  "Friday"
];


foreach ($weekdays as $weekday) {
  $sql = "SELECT * FROM WORK_INFO WHERE Doctor_id = '$id' AND Weekday = '$weekday'";
  $result = mysqli_query($db, $sql);
  if ($result->num_rows == 0)
    continue;
  $row = $result -> fetch_assoc();

  $SPtableResult .= "<tr>";
  $SPtableResult .= "<td>" . $weekday . "</td><td>"  . $row["Start_time"] . "</td><td>" . $row["End_time"] . "</td><td>" . $row["Office_id"] . "</td>";
  $SPtableResult .= "</tr>"; 
}

if (isset($_GET['delete_id'])) {
	$id = $_GET['delete_id'];

  try {
	mysqli_query($db, "DELETE FROM APPOINTMENT WHERE Appointment_id = " . $id);
} catch (\Throwable $th) {}
  header('location: doctorPage.php');
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
<!-- ======= Doctor Section ======= -->

<section id="Doctors">
  <div class="main-container">
    <div class="main-wrap">

      <div class="text-center" id="Doctor-header">Doctor</div>
      <div class="container-fluid">
        <div class="row justify-content-center my-5">
          <div class="col-10">
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th colspan='3'>Office Information</th>
                  <th colspan='3'>Personal Information</th>
                </tr>
                <tr>
                  <th>Address</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Name</th>
                  <th>Specialty</th>
                  <th>Phone Number</th>
                </tr>
                <?php echo $tableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>
            
            <br><br>

            <h2>Assigned Patients</h2>
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th>Name</th>
                  <th>Age</th>
                  <th>Medical_allergy</th>
                  <th>Email</th>
                  <th>Phone number</th>
                  <th>Primary physician</th>
                  <th>Approved by specialist?</th>
                </tr>
                <?php echo $PtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>

            <br><br>

            <h2>Appointments</h2>
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th>Patient Name</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Address</th>
                  <th>Appointment status</th>
                  <th>Specialist Appointment</th>
                  <th>Cancel Appointment</th>
                </tr>
                <?php echo $APtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>

            <br><br>

            <h2>Schedule</h2>
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th>Weekday</th>
                  <th>Start time</th>
                  <th>End time</th>
                  <th>Office id</th>
                </tr>
                <?php echo $SPtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>

          </div>
        </div>
      </div>

      <footer>
        <div class="copyright-wrap">
        </div>
      </footer>
    </div>
  </div>
</section>
<!-- End Doctors Page-->



<!-- Footer-->

<script src="main.js"></script>
</body>

</html>