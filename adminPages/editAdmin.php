

<?php
session_start();

require_once "../php/config.php";


if(count($_POST) > 0)
{
      //Store input values
      $PName = $_POST['Pname'];
      $PPWord = $_POST['PPWord'];
      $PPhoneNum = $_POST['PPhoneNum'];
      $PEmail = $_POST['PEmail'];
      $PAge = $_POST['PAge'];

    mysqli_query($db, "UPDATE ADMIN SET Name='$PID' , Password='$PPWord' , Phone_number = '$PPhoneNum', Email = '$PEmail',
                 Age = '$PAge' WHERE Patient_id= '".$_GET['update_Did'] . "'");
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
    <h1 class="text-center" id="data-entry-header">Edit Form for Admin</h1>
  </section>
  

<!-- ======= Doctor Section ======= -->

<section id="dataEntry">
<form action="" method="POST">
            <!--input taken for doctor-->
              <input type = "hidden" name = "id" class = "txtField" value = "<?php echo $row['Patient_id']; ?>">
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
              </form>
            
  
</section>



<!-- End Of Data Entry -->



<!-- Footer-->


<script src="main.js"></script>
</body>

</html>