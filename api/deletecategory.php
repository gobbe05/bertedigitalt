<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    $mysqli -> close();
    exit();
}

if(!isset($_GET['id'])) {
    header("Location: /admin/dashboard?error=Please pass an id when deleting an object");
    $mysqli -> close();
    exit();
}
$id = $_GET['id'];

$sql = "DELETE FROM Kategorier WHERE Id=?";
$stmt = $mysqli -> prepare($sql);
$stmt -> bind_param("s", $id);

if(!$stmt -> execute()) {
    header("Location: /admin/dashboard?error=There was an error deleting category");
    $mysqli -> close();
    $stmt -> close();
    exit();
}

header("Location: /admin/dashboard?message=Went");
$mysqli -> close();
$stmt -> close();
exit();
?>