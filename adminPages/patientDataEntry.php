<?php
session_start();

require_once "../php/config.php";


//----------------------------------------Retrieve patients----------------------------------
$sql = "SELECT Name, Phone_number, Email , Age, Medical_allergy, Specialist_approved, Patient_id FROM PATIENT";
$result = mysqli_query($db, $sql);

$PtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $PtableResult .= "<tr>" . "<td>" . $row["Name"] . "</td><td>" . $row["Phone_number"] . "</td><td>" . 
                    $row["Email"] . "</td><td>" . $row["Age"] . "</td>" . "</td><td>" . $row["Medical_allergy"] . "</td>" .
                     "</td><td> <a href='../adminPages/editPatient.php?update_Pid=" . $row["Patient_id"]  . "'>edit</a> </td>" . "</td><td> <a href='../adminPages/patientDataEntry.php?delete_Pid=" . 
                     $row["Patient_id"] . "'>Delete</a> </td>"  . "<tr>";
  }
}



//Takes in input for Patient from submitP
if (isset($_POST['SubmitP']))
{
  //Store input values
   
    $PName = $_POST['Pname'];
    $PPWord = $_POST['PPWord'];
    $PPhoneNum = $_POST['PPhoneNum'];
    $PEmail = $_POST['PEmail'];
    $PAge = $_POST['PAge'];

    //Used to insert data into admin
    try {
      $db->query("INSERT INTO PATIENT (Name, Password, Phone_number, Email, Age) 
                      VALUES ('$PName', '$PPWord', '$PPhoneNum', '$PEmail', '$PAge')")  or die($db->error); 
    } catch (\Throwable $th) {}

   
    header("location:patientDataEntry.php");

}

//used when the delete hyperlink is pressed
if (isset($_GET['delete_Pid'])) {
  $id = $_GET['delete_Pid'];

  try {
 mysqli_query($db, "DELETE FROM PATIENT WHERE Patient_id = " . $id);
} catch (\Throwable $th) {}
header('location:patientDataEntry.php');

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
    #dataEntry {
      border: 1px solid black;
    }

    table,
    th,
    td {
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

    label:after {
      content: ": "
    }


    .ct1 {
      margin-top: 100px;
    }

    h1 {
      font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
      margin-bottom: 25px;
    }

    h2 {
      font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
      margin-bottom: 25px;
    }

    fieldset {
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

    <form action="" method="POST">
      <h1>Patient</h1>
      <table class="center" border="6">
        <thead class="thead">
          <tr>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Age</th>
            <th>Medical Allergy</th>
            <th>edit</th>
            <th>delete</th>
          </tr>
          <?php echo $PtableResult;?>
        </thead>
        <tbody>
        </tbody>
      </table>
      <!-- Input taken for Patient -->
      <fieldset id="ct1">
        <h2> Patient info: </h2>
        <p>
          <label for="Pname">Name:</label>
          <input type="text" id="Pname" name="Pname" maxlength="20">
        </p>
        <p>
          <label for="PPWord">create password:</label>
          <input type="Password" id="PPWord" name="PPWord">
        </p>
        <p>
          <label for="PAge">Age:</label>
          <input type="number" id="PAge" name="PAge">
        </p>

        <br>
        <p>
          <label for="PPhoneNum">Phone Number:</label>
          <input type="text" id="PPhoneNum" name="PPhoneNum" maxlength="10">
        </p>
        <p>
          <label for="PEmail">Email:</label>
          <input type="text" id="PEmail" name="PEmail" maxlength="30">
        </p>
        <!--Used to separate inputs-->
        <br>
        <button type="submit" class="btn btn-primary" name="SubmitP" id="dataentrysubmitbtn">Submit</button>
        <fieldset>
    </form>

  </section>



  <!-- End Of Data Entry -->



  <!-- Footer-->


  <script src="main.js"></script>
</body>

</html>