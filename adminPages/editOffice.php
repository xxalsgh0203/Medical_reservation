<?php
session_start();

require_once "../php/config.php";
if(count($_POST) > 0)
{
      //Store input values
    $id =$_GET['update_Oid'];
    $OAddress = $_POST['OAddress'];
    $OCity = $_POST['OCity'];
    $State = $_POST['OState'];
    $OPhone_num = $_POST['OPhone_num'];
    $Open_time = $_POST['startTime'];
    $Close_time = $_POST['endTime'];


    mysqli_query($db, "UPDATE OFFICE SET Address= '$OAddress' , State='$State' , Phone_number = '$OPhone_num', City = '$OCity',
                 Open_time = '$Open_time', Close_time ='$Close_time' WHERE Office_id= '$id'");



}

$id =$_GET['update_Oid'];
$result = mysqli_query($db, "SELECT * FROM OFFICE WHERE Office_id = '$id'");
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

<nav class="floating-menu">
     
        <a href="officeDataEntry.php">
            <div>
                Office Data Entry Page
            </div>
        </a>
    </nav>


<?php include_once("../php/header.php"); ?>

<!-- End Header -->
<!-- ======= DataEntry Page ======= -->

<body>
    


  <!-- Header of the page-->
  <section>
    <br><br>
    <h1 class="text-center" id="data-entry-header">Edit Form for Office</h1>
  </section>
  

<!-- ======= Doctor Section ======= -->

<section id="dataEntry">
<form action="" method="POST">
            <!--input taken for doctor-->
              <label for="OAddress">Address:</label>
              <input type="text" id="OAddress" name="OAddress" maxlength="20" value = "<?php echo $row['Address']; ?>" required>
              <label for="OState">State:</label>
              <input type="text" id="OState" name="OState" maxlength="15" value = "<?php echo $row['State']; ?>" required>
              <label for="OCity">City:</label>
              <input type="text" id="OCity" name="OCity"  maxlength="15" value = "<?php echo $row['City']; ?>" required>
              <br><!-- still editing right here--------------------------------------->
              <label for="OPhone_num">Phone Number:</label>
              <input type="text" id="OPhone_num" name="OPhone_num" maxlength="10" value = "<?php echo $row['Phone_number']; ?>" required>
              <label for="startTime">Start time: </label>
              <input type="time" id="startTime" name= "startTime" value = "<?php echo $row['Open_time']; ?>" required>   
              <label for="endTime">End time: </label>
              <input type="time" id="endTime" name= "endTime" value = "<?php echo $row['Close_time']; ?>" required>  
              <!--Used to separate inputs-->
              <br>
              <button type="submit" class="btn btn-primary" name="SubmitO" id="SubmitO">Submit</button>
              </form>
            
  
</section>



<!-- End Of Data Entry -->



<!-- Footer-->


<script src="main.js"></script>
</body>

</html>