

<?php
session_start();

require_once "../php/config.php";


if(count($_POST) > 0)
{


    mysqli_query($db, "UPDATE DOCTOR SET Office_id= '".$_POST['Office_id'] . "' ,Name='".$_POST['Name'] . "' 
    , Speciality='".$_POST['Speciality'] . "' , Phone_number = '".$_POST['Phone_number'] . "'  WHERE Doctor_id= '".$_GET['update_Did'] . "'");
}
$id =$_GET['update_Did'];
$result = mysqli_query($db, "SELECT * FROM DOCTOR WHERE Doctor_id = '$id'");
$row = mysqli_fetch_array($result);
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

<?php include_once("../php/header.php"); ?>

<!-- End Header -->
<!-- ======= DataEntry Page ======= -->

<body>
    

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
    <h1 class="text-center" id="data-entry-header">Edit Form for Doctor</h1>
  </section>
  

<!-- ======= Doctor Section ======= -->

<section id="dataEntry">
<form action="" method="POST">
            <!--input taken for doctor-->
              <input type = "hidden" name = "id" class = "txtField" value = "<?php echo $row['Doctor_id']; ?>">
              <label for="OFFID">Office ID:</label>
              <input type="number" id="OFFID" name="OFFID" value = "<?php echo $row['Office_id']; ?>">
              <label for="SPType">Speciality:</label>
              <input type="text" id="SPType" name="SPType" maxlength = "30" value = "<?php echo $row['Specialist']; ?>"> 
              <label for="Dname">Name:</label>
              <input type="text" id="Dname" name="Dname" maxlength="20" value = "<?php echo $row['Name']; ?>">
              <br>
              <label for="DPWord">create password:</label>
              <input type="Password" id="DPWord" name="DPWord" value = "<?php echo $row['Password']; ?>">
              <label for="DPhoneNum">Phone Number:</label>
              <input type="text" id="DPhoneNum" name="DPhoneNum" maxlength="10" value = "<?php echo $row['Phone_Number']; ?>">    
              <!--Used to separate inputs-->
              <br>
              <button type="submit" class="btn btn-primary" name="SubmitD" value ="SubmitD">Submit</button>
            
  
</section>



<!-- End Of Data Entry -->



<!-- Footer-->


<script src="main.js"></script>
</body>

</html>