<?php 
include dirname(__DIR__) . '/api/db.php';
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /login');
    exit();
}
if(!isset($_GET['id'])) {
    header('Location: /admin/dashboard?error=Please pass an id');
    $mysqli -> close();
    exit();
}
$id = $_GET['id'];
$sql = "SELECT * FROM Objekt WHERE Id=? LIMIT 1";
$object = $mysqli -> execute_query($sql, [$id]) -> fetch_object();
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<form class="d-flex flex-column gap-3 mx-auto my-5" style="width: 768px;" action="/admin/addfiletoobject?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <div class="d-flex">
        <a href="/admin/dashboard" class="btn btn-dark d-flex align-items-center gap-1">Back <span class="material-symbols-outlined">arrow_back</span></a>
    </div>
    <h3><?php echo $object->Objekt;?> - <?php echo $object->Id ?></h3>
    <div>
        <label class="form-label">Upload Image</label>
        <input class="form-control" type="file" name="image">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>