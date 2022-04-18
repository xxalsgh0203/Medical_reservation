<?php
session_start();

require_once "../php/config.php";

// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//   header("location: patientPage.php");
//   exit;
// }


if($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']); 
  
  $sqlPatient = "SELECT patient_id FROM PATIENT WHERE name = '$username' AND password = '$password'";
  $resultPatient = mysqli_query($db, $sqlPatient);
  $rowPatient = mysqli_fetch_array($resultPatient, MYSQLI_ASSOC);
  
  $countPatient = mysqli_num_rows($resultPatient);
      
  if($countPatient == 1) {
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $username;
    $_SESSION["id"] = $rowPatient["patient_id"];
    $_SESSION["type"] = "patient";
    $_SESSION["href"] = "//localhost/cosc3380/patientPages/patientPage.php";
  
    header("location: ../patientPages/patientPage.php");
  }

  $sqlDoctor = "SELECT doctor_id FROM DOCTOR WHERE name = '$username' AND password = '$password'";
  $resultDoctor = mysqli_query($db, $sqlDoctor);
  $rowDoctor = mysqli_fetch_array($resultDoctor, MYSQLI_ASSOC);
  
  $countDoctor = mysqli_num_rows($resultDoctor);
      
  if($countDoctor == 1) {
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $username;
    $_SESSION["id"] = $rowDoctor["doctor_id"];
    $_SESSION["href"] = "//localhost/cosc3380/doctorPages/doctorPage.php";
    $_SESSION["type"] = "doctor";
    
    header("location: ../doctorPages/doctorPage.php");
  }

  $sqlAdmin = "SELECT admin_id FROM ADMIN WHERE name = '$username' AND password = '$password'";
  $resultAdmin = mysqli_query($db, $sqlAdmin);
  $rowAdmin = mysqli_fetch_array($resultAdmin, MYSQLI_ASSOC);
  
  $countAdmin = mysqli_num_rows($resultAdmin);
      
  if($countAdmin == 1) {
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $username;
    $_SESSION["id"] = $rowAdmin["admin_id"];
    $_SESSION["href"] = "//localhost/cosc3380/adminPages/adminPage.php";
    $_SESSION["type"] = "admin";
    header("location: ../adminPages/adminPage.php");
  }
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
<!-- ======= signup Section ======= -->
<section id="signin">
  <div class="main-container">
    <div class="main-wrap">

      <div class="text-center" id="login-header">Log in to your Account</div>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
        class="login-input-section-wrap">
        <div class="login-input-wrap">
          <input placeholder="Username" type="text" name="username"></input>
        </div>
        <div class="login-input-wrap password-wrap">
          <input placeholder="Password" type="password" name="password"></input>
        </div>
        <div class="login-button-wrap">
          <input id="login-button" type="submit" value="Sign in">
        </div>
        <a href = "signup.php">
          <div class="noidsignin">Create an account</div>
        </a>
        <div class="login-stay-sign-in">
          <!-- <i class="far fa-check-circle"></i>
          <span>Stay Signed in</span> -->
        </div>
      </form>
      <footer>
        <div class="copyright-wrap">
        </div>
      </footer>
    </div>
  </div>
</section>
<!-- End signup -->

<!-- Footer-->


<script>
  const loginbutton = document.getElementById("login-button");
  const foo = "<?php echo $_SESSION['loggedin'] ?>";
  const usrname = "<?php echo $_SESSION['username'] ?>";
  const logged_in = document.getElementById("login");
  loginbutton.addEventListener('click', ()=>{
    if(logged_in){
      alert("Welcome" + $usrname + "!");
    }
  });
</script>
</body>

</html>