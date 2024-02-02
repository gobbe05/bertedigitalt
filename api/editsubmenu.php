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
if(!isset($_POST['article']) || !isset($_POST['name']) ||  !isset($_POST['menu'])) {
    exit();
}

$article = $_POST['article'];
$name = $_POST['name'];
$menu = $_POST['menu'];
$id = $_GET['id'];

$sql = "UPDATE SubMenus SET Name=?, Menu=?, Article=? WHERE Id=?";
$result = $mysqli -> execute_query($sql, [$name, $menu, $article, $id]);


header('Location: /admin/submenus/' . $menu);
$mysqli -> close();
exit();
?>

