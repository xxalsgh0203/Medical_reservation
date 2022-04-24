

<?php
session_start();

require_once "../php/config.php";

//----------------------------------------Retrieve Office Table----------------------------------
$sql = "SELECT * FROM OFFICE";
$result = mysqli_query($db, $sql);

$OtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $OtableResult .= "<tr>" . "<td>" . $row["Office_id"] . "</td><td>" .  $row["Address"]. "</td><td>" . $row["State"] . "</td><td>" 
                    . $row["City"] . "</td><td>" . $row["Phone_number"] . "</td>" . "</td><td>" . $row["Open_time"] . "</td>" 
                    . "</td><td>" . $row["Close_time"] . "</td>" . "<tr>";
  }
}

//record update for admin
if(count($_POST) > 0)
{
  //Store input values
  $ADOFFID =  $_POST['ADOFFID'];
  $ADName = $_POST['ADname'];
  $ADPWord = $_POST['ADPWord'];
  $ADPhoneNum = $_POST['ADPhoneNum'];
  $ADEmail = $_POST['ADEmail'];
  $id =$_GET['update_ADid'];
    mysqli_query($db, "UPDATE ADMIN SET Office_id='$ADOFFID' , Name='$ADName' , Password = '$ADPWord', Phone_number = '$ADPhoneNum',
                 Email = '$ADEmail' WHERE Admin_id= '$id'");
}
$id =$_GET['update_ADid'];
$result = mysqli_query($db, "SELECT * FROM ADMIN WHERE Admin_id = '$id'");
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

<nav class="floating-menu">
     
        <a href="adminDataEntry.php">
            <div>
                Admin Data Entry Page
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
    <h1 class="text-center" id="data-entry-header">Edit Form for Admin</h1>
  </section>
  

<!-- ======= Doctor Section ======= -->

<section id="dataEntry">
<form action="" method="POST">
            <!--input taken for doctor-->
              
              <label for="ADOFFID">Office ID:</label>
              <input type="number" id="ADOFFID" name="ADOFFID" value = "<?php echo $row['Office_id']; ?>">
              <label for="ADname">Name:</label>
              <input type="text" id="ADname" name="ADname" maxlength="20" value = "<?php echo $row['Name']; ?>">
              <label for="ADPWord">create password:</label>
              <input type="text" id="ADPWord" name="ADPWord" value = "<?php echo $row['Password']; ?>">
              <br>
              <label for="ADPhoneNum">Phone Number:</label>
              <input type="text" id="ADPhoneNum" name="ADPhoneNum" maxlength="10" value = "<?php echo $row['Phone_number']; ?>"> 
              <label for="ADEmail">Email:</label>
              <input type="text" id="ADEmail" name="ADEmail" maxlength="30" value = "<?php echo $row['Email']; ?>">   
              <!--Used to separate inputs-->
              <br>
              <button type="submit" class="btn btn-primary" name="SubmitAD">Submit</button>
              </form>
              <br><br>
              <h1>Current Offices</h1>
              <table  class = "center" border="6">
              <thead class="thead">
                <tr>
                  <th>Office id</th>
                  <th>Address</th> 
                  <th>State</th>
                  <th>City</th> 
                  <th>Phone Number</th>
                   <th>Opening Time</th>
                    <th>Closing Time</th>
                </tr>
                <?php echo $OtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>
            
  
</section>



<!-- End Of Data Entry -->



<!-- Footer-->


<script src="main.js"></script>
</body>

</html>