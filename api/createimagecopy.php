<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function createImageCopy($file, $folder, $newWidth){
	
	//$file source : (original) path filename
	//$folder : desired output folder
	//$newWidth:the desired output width(height will scale porportionally)
	echo $file;
	
	list($width, $height) = getimagesize($file);
	$imgRatio = $width/$height;
	$newHeight = $newWidth/$imgRatio;

	//echo "width: $width | height : $height | ratio : $imgRatio";
	
	//create image functions:

	//$thumb = imagecreatetruecolor($newWidth, $newHeight);
	//$source = imagecreatefromjpeg($file);

	if($_FILES['image']['type'] =="image/jpeg"){
		$thumb = imagecreatetruecolor($newWidth, $newHeight);
		$source = imagecreatefromjpeg($file);
	}else if($_FILES['image']['type'] == "image/png"){
		$thumb = imagecreatetruecolor($newWidth, $newHeight);
		$source = imagecreatefrompng($file);
	}
	   
	if($newFileName = $folder.$_FILES['image']['name']){
		imagejpeg($thumb,$newFileName,80);
	}else if($newFileName = $folder.$_FILES['image']['name']){
		imagepng($thumb,$newFileName,8);
	}

	
	imagedestroy($source);
	imagedestroy($thumb);
	


}//end of createImageCopy

?>