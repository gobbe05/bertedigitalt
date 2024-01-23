<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /login');
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
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (!file_exists($target_file)) {
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      header('Location: /admin/dashboard?error=File upload failed!');
      $mysqli -> close();
      exit();
    }
}
$sql = "INSERT INTO Bilder (filePath, ObjektID) VALUES (?, ?)";

if(!$mysqli -> execute_query($sql, [$target_file, $id])){
    header('Location: /admin/dashboard?error=There was an error adding the file to the database!');
    $mysqli -> close();
    exit();
}
header('Location: /admin/dashboard?message=Successfully added the file to the object!');
$mysqli -> close();
exit();

?>