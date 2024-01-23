<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /login');
    exit();
}
if(!isset($_POST) || !isset($_POST['objekt']) || !isset($_POST['kategori']) || !isset($_POST['givare']) || !isset($_POST['notering']) || !isset($_POST['storlek']) || !isset($_POST['tidsepok']) || !isset($_POST['story'])){
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
$objekt = $_POST['objekt'];
$kategori = $_POST['kategori'];
$givare = $_POST['givare'];
$notering = $_POST['notering'];
$storlek = $_POST['storlek'];
$tidsepok = $_POST['tidsepok'];
$story = $_POST['story'];

$sql = "UPDATE Objekt SET Objekt=?, Kategori=?, Givare=?, Notering=?, Storlek=?, Tidsepok=?, Story=? WHERE Id=?";
$mysqli -> execute_query($sql, [$objekt,$kategori, $givare, $notering, $storlek, $tidsepok, $story, $id]);

header('Location: /admin/dashboard?message=Object was successfully changed!');
$mysqli -> close();
exit();
?>