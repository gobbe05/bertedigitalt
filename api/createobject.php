<?php 
echo json_encode($_FILES);
die();
include 'db.php';
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /login');
    exit();
}

$objekt =  $_POST['objekt'];
$kategori = $_POST['kategori'];
$givare = $_POST['givare'];
$notering = $_POST['notering'];
$storlek = $_POST['storlek'];
$tidsepok = $_POST['tidsepok'];
$story = $_POST['story'];

$sql = "INSERT INTO Objekt (Objekt, Kategori, Givare, Notering, Storlek, Tidsepok, Story) 
        VALUES (?,?,?,?,?,?,?)";
$stmt = $mysqli -> prepare($sql);
$stmt -> bind_param("sssssss", $objekt, $kategori, $givare, $notering, $storlek, $tidsepok, $story);
if(!$stmt -> execute()){
    header("Location /admin/createobject?error=There was an error deleting object");
    $stmt -> close();
    $mysqli -> close();
    exit();
} 
header("Location: /admin/dashboard");
$stmt -> close();
$mysqli -> close();
exit();

?>