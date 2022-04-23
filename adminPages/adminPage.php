<?php
session_start();

require_once "../php/config.php";


//Current admin log in info
$id = $_SESSION["id"];
$sql = "SELECT O.Address, O.City, O.State, A.Name, A.Phone_number, A.Email FROM ADMIN AS A lEFT JOIN OFFICE AS O ON A.Office_id = O.Office_id WHERE Admin_id = '$id'";
$result = mysqli_query($db, $sql);

$tableResult = "";
if ($result->num_rows > 0) {
  $tableResult .= "<tr>
                    <th colspan='3'>Office Information</th>
                    <th colspan='3'>Personal Information</th>
                  </tr>";
  $tableResult .= "<tr>
                    <th scope='col'>Address</th>
                    <th scope='col'>City</th>
                    <th scope='col'>State</th>
                    <th scope='col'>Name</th>
                    <th scope='col'>Phone number</th>
                    <th scope='col'>Email</th>
                  </tr>";
  while($row = $result-> fetch_assoc()) {
    $tableResult .= "<tr>" . "<td>" . $row["Address"] . "</td><td>" . $row["City"] . "</td><td>" . 
                    $row["State"] . "</td><td>" . 
                    $row["Name"] . "</td><td>" . 
                    $row["Phone_number"] . "</td><td>" . $row["Email"] . "</td>" . "</tr>";
  }
}

//Query to retrieve appointments for doctors
$sql = " SELECT P.Name AS Patient_name, D.Name AS Doctor_name, A.Appointment_id, A.Date, A.Slotted_time, O.City, O.State, A.Appointment_status, Specialist_status FROM APPOINTMENT AS A
LEFt JOIN OFFICE AS O ON A.Office_id = O.Office_id
LEFT JOIN PATIENT AS P ON P.Patient_id = A.Patient_id
LEFT JOIN DOCTOR AS D ON D.Doctor_id = A.Doctor_id
ORDER BY Appointment_status='rejected', Appointment_status='canceled', Appointment_status='approved', Appointment_status='pending';";
$result = mysqli_query($db, $sql);

//table results for appointments
$APtableResult = "";
if ($result->num_rows > 0) {
  $APtableResult = "<tr>
                      <th>Patient Name</th>
                      <th>Doctor Name</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>City</th>
                      <th>State</th>
                      <th>Specialist required?</th>
                      <th>Status</th>
                      <th>Approve</th>
                      <th>Reject</th>
                    </tr>";
  while($row = $result-> fetch_assoc()) {
    $approved = 'No';
    if ($row['Specialist_status'] == 1) {
      $approved = 'Yes';
    }
    $APtableResult .= "<tr>". "<td>" . $row["Patient_name"] . "</td><td>"  . $row["Doctor_name"] . "</td><td>"
    . $row["Date"] . "</td><td>"
    . $row["Slotted_time"] . "</td><td>"
    . $row["City"] . "</td><td>"
    . $row["State"] . "</td><td>" .
                       $approved . "</td><td>" . $row["Appointment_status"] . "</td>";
                       
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
$sql = "SELECT Name, A.Phone_number AS Admin_number, Email, Address, O.Phone_number AS Office_number FROM ADMIN AS A
LEFT JOIN OFFICE AS O ON A.Office_id = O.Office_id;";
$result = mysqli_query($db, $sql);

$OtADtableResult = "";
if ($result->num_rows > 0) {
  $OtADtableResult = "<tr>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Email</th>
                        <th>Work Address</th>
                        <th>Work Number</th>
                      </tr>";
  while($row = $result-> fetch_assoc()) {
    $OtADtableResult .= "<tr>". "<td>" . $row["Name"] . "</td><td>" . 
                          $row["Admin_number"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["Address"] . "</td><td>" . $row["Office_number"] . "</td>" . "<tr>";
  }
 
}

//-------------------------Retrieve table for doctors-------------->
$sql = "SELECT Name, D.Name, D.Phone_number AS Doctor_number, D.Speciality, O.Address, O.Phone_number AS Office_number FROM DOCTOR AS D
LEFT JOIN OFFICE AS O ON D.Office_id = O.Office_id;";
$result = mysqli_query($db, $sql);

$DtableResult = "";
if ($result->num_rows > 0) {
  $DtableResult = "<tr>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Speciality</th>
                        <th>Work Address</th>
                        <th>Work Number</th>
                      </tr>";
  while($row = $result-> fetch_assoc()) {
    $spec = $row['Speciality'];
    if (is_null($row['Speciality'])) {
      $spec = "Regular";
    }
    $DtableResult .= "</tr>" . "<td>" . $row["Name"] . "</td><td>" . $row["Doctor_number"] . "</td><td>" . $spec . "</td><td>" . $row["Address"] . "</td><td>" . $row["Office_number"] . "</td>" . "</tr>";
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
        <br>
        <a href="adminDataEntry.php">
            <div>
                Admin Data Entry Page
            </div>
        </a>
        <br>
        <a href="patientDataEntry.php">
            <div>
                Patient Data Entry Page
            </div>
        </a>
        <br> 
        </a>
        <a href="SpecialistApproval.php">
            <div>
                Specialist Approval Page
            </div>
        </a> 
        <br>
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
                <?php echo $tableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>

            <br> <br>

            <h2>Appointments</h2>
            <table class="table table-bordered">
              <thead class="thead">
                <?php echo $APtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>

            <br> <br>

            <h2>Other Admins</h2>
            <table class="table table-bordered">
              <thead class="thead">
                <?php echo $OtADtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>


            <br> <br>

            <h2>Doctors</h2>
            <table class="table table-bordered">
              <thead class="thead">
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