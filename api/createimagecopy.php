<?php 
function createImageCopy($file, $folder, $newFileName){

    $filename = $file;
    
    $mime = image_type_to_mime_type(exif_imagetype($_SERVER["DOCUMENT_ROOT"] . $file));
    
    if($mime == "image/jpeg") {
        $source = imagecreatefromjpeg($_SERVER["DOCUMENT_ROOT"] . $filename);
    } else if($mime == "image/png") {
        $source = imagecreatefrompng($_SERVER["DOCUMENT_ROOT"] . $filename);
    } else {
        header('Location: /admin/dashboard?error=Only png and jpeg allowed');
        exit();
    }
    
    $exif = exif_read_data($_SERVER["DOCUMENT_ROOT"] . $file);
    if(!empty($exif['Orientation'])) {
        switch($exif['Orientation']) {
            case 8:
                $source = imagerotate($source,90,0);
                break;
            case 3:
                $source = imagerotate($source,180,0);
                break;
            case 6:
                $source = imagerotate($source,-90,0);
                break;
        }
    }
    $width  = imagesx($source);
    $height = imagesy($source);
    $newwidth = $width/5;
    $newheight = $height/5;
    
    $destination = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($destination, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    
    if($mime == "image/jpeg") {
        imagejpeg($destination, $folder.$newFileName, 25);
    } else if($mime == "image/png") {
        imagepng($destination, $folder.$newFileName, 8);
    }
    
    
}//end of createImageCopy

?>