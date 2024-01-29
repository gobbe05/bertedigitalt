<?php 
include(dirname(__DIR__) . '/api/db.php');

$objekt = "";

$sql = "SELECT * FROM Kategorier";
$categories = $mysqli -> query($sql) -> fetch_all(MYSQLI_ASSOC);

$page = 1;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
}
if(!isset($_GET['objekt']) && !isset($_GET['kategori'])) 
{
    $sql = "SELECT * FROM Objekt LIMIT 25 OFFSET ?";
    $objects = $mysqli -> execute_query($sql, [($page-1)*25]) -> fetch_all(MYSQLI_ASSOC);
    $sql = "SELECT COUNT(*) FROM Objekt";
    $count = $mysqli -> query($sql) -> fetch_object();
}
else {
    $objekt = $_GET['objekt'];
    $kategori = $_GET['kategori'];
    $sql = "SELECT * FROM Objekt
            WHERE 
            Objekt LIKE ? AND
            Kategori LIKE ?
            LIMIT 25 OFFSET ?";
    $objects = $mysqli -> execute_query($sql, ["%".$objekt."%", "%".$kategori."%", ($page-1)*25]) -> fetch_all(MYSQLI_ASSOC);
    $sql = "SELECT COUNT(*) FROM Objekt
            WHERE 
            Objekt LIKE ? AND
            Kategori LIKE ?";
    $count = $mysqli -> execute_query($sql, ["%".$objekt."%", "%".$kategori."%"]) -> fetch_object();
}
if($count->{'COUNT(*)'} == 0)
$pages = 0;
else
$pages = ceil($count->{'COUNT(*)'}/25);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<div class="m-2 mx-auto" style="max-width: 768px;">
    <form class="d-flex flex-column gap-3" action="">
        <div class="form-floating">
            <input class="form-control" type="text" name="objekt" id="objekt" value="<?php echo $objekt; ?>">
            <label class="form-label" for="name">Namn</label>
        </div>
        <select class="form-select" name="kategori" id="kategori" aria-label="kategori">
            <option value=""></option>
            <?php 
                foreach($categories as $key => $value) {
                    if($value['Kategori'] == $kategori) 
                    echo "<option value='".$value['Kategori']."' selected>".$value['Kategori']."</option>";
                    else
                    echo "<option value='".$value['Kategori']."'>".$value['Kategori']."</option>";
                }
            ?>
        </select>
        
        <?php if(isset($_GET['kategori']) || isset($_GET['name'])) {
            echo "<div class='d-flex'>
<a href='/digitalt-arkiv/arkiv' class='d-flex align-items-center gap-1 btn btn-danger ms-auto'>Clear <span class='material-symbols-outlined'>close</span></a>
</div>";
        }?>
        <button class="bg-primary text-white btn btn-primary d-flex align-items-center justify-content-center gap-1" type="submit">Search <span class="material-symbols-outlined">search</span></button>

    </form>

    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col">Objekt</th>
                <th>Kategori</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            <?php 

                    foreach ($objects as $key => $value) {
                        echo "<tr>";
                        echo "<td class='p-0'><a class='text-decoration-none text-black p-2 d-block' href='/digitalt-arkiv/objekt?uniktid=".$value['Id']."'>". $value['Objekt']."</a></td>";
                        echo "<td class='p-0'><a class='text-decoration-none text-black p-2 d-block' href='/digitalt-arkiv/objekt?uniktid=".$value['Id']."'>". $value['Kategori']."</a></td>";
                        echo "<td class='p-0'><a class='text-decoration-none text-black p-2 d-block' href='/digitalt-arkiv/objekt?uniktid=".$value['Id']."'>". $value['Id']."</a></td>";
                        echo "</tr>";
                    }
                
            ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>