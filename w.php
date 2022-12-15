<?php
// this tells the browser to render jpg image
header('content-type: image/jpeg'); 
 
// getting the image name from GET variable 
$image = $_GET['image']; 
 
// creating png image of watermark
$watermark = imagecreatefrompng('images/watermark-original.png');   
 
// getting dimensions of watermark image
$watermark_width = imagesx($watermark);  
$watermark_height = imagesy($watermark);  
 
// creting jpg from original image
$image_path = '' . $image;
$image = imagecreatefromjpeg($image_path);
//something went wrong 
if ($image === false) {
    return false;
} 
// getting the dimensions of original image
$size = getimagesize($image_path);  
// placing the watermark 5px from bottom and right
//$dest_x = $size[0] - $watermark_width - 5;  
//$dest_y = $size[1] - $watermark_height - 5;

$dest_x = ($size[0] - $watermark_width) / 2;
$dest_y = ($size[1] - $watermark_height) / 2;

// blending the images together
imagealphablending($image, true);
imagealphablending($watermark, true); 
// creating the new image
imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height); 
imagejpeg($image);  
// destroying and freeing memory
imagedestroy($image);  
imagedestroy($watermark); 
?>