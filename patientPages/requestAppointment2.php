
<?php
require_once "../php/config.php";
session_start();
  // Check if the user is logged in, if not then redirect them to login page
/*if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
  header("location: login.php");
  exit;

}*/
 
?>
<!doctype html>
<html lang="en">

<head>
  <title>Consultation</title>
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
    <a class="navbar-brand" href="../index.php">Medimon</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
      data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
      aria-label="Toggle navigation"><i class="fas fa-syringe fa-2x"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="../auth/login.php">Log Out</a></li>
        <li class="nav-item"><a class="nav-link" href="./patientPage.php">Manage Reservation</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- End Header -->
<!-- ======= signup Section ======= -->
<body>
    <div class = "container">
        <?php
            $doctor;
            if(isset($_POST['doctor'])) {
                $doctor = $_POST['doctor'];
                $_SESSION['doctor'] = $doctor;
                if ($doctor == "Regular") {
                    $query = "SELECT name, Doctor_id, Speciality FROM DOCTOR;";
                    $result   = mysqli_query($db, $query);
                    $resultCheck = mysqli_num_rows($result);
                    /* select DOCTOR.name, DOCTOR.Doctor_id, DOCTOR.Speciality, WORK_INFO.Weekday
from DOCTOR
inner join WORK_INFO on DOCTOR.Doctor_id = WORK_INFO.Doctor_id
where Speciality = 'Oncologist';*/
        
                    if($resultCheck > 0) {
                    echo "
                    <form class='ra' id='ra' action='requestAppointment3.php' method = 'POST';>
                        <h3 class='ra-header'>Select an avaiable Doctor</h3>";
                    while ($row = mysqli_fetch_array($result)) {
                        if ((is_null($row['Speciality']) and $doctor == "Regular") or $row['Speciality'] == "Regular") {
                            $doctorID = $row['Doctor_id'];
                            /*$q1 = "select WORK_INFO.Weekday as day
                            from DOCTOR
                            inner join WORK_INFO on DOCTOR.Doctor_id = WORK_INFO.Doctor_id
                            where Speciality = '$doctor';";*/
                            echo "
                            <div class = 'ra-form'>
                                <label for= ".$row['Doctor_id'].">".$row['name']."</label>
                                <input type='radio' name= 'name' id= ".$row['Doctor_id']." value = ".$row['Doctor_id']." /><br>
                            </div>";
                        }
                    }
                    echo "
                        <div class='ra-form'>
                            <input class='ra-form' type='submit' name='button' value='Next'/>
                        </div>
                    </form>";
                    }
                }
                else {
                    $query = "SELECT name, Doctor_id from DOCTOR where Speciality = '$doctor';";
                    $result = mysqli_query($db, $query);
                    $resultCheck = mysqli_num_rows($result);

                    //echo $resultCheck;
        
                    if($resultCheck > 0) {
                        echo "
                        <form class='ra' id='ra' action='requestAppointment3.php' method = 'POST';>
                        <h3 class='ra-header'>Select an avaiable Doctor</h3>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "
                            <div class = 'ra-form'>
                            <label for= ".$row['Doctor_id'].">".$row['name']."</label>
                            <input type='radio' name= 'name' id= ".$row['Doctor_id']." value = ".$row['Doctor_id']." /><br>
                            </div>";
                        }
                    echo "
                    <div class='ra-form'>
                    <input class='ra-form' type='submit' name='button' value='Next'/>
                    </div>
                    </form>";
                    }
                }
            }
        ?>
    </div>
</body>
<!-- Footer-->


<script src="main.js"></script>


</html>