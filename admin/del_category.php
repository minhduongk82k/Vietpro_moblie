<?php 
    include_once("connect.php");
    $cat_id = $_GET["cat_id"];

    $sql = "DELETE FROM category
            WHERE cat_id=$cat_id";
    mysqli_query($conn, $sql);
    header("location: index.php?page_layout=category");
?>