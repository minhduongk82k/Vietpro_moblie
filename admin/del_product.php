<?php 
    include_once("connect.php");
    $prd_id = $_GET["prd_id"];

    $sql = "DELETE FROM product
            WHERE prd_id=$prd_id";
    mysqli_query($conn, $sql);
    header("location: index.php?page_layout=product");
?>