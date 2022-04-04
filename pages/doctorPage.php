<?php
session_start();

require_once "../php/config.php";

// Check if the user is logged in, if not then redirect them to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
// {
//   header("location: login.php");
//   exit;
// }

$id = $_SESSION["id"];
$sql = "SELECT Office_id, Name, Days_in_office, Speciality, Phone_number FROM DOCTOR WHERE Doctor_id = '$id'";
$result = mysqli_query($db, $sql);

$tableResult = "";
if ($result->num_rows > 0) {
  $tableResult = "<tr>";
  while($row = $result-> fetch_assoc()) {
    $tableResult .= "<td>" . $row["Office_id"] . "</td><td>" . $row["Name"] . "</td><td>". "</td><td>" . $row["Days_in_office"] . "</td><td>" . $row["Speciality"] . "</td><td>" . $row["Phone_number"] . "</td>";
  }
  $tableResult .= "</tr>";
}

?>

<!doctype html>
<html lang="en">

<head>
  <title>Doctors</title>
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
<!-- ======= Doctor Section ======= -->

<body>
  <!--
        <div class="text-center" id="login-header">Doctors Page</div>
        <div class="carousel-container">
          <div class="carousel-slide">
              <img src="https://th.bing.com/th/id/OIP.ojEjZxhp8ORBoX0Y2JFbkgHaEM?pid=ImgDet&rs=1" aLt="">
              <img src="https://th.bing.com/th/id/OIP.JW_4m4RVV4ywf0aiB6TWrgHaLH?w=124&h=186&c=7&r=0&o=5&dpr=1.25&pid=1.7" aLt="">
              <img src="https://pikwizard.com/photos/823b34ec55677202d73fd148bc416087-m.jpg" aLt="">
          </div>
        </div>-->

  <br>
  <table style="margin-left:auto; margin-right:auto;" border="2">
    <tr>
      <th>Doctor ID</th>
      <th>Office ID</th>
      <th>Specialty</th>
      <th>Name</th>
      <th>Availability</th>
      <th>Phone Number</th>
    </tr>
    <?php echo $tableResult;?>
  </table>

  <!--
        <table style="margin-left:auto; margin-right:auto;">
          <tr>
            <th>Doctor ID</th>
            <th>Office ID</th>
            <th>Specialty</th>
            <th>Name</th>
            <th>Availability</th>
            <th>Phone Number</th>

          </tr>
        </table> -->
</body>
<!-- End Doctors Page-->

<!-- Footer-->
<?php include_once("../php/footer.php"); ?>

<script src="main.js"></script>
</body>

</html>