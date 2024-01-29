<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    exit();
}
if(!isset($_POST) || !isset($_POST['uniktid']) || !isset($_POST['kategori'])){
    header('Location: /admin/dashboard?error=Please fill in all the required fields');
    $mysqli -> close();
    exit();
}
if(!isset($_GET['id'])){
    header('Location: /admin/dashboard?error=Please pass an id');
    $mysqli -> close();
    exit();
}
$id = $_GET['id'];
$uniktid = $_POST['uniktid'];
$kategori = $_POST['kategori'];

$sql = "UPDATE Kategorier SET Kategori=?, Unikt_Id=? WHERE Id=?";
$mysqli -> execute_query($sql, [$kategori, $uniktid, $id]);

header('Location: /admin/dashboard?message=Category was successfully changed!');
$mysqli -> close();
exit();
?>