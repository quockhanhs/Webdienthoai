<?php
global $con;
    $con = new PDO('mysql:host=localhost;dbname=dienthoai','root','');

function delete($ID){
    global $con;
    $sql = "DELETE FROM sanpham WHERE ID = '$ID'";
    $stmt = $con->prepare($sql);
    $query = $stmt->execute();
    return $query;
}

function get_info_id($ID){
    global $con;
    $sql = "select * from sanpham where ID = {$ID}";
    $stmt = $con->prepare($sql);
    $query = $stmt->execute();
    $result = array();
    if($query){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $result = $row;
    }
    return $result;
}
function edit($ID,$name,$image,$maintain,$price,$status){
    global $con;
	$sql = "UPDATE sanpham SET name = '$name',image = '$image',maintain='$maintain',price = '$price',status='$status' WHERE ID = '$ID'";
    $stmt = $con->prepare($sql);
    $query = $stmt->execute();
    return $query;

}
?>