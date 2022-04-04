<?php
require_once "../php/config.php";
 
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
<!-- ======= signup Section ======= -->
<section id="signup">
  <!-- wrapper -->
  <div id="wrapper">
    <form class="text-center">
      Choose your date
      <p><input type="date" value="2019-09-22"></p>
      <p><input type="submit" value="Submit"></p>
    </form>

  </div>
  <!-- wrapper -->
</section>
<!-- End signup -->

<!-- Footer-->
<?php include_once("../php/footer.php"); ?>

<script src="main.js"></script>


</html>