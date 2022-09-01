<?php
    define("TEMPLATE",true);
    session_start();

    include_once("connect.php");

    if(isset($_SESSION['mail']) && isset($_SESSION['pass'])){
        include_once('admin.php');
    }
    else{
        include_once('login.php');
    }
?>