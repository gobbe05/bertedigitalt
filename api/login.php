<?php 

session_start();
if(!isset($_POST['username']) || !isset($_POST['password'])){
    header('Location: /login?error=Please fill in all the required credentials!');
    exit();
}
if($_POST['username'] == "admin" && $_POST['password'] == "admin"){
    $_SESSION['loggedin'] = true;
    header('Location: /admin/dashboard');
    exit();
}
header('Location: /login?error=Username and passwords does not match!')
?>