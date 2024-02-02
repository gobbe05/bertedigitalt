<?php
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    $mysqli -> close();
    exit();
}
if(!isset($_GET['id'])){
    header('Location: /admin?error=Please pass an id when editing a category!');
    $mysqli -> close();
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM Kategorier WHERE Id=? LIMIT 1";
$category = $mysqli -> execute_query($sql, [$id]) -> fetch_assoc();
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<form class="d-flex flex-column gap-1 mx-auto my-5" style="width: 768px;" action="/admin/editcategory?id=<?php echo $category['Id']; ?>" method="post">
  <div class="d-flex my-2">
    <a href="/admin/dashboard" class="btn btn-dark d-flex align-items-center gap-1 my-2">Back <span class="material-symbols-outlined">arrow_back</span></a>
  </div>  
  <h3>Edit Category</h3>  
    <div class="form-floating">
        <input class="form-control" type="text" value="<?php echo $category['Kategori']; ?>" name="kategori" id="objekt" required>
        <label class="form-label" for="objekt">Namn</label>
    </div>
    <div class="form-floating">
        <input class="form-control" type="text" name="uniktid" id="givare" value="<?php echo $category['Unikt Id'];?>" required>
        <label class="form-label" for="givare">Unikt ID</label>
    </div>
    <div class="modal" tabindex="-1" id="modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Save Changes?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Are you sure that you want to save changes to category?</p>
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