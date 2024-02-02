<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db.php';
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    exit();
}

$objekt =  $_POST['objekt'];
$kategori = $_POST['kategori'];
$givare = $_POST['givare'];
$givarepublik;
$notering = $_POST['notering'];
$storlek = $_POST['storlek'];
$tidsepok = $_POST['tidsepok'];
$placering = $_POST['placering'];
$story = $_POST['story'];
if(isset($_POST['givarepublik']) && $_POST['givarepublik'] == "on") {
    $givarepublik = 1;
} else {
    $givarepublik = 0;
}

$sql = "INSERT INTO Objekt (Objekt, Kategori, Givare, GivarePublik, Notering, Storlek, Tidsepok, Placering, Story) 
        VALUES (?,?,?,?,?,?,?,?,?)";
$result = $mysqli -> execute_query($sql, [$objekt, $kategori, $givare, $givarepublik, $notering, $storlek, $tidsepok, $placering, $story]);
if(!$result){
    header("Location /admin/createobject?error=There was an error creating object");
    $stmt -> close();
    $mysqli -> close();
    exit();
}
$insertid = $mysqli -> insert_id;
$sql = "SELECT * FROM Kategorier WHERE Kategori=?";
$category = $mysqli -> execute_query($sql, [$kategori]) -> fetch_object();
$uniqueid = $category -> {'Unikt Id'} . $insertid;
$sql = "UPDATE Objekt SET UniqueId=? WHERE Id=?";
$result = $mysqli -> execute_query($sql, [$uniqueid, $insertid]); 
if(!$result){
    header("Location /admin/createobject?error=There was an error updating the unique id for the object");
    $stmt -> close();
    $mysqli -> close();
    exit();
}
header("Location: /admin/dashboard");
$stmt -> close();
$mysqli -> close();
exit();

?>