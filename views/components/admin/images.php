<?php 
include(dirname(dirname(dirname(__DIR__))) . '/api/db.php');
if(!isset($_SESSION['loggedin'])){
    header('Location: /login');
    exit();
}

// Kategori
$sql = "SELECT * FROM Bilder ORDER BY ObjektID";
$files = $mysqli -> query($sql) -> fetch_all(MYSQLI_ASSOC);
$mysqli -> close();

?>


<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th>File Path</th>
            <th>Object ID</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach ($files as $file) {
                echo "<tr>";
                    echo "<th scope='row'>". $file['Id'] ."</th>";
                    echo "<td>". $file['filePath'] ."</td>";
                    echo "<td scope='row'>". $file['ObjektID'] ."</td>";
                    echo "<td class='d-flex gap-1'>
                            <a href='/". $file['filePath'] ."' class='btn btn-primary ms-auto'>Show File</a>
                            <button type='button' class='btn btn-danger d-flex align-items-center gap-1' data-bs-toggle='modal' data-bs-target='#filemodal". $file['Id'] ."'>Delete <span class='material-symbols-outlined'>delete</span></button>
                            <!-- Modal -->
                            <div class='modal fade' id='filemodal". $file['Id'] ."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
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
                                    <a href='/admin/deletefile/?id=". $file['Id'] ."' class='btn btn-danger d-flex align-items-center gap-1'>Delete <span class='material-symbols-outlined'>delete</span></a>
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