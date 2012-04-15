<?php
require_once('uuid.php');
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

$cropped_uniq = $_POST['template_id'] . '-' . gen_uuid();
$cropped_img = $cropped_uniq . '.jpg';
imagejpeg($canvas, 'cropped/' . $cropped_img, 100);

exec("tesseract cropped/{$cropped_img} /tmp/{$cropped_uniq} -l eng", $foo, $return_status);

if($return_status != 0) {
	echo "FAILURE";
} else {
	echo nl2br(file_get_contents("/tmp/{$cropped_uniq}.txt"));
	unlink("/tmp/{$cropped_uniq}.txt");
}
?>
