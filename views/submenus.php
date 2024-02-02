<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    $mysqli -> close();
    exit();
}
if(!isset($menu)) {
    header('Location: /admin/menus');
    exit();
}
$sql = "SELECT * FROM Menus WHERE Id=?";
$menu = $mysqli -> execute_query($sql, [$menu]) -> fetch_object();

$sql = "SELECT * FROM SubMenus WHERE Menu=?";
$submenus = $mysqli -> execute_query($sql, [$menu->Id]) -> fetch_all(MYSQLI_ASSOC);
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<?php include dirname(__DIR__) . '/views/components/header.php'; ?>
<div class="mx-auto mt-5" style="width: 768px;">
    <h3>Menu - <?php echo $menu->Name; ?></h3>
    <a class="btn btn-dark" href="/admin/menus">Back</a>
    <a href="/admin/createsubmenu" class="btn btn-success my-2">New submenu</a>
    
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Article</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($submenus as $key => $value) {
                        $sql = "SELECT * FROM Articles WHERE Id=". $value['Article'] ."";
                        $article = $mysqli -> query($sql) -> fetch_object();
                        echo "<tr>
                                <th scope='row'>".$value['Id']."</th>
                                <td>".$value['Name']."</td>
                                <td>".$article->Name."</td>
                                <td>
                                    
                                    <div class='d-flex gap-1'>
                                        <a class='ms-auto btn btn-warning text-white' href='/admin/editsubmenu/".$value['Id']."'>Edit</a>
                                        <a class='btn btn-danger' href='/admin/deletesubmenu/".$value['Id']."'>Delete</a>
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
