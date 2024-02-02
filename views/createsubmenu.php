<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    $mysqli -> close();
    exit();
}

$sql = "SELECT * FROM Menus";
$menus = $mysqli -> query($sql) -> fetch_all(MYSQLI_ASSOC);
$sql = "SELECT * FROM Articles";
$articles = $mysqli -> query($sql) -> fetch_all(MYSQLI_ASSOC);
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<div class="mx-auto" style="width: 768px;">
    <form class="d-flex flex-column gap-2 m-5" action="/admin/createsubmenu" method="POST">
        <div class="form-floating">
            <input class="form-control" name="name" id="name" type="text" />
            <label class="form-label" for="name">Name</label>
        </div>
        <label class="form-label">Menu</label>
        <select class="form-control" name="menu">
            <?php 
            
                foreach($menus as $key => $value) {
                    echo "<option value='".$value['Id']."'>".$value['Name']."</option>";
                }
            
            ?>
        </select>
        <label class="form-label">Article</label>
        <select class="form-control" name="article">
            <?php 
            
                foreach($articles as $key => $value) {
                    echo "<option value='".$value['Id']."'>".$value['Name']."</option>";
                }
            
            ?>
        </select>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>