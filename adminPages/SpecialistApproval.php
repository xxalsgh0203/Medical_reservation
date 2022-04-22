<?php
session_start();

require_once "../php/config.php";


//Query to retrieve appointments for doctors
$sql = "SELECT PData.NAME, PData.Email , PData.Phone_Number, PData.Age, PData.Specialist_approved, DData.NAME, DData.Email , DData.Phone_Number FROM PATIENT PData LEFT JOIN DOCTOR DData";
$result = mysqli_query($db, $sql);


$PtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $APtableResult .= "<tr>". "<td>" . $row["Office_id"] . "</td><td>"  . $row["Office_id"] . "</td><td>" .
                       $row["Appointment_status"] . "</td><td>" . $row["Slotted_time"] . "</td><td>" . $row["Specialist_status"] . "</td>";
                       
    if ($row["Appointment_status"] === 'pending') {
      $APtableResult .= "<td><a href='../adminPages/adminPage.php?approve_id=" . $row["Appointment_id"] . "'>X</a></td>";
      $APtableResult .= "<td><a href='../adminPages/adminPage.php?ren  ject_id=" . $row["Appointment_id"] . "'>X</a></td>";
    } else {
      $APtableResult .= "<td></td><td></td>";
    }
    $APtableResult .= "</tr>";

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

    <!--style for buttons --> 
   <style>
     button
     {
       font-size: 20px;
       padding:10px;
       border-radius:10px;
       margin:20px;
     }
     #container
     {
       text-align: center;
     }
     h2
     {
       text-align: center;
     }
     h1
     {
       text-align: center;
     }
   </style>
</head>

<?php include_once("../php/header.php"); ?>



  

     <!-- Footer-->

     <script src="main.js"></script>
</body>

</html>