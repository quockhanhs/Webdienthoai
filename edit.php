<?php

include('lib.php');

$ID = isset($_GET['ID']) ? (int)$_GET['ID'] : '';
$data = get_info_id($ID);

if (!empty($_POST['edit']))
{
	// Lay data
	$ID = isset($_GET['ID']) ? $_GET['ID'] : '';
    $name    = isset($_POST['name']) ? $_POST['name'] : '';
    $image   = isset($_POST['image']) ? $_POST['image'] : '';
    $maintain = isset($_POST['maintain']) ? $_POST['maintain'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';

	edit($ID,$name,$image, $maintain,$price,$status);
    header("location: index.php");
}
?>


<html>
<form method="POST" name="edit"?>
				<br>
				<br>
				<br><br>
				<table>
		 			<tr>
		 				<td>Tên sản phẩm</td>
		 				<td><input type="text" name="name" value="<?php echo $data['name']; ?>"></td>
		 			</tr>
		 			<tr>
		 				<td>Hình ảnh sản phẩm:</td>
		 				<td><input type="file" name="image" value="<?php echo $data['image']; ?>"></td>
		 			</tr>
		 			<tr>
		 				<td>Bảo hành:</td>
		 				<td><input type="text" name="maintain" value="<?php echo $data['maintain']; ?>"></td>
		 			</tr>
		 			<tr>
		 				<td>Trạng thái:</td>
		 				<td>
		 					<input type="text" name="status" value="<?php echo $data['status']; ?>">
		 				</td>
		 			</tr>
		 			<tr>
		 				<td>Giá:</td>
		 				<td><input type="text" name="price" value="<?php echo $data['price']; ?>"></td>
		 			</tr>
		 			<tr>
		 				<td><input type="submit" name ="edit" value="SỬA"></td>
		 			</tr>
		 	</table>
		 </form>


</html>
