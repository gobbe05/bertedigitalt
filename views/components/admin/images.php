<?php 
include(dirname(dirname(dirname(__DIR__))) . '/api/db.php');
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    exit();
}

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $sql = "SELECT * FROM Image WHERE Object_Id=? ORDER BY Object_Id";
  $files = $mysqli -> execute_query($sql, [$id]) -> fetch_all(MYSQLI_ASSOC);
} else {
  $sql = "SELECT * FROM Image ORDER BY Object_Id";
  $files = $mysqli -> query($sql) -> fetch_all(MYSQLI_ASSOC);
}
if(count($files) == 0) {exit();}
?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th class="text-nowrap">File Path</th>
            <th class="text-nowrap">Object ID</th>
            <th class="text-nowrap">Object Name</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach ($files as $file) {
                $sql = "SELECT * FROM Objekt WHERE Id=? LIMIT 1";
                $object = $mysqli -> execute_query($sql, [$file['Object_Id']]) -> fetch_object();
                echo "<tr>";
                    echo "<th scope='row'>". $file['Id'] ."</th>";
                    echo "<td>". $file['Image'] ."</td>";
                    echo "<td scope='row'>". $file['Object_Id'] ."</td>";
                    echo "<td scope='row'>". $object->Objekt ."</td>";
                    echo "<td class='d-flex gap-1'>
                            <a target='_blank' href='". $file['Image'] ."' class='text-nowrap btn btn-primary ms-auto'>Show File</a>
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