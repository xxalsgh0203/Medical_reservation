<!doctype html>
<html lang="en">
<?php
  session_start();
?>

<head>
  <title>Consultation</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/style.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

  <!-- Header -->
  <?php include("./php/header.php"); ?>

  <!-- End Header -->
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative">
      <h1>Service opens in 2 weeks</h1>
      <h2>Group project COSC3380.</h2>
      <a href="./requestAppointment.php" class="main-btn">Make Reservation!</a>
    </div>
  </section>
  <!-- End Hero -->


  <!-- Footer-->
  <?php include_once("./php/footer.php"); ?>

</body>

</html>