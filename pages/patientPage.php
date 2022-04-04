<?php
session_start();

require_once "../php/config.php";
 
// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$id = $_SESSION["id"];
$sql = "SELECT email FROM PATIENT WHERE patient_id = '$id'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$email = $row["email"];
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

<?php include_once("../php/header.php"); ?>

  <!-- End Header -->
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative">
      <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
      <p>I got your email from the database: <?php echo $email;?></p>
    </div>
  </section>
  <!-- End Hero -->




  <!-- Footer-->
  <?php include_once("../php/footer.php"); ?>

  <script src="main.js"></script>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  </script>
</body>

</html>
