<?php
    session_start();

    unset($_SESSION["mail"]);
    unset($_SESSION["pass"]);

    header("location:index.php");
?>