<?php
session_start();

require_once "../php/config.php";


//Query to retrieve appointments for doctors


$sql = "SELECT PData.Name as P_Name, PData.Email as P_Email, PData.Phone_Number as P_Phone_Num, PData.Age as P_Age, PData.Patient_id as P_id, PData.Specialist_check as P_SpesCheck, DData.Name as Doctor_name,
         DData.Phone_Number as D_Phone_Num FROM PATIENT AS PData LEFT JOIN DOCTOR AS DData ON PData.Primary_physician_id = DData.Doctor_id; ";
$result = mysqli_query($db, $sql); 

$PtableResult = "";
if ($result->num_rows > 0) {
  while($row = $result-> fetch_assoc()) {
    $PtableResult .= "<tr>". "<td>" . $row["P_Name"] . "</td><td>"  . $row["P_Email"] . "</td><td>" . $row["P_Phone_Num"] . "</td><td>" .  $row["P_Age"] . "</td><td>" 
                    . $row["P_SpesCheck"] . "</td><td>" . $row["D_Phone_Num"] . "</td><td>" . $row["Doctor_name"] . "</td>". "</td><td> 
                    <a href='../adminPages/SpecialistApproval.php?approve_Pid=" . $row["P_id"]  . "'>Approve</a> </td>" . "</td><td> <a href='../adminPages/SpecialistApproval.php?remove_Pid=" . $row["P_id"] . "'>Remove</a>
                                         </td>" .  "</tr>";
                       
  }
}


if (isset($_GET['approve_Pid'])) {
    $id = $_GET['approve_Pid'];
    try {
    mysqli_query($db, "UPDATE PATIENT SET Specialist_Check = 'Approved' WHERE Patient_id = " . $id);
    mysqli_query($db, "UPDATE PATIENT SET Specialist_approved = 1 WHERE Patient_id = " . $id);
  } catch (\Throwable $th) {}
    header('location:SpecialistApproval.php');
  }
  
  if (isset($_GET['remove_Pid'])) {
    $id = $_GET['remove_Pid'];
    try {
    mysqli_query($db, "UPDATE PATIENT SET Specialist_Check ='NA' WHERE  Patient_id  = " . $id);
    mysqli_query($db, "UPDATE PATIENT SET Specialist_approved = 0 WHERE Patient_id = " . $id);
  } catch (\Throwable $th) {}
    header('location:SpecialistApproval.php');
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

<nav class="floating-menu">
    </a>
        <a href="adminPage.php">
            <div>
                Admin Page
            </div>
        </a>
</nav>

<?php include_once("../php/header.php"); ?>

<section id = "Admin user">
<div class="main-container">
    <div class="main-wrap">
      <div class="text-center" id="Admin-header">Specialist approval</div>
      <div class="container-fluid">
        <div class="row justify-content-center my-5">
          <div class="col-12">
            <table class="table table-bordered">
              <thead class="thead">
                <tr>
                  <th scope="col">Patient Name</th>
                  <th scope="col">Patient Phone number</th>
                  <th scope="col">Patient Email</th>
                  <th scope="col">Age</th>
                  <th scope="col">Approved for specialist</th>
                  <th scope="col">Primary physcian</th>
                  <th scope="col">Doctors contact</th>
                  <th scope="col">Approve status</th>
                  <th scope="col">Remove status</th>
                </tr>
                <?php echo $PtableResult;?>
              </thead>
              <tbody>
              </tbody>
            </table>
          
            
          </div>
        </div>
      </div>
      </section>

     <!-- Footer-->

     <script src="main.js"></script>
</body>

</html>