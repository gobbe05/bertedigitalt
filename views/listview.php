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

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<div class="m-2 mx-auto" style="max-width: 768px;">
    <h2 class="fw-lighter">Arkiv</h2>
    <form class="d-flex gap-3 my-2" action="">
        <div class="flex-grow-1">
            <input class="form-control" placeholder="Namn..." type="text" name="objekt" id="objekt" value="<?php echo $objekt; ?>">
        </div>
        <select class="form-select input-sm" style="width: 128px;" name="kategori" id="kategori" aria-label="kategori">
            <option value="">Kategori</option>
            <?php 
                foreach($categories as $key => $value) {
                    if($value['Kategori'] == $kategori) 
                    echo "<option value='".$value['Kategori']."' selected>".$value['Kategori']."</option>";
                    else
                    echo "<option value='".$value['Kategori']."'>".$value['Kategori']."</option>";
                }
            ?>
        </select>
            
        <?php if(isset($_GET['kategori']) && $_GET['kategori'] != "" || isset($_GET['objekt']) && $_GET['objekt'] != "") {
            echo "<div class='d-flex'>
                    <a href='/digitalt-arkiv' class='d-flex align-items-center gap-1 bg-danger text-white btn btn-danger ms-auto'>Clear <span class='material-symbols-outlined'>close</span></a>
                </div>";
        }?>
        <button class="bg-dark text-white btn btn-dark d-flex align-items-center justify-content-center gap-1" type="submit">Sök <span class="material-symbols-outlined">search</span></button>
        <a class="d-flex justify-content-center align-items-center text-decoration-none link-secondary" href="?galleryview=1"><span style="font-size: 40px;" class="material-symbols-outlined">grid_view</span></a>

    </form>

    <div class="bg-white mt-3 p-3 rounded">
        <table class="table">
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
                            echo "<td class='p-0'><a class='text-decoration-none text-black p-2 d-block' href='/objekt/".$value['Id']."'    >". $value['Objekt']."</a></td>";
                            echo "<td class='p-0'><a class='text-decoration-none text-black p-2 d-block' href='/objekt/".$value['Id']."'    >". $value['Kategori']."</a></td>";
                            echo "<td class='p-0'><a class='text-decoration-none text-black p-2 d-block' href='/objekt/".$value['Id']."'    >". $value['Id']."</a></td>";
                            echo "</tr>";
                        }
                    
                ?>
            </tbody>
        </table>
    </div>
    <nav class="mt-4 <?php if($pages == 0) echo "d-none"; ?>" aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
        <li class="page-item  <?php if($page == 1) echo "disabled"; ?>">
            <?php 
            if(isset($_GET['kategori']) || isset($_GET['namn']) || isset($_GET['page'])) 
            echo "<a class='page-link' href='". $_SERVER['REQUEST_URI']."&page=" . $page-1 ."'>Prev</a>";
            else 
            echo "<a class='page-link' href='". $_SERVER['REQUEST_URI']."?page=" . $page-1 ."'>Prev</a>";
            ?>
        </li>
        
            <?php 
            if(isset($_GET['kategori']) || isset($_GET['namn']) || isset($_GET['page'])) {
                for ($i=1; $i <= $pages; $i++) { 
                    echo "<li class='page-item'><a class='page-link' href='".$_SERVER['REQUEST_URI']."&page=" . $i ."'>".$i."</a></li>";
                }
            }
            else {
                for ($i=1; $i <= $pages; $i++) { 
                    echo "<li class='page-item'><a class='page-link' href='".$_SERVER['REQUEST_URI']."?page=". $i ."'>".$i."</a></li>";
                }
            } ?>        
        <li class="page-item  <?php if($page == $pages) echo "disabled"; ?>">
            <?php 
            if(isset($_GET['kategori']) || isset($_GET['namn']) || isset($_GET['page'])) 
            echo "<a class='page-link' href='". $_SERVER['REQUEST_URI']."&page=" . $page+1 ."'>Next</a>";
            else 
            echo "<a class='page-link' href='". $_SERVER['REQUEST_URI']."?page=" . $page+1 ."'>Next</a>";
            ?>
        </li>
        </ul>
    </nav>
</div>