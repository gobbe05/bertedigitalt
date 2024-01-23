<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /login');
    exit();
}

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<form class="d-flex flex-column gap-1" action="/admin/createcategory" method="post">
    <div class="form-floating">
        <input class="form-control" type="text" name="kategori" id="kategori">
        <label class="form-label" for="kategori">Kategori</label>
    </div>
    <div class="form-floating">
        <input class="form-control" type="text" name="uniktid" id="uniktid">
        <label class="form-label" for="uniktid">Unikt ID</label>
    </div>
    <button class="btn btn-primary">Submit</button>
</form>