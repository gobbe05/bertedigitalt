<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    $mysqli -> close();
    exit();
}

$sql = "SELECT * FROM SubMenus WHERE Id=? LIMIT 1";
$submenu = $mysqli -> execute_query($sql, [$id]) -> fetch_object();
$sql = "DELETE FROM SubMenus WHERE Id=? LIMIT 1";
$mysqli-> execute_query($sql, [$id]);

header('Location: /admin/submenus/'.$submenu->Menu);
exit();

?>