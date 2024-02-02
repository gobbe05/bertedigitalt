<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    $mysqli -> close();
    exit();
}

$sql = "SELECT * FROM Menus";
$menus = $mysqli -> query($sql) -> fetch_all(MYSQLI_ASSOC);
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<?php include dirname(__DIR__) . '/views/components/header.php'; ?>
<div class="d-flex flex-column gap-3 mx-auto my-5" style="width: 768px;">
    <h3>Menus</h3>
    <div>
        <a href="/admin/createmenu" class="btn btn-success">New Menu</a>
    </div>
    
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Article</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($menus as $key => $value) {
                        $sql = "SELECT * FROM Articles WHERE Id=". $value['Article'] ."";
                        $article = $mysqli -> query($sql) -> fetch_object();
                        echo "<tr>
                                <th scope='row'>".$value['Id']."</th>
                                <td>".$value['Name']."</td>
                                <td>".$article->Name."</td>
                                <td>
                                    <div class='d-flex gap-1'>
                                        <a class='btn btn-primary ms-auto' href='/admin/submenus/".$value['Id']."'>Submenus</a>
                                        <a class='btn btn-warning text-white' href='/admin/editmenu/".$value['Id']."'>Edit</a>
                                        <a class='btn btn-danger' href='/admin/deletemenu/".$value['Id']."'>Delete</a>
                                    </div>
                                </td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
