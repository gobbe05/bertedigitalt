<?php 
function createImageCopy($file, $folder, $newFileName){

    $filename = $file;
    list($width, $height) = getimagesize($_SERVER["DOCUMENT_ROOT"] . $filename);
    
    $mime = image_type_to_mime_type(exif_imagetype($_SERVER["DOCUMENT_ROOT"] . $file));
    
    if($mime == "image/jpeg") {
        $source = imagecreatefromjpeg($_SERVER["DOCUMENT_ROOT"] . $filename);
    } else if($mime == "image/png") {
        $source = imagecreatefrompng($_SERVER["DOCUMENT_ROOT"] . $filename);
    } else {
        header('Location: /admin/dashboard?error=Only png and jpeg allowed');
        exit();
    }
    
    $newwidth = $width/5;
    $newheight = $height/5;
    
    $destination = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($destination, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    
    if($mime == "image/jpeg") {
        imagejpeg($destination, $folder.$newFileName, 50);
    } else if($mime == "image/png") {
        imagepng($destination, $folder.$newFileName, 8);
    }
    
    
}//end of createImageCopy

?>