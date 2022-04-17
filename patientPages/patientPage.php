<!-- 

Purpose: Display patient information

Implemented Features:
  display upcomming appointments
  button to requestAppointment page
  display prescription

TODO: 
  display personal information (including general doctor/physician)

 -->
 
<?php
session_start();

require_once "../php/config.php";
 
// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

$id = $_SESSION["id"];
$sql = "SELECT Primary_physician_id, Name, Phone_number, Email, Age, Medical_allergy FROM PATIENT WHERE Patient_id = '$id'";
$result = mysqli_query($db, $sql);

$tableResult = "";
if ($result->num_rows > 0) {
  $tableResult = "<tr>";
  while($row = $result-> fetch_assoc()) {
    $tableResult .= "<td>" . $row["Primary_physician_id"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["Phone_number"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["Age"] . "</td><td>" . $row["Medical_allergy"] . "</td>";
  }
  $tableResult .= "</tr>";
}

$sql = "SELECT * FROM PRESCRIPTION WHERE Patient_id = '$id'";
$result = mysqli_query($db, $sql);

$PtableResult = "";
if ($result->num_rows > 0) {
  $PtableResult = "<tr>";
  while($row = $result-> fetch_assoc()) {
    $PtableResult .= "<td>" . $row["Patient_id"] . "</td><td>"  . $row["Medication"] . "</td><td>" . $row["Test"] . "</td><td>" . $row["Prescription_date"] . "</td>";
  }
  $PtableResult .= "</tr>"; 
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
</head>

<?php include("../php/header.php"); ?>

  <!-- End Header -->

  <!-- ======= Patient Page ======= -->
<section id="AdminUsers">
  <div class="main-container">
    <div class="main-wrap">
      <div class="text-center" id="Admin-header">Patient - Manage your reservation</div>
      <div class="container-fluid">
        <div class="row justify-content-center my-5">
          <div class="col-12">
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th scope="col">Primary_physician_id</th>
                  <th scope="col">Name</th>
                  <th scope="col">Phone number</th>
                  <th scope="col">Email</th>
                  <th scope="col">Age</th>
                  <th scope="col">Medical_allergy</th>
                </tr>
                <?php echo $tableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>
            <a href="requestAppointment.php">Make Reservation!</a>

            <h2>Prescriptions</h2>
  
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th scope="col">Patient_id</th>
                  <th scope="col">Medication</th>
                  <th scope="col">Test</th>
                  <th scope="col">Prescription_date</th>
                </tr>
                <?php echo $PtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>
            
          </div>
        </div>
      </div>
      
      <footer>
        <div class="copyright-wrap">
          </div>
        </footer>
        </div>
      </div>
</section>
<!-- End signup -->




  <!-- Footer-->
  <?php include_once("../php/footer.php"); ?>

  <script>

  </script>
</body>

</html>