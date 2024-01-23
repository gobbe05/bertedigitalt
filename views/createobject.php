<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /login');
    exit();
}

$sql = "SELECT * FROM Kategori";
$result = $mysqli -> query($sql);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
$mysqli -> close();
?>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<form class="d-flex flex-column gap-1" action="/admin/createobject" method="post">
  <h3>Create Object</h3>  
  <div class="form-floating">
        <input class="form-control" type="text" name="objekt" id="objekt">
        <label class="form-label" for="objekt">Namn</label>
    </div>
    <div class="input-group">
    <select class="form-control" name="kategori" id="kategori">
        <?php 
          foreach ($categories as $value) {
            echo "<option value='" . $value['Kategori'] . "'>". $value['Kategori']."</option>";
          }
        ?>
      </select>
      <div class="input-group-append">
        <label class="input-group-text" for="inputGroupSelect02">Kategori</label>
      </div>
    </div>
    <div class="form-floating">
        <input class="form-control" type="text" name="givare" id="givare">
        <label class="form-label" for="givare">Givare</label>
    </div>
    <div class="form-floating">
        <input class="form-control" type="text" name="notering" id="notering">
        <label class="form-label" for="notering">Notering</label>
    </div>
    <div class="form-floating">
        <input class="form-control" type="text" name="storlek" id="storlek">
        <label class="form-label" for="storlek">Storlek</label>
    </div>
    <div class="form-floating">
        <input class="form-control" type="text" name="tidsepok" id="tidsepok">
        <label class="form-label" for="tidsepok">Tidsepok</label>
    </div>
    <div class="form-floating">
        <input class="form-control" type="text" name="story" id="story">
        <label class="form-label" for="story">Story</label>
    </div>
    <div class="modal" tabindex="-1" id="modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Create Object?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Are you sure that you want to create a new object?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>
        </div>
    </div>
    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal">Submit</button>
</form>