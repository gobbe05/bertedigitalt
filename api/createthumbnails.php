<?php 

include 'db.php';
include 'createimagecopy.php';

$sql = "SELECT * FROM Image";
$images = $mysqli -> query($sql) -> fetch_all(MYSQLI_ASSOC);
foreach($images as $key => $value) {
    createImageCopy($value['Image'], $_SERVER["DOCUMENT_ROOT"] . "/images/bilder/databas/thumbnails/", "thumbnail-".$value['Name']);
    $sql = "UPDATE Image SET Thumbnail=? WHERE Id=?";
    $mysqli -> execute_query($sql, ["/images/bilder/databas/thumbnails/" . "thumbnail-".$value['Name'], $value['Id']]);
}
?>