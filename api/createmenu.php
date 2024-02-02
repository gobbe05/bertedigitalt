<?php
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    $mysqli -> close();
    exit();
}
if(!isset($_POST['name']) || !isset($_POST['article'])) {
    exit();
}
$name = $_POST['name'];
$sql = "SELECT * FROM Menus WHERE Name=? LIMIT 1";
$nulltest = $mysqli -> execute_query($sql, [$name]) -> fetch_object();
if($nulltest != null) {
    header('Location: /admin/menus/');
    exit();
}


$name = $_POST['name'];
$path = preg_replace('/\s+/', '-', $name);
$article = $_POST['article'];

$sql = "INSERT INTO Menus (Name, Path, Article) VALUES (?,?,?)";
$mysqli -> execute_query($sql, [$name, $path, $article]);

header('Location: /admin/menus');
exit();
?>