<?php
          require_once "../php/config.php";

          // Check if the user is logged in, if not then redirect them to login page
          if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
          {
            header("location: login.php");
            exit;
          }
          $id = $_SESSION["id"];
          $sql = "SELECT Office_id, Name, Days_in_office, Speciality, Phone_number FROM DOCTOR WHERE Doctor_id = '$id'";
          $result = mysqli_query($db, $sql);
          
          $tableResult = "";
          if ($result->num_rows > 0) {
            $tableResult = "<tr>";
            while($row = $result-> fetch_assoc()) {
              $tableResult .= "<td>" . $row["Office_id"] . "</td><td>" . $row["Name"] . "</td><td>". "</td><td>" . $row["Days_in_office"] . "</td><td>" . $row["Speciality"] . "</td><td>" . $row["Phone_Number"] . "</td>";
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

<nav class="navbar navbar-expand-lg nav-back fixed-top" id="mainNav">
  <div class="container">
    <img src="../img/main_icon.png" class="mainicon">
    <a class="navbar-brand" href="./main.html">Medimon</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
      data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
      aria-label="Toggle navigation"><i class="fas fa-syringe fa-2x"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="./login.php">Log in</a></li>
        <li class="nav-item"><a class="nav-link" href="./signup.php">Sign up</a></li>
        <li class="nav-item"><a class="nav-link" href="./patientPage.php">Manage Reservation</a></li>
      </ul>
    </div>
  </div>
</nav>

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
  <footer class="footer py-4 mt-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-4 text-lg-left">COSC3380 Group Project</div>
        <div class="col-lg-4 my-3 my-lg-0">
          <a class="btn btn-back btn-social mx-2" href="#!">
            <i class="fab fa-twitter"></i></a>
          <a class="btn btn-back btn-social mx-2" href="#!">
            <i class="fab fa-facebook-f"></i></a>
          <a class="btn btn-back btn-social mx-2" href="#!">
            <i class="fab fa-linkedin-in"></i></a>
        </div>
        <div class="col-lg-4 text-lg-right">
          <a class="mr-3 text" href="#!">Privacy Policy</a>
          <a href="#!" class="text">Terms of Use</a></div>
      </div>
    </div>
  </footer>

  <script src="main.js"></script>
</body>

</html>