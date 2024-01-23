<?php
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /login');
    $mysqli -> close();
    exit();
}
if(!isset($_GET['id'])){
    header('Location: /admin?error=Please pass an id when editing an object!');
    $mysqli -> close();
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM Objekt WHERE Id=? LIMIT 1";
$object = $mysqli -> execute_query($sql, [$id]) -> fetch_assoc();

$sql = "SELECT * FROM Kategori";
$categories = $mysqli -> query($sql) -> fetch_all(MYSQLI_ASSOC);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<form class="d-flex flex-column gap-1" action="/admin/editobject?id=<?php echo $object['Id']; ?>" method="post">
    <h3>Edit Object</h3>  
    <div class="form-floating">
        <input class="form-control" type="text" value="<?php echo $object['Objekt']; ?>" name="objekt" id="objekt">
        <label class="form-label" for="objekt">Namn</label>
    </div>
    <div class="input-group">
    <select class="form-control" name="kategori" id="kategori">
        <?php 
          foreach ($categories as $value) {
            if($value['Kategori'] == $object['Kategori']){
              echo "<option value='" . $value['Kategori'] . "' selected>". $value['Kategori']."</option>";
            } else{
              echo "<option value='" . $value['Kategori'] . "' >". $value['Kategori']."</option>";
            }
          }
        ?>
      </select>
      <div class="input-group-append">
        <label class="input-group-text" for="inputGroupSelect02">Kategori</label>
      </div>
    </div>
    <div class="form-floating">
        <input class="form-control" type="text" name="givare" id="givare" value="<?php echo $object['Givare'];?>">
        <label class="form-label" for="givare">Givare</label>
    </div>
    <div class="form-floating">
        <input class="form-control" type="text" name="notering" id="notering" value="<?php  echo $object['Notering']; ?>">
        <label class="form-label" for="notering">Notering</label>
    </div>
    <div class="form-floating"> 
        <input class="form-control" type="text" name="storlek" id="storlek" value="<?php echo $object['Storlek'] ;?>">
        <label class="form-label" for="storlek">Storlek</label>
    </div>
    <div class="form-floating">
        <input class="form-control" type="text" name="tidsepok" id="tidsepok" value="<?php echo $object['Tidsepok']; ?>">
        <label class="form-label" for="tidsepok">Tidsepok</label>
    </div>
    <div class="form-floating">
        <input class="form-control" type="text" name="story" id="story" value="<?php echo $object['Story'];?>">
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