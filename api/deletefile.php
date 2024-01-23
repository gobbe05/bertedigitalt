<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /login');
    exit();
}

if(!isset($_GET['id'])){
    header('Location: /admin/dashboard?error=Please pass an id');
    $mysqli -> close();
    exit();
}

$id = $_GET['id'];
$sql = "DELETE FROM Bilder WHERE Id=?";
if(!$mysqli -> execute_query($sql, [$id])) {
    header("Location: /admin/dashboard?There was an error deleting the image!");
    $mysqli -> close();
    exit();
}

header('Location: /admin/dashboard?message=Successfully deleted image!');
$mysqli -> close();
exit();

?>