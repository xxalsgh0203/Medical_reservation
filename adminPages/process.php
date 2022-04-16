<?php
session_start();

require_once "../php/config.php";

if (isset($_POST['save']))
{
    $OFFID =  $_POST['OFFID'];
    $DName = $_POST['DName'];
    $SPType = $_POST['SPType'];
    $DPWord = $_POST['DPWord'];
    $DPhoneNum = $_POST['DPhoneNum'];

    //Used to insert data into doctor
    $mysqil->query("INSERT INTO DOCTOR (Office_id Name Speciality Name Password Phone_number) 
                    VALUES ('$OFFID', '$DName', '$SPType', '$DName', '$DPWord', '$DPhoneNum')") 
                    or  die ($mysqli->error);
}

?>