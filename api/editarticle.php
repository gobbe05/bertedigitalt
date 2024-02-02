<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    $mysqli -> close();
    exit();
}
if(!isset($_POST['content']) || !isset($_POST['name'])) {
    exit();
}

$content = $_POST['content'];
$name = $_POST['name'];
$id = $_GET['id'];

$sql = "UPDATE Articles SET Name=?, Content=? WHERE Id=?";
$result = $mysqli -> execute_query($sql, [$name, $content, $id]);


header('Location: /admin/articles');
$mysqli -> close();
exit();
?>

