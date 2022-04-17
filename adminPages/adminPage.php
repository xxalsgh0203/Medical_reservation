<!-- 

Purpose: Display admin information and allow them to access reports, dataEntry page, and approve appointments

Implemented Features:
  Display logedin admin info
  Display appoitnments for doctor with same id as logged in admin
  Display all doctors
  Display all admins
  display all patients
  Button to dataEntryForm and reportsForm

TODO: 
  Move general display stuff to report page
  
 -->


<?php
session_start();

require_once "../php/config.php";
 

// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}

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

//Query to retrieve appointments for doctor
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


//used to retrieve other doctors
$sql = "SELECT Office_id, Name, Speciality, Phone_number, Doctor_id FROM DOCTOR";
$result = mysqli_query($db, $sql);

$DtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $DtableResult .= "<tr>". "<td>" . $row["Office_id"] . "</td><td>" . $row["Name"] . "</td><td>" . 
                      $row["Speciality"] . "</td> <td>" . $row["Phone_number"] . "</td>" . "</td><td> 
                      <a href='../adminPages/adminPage.php?update_Did=" . $row["Doctor_id"]  . "'>Update</a> </td>" . "</td><td> <a href='../adminPages/adminPage.php?delete_Did=" . $row["Doctor_id"] . "'>Delete</a>
                                           </td>" .  "</tr>";
  }
}

//used when the delete hyperlink is pressed
if (isset($_GET['delete_Did'])) {
  $id = $_GET['delete_Did'];

 mysqli_query($db, "DELETE FROM DOCTOR WHERE Doctor_id = " . $id);
header('location: adminPage.php');

}

/*used when the update link is pressed
if (isset($_GET['update_Did'])) {
  $id = $_GET['update_Did'];
  $result =  $db->query("SELECT * FROM DOCTOR WHERE Doctor_id = $id");
  if (count($result) == 1)
  {
    
  }

header('location: adminPage.php');
}*/

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

//Retrieve patients based on assigned office
$sql = "SELECT Name, Phone_number, Email , Age, Medical_allergy, Specialist_approved, Patient_id FROM PATIENT";
$result = mysqli_query($db, $sql);

$PtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $PtableResult .= "<tr>" . "<td>" . $row["Name"] . "</td><td>" . $row["Phone_number"] . "</td><td>" . 
                    $row["Email"] . "</td><td>" . $row["Age"] . "</td>" . "</td><td>" . $row["Medical_allergy"] . "</td>" .  "</td><td>" . $row["Specialist_approved"] . "</td>" .
                     "</td><td> <a href='../adminPages/adminPage.php?update_Pid=" . $row["Patient_id"]  . "'>Update</a> </td>" . "</td><td> <a href='../adminPages/adminPage.php?delete_Pid=" . 
                     $row["Patient_id"] . "'>Delete</a> </td>"  . "<tr>";
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

<!-- End Header -->



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
                  <th>update</th>
                  <th>delete</th>
                </tr>
                <?php echo $DtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>

          </div>
        </div>
      </div>
            <!--Update Doctor info-->
            <h1> Update Doctor info: </h1>
            <label for="UOFFID">Office ID:</label>
            <input type="number" id="UOFFID" name="UOFFID">
            <label for="USPType">Speciality:</label>
            <input type="text" id="USPType" name="USPType" maxlength = "30"> 
            <label for="UDname">Name:</label>
            <input type="text" id="UDname" name="UDname" maxlength="20">
            <br>
            <label for="UDPWord">change password:</label>
            <input type="Password" id="UDPWord" name="UDPWord">
            <label for="UDPhoneNum">Phone Number:</label>
            <input type="text" id="UDPhoneNum" name="UDPhoneNum" maxlength="10">
            <br>
            <button type="submit" class="btn btn-primary" name="USubmitD">Submit</button>
      
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
                </tr>
                <?php echo $OtADtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>

          </div>
        </div>
      </div>

          <!--Update Admin info-->
          <h1> Update Admin info: </h1>
            <label for="UOFFIAD">Office ID:</label>
            <input type="number" id="UOFFIAD" name="UOFFIAD">
            <label for="UDname">Name:</label>
            <input type="text" id="UADname" name="UADname" maxlength="20">
            <br>
            <label for="UADPhoneNum">Phone Number:</label>
            <input type="text" id="UADPhoneNum" name="UADPhoneNum" maxlength="10">
            <label for="UADEmail">Email:</label>
            <input type="text" id="UADEmail" name="UADEmail" maxlength="254">
            <br>
            <button type="submit" class="btn btn-primary" name="USubmitAD">Submit</button>
    </div>
  </div>
</section>
<!-- End of other Admins -->

<!-- Patients -->
<section id="Patient">
  <div class="main-container">
    <div class="main-wrap">

      <div class="text-center" id="PatientT"></div>
      <h1>Patients</h1>
      <div class="container-fluid">
        <div class="row justify-content-center my-5">
          <div class="col-100">
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Phone Number</th>
                  <th scope="col">Email</th>
                  <th scope="col">Age</th>
                  <th scope="col">Medical allergy</th>
                  <th scope="col">Specialist approved</th>
                  <th scope="col">Update</th>
                  <th scope="col">Delete</th>
                </tr>
                <?php echo $PtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>

          </div>
        </div>
      </div>

     <!-- Handles patient updates-->
  <h2>  <b>Update patient info:</b>  </h2>
  <label for="PPname">Primary physician:</label>
  <input type="text" id="PPname" name="PPname">
  <label for="name">Patient Name:</label>
  <input type="text" id="name" name="name" maxlength="20"> 
  <br>
  <label for="PPWord">Update password:</label>
  <input type="text" id="PPWord" name="PPWord">
  <label for="SPApproved">Specialist approval:</label>
  <input type="number" id="AprNum" name="AprNum"> 
  <br>
  <label for="PhoneNum">Phone Number:</label>
  <input type="text" id="AprNum" name="AprNum" maxlength="10">    
  <!--Used to separate inputs-->
  <br>
  <button type="submit" class="btn btn-primary" name="USubmitP">Submit</button>


     <footer>
        <div class="copyright-wrap">
        </div>
      </footer>
    </div>
  </div>
</section>
<!-- End of Patients -->
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


<!-- End of redirection-->

<!-- Footer-->
<?php include_once("../php/footer.php"); ?>

<script src="main.js"></script>
</body>

</html>

<!--
"</td><td> 
  <a href='../adminPage.php?edit=" . $row["Doctor_id"]  . "'>Update</a> </td>" . "</td><td> <a href='../adminPage.php?delete_id=" . $row["Doctor_id"] . "'>Delete</a>
                       </td>" -->

