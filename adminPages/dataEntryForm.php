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
/*
if($_SERVER["REQUEST_METHOD"] == "POST")
{
 $sql = ""
} */

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
  </style>
</head>

<?php include_once("../php/header.php"); ?>

<!-- End Header -->
<!-- ======= DataEntry Page ======= -->
<section id="signup">

<!-- Header of the page-->
<h1>Data Entry Form</h1>

<form action="">
  <h2>  <b>Add Doctor</b>  </h2>
  <label for="OFFID">Office ID:</label>
  <input type="number" id="OFFID" name="OFFID">
  <label for="Inoffice">Days in office:</label>
  <input type="text" id="Inoffice" name="Inoffice" maxlength="10">
  <label for="SPType">Speciality:</label>
  <input type="text" id="SPType" name="SPType" maxlength = "30"> 
  <br>
  <label for="Dname">Name:</label>
  <input type="text" id="Dname" name="Dname" maxlength="20">
  <label for="DPWord">create password:</label>
  <input type="text" id="DPWord" name="DPWord">
  <label for="DPhoneNum">Phone Number:</label>
  <input type="text" id="DPhoneNum" name="DPhoneNum" maxlength="10">    
  <!--Used to separate inputs-->
  <br>
  <input type="submit" value="Submit">

  <br>  <br>
 
  <h2>  <b>Add Admin</b>  </h2>
  <label for="ADOFFID">Office ID:</label>
  <input type="number" id="ADOFFID" name="ADOFFID">
  <label for="Inoffice">Days in office:</label>
  <label for="ADname">Name:</label>
  <input type="text" id="ADname" name="ADname" maxlength="20">
  <br>
  <label for="ADPWord">create password:</label>
  <input type="text" id="ADPWord" name="ADPWord">
  <label for="DPhoneNum">Phone Number:</label>
  <input type="text" id="ADPhoneNum" name="ADPhoneNum" maxlength="10"> 
  <label for="ADEmail">Email:</label>
  <input type="text" id="ADEmail" name="ADEmail" maxlength="30">   
  <!--Used to separate inputs-->
  <br>
  <input type="submit" value="Submit">



</form>

</section>



<!-- End Of Data Entry -->



<!-- Footer-->
<?php include_once("../php/footer.php"); ?>

<script src="main.js"></script>
</body>

</html>