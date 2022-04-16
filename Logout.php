<?php
    session_start();
    unset($_SESSION["username"]);
    unset($_SESSION["id"]);
    unset($_SESSION["loggedin"]);
    unset($_SESSION["type"]);

    $countPatient = 0;
    $countDoctor = 0;

    session_destroy();
    session_unset();

    header("Location:index.php");
?>