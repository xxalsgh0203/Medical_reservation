<?php
session_start();

require_once "../php/config.php";


/*---------------------------to retrieve  admins------------------------------------------------*/
$sql = "SELECT * FROM ADMIN";
$result = mysqli_query($db, $sql);

$OtADtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $OtADtableResult .= "<tr>". "<td>" . $row["Office_id"] . "</td><td>" . $row["Name"] . "</td><td>" . 
                          $row["Phone_number"] . "</td><td>" . $row["Email"] . "</td>" . "</td><td> 
                          <a href='../adminPages/editAdmin.php?update_ADid=" . $row["Admin_id"]  . "'>edit</a> </td>" . "</td><td> <a href='../adminPages/adminDataEntry.php?delete_ADid=" . $row["Admin_id"] . "'>Delete</a>
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
    try {
    $db->query("INSERT INTO ADMIN (Office_id,  Name, Password, Phone_number, Email) 
                    VALUES ('$ADOFFID', '$ADName', '$ADPWord', '$ADPhoneNum', '$ADEmail')")  or die($db->error);
    } catch (\Throwable $th) {}

   
    header("location:adminDataEntry.php");

}

//used when the delete hyperlink is pressed for admin
if (isset($_GET['delete_ADid'])) {
  $id = $_GET['delete_ADid'];

  try {
 mysqli_query($db, "DELETE FROM ADMIN WHERE Admin_id = " . $id);
  } catch (\Throwable $th) {}
header('location:adminDataEntry.php');

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

#dataEntry{
        border: 1px solid black;
      }

table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

table.center {
  margin-left: auto; 
  margin-right: auto;
}

label {
  color: #B4886B;
  font-weight: bold;
  width: 130px;
  /* float: left; */
}
label:after { content: ": " }


.ct1{
  margin-top: 100px;
}

h1{
  font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  margin-bottom: 25px;
}

h2{
  font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  margin-bottom: 25px;
}

fieldset{
  margin-top: 80px;
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
    <br>
    </a>
        <a href="officeDataEntry.php">
            <div>
                Office Data Entry
            </div>
        </a>
        <br>
        </a>
        <a href="adminPage.php">
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
            <h1>Admin</h1>
            <table  class = "center">
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
            <form action="" method="POST">
            <!--input taken for admin -->
            <fieldset id="ct1">
              <h2>  Admin info:  </h2>
              <p>
              <label for="ADOFFID">Office ID:</label>
              <input type="number" id="ADOFFID" name="ADOFFID">
</p>
<p>
              <label for="ADname">Name:</label>
              <input type="text" id="ADname" name="ADname" maxlength="20" required>
</p>
<p>
              <label for="ADPWord">create password:</label>
              <input type="Password" id="ADPWord" name="ADPWord" required>
</p>
              <br>
              <p>
              <label for="ADPhoneNum">Phone Number:</label>
              <input type="text" id="ADPhoneNum" name="ADPhoneNum" maxlength="10" required> 
</p>
<p>
              <label for="ADEmail">Email:</label>
              <input type="text" id="ADEmail" name="ADEmail" maxlength="30">
</p>   
              <!--Used to separate inputs-->
              <br>
              <button type="submit" class="btn btn-primary" name="SubmitAD">Submit</button>
              <fieldset>
              </form>
</section>



<!-- End Of Data Entry -->



<!-- Footer-->


<script src="main.js"></script>
</body>

</html>