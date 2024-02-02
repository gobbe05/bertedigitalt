<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    $mysqli -> close();
    exit();
}
if(!isset($_POST['name']) || !isset($_POST['article']) || !isset($_POST['menu'])) {
    exit();
}
$name = $_POST['name'];
$menu = $_POST['menu'];

$sql = "SELECT * FROM SubMenus WHERE Name=? AND Menu=? LIMIT 1";
$nulltest = $mysqli -> execute_query($sql, [$name, $menu]) -> fetch_object();
if($nulltest != null) {
    header('Location: /admin/submenus/'.$menu);
    exit();
}
$name = $_POST['name'];
$path = preg_replace('/\s+/', '-', $name);
$menu = $_POST['menu'];
$article = $_POST['article'];

$sql = "INSERT INTO SubMenus (Name, Path, Menu, Article) VALUES (?,?,?,?)";
$mysqli -> execute_query($sql, [$name, $path, $menu, $article]);

header('Location: /admin/submenus/'.$menu);
?>