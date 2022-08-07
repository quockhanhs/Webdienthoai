<?php
if (!empty($_POST['upload'])){
/* Get original image x y*/
list($w, $h) = getimagesize($_FILES['fileToUpload']['tmp_name']);
$new_height=$h*$_POST['picture_width']/$w;
/* calculate new image size with ratio */
$ratio = max($_POST['picture_width']/$w, $new_height/$h);
$h = ceil($new_height / $ratio);
$x = ($w - $_POST['picture_width'] / $ratio) / 2;
$w = ceil($_POST['picture_width'] / $ratio);
/* new file name */
//$path = 'uploads/'.$_POST['picture_width'].'x'.$new_height.'_'.basename($_FILES['fileToUpload']['name']);
$path = 'image/'.basename($_FILES['fileToUpload']['name']);
/* read binary data from image file */
$imgString = file_get_contents($_FILES['fileToUpload']['tmp_name']);
/* create image from string */
$image = imagecreatefromstring($imgString);
$tmp = imagecreatetruecolor($_POST['picture_width'], $new_height);
imagecopyresampled($tmp, $image,
    0, 0,
    $x, 0,
    $_POST['picture_width'], $new_height,
    $w, $h);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($path,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($path)) {
    echo "Ảnh đã tồn tại trên server.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Ảnh có dung lượng quá lớn";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Chỉ chấp nhận ảnh JPG,JPEG,PNG.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Ảnh của bạn chưa được tải lên.";
    // if everything is ok, try to upload file
} else {
    /* Save image */
    switch ($_FILES['fileToUpload']['type']) {
        case 'image/jpeg':
            imagejpeg($tmp, $path, 100);
            break;
        case 'image/png':
            imagepng($tmp, $path, 0);
            break;
        case 'image/gif':
            imagegif($tmp, $path);
            break;
        default:
            exit;
            break;
    }
    echo "Ảnh ". basename( $_FILES["fileToUpload"]["name"]). " đã được tải lên.";
    /* cleanup memory */
    imagedestroy($image);
    imagedestroy($tmp);
	}
}
?>

<!DOCTYPE html> 
<html> 
<head> 
<title>TRÌNH TẢI ẢNH</title> 
<link rel="stylesheet" type= "text/css" href ="style.css"/> 
<div id="content"> 

<form  method="post" name="upload" enctype="multipart/form-data">
<label for="quantity">Độ rộng của ảnh (Đơn vị Pixel):</label>
  <input type="number" id="picture_width" name="picture_width" min="10" max="800" step="1" value="500">
Chọn ảnh để tải lên
<input type="file" name="fileToUpload" id="fileToUpload">
<input type="submit" value="Upload Image" name="upload">
</form>

<p><button><a href="index.php">QUAY VỀ TRANG CHỦ</a></button></p>
</div> 
</body> 
</html> 
