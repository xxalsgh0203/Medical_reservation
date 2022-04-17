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



}

$chosenTable = "";

if(isset($_POST['SubmitTID']))
{
  $TableID = $_POST['TableID'];

  if ($TableID == "DOCTOR")
  {
    //used to retrieve other doctors
    $sql = "SELECT Office_id, Name, Speciality, Phone_number FROM DOCTOR";
    $result = mysqli_query($db, $sql);

    if ($result->num_rows > 0) {
      while($row = $result-> fetch_assoc()) {
        $chosenTable .= "<tr>". "<td>" . $row["Office_id"] . "</td><td>" . $row["Name"] . "</td><td>" . 
                          $row["Speciality"] . "</td><td>" . $row["Phone_number"] . "</td>" . "<tr>";
      }
    }
  }
  
  if ($TableID == "ADMIN")
  {
    /*to retrieve admins*/
    $sql = "SELECT * FROM ADMIN";
    $result = mysqli_query($db, $sql);

    if ($result->num_rows > 0) {
      while($row = $result-> fetch_assoc()) {
        $chosenTable .= "<tr>". "<td>" . $row["Office_id"] . "</td><td>" . $row["Name"] . "</td><td>" . 
                              $row["Phone_number"] . "</td><td>" . $row["Email"] . "</td>" . "<tr>";
      }
    
    }
  }

  if ($TableID == "PATIENT")
  {
    //used to store patient table
    $sql = "SELECT * FROM PATIENT ";
    $result = mysqli_query($db, $sql);
    
    if ($result->num_rows > 0) {
      while($row = $result-> fetch_assoc()) {
        $chosenTable .= "<tr>" ."<td>" . $row["Primary_physician_id"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["Phone_number"] 
                        . "</td><td>" . $row["Email"] . "</td><td>" . $row["Age"] . "</td><td>" . $row["Medical_allergy"] . "</td>" . "<tr>";
      }
    }
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

 
  <style>
     /* Used to center the title*/
    h1 {text-align: center;}
  /* used to center inputs*/
    form { 
          margin: 0 auto; 
          width:1000px;
          }

    div
    {
    margin: 0px auto;
    width:300px;
    }
  </style>
</head>

<?php include_once("../php/header.php"); ?>

<!-- End Header -->
<!-- ======= DataEntry Page ======= -->

<!-- Header of the page-->
<h1>Data Entry Form</h1>

<!-- Pick a specific table -->
<body>
  <br>
  <div>
  <label for="TableID"> <b>Select table to View:</b> </label>
  <input type="text" id="TableID" name="TableID">
  <button type="submit" class="btn btn-primary" name="SubmitTID">Submit</button>
  </div>
</body>

<section id="signup">


<form action="" method="POST">
          
            <h2>  <b>Add Doctor</b>  </h2>
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
            <button type="submit" class="btn btn-primary" name="SubmitD">Submit</button>

            <br>  <br>
          
            <h2>  <b>Add Admin</b>  </h2>
            <label for="ADOFFID">Office ID:</label>
            <input type="number" id="ADOFFID" name="ADOFFID">
            <label for="ADname">Name:</label>
            <input type="text" id="ADname" name="ADname" maxlength="20">
            <label for="ADPWord">create password:</label>
            <input type="text" id="ADPWord" name="ADPWord">
            <br>
            <label for="DPhoneNum">Phone Number:</label>
            <input type="text" id="ADPhoneNum" name="ADPhoneNum" maxlength="10"> 
            <label for="ADEmail">Email:</label>
            <input type="text" id="ADEmail" name="ADEmail" maxlength="30">   
            <!--Used to separate inputs-->
            <br>
            <button type="submit" class="btn btn-primary" name="SubmitAD">Submit</button>

             <br>  <br>
          
            <h2>  <b>Add Patient</b>  </h2>
            <label for="ADOFFID">Office ID:</label>
            <input type="number" id="ADOFFID" name="ADOFFID">
            <label for="ADname">Name:</label>
            <input type="text" id="ADname" name="ADname" maxlength="20">
            <label for="ADPWord">create password:</label>
            <input type="text" id="ADPWord" name="ADPWord">
            <br>
            <label for="DPhoneNum">Phone Number:</label>
            <input type="text" id="ADPhoneNum" name="ADPhoneNum" maxlength="10"> 
            <label for="ADEmail">Email:</label>
            <input type="text" id="ADEmail" name="ADEmail" maxlength="30">   
            <!--Used to separate inputs-->
            <br>
            <button type="submit" class="btn btn-primary" name="SubmitAD">Submit</button>

</form>

</section>



<!-- End Of Data Entry -->



<!-- Footer-->
<?php include_once("../php/footer.php"); ?>

<script src="main.js"></script>
</body>

</html>