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
      $APtableResult .= "<td><a href='../adminPages/adminPage.php?reject_id=" . $row["Appointment_id"] . "'>X</a></td>";
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
     button
     {
       font-size: 20px;
       padding:10px;
       border-radius:10px;
       margin:20px;
     }
     #container
     {
       text-align: center;
     }
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

          </div>
        </div>

      </div>
    </div>
  </div>


  
  </body>


<!-- End signup -->

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
                  <th>Approve</th>
                  <th>Reject</th>
                </tr>
                <?php echo $APtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    
      </footer>
    </div>
  </div>
</section>
<!-- End Appointments-->


<!-- ======= Other Admins======= -->
<section id="AdminUsers">
  <div class="main-container">
    <div class="main-wrap">

      <div class="text-center" id="Admin-header">Other Admins</div>
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
                <?php echo $OtADtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>

          </div>
        </div>
      </div>

     
    </div>
  </div>
</section>
<!-- End of other Admins -->

<br> <br>

         <!-- Used to center container -->
         <div id = "container">
        <!--Used to redirect to data entry page -->
        <a href="dataEntryForm.php"> 
          <button id = "Redi1">Enter Data</button>
        </a>
        <!--Used to redirect to report page -->
        <a href="reportsForm.php"> 
          <button id = "Redi2">Reports</button>
        </a>
     </div>

     <!-- Footer-->

<script src="main.js"></script>
</body>

</html>