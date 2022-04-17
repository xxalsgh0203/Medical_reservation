<!-- 

Purpose: Display admin information and allow them to access reports, dataEntry page, and approve appointments

Implemented Features:
  Display logedin admin info
  Display appoitnments for doctor with same id as logged in admin
  Display all doctors
  Display all admins
  Button to dataEntryForm and reportsForm

TODO: 
  Move general display stuff to report page
  display appointments to approve with functioanlity to approve/not approve
  
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
  while($row = $result-> fetch_assoc()) {
    $tableResult .= "<tr>" . "<td>" . $row["Office_id"] . "</td><td>" . $row["Name"] . "</td><td>" . 
                    $row["Phone_number"] . "</td><td>" . $row["Email"] . "</td>" . "<tr>";
  }
}

//Query to retrieve appointments for doctor
$sql = "SELECT Patient_id, Office_id, Appointment_status_id, Slotted_time, Specialist_status FROM APPOINTMENT WHERE Doctor_id = '$id'";
$result = mysqli_query($db, $sql);

//table results for appointments
$APtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $APtableResult .= "<tr>". "<td>" . $row["Patient_id"] . "</td><td>"  . $row["Office_id"] . "</td><td>" .
                       $row["Appointment_status_id"] . "</td><td>" . $row["Slotted_time"] . "</td><td>" . $row["Specialist_status"] . "</td>" . "<tr>";
  }
}


//used to retrieve other doctors
$sql = "SELECT Office_id, Name, Speciality, Phone_number FROM DOCTOR";
$result = mysqli_query($db, $sql);

$DtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $DtableResult .= "<tr>". "<td>" . $row["Office_id"] . "</td><td>" . $row["Name"] . "</td><td>" . 
                      $row["Speciality"] . "</td><td>" . $row["Phone_number"] . "</td>" . "<tr>";
  }
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
   </style>
</head>

<?php include_once("../php/header.php"); ?>

<!-- End Header -->
<!-- ======= Admin Page ======= -->
<section id="AdminUsers">
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

      <footer>
        <div class="copyright-wrap">
        </div>
      </footer>
    </div>
  </div>


  <h2>hi hello</h2>
</section>


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
                  <th>Update</th>
                  <th>Delete</th>
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
                  <th>Phone Number</th>
                  <th>Update</th>
                  <th>Delete</th>
                </tr>
                <?php echo $DtableResult;?>
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
                  <th>Update</th>
                  <th>Delete</th>
                </tr>
                <?php echo $OtADtableResult;?>
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
<!-- End signup -->

    



<!-- Redirection buttons for Admin-->
  <body>
     <!-- Used to center container -->
     <div id = "container">
        <!--Used to redirect to data entry page -->
        <a href="dataEntryForm.php"> 
          <button id = "Redi1">Edit Data</button>
        </a>
        <!--Used to redirect to report page -->
        <a href="reportsForm.php"> 
          <button id = "Redi2">Reports</button>
        </a>
     </div>
  </body>

<!-- End of redirection-->

<!-- Footer-->
<?php include_once("../php/footer.php"); ?>

<script src="main.js"></script>
</body>

</html>

<!--
"</td><td>" . $row["Specialist_status"] . "</td><td> 
    <a href='../doctorPage.php?delete_id=" . $row["Appointment_id"] . "'>X</a>
    </td>" -->