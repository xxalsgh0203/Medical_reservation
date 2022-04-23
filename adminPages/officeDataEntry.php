<?php
session_start();

require_once "../php/config.php";


//----------------------------------------Retrieve Office Table----------------------------------
$sql = "SELECT * FROM OFFICE";
$result = mysqli_query($db, $sql);

$OtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $OtableResult .= "<tr>" . "<td>" . $row["Office_id"] . "</td><td>" . "<td>" . $row["Address"].  $row["State"] . "</td><td>" . "</td><td>" 
                    . $row["City"] . "</td><td>" . $row["Phone_number"] . "</td>" . "</td><td>" . $row["Open_time"] . "</td>" 
                    . "</td><td>" . $row["Close_time"] . "</td>" .
                     "</td><td> <a href='../adminPages/editOffice.php?update_Oid=" . $row["Office_id"]  . "'>edit</a> </td>" 
                     . "</td><td> <a href='../adminPages/officeDataEntry.php?delete_Oid=" . 
                     $row["Office_id"] . "'>Delete</a> </td>"  . "<tr>";
  }
}



//Takes in input for Patient from submitP
if (isset($_POST['SubmitO']))
{
  //Store input values
   
    $OAddress = $_POST['OAddress'];
    $OCity = $_POST['OCity'];
    $State = $_POST['OState'];
    $OPhone_num = $_POST['OPhone_number'];
    $Open_time = $_POST['O_Open_time'];
    $Close_time = $_POST['O_Close_time'];

    //Used to insert data into Office
    $db->query("INSERT INTO OFFICE (Address, State, City, Phone_number, Open_time, Close_time) 
                    VALUES ('$OAddress', '$State', '$OCity',  ' $OPhone_num', ' $Open_time', ' $Close_time')")  or die($db->error); 

   
    header("location:officeDataEntry.php");

}

//used when the delete hyperlink is pressed
if (isset($_GET['delete_Pid'])) {
  $id = $_GET['delete_Pid'];

 mysqli_query($db, "DELETE FROM OFFICE WHERE Office_id = " . $id);
header('location:officeDataEntry.php');

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
<body>
<nav class="floating-menu">
    <a href="doctorDataEntry.php">
        <div>
            Doctor Data Entry Page
        </div>
    </a>
    <br>
    <a href="adminDataEntry.php">
        <div>
            Admin Data Entry Page
        </div>
    </a>
    <br>
    <a href="patientDataEntry.php">
        <div>
            Patient Data Entry Page
        </div>
    </a>
    </a>
        <a href="AdminPage.php">
            <div>
                Admin Page
            </div>
        </a>
</nav>


<?php include_once("../php/header.php"); ?>

  <!-- Header of the page-->
  <section>
    <br><br>
    <h1 class="text-center" id="data-entry-header">Data Entry Form</h1>
  </section>
  

<!-- ======= Doctor Section ======= -->

<section id="dataEntry">

<form action="" method="POST">
              <h1>Office</h1>
              <table  class = "center" border="6">
              <thead class="thead">
                <tr>
                  <th>Address</th> 
                  <th>State</th>
                  <th>City</th> 
                  <th>Phone Number</th>
                   <th>Opening Time</th>
                    <th>Closing Time</th>
                  <th>edit</th>
                  <th>delete</th>
                </tr>
                <?php echo $OtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>
              <!-- Input taken for Patient -->
              
              <h2> Patient info:  </h2>
              <label for="OAddress">Address:</label>
              <input type="text" id="OAddress" name="OAddress" maxlength="20">
              <label for="OState">State:</label>
              <input type="text" id="OState" name="OState">
              <label for="OCity">City:</label>
              <input type="text" id="OCity" name="OCity">
              <br><!-- still editing right here--------------------------------------->
              <label for="PPhoneNum">Phone Number:</label>
              <input type="text" id="PPhoneNum" name="PPhoneNum" maxlength="10"> 
              <label for="PEmail">Email:</label>
              <input type="text" id="PEmail" name="PEmail" maxlength="30">   
              <!--Used to separate inputs-->
              <br>
              <button type="submit" class="btn btn-primary" name="Submit0" id="dataentrysubmitbtn">Submit</button>
              
              </form>
  
</section>



<!-- End Of Data Entry -->



<!-- Footer-->


<script src="main.js"></script>
</body>

</html>