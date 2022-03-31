<?php
   include("config.php");
   session_start();

   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      
      $myusername = mysqli_real_escape_string($db, $_POST['username']);
      $mypassword = mysqli_real_escape_string($db, $_POST['password']); 
      
      $sql = "SELECT patient_id FROM PATIENT WHERE name = '$myusername'";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      // $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         
         echo(" Welcome ");
         echo($myusername);
      }else {

        echo(" Log in failed (only username Bob is a patient)");
        //  $error = "Your Login Name or Password is invalid";
      }
   }
?>