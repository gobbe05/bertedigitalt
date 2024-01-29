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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<div class="mx-auto" style="max-width: 768px;">
    <form class="d-flex flex-column gap-3 my-2" action="">
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
                    <a href='/digitalt-arkiv/gallery' class='d-flex align-items-center gap-1 btn btn-danger ms-auto'>Clear <span class='material-symbols-outlined'>close</span></a>
                </div>";
        }?>
        <button class="bg-primary text-white btn btn-primary d-flex align-items-center justify-content-center gap-1" type="submit">Search <span class="material-symbols-outlined">search</span></button>

    </form>
    <div class="d-grid gap-2 mx-auto" style="grid-template-columns: 1fr 1fr 1fr;"> 
        <div class="d-flex flex-column">
            <?php 
                for ($i=0; $i < count($objects); $i+=3) {
                    $sql = "SELECT * FROM Image WHERE Object_Id=? LIMIT 1";
                    $image = $mysqli -> execute_query($sql, [$objects[$i]['Id']]) -> fetch_object();
                    if(isset($image->Image))
                    echo "<a href='/digitalt-arkiv/objekt?uniktid=". $objects[$i]['Id'] ."'>
                            <img loading='lazy' width='200' class='w-100' src='". $image->Image ."' />
                            <p class='text-center'>".$objects[$i]['Objekt']."</p>
                        </a>";
                }
            ?>
        </div>
        <div class="d-flex flex-column">
            <?php 
                for ($i=1; $i < count($objects); $i+=3) { 
                    $sql = "SELECT * FROM Image WHERE Object_Id=? LIMIT 1";
                    $image = $mysqli -> execute_query($sql, [$objects[$i]['Id']]) -> fetch_object();
                    
                    if(isset($image->Image)) {
                        $thumb = exif_thumbnail($image->Image, 100, 100);
                        echo "<a href='/digitalt-arkiv/objekt?uniktid=". $objects[$i]['Id'] ."'>
                            <img loading='lazy' width='200' class='w-100' src='". $image->Image ."' />
                            <p class='text-center'>".$objects[$i]['Objekt']."</p>
                        </a>";
                    }
                }
            ?>
        </div>
        <div class="d-flex flex-column">
            <?php 
                for ($i=2; $i < count($objects); $i+=3) { 
                    $sql = "SELECT * FROM Image WHERE Object_Id=? LIMIT 1";
                    $image = $mysqli -> execute_query($sql, [$objects[$i]['Id']]) -> fetch_object();
                    if(isset($image->Image))
                    echo "<a href='/digitalt-arkiv/objekt?uniktid=". $objects[$i]['Id'] ."'>
                            <img loading='lazy' width='200' class='w-100' src='". $image->Image ."' />
                            <p class='text-center'>".$objects[$i]['Objekt']."</p>
                        </a>";
                }
            ?>
        </div>
    </div>
    <nav class=" <?php if($pages == 0) echo "d-none"; ?>" aria-label="Page navigation example">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>