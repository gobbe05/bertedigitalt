<?php 
include(dirname(dirname(dirname(__DIR__))) . '/api/db.php');
if(!isset($_SESSION['loggedin'])){
    header('Location: /login');
    exit();
}

// Objekt
$sql = "SELECT * FROM Objekt";
$objects = $mysqli -> query($sql) -> fetch_all(MYSQLI_ASSOC);
$mysqli -> close();
?>

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
                            <a href='/admin/addfiletoobject/?id=". $object['Id'] ."' class='ms-auto btn btn-success text-white d-flex align-items-center gap-1'>Add File <span class='material-symbols-outlined'>add</span></a>
                            <a href='/admin/editobject/?id=". $object['Id'] ."' class='btn btn-warning text-white d-flex align-items-center gap-1'>Edit <span class='material-symbols-outlined'>edit</span></a>
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