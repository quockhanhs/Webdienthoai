<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
	 header('Location: signin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Điện thoại</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="styles.css">
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
	<?php include('lib.php'); ?>
	<div class="container">
		<div class="bg-primary">
			<p>SẢN PHẨM NỔI BẬT</p>
		</div>
		<div class="row">
		<?php 
			if (!empty($_POST['add_sp'])) {
				if(isset($_POST['name']) && isset($_POST['image']) && isset($_POST['maintain']) && isset($_POST['status']) && isset($_POST['price']) )
				{
					$name = $_POST['name'];
					$maintain = $_POST['maintain'];
					$price = $_POST['price'];
					$image = 'image/'.$_POST['image'];
					$status = $_POST['status'];

						$sqlAdd = "INSERT INTO sanpham (name,maintain,price,image,status) VALUES ('$name','$maintain','$price','$image','$status')";
						$stmt = $con->prepare($sqlAdd);
						$query = $stmt->execute();
					}
			}
				
			if(!isset($_POST['search'])){
				$sql = "SELECT * FROM sanpham";
				$stmt = $con->prepare($sql);
				$query = $stmt->execute();
				if($query){
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				?>				
		
			<div class="col-lg-4">
				<div id="idProduct">	
					<div class="top">
						<img src="<?php echo $row['image'];?>" alt="" class="image">
						<p><?php echo $row['name']; ?></p>
						<p><?php echo '*Bảo hành:'.$row['maintain'].' tháng'; ?></p>
						<p><?php echo '*Trạng thái: '.(($row['status']) ? "còn hàng" : "hết hàng"); ?></p>
					</div>
					<div>
						<span class="bottom">Giá: <?php echo number_format($row['price']).'đ'; ?> </span>

					</div>
				</div>
			</div>

				<?php 		
					}
				}
			}else{
				$querySearch = $_POST['search'];
				$sqlSearch = "SELECT * FROM sanpham WHERE name LIKE '%$querySearch%'";
				$stmt = $con->prepare($sqlSearch);
				$query = $stmt->execute();
				if($query){
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		 ?>
		 		<div class="col-lg-4">
				<div id="idProduct">	
					<div class="top">
						<img src="<?php echo $row['image'];?>" alt="" class="image">
						<p><?php echo $row['name']; ?></p>
						<p><?php echo '*Bảo hành:'.$row['maintain'].' tháng'; ?></p>
						<p><?php echo '*Trạng thái: '.(($row['status']) ? "còn hàng" : "hết hàng"); ?></p>
					</div>
					<div>
						<span class="bottom">Giá: <?php echo number_format($row['price']).'đ'; ?> </span>
					</div>
				</div>
			</div>
			<?php 
				}
			}else{
				echo "Không tìm thấy sản phẩm nào !";
			}
		}
			 ?>
		 		</div>
				 <form method="POST" action="" name= "add_sp"> 
				<br>
				<br>
				<tr>
					<label>Tên sản phẩm:</label>
					<input type="text" id="input_Search" name="search">	
				</tr>
				<br><br>
				<button>Tìm kiếm</button>
				<p><a href="upload.php">TẢI ẢNH LÊN</a></p>
				<table>
		 			<tr>
		 				<td>Tên sản phẩm</td>
		 				<td><input type="text" name="name"></td>
		 			</tr>
		 			<tr>
						 <td>Hình ảnh sản phẩm:</td>
						<td><input type="file" name="image">từ phía server (trong folder image htdocs)</td>

		 			</tr>
		 			<tr>
		 				<td>Bảo hành:</td>
		 				<td><input type="text" name="maintain"></td>
		 			</tr>
		 			<tr>
		 				<td>Trạng thái:</td>
		 				<td>
		 					<input type="text" name="status">
		 				</td>
		 			</tr>
		 			<tr>
		 				<td>Giá:</td>
		 				<td><input type="text" name="price"></td>
		 			</tr>
		 			<tr>
		 				<td><input type="submit" name="add_sp" value="Thêm"></td>
		 			</tr>
		 	</table>
		 </form>
		 <button><a href="signout.php">ĐĂNG XUẤT</a></button>
		 </div>
		 <script type="text/javascript" src="script.js"></script>
	</body>
</html>

