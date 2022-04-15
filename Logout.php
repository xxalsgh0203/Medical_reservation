<?php
    session_start();
    unset($_SESSION["username"]);
    unset($_SESSION["id"]);
    unset($_SESSION["loggedin"]);

    session_destroy();
    session_unset();

    header("Location:index.php");
?>