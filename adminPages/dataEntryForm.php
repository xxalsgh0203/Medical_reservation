<!-- 

Purpose: Allow admin to enter data into database

Implemented Features:
  form to add doctor
  form to add admin

TODO: 
  form to add patient
  add backend to all forms

 -->
 
 <?php
session_start();

require_once "../php/config.php";


//------------------------------used to retrieve other doctors------------------------------------
$sql = "SELECT Office_id, Name, Speciality, Phone_number, Doctor_id FROM DOCTOR";
$result = mysqli_query($db, $sql);

$DtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $DtableResult .= "<tr>". "<td>" . $row["Office_id"] . "</td><td>" . $row["Name"] . "</td><td>" . 
                      $row["Speciality"] . "</td> <td>" . $row["Phone_number"] . "</td>" . "</td><td> 
                      <a href='../adminPages/editDoctor.php?update_Did=" . $row["Doctor_id"]  . "'>edit</a> </td>" . "</td><td> <a href='../adminPages/dataEntryForm.php?delete_Did=" . $row["Doctor_id"] . "'>Delete</a>
                                           </td>" .  "</tr>";
  }
}

//used when the delete hyperlink is pressed
if (isset($_GET['delete_Did'])) {
  $id = $_GET['delete_Did'];

 mysqli_query($db, "DELETE FROM DOCTOR WHERE Doctor_id = " . $id);
header('location:dataEntryForm.php');

}

//used when the delete hyperlink is pressed
if (isset($_GET['delete_Did'])) {
  $id = $_GET['delete_Did'];

 mysqli_query($db, "DELETE FROM DOCTOR WHERE Doctor_id = " . $id);
header('location:dataEntryForm.php');

}

$update = false;
$id = 1;
if (isset($_GET['update_Did'])) {
  $id = $_GET['update_Did'];
  $update = true;
  $Eresult = $db->query("Select * FROM DOCTOR WHERE Doctor_id = $id");

  if($Eresult->num_rows == 1)
  {
    $row = $Eresult->fetch_array();
    $OFFID =  $row['OFFID'];
    $DName = $row['Dname'];
    $SPType = $row['SPType'];
    $DPWord = $row['DPWord'];
    $DPhoneNum = $row['DPhoneNum'];
  }


header('location:dataEntryForm.php');

}


if (isset($_POST['USubmitD']))
{
  $ID = $_POST['id'];
  $Off_id = $_POST['OFFID'];
  $dname = $_POST['Dname'];
  $Speciality = $_POST[''];



  $db->query("UPDATE DOCTOR SET Office_id='$Off_id',Name='$dname', Speciality='$Speciality' , Phone_number = '$PhoneNum' WHERE Doctor_id=$id");



header('location:dataEntryForm.php');

}


//Takes in input for doctor from SubmitD
if (isset($_POST['SubmitD']))
{

    $OFFID =  $_POST['OFFID'];
    $DName = $_POST['Dname'];
    $SPType = $_POST['SPType'];
    $DPWord = $_POST['DPWord'];
    $DPhoneNum = $_POST['DPhoneNum'];

    //Used to insert data into doctor
    $db->query("INSERT INTO DOCTOR (Office_id,  Name, Speciality, Password, Phone_number) 
                    VALUES ('$OFFID', '$DName', '$SPType', '$DPWord', '$DPhoneNum')")  or die($db->error); 

  
    header("location:dataEntryForm.php");

}


/*---------------------------to retrieve  admins------------------------------------------------*/
$sql = "SELECT * FROM ADMIN";
$result = mysqli_query($db, $sql);

$OtADtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $OtADtableResult .= "<tr>". "<td>" . $row["Office_id"] . "</td><td>" . $row["Name"] . "</td><td>" . 
                          $row["Phone_number"] . "</td><td>" . $row["Email"] . "</td>" . "</td><td> 
                          <a href='../adminPages/editAdmin.php?update_ADid=" . $row["Admin_id"]  . "'>edit</a> </td>" . "</td><td> <a href='../adminPages/dataEntryForm.php?delete_ADid=" . $row["Admin_id"] . "'>Delete</a>
                                               </td>"."<tr>";
  }
 
}


//Takes in input for Admin from submitAD
if (isset($_POST['SubmitAD']))
{
  //Store input values
    $ADOFFID =  $_POST['ADOFFID'];
    $ADName = $_POST['ADname'];
    $ADPWord = $_POST['ADPWord'];
    $ADPhoneNum = $_POST['ADPhoneNum'];
    $ADEmail = $_POST['ADEmail'];

    //Used to insert data into admin
    $db->query("INSERT INTO ADMIN (Office_id,  Name, Password, Phone_number, Email) 
                    VALUES ('$ADOFFID', '$ADName', '$ADPWord', '$ADPhoneNum', '$ADEmail')")  or die($db->error); 

   
    header("location:dataEntryForm.php");

}



//----------------------------------------Retrieve patients----------------------------------
$sql = "SELECT Name, Phone_number, Email , Age, Medical_allergy, Specialist_approved, Patient_id FROM PATIENT";
$result = mysqli_query($db, $sql);

$PtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $PtableResult .= "<tr>" . "<td>" . $row["Name"] . "</td><td>" . $row["Phone_number"] . "</td><td>" . 
                    $row["Email"] . "</td><td>" . $row["Age"] . "</td>" . "</td><td>" . $row["Medical_allergy"] . "</td>" .
                     "</td><td> <a href='../adminPages/editPatient.php?update_Pid=" . $row["Patient_id"]  . "'>edit</a> </td>" . "</td><td> <a href='../adminPages/dataEntryForm.php?delete_Pid=" . 
                     $row["Patient_id"] . "'>Delete</a> </td>"  . "<tr>";
  }
}



//Takes in input for Admin from submitP
if (isset($_POST['SubmitP']))
{
  //Store input values
    $PID =  $_POST['PID'];
    $PName = $_POST['Pname'];
    $PPWord = $_POST['PPWord'];
    $PPhoneNum = $_POST['PPhoneNum'];
    $PEmail = $_POST['PEmail'];
    $PAge = $_POST['PAge'];

    //Used to insert data into admin
    $db->query("INSERT INTO PATIENT (Name, Password, Phone_number, Email, Age) 
                    VALUES ('$PName', '$PPWord', '$PPhoneNum', '$PEmail', '$PAge')")  or die($db->error); 

   
    header("location:dataEntryForm.php");

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

 
    <style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

table.center {
  margin-left: auto; 
  margin-right: auto;
}

</style>
</head>

<?php include_once("../php/header.php"); ?>

<!-- End Header -->
<!-- ======= DataEntry Page ======= -->


<!-- Pick a specific table 
<body>
  <br>
  <div>
  <label for="TableID"> <b>Select table to View:</b> </label>
  <input type="text" id="TableID" name="TableID">
  <button type="submit" class="btn btn-primary" name="SubmitTID">Submit</button>
  </div>
</body> -->

  <!-- Header of the page-->
  <section>
    <br><br>
    <h1 class="text-center" id="data-entry-header">Data Entry Form</h1>
  </section>
  

<!-- ======= Doctor Section ======= -->

<section id="dataEntry">
      <h1>Doctors</h1>
    
      <table  class = "center" border="6" >
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
  

      <form action="" method="POST">
            <!--input taken for doctor-->
              <h2>  Doctor info:  </h2>
              <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
              <label for="OFFID">Office ID:</label>
              <input type="number" id="OFFID" name="OFFID">
              <label for="SPType">Speciality:</label>
              <input type="text" id="SPType" name="SPType" maxlength = "30"> 
              <label for="Dname">Name:</label>
              <input type="text" id="Dname" name="Dname" maxlength="20">
              <br>
              <label for="DPWord">create password:</label>
              <input type="Password" id="DPWord" name="DPWord">
              <label for="DPhoneNum">Phone Number:</label>
              <input type="text" id="DPhoneNum" name="DPhoneNum" maxlength="10">    
              <!--Used to separate inputs-->
              <br>
              <?php
              if ($update == true):
              ?>
                <button type="submit" class="btn btn-info" name="SubmitD">Update</button>
               <?php else: ?>
              <button type="submit" class="btn btn-primary" name="SubmitD">Submit</button>
              <?php endif; ?>
              

            <br><br><br> <br><br><br> <br><br><br>
            <h1>Admin</h1>
            <table  class = "center" border="6">
              <thead class="thead">
                <tr>
                  <th scope="col">Office ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Phone number</th>
                  <th scope="col">Email</th>
                  <th scope="col">update</th>
                  <th scope="col">delete</th>
                </tr>
                <?php echo $OtADtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>
            <!--input taken for admin -->
              <h2>  Admin info:  </h2>
              <label for="ADOFFID">Office ID:</label>
              <input type="number" id="ADOFFID" name="ADOFFID">
              <label for="ADname">Name:</label>
              <input type="text" id="ADname" name="ADname" maxlength="20">
              <label for="ADPWord">create password:</label>
              <input type="Password" id="ADPWord" name="ADPWord">
              <br>
              <label for="ADPhoneNum">Phone Number:</label>
              <input type="text" id="ADPhoneNum" name="ADPhoneNum" maxlength="10"> 
              <label for="ADEmail">Email:</label>
              <input type="text" id="ADEmail" name="ADEmail" maxlength="30">   
              <!--Used to separate inputs-->
              <br>
              <button type="submit" class="btn btn-primary" name="SubmitAD">Submit</button>
              </form>




</section>



<section id="dataEntry">

<form action="" method="POST">
<br><br><br>
              <h1>Patient</h1>
              <table  class = "center" border="6">
              <thead class="thead">
                <tr>
                  <th>Name</th>
                  <th>Phone Number</th>
                  <th>Email</th>
                  <th>Age</th>
                  <th>Medical Allergy</th>
                  <th>edit</th>
                  <th>delete</th>
                </tr>
                <?php echo $PtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>
              <!-- Input taken for Patient -->
              <h2> Patient info:  </h2>
              <label for="Pname">Name:</label>
              <input type="text" id="Pname" name="Pname" maxlength="20">
              <label for="PPWord">create password:</label>
              <input type="Password" id="PPWord" name="PPWord">
              <label for="PAge">Age:</label>
              <input type="number" id="PAge" name="PAge">
              <br>
              <label for="PPhoneNum">Phone Number:</label>
              <input type="text" id="PPhoneNum" name="PPhoneNum" maxlength="10"> 
              <label for="PEmail">Email:</label>
              <input type="text" id="PEmail" name="PEmail" maxlength="30">   
              <!--Used to separate inputs-->
              <br>
              <button type="submit" class="btn btn-primary" name="SubmitP" id="dataentrysubmitbtn">Submit</button>
              </form>
  
</section>



<!-- End Of Data Entry -->



<!-- Footer-->


<script src="main.js"></script>
</body>

</html>