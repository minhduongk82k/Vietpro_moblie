<?php
if(!defined('TEMPLATE')){
    die('Bạn không có quyền truy cập file này!');
}
    $conn = mysqli_connect('localhost','root','','vietpro_moblie_shop');

    if($conn){
        mysqli_query($conn, "SET NAMES 'utf8'");
    }
    else{
        die("Không thể kết nối với MySQL Server");
    }
?> 