<?php
session_start();

require_once "./php/config.php";

// Check if the user is logged in, if not then redirect them to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
// {
//   header("location: login.php");
//   exit;
// }

$id = $_SESSION["id"];
$sql = "SELECT Office_id, Name, Days_in_office, Speciality, Phone_number FROM DOCTOR WHERE Doctor_id = '$id'";
$result = mysqli_query($db, $sql);

$tableResult = "";
if ($result->num_rows > 0) {
  $tableResult = "<tr>";
  while($row = $result-> fetch_assoc()) {
    $tableResult .= "<td>" . $row["Office_id"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["Speciality"] . "</td><td>" . $row["Days_in_office"] . "</td><td>" . $row["Phone_number"] . "</td>";
  }
  $tableResult .= "</tr>";
}

//Querie to retrieve patients for said id
$sql = "SELECT Patient_id, Name, Phone_number, Email, Age, Medical_allergy FROM PATIENT WHERE Primary_physician_id = '$id'";
$result = mysqli_query($db, $sql);

$PtableResult = "";
if ($result->num_rows > 0) {
  $PtableResult = "<tr>";
  while($row = $result-> fetch_assoc()) {
    $PtableResult .= "<td>" . $row["Patient_id"] . "</td><td>"  . $row["Name"] . "</td><td>" . $row["Phone_number"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["Age"] . "</td><td>" . $row["Medical_allergy"] . "</td>";
  }
  $PtableResult .= "</tr>"; 
}

//Query to retrieve appointments for doctor
$sql = "SELECT Patient_id, Office_id, Appointment_id, Appointment_status_id, Slotted_time, Specialist_status FROM APPOINTMENT WHERE Doctor_id = '$id'";
$result = mysqli_query($db, $sql);

//table results for appointments
$APtableResult = "";
if ($result->num_rows > 0) {
  $APtableResult = "<tr>";
  while($row = $result-> fetch_assoc()) {
    $APtableResult .= "<td>" . $row["Patient_id"] . "</td><td>"  . $row["Office_id"] . "</td><td>" . $row["Appointment_status_id"] . "</td><td>" . $row["Slotted_time"] . "</td><td>" . $row["Specialist_status"] . "</td><td> 
    <a href='./doctorPage.php?delete_id=" . $row["Appointment_id"] . "'>X</a>
    </td>";
  }
  $APtableResult .= "</tr>"; 
}

if (isset($_GET['delete_id'])) {
	$id = $_GET['delete_id'];

	mysqli_query($db, "DELETE FROM APPOINTMENT WHERE Appointment_id = " . $id);
}

?>


<!doctype html>
<html lang="en">

<head>
  <title>Doctors</title>
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
                  <th>Office ID</th>
                  <th>Name</th>
                  <th>Specialty</th>
                  <th>Availability</th>
                  <th>Phone Number</th>
                </tr>
                <?php echo $tableResult;?>
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

<!-- ======= Doctor's Patients Section ======= -->

<section id="Doc's Patients">
  <div class="main-container">
    <div class="main-wrap">

      <div class="text-center" id="Doctor-header">Assigned Patients</div>
      <div class="container-fluid">
        <div class="row justify-content-center my-5">
          <div class="col-10">
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th>Patient ID</th>
                  <th>Name</th>
                  <th>Phone number</th>
                  <th>Email</th>
                  <th>Age</th>
                  <th>Medical_allergy</th>
                </tr>
                <?php echo $PtableResult;?>
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
<!-- End Doctor's Patients-->

<!-- ======= Appointments Section ======= -->

<section id="Doc's Patients">
  <div class="main-container">
    <div class="main-wrap">

      <div class="text-center" id="Doctor-header">Appointments</div>
      <div class="container-fluid">
        <div class="row justify-content-center my-5">
          <div class="col-10">
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th>Patient ID</th>
                  <th>Office ID</th>
                  <th>Appointment status</th>
                  <th>Slotted Time</th>
                  <th>Specialist Status</th>
                  <th>Cancel Appointment</th>
                </tr>
                <?php echo $APtableResult;?>
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
<!-- End Appointments-->



<!-- Footer-->
<?php include_once("./php/footer.php"); ?>

<script src="main.js"></script>
</body>

</html>