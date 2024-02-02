<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    $mysqli -> close();
    exit();
}

$sql = "SELECT * FROM SubMenus WHERE Id=?";
$submenu = $mysqli -> execute_query($sql, [$id]) -> fetch_object();
$sql = "SELECT * FROM Menus";
$menus = $mysqli -> query($sql) -> fetch_all(MYSQLI_ASSOC);
$sql = "SELECT * FROM Articles";
$articles = $mysqli -> query($sql) -> fetch_all(MYSQLI_ASSOC);
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<div class="mx-auto my-5" style="width: 768px;">
    <a class="btn btn-dark my-2" href="/admin/submenus/<?= $submenu->Menu ?>">Back</a>
    <form class="d-flex flex-column gap-2" action="/admin/editsubmenu?id=<?= $id ?>" method="POST">
        <div class="form-floating">
            <input value="<?php echo $submenu->Name ?>" class="form-control" name="name" id="name" type="text" />
            <label class="form-label" for="name">Name</label>
        </div>
        <label class="form-label">Menu</label>
        <select class="form-control" name="menu">
            <?php 
            
                foreach($menus as $key => $value) {
                    if($value['Id'] == $submenu->Menu)
                    echo "<option value='".$value['Id']."' selected>".$value['Name']."</option>";
                    else
                    echo "<option value='".$value['Id']."'>".$value['Name']."</option>";
                }
            ?>
        </select>
        <label class="form-label">Article</label>
        <select class="form-control" name="article">
            <?php 
            
                foreach($articles as $key => $value) {
                    if($value['Id'] == $submenu->Article)
                    echo "<option value='".$value['Id']."' selected>".$value['Name']."</option>";
                    else
                    echo "<option value='".$value['Id']."'>".$value['Name']."</option>";
                }
            
            ?>
        </select>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>