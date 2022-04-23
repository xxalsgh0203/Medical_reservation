<!-- 

Purpose: Display patient information

Implemented Features:
  display personal information
  button to requestAppointment page
  display upcomming appointments
  display prescription

TODO: 
  finalize design
  finalize attributes being displayed

 -->
 
<?php
session_start();

require_once "../php/config.php";
 
// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

$id = $_SESSION["id"];
$sql = "select DOCTOR.Name as Doctor_name, PATIENT.Name, PATIENT.Phone_number, PATIENT.Email, PATIENT.Age, PATIENT.Specialist_approved, PATIENT.Medical_allergy
from PATIENT
inner join DOCTOR on DOCTOR.Doctor_id = PATIENT.Primary_physician_id
where Patient_id = '$id';";
$result = mysqli_query($db, $sql);

$tableResult = "";
if ($result->num_rows > 0) {
  $tableResult = "<tr>";
  while($row = $result-> fetch_assoc()) {
    $approved = 'No';
    if ($row['Specialist_approved'] == 1) {
      $approved = 'Yes';
    }
    $tableResult .= "<td>" . $row["Doctor_name"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["Phone_number"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["Age"] . "</td><td>" . $approved . "</td><td>" . $row["Medical_allergy"] . "</td>";
  }
  $tableResult .= "</tr>";
}



$sql = "SELECT * FROM PRESCRIPTION WHERE Patient_id = '$id'";
$result = mysqli_query($db, $sql);

$PtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $PtableResult .= "<tr>" ."<td>" . $row["Prescription_date"] . "</td><td>"  . $row["Medication"] . "</td><td>" . $row["Test"] . "</td>". "<tr>";
  }
}

$sql = "SELECT D.Name AS Doctor_name, A.Date, A.Slotted_time, O.Address, O.City, O.State, A.Appointment_id, A.Appointment_status, Specialist_status FROM APPOINTMENT AS A
LEFT JOIN OFFICE AS O ON A.Office_id = O.Office_id
LEFT JOIN PATIENT AS P ON P.Patient_id = A.Patient_id
LEFT JOIN DOCTOR AS D ON D.Doctor_id = A.Doctor_id
WHERE P.Patient_id = '$id'
ORDER BY Date;";
$result = mysqli_query($db, $sql);

//table results for appointments
$APtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $approved = 'No';
    if ($row['Specialist_status'] == 1) {
      $approved = 'Yes';
    }
    $APtableResult .= "<tr>";
    $APtableResult .= "<td>" . $row["Doctor_name"] . "</td><td>"  . $row["Date"] . "</td><td>" . $row["Slotted_time"] . "</td><td>" . $row["Address"] . "</td><td>" . $row["City"] . "</td><td>" . $row["State"] . "</td><td>" . $row["Appointment_status"] . "</td><td>" . $approved . "</td><td> 
    <a href='../patientPages/patientPage.php?delete_id=" . $row["Appointment_id"] . "'>X</a>
    </td>";
    $APtableResult .= "</tr>";
  }
}

if (isset($_GET['delete_id'])) {
	$id = $_GET['delete_id'];

	mysqli_query($db, "DELETE FROM APPOINTMENT WHERE Appointment_id = " . $id);
  header('location: patientPage.php');
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

<?php include("../php/header.php"); ?>

  <!-- End Header -->

  <!-- ======= Patient Page ======= -->
<section id="AdminUsers">
  <div class="main-container">
    <div class="main-wrap">
      <div class="text-center" id="Admin-header">Patient - Manage your reservation</div>
      <div class="container-fluid">
        <div class="row justify-content-center my-5">
          <div class="col-12">
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th scope="col">Primary Physician Name</th>
                  <th scope="col">Name</th>
                  <th scope="col">Phone number</th>
                  <th scope="col">Email</th>
                  <th scope="col">Age</th>
                  <th scope="col">Approved by specialist</th>
                  <th scope="col">Medical_allergy</th>
                </tr>
                <?php echo $tableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>
            <a href="requestAppointment.php">Make Reservation!</a>

            <br><br>

            <h2>Appointments</h2>
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th>Doctor</th>
                  <th>Date</th>
                  <th>Slotted Time</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>State</th>
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

            <h2>Prescriptions</h2>
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th scope="col">Prescription_date</th>
                  <th scope="col">Medication</th>
                  <th scope="col">Test</th>
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

  <!-- Footer-->

  <script>

  </script>
</body>

</html>
