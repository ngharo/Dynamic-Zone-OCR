<?php
// Original image
$filename = $_POST['img'];
 
// Get dimensions of the original image
list($current_width, $current_height) = getimagesize($filename);
 
// The x and y coordinates on the original image where we
// will begin cropping the image
$left = $_POST['x'];
$top = $_POST['y'];
 
// This will be the final size of the image (e.g. how many pixels
// left and down we will be going)
$crop_width = $_POST['w'];
$crop_height = $_POST['h'];

// Resample the image
$canvas = imagecreatetruecolor($crop_width, $crop_height);
$current_image = imagecreatefromjpeg(dirname(__FILE__) . '/' . $filename);
imagecopy($canvas, $current_image, 0, 0, $left, $top, $current_width, $current_height);
header('Content-Type: image/jpeg');
imagejpeg($canvas, 'cropped/' . str_replace('.jpg', '', $filename) . '.cropped.jpg', 100);
?>
