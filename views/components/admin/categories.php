<?php 
include(dirname(dirname(dirname(__DIR__))) . '/api/db.php');
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    exit();
}

// Kategori
$sql = "SELECT * FROM Kategorier";
$categories = $mysqli -> query($sql) -> fetch_all(MYSQLI_ASSOC);
$mysqli -> close();

?>
<div class="d-flex">
    <a href="/admin/createcategory" class="btn btn-success my-2 d-flex justify-content-center align-items-center">New <span class="material-symbols-outlined">add</span></a>
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
                    echo "<td scope='row'>". $category['Unikt Id'] ."</td>";
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