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

$sql = "SELECT * FROM Articles WHERE Name=? LIMIT 1";
$nulltest = $mysqli -> execute_query($sql, [$name]) -> fetch_object();
if($nulltest != null) {
    header('Location: /admin/createarticle/'.$name.'/' . $content);
}

$sql = "INSERT INTO Articles (Name, Content) VALUES (?,?)";
$result = $mysqli -> execute_query($sql, [$name, $content]);


header('Location: /admin/articles');
$mysqli -> close();
exit();
?>