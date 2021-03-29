
<?php 
require ('class/Image.php');
define ('WEB_DIR_PATH', $_SERVER['DOCUMENT_ROOT'].'/Devoir/images');

$images= new Image();
$image_array=$images->getImages(WEB_DIR_PATH);
$dir_sort=$images->creatDir($image_array);
$result=$images->moveFile($image_array);
echo $result;


?>