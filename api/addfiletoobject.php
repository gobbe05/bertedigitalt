<?php 
include(dirname(__DIR__) . '/api/db.php');
include(dirname(__DIR__) . '/api/createimagecopy.php');

session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    exit();
}

if(!isset($_GET['id'])){
    header('Location: /admin/dashboard?error=Please fill in the required fields!');
    $mysqli -> close();
    exit();
}
if(!isset($_FILES["image"]["name"][0])){
    header('Location: /admin/dashboard?error=Please fill in the required fields! (file)');
    $mysqli -> close();
    exit();
}
$id = $_GET['id'];

$sql = "SELECT * FROM Objekt WHERE Id=? LIMIT 1";
$object = $mysqli -> execute_query($sql, [$id]) -> fetch_object();

$fileName = "berte-museum-" . $object -> UniqueId . "-" . basename($_FILES["image"]["name"]);
$target_dir = "uploads/";
$target_file = $target_dir . $fileName;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (!file_exists($target_file)) {
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      header('Location: /admin/dashboard?error=File upload failed!');
      $mysqli -> close();
      exit();
    } else {
        createImageCopy($target_file, "/uploads/thumbnails/", 150);
        echo "test";
        exit();
    }
}
$sql = "INSERT INTO Image (Image, Object_Id, Name) VALUES (?, ?, ?)";

if(!$mysqli -> execute_query($sql, ["/".$target_file, $id, $fileName])){
    header('Location: /admin/dashboard?error=There was an error adding the file to the database!');
    $mysqli -> close();
    exit();
}
header('Location: /admin/dashboard?message=Successfully added the file to the object!');
$mysqli -> close();
exit();

?>