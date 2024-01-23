<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /login');
    exit();
}

// Objekt
$sql = "SELECT * FROM Objekt";
$objects = $mysqli -> query($sql) -> fetch_all(MYSQLI_ASSOC);

// Kategori
$sql = "SELECT * FROM Kategori";
$categories = $mysqli -> query($sql) -> fetch_all(MYSQLI_ASSOC);
$mysqli -> close();

?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<div class="d-flex">
    <a href="/admin/createobject" class="btn btn-success ms-auto d-flex justify-content-center align-items-center">New <span class="material-symbols-outlined">add</span></a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th>Objekt</th>
            <th>Kategori</th>
            <th>Givare</th>
            <th>Notering</th>
            <th>Storlek</th>
            <th>Tidsepok</th>
            <th>Story</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach ($objects as $object) {
                echo "<tr>";
                    echo "<th scope='row'>". $object['Id'] ."</th>";
                    echo "<td>". $object['Objekt'] ."</td>";
                    echo "<td>". $object['Kategori'] ."</td>";
                    echo "<td>". $object['Givare'] ."</td>";
                    echo "<td>". $object['Notering'] ."</td>";
                    echo "<td>". $object['Storlek'] ."</td>";
                    echo "<td>". $object['Tidsepok'] ."</td>";
                    echo "<td>". $object['Story'] ."</td>";
                    echo "<td class='d-flex gap-1'>
                            <a href='/admin/editobject/?id=". $object['Id'] ."' class='ms-auto btn btn-warning text-white d-flex align-items-center gap-1'>Edit <span class='material-symbols-outlined'>edit</span></a>
                            <button type='button' class='btn btn-danger d-flex align-items-center gap-1' data-bs-toggle='modal' data-bs-target='#modal". $object['Id'] ."'>Delete <span class='material-symbols-outlined'>delete</span></button>
                            <!-- Modal -->
                            <div class='modal fade' id='modal". $object['Id'] ."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                              <div class='modal-dialog'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel'>Delete object?</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                  </div>
                                  <div class='modal-body'>
                                    Are you sure that you want to delete the object?
                                  </div>
                                  <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                    <a href='/admin/deleteobject/?id=". $object['Id'] ."' class='btn btn-danger d-flex align-items-center gap-1'>Delete <span class='material-symbols-outlined'>delete</span></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </td>";
                echo "</tr>";
            }
        
        ?>
    </tbody>
</table>

<div class="d-flex">
    <a href="/admin/createcategory" class="btn btn-success ms-auto d-flex justify-content-center align-items-center">New <span class="material-symbols-outlined">add</span></a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th>Namn</th>
            <th>Unikt ID</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach ($categories as $category) {
                echo "<tr>";
                    echo "<th scope='row'>". $category['Id'] ."</th>";
                    echo "<td>". $category['Kategori'] ."</td>";
                    echo "<td scope='row'>". $category['UniktID'] ."</td>";
                    echo "<td class='d-flex gap-1'>
                            <a href='/admin/editcategory/?id=". $category['Id'] ."' class='ms-auto btn btn-warning text-white d-flex align-items-center gap-1'>Edit <span class='material-symbols-outlined'>edit</span></a>
                            <button type='button' class='btn btn-danger d-flex align-items-center gap-1' data-bs-toggle='modal' data-bs-target='#categorymodal". $category['Id'] ."'>Delete <span class='material-symbols-outlined'>delete</span></button>
                            <!-- Modal -->
                            <div class='modal fade' id='categorymodal". $category['Id'] ."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                              <div class='modal-dialog'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel'>Delete category?</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                  </div>
                                  <div class='modal-body'>
                                    Are you sure that you want to delete the category?
                                  </div>
                                  <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                    <a href='/admin/deletecategory/?id=". $category['Id'] ."' class='btn btn-danger d-flex align-items-center gap-1'>Delete <span class='material-symbols-outlined'>delete</span></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </td>";
                echo "</tr>";
            }
        
        ?>
    </tbody>
</table>