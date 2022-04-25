<?php
    session_start();
    unset($_SESSION["username"]);
    unset($_SESSION["id"]);
    unset($_SESSION["loggedin"]);
    unset($_SESSION["type"]);

    session_destroy();
    session_unset();

    header("Location: //localhost/COSC3380/index.php");
?>