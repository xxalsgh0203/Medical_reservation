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

<section id="dataEntry">
  <form action="" method="POST">
            <!--input taken for doctor-->
              <h2>  Add Doctor  </h2>
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
            <!--input taken for admin -->
              <h2>  Add Admin  </h2>
              <label for="ADOFFID">Office ID:</label>
              <input type="number" id="ADOFFID" name="ADOFFID">
              <label for="ADname">Name:</label>
              <input type="text" id="ADname" name="ADname" maxlength="20">
              <label for="ADPWord">create password:</label>
              <input type="text" id="ADPWord" name="ADPWord">
              <br>
              <label for="ADPhoneNum">Phone Number:</label>
              <input type="text" id="ADPhoneNum" name="ADPhoneNum" maxlength="10"> 
              <label for="ADEmail">Email:</label>
              <input type="text" id="ADEmail" name="ADEmail" maxlength="30">   
              <!--Used to separate inputs-->
              <br>
              <button type="submit" class="btn btn-primary" name="SubmitAD">Submit</button>

              <br>  <br>
              <!-- Input taken for Patient -->
              <h2>  Add Patient  </h2>
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



              <br><br><br>
              <!--Update row by unique identifier-->
              <h3> <b>Update Doctor info:</b> </h3>
              <label for="DPhoneID">Identify Row to Edit:</label>
              <input type="text" id="DPhoneID" name ="DPhoneID" maxlength="10">
              <br>
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

              <br><br><br>
              <!--Delete doctor row -->
              <h3> <b>Delete Doctor row:</b> </h3>
              <label for="DPhoneID">Identify Row to Edit:</label>
              <input type="text" id="DPhoneID" name ="DPhoneID" maxlength="10">
              <br>
              <button type="submit" class="btn btn-primary" name="DelSubmitD">Delete</button>
  </form>
</section>



<!-- End Of Data Entry -->



<!-- Footer-->
<?php include_once("../php/footer.php"); ?>

<script src="main.js"></script>
</body>

</html>