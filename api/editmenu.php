<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    $mysqli -> close();
    exit();
}
if(!isset($_POST['article']) || !isset($_POST['name'])) {
    exit();
}

$article = $_POST['article'];
$name = $_POST['name'];
$id = $_GET['id'];

$sql = "UPDATE Menus SET Name=?, Article=? WHERE Id=?";
$result = $mysqli -> execute_query($sql, [$name, $article, $id]);


header('Location: /admin/menus');
$mysqli -> close();
exit();
?>

