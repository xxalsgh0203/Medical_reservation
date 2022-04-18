

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

    mysqli_query($db, "UPDATE PATIENT SET Name='$PID' , Password='$PPWord' , Phone_number = '$PPhoneNum', Email = '$PEmail',
                 Age = '$PAge' WHERE Patient_id= '".$_GET['update_Pid'] . "'");
}
$id =$_GET['update_Did'];
$result = mysqli_query($db, "SELECT * FROM PATIENT WHERE Patient_id = '$id'");
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
    <h1 class="text-center" id="data-entry-header">Edit Form for Patient</h1>
  </section>
  

<!-- ======= Doctor Section ======= -->

<section id="dataEntry">
<form action="" method="POST">
            <!--input taken for doctor-->
              <input type = "hidden" name = "id" class = "txtField" value = "<?php echo $row['Patient_id']; ?>">
              <label for="Pname">Name:</label>
              <input type="text" id="Pname" name="Pname" maxlength="20">
              <label for="PPWord">create password:</label>
              <input type="text" id="PPWord" name="PPWord">
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