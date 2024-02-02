<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    $mysqli -> close();
    exit();
}

$sql = "DELETE FROM Articles WHERE Id=? LIMIT 1";
$mysqli-> execute_query($sql, [$id]);

header('Location: /admin/articles');
exit();

?>