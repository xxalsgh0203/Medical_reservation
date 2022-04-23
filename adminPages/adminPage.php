<?php
session_start();

require_once "../php/config.php";


//Current admin log in info
$id = $_SESSION["id"];
$sql = "SELECT Office_id, Name, Phone_number, Email FROM ADMIN WHERE Admin_id = '$id'";
$result = mysqli_query($db, $sql);

$tableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $tableResult .= "<tr>" . "<td>" . $row["Office_id"] . "</td><td>" . $row["Name"] . "</td><td>" . 
                    $row["Phone_number"] . "</td><td>" . $row["Email"] . "</td>" . "</tr>";
  }
}


//Query to retrieve appointments for doctors
$sql = "SELECT Patient_id, Office_id, Appointment_id, Appointment_status, Slotted_time, Specialist_status FROM APPOINTMENT ORDER BY Appointment_status='rejected', Appointment_status='canceled', Appointment_status='approved', Appointment_status='pending'";
$result = mysqli_query($db, $sql);

//table results for appointments
$APtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $APtableResult .= "<tr>". "<td>" . $row["Patient_id"] . "</td><td>"  . $row["Office_id"] . "</td><td>" .
                       $row["Appointment_status"] . "</td><td>" . $row["Slotted_time"] . "</td><td>" . $row["Specialist_status"] . "</td>";
                       
    if ($row["Appointment_status"] === 'pending') {
      $APtableResult .= "<td><a href='../adminPages/adminPage.php?approve_id=" . $row["Appointment_id"] . "'>X</a></td>";
      $APtableResult .= "<td><a href='../adminPages/adminPage.php?ren  ject_id=" . $row["Appointment_id"] . "'>X</a></td>";
    } else {
      $APtableResult .= "<td></td><td></td>";
    }
    $APtableResult .= "</tr>";

  }
}


if (isset($_GET['approve_id'])) {
    $id = $_GET['approve_id'];
  
    mysqli_query($db, "UPDATE APPOINTMENT SET Appointment_status='approved' WHERE Appointment_id = " . $id);
    header('location: adminPage.php');
  }
  
  if (isset($_GET['reject_id'])) {
    $id = $_GET['reject_id'];
  
    mysqli_query($db, "UPDATE APPOINTMENT SET Appointment_status='rejected' WHERE Appointment_id = " . $id);
    header('location: adminPage.php');
  }


  /*to retrieve other admins*/
$sql = "SELECT * FROM ADMIN";
$result = mysqli_query($db, $sql);

$OtADtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $OtADtableResult .= "<tr>". "<td>" . $row["Office_id"] . "</td><td>" . $row["Name"] . "</td><td>" . 
                          $row["Phone_number"] . "</td><td>" . $row["Email"] . "</td>" . "<tr>";
  }
 
}

//-------------------------Retrieve table for doctors-------------->
$sql = "SELECT * FROM DOCTOR";
$result = mysqli_query($db, $sql);

$DtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $DtableResult .= "</tr>" . "<td>" . $row["Office_id"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["Speciality"] .  "</td><td>" . $row["Phone_number"] . "</td>" . "</tr>";
  }
  
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

    <!--style for buttons --> 
   <style>
  
     h2
     {
       text-align: center;
     }
     h1
     {
       text-align: center;
     }
   </style>
</head>


<body>
    <nav class="floating-menu">
        <a href="doctorDataEntry.php">
            <div>
                Doctor Data Entry Page
            </div>
        </a>
        <a href="adminDataEntry.php">
            <div>
                Admin Data Entry Page
            </div>
        </a>
        <a href="patientDataEntry.php">
            <div>
                Patient Data Entry Page
            </div>
        </a> 
        </a>
        <a href="SpecialistApproval.php">
            <div>
                Specialist Approval Page
            </div>
        </a> 
        </a>
        <a href="reportsForm.php">
            <div>
                ReportsForm Page
            </div>
        </a> 
    </nav>

<?php include_once("../php/header.php"); ?>


<!-- ======= Admin Page ======= -->
<body>
  <div class="main-container">
    <div class="main-wrap">

      <div class="text-center" id="Admin-header">Current Admin</div>
      <div class="container-fluid">
        <div class="row justify-content-center my-5">
          <div class="col-10">
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th scope="col">Office ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Phone number</th>
                  <th scope="col">Email</th>
                </tr>
                <?php echo $tableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>

            <br> <br>

            <h2>Appointments</h2>
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th>Patient ID</th>
                  <th>Office ID</th>
                  <th>Appointment status</th>
                  <th>Slotted Time</th>
                  <th>Specialist Status</th>
                  <th>Approve</th>
                  <th>Reject</th>
                </tr>
                <?php echo $APtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>

            <br> <br>

            <h2>Other Admins</h2>
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th scope="col">Office ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Phone number</th>
                  <th scope="col">Email</th>
                </tr>
                <?php echo $OtADtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>


            <br> <br>

            <h2>Doctors</h2>
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th>Office ID</th>
                  <th>Name</th>
                  <th>Specialty</th>
                  <th>Phone Number</th>
                </tr>
                <?php echo $DtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>

            <br> <br>

            


    

          </div>
        </div>

      </div>
    </div>
  </div>

  





  

     <!-- Footer-->

<script src="main.js"></script>
</body>

</html>