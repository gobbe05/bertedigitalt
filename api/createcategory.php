<?php
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    exit();
}

$kategori = $_POST['kategori'];
$uniktid = $_POST['uniktid'];

$sql = "INSERT INTO Kategorier (Kategori, `Unikt Id`)
        VALUES (?,?)";
$stmt = $mysqli -> prepare($sql);
$stmt -> bind_param("ss", $kategori, $uniktid);

if(!$stmt -> execute()){
    header("Location: /admin/dashboard?error=There was an error creating a new category!");
    $mysqli -> close();
    $stmt -> close();
    exit();
}
header("Location: /admin/dashboard");
$mysqli -> close();
$stmt -> close();
exit();
?>