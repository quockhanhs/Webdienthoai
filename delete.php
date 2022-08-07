<?php
include('lib.php');

// Thực hiện xóa
$ID = isset($_GET['ID']) ? (int)$_GET['ID'] : '';

if ($ID){
    delete($ID);
}

// Trở về trang danh sách
header("location: index.php");