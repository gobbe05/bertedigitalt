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
<div class="mx-auto" style="max-width: 768px;">
    <h2 class="fw-lighter">Galleri</h2>
    <form class="d-flex gap-3 my-2" action="?galleryview=1">
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
                    <a href='/digitalt-arkiv?galleryview=1' class='d-flex align-items-center gap-1 bg-danger text-white btn btn-danger ms-auto'>Clear <span class='material-symbols-outlined'>close</span></a>
                </div>";
        }?>
        <input name="galleryview" type="hidden" value="1" />
        <button class="bg-dark text-white btn btn-dark d-flex align-items-center justify-content-center gap-1" type="submit">Sök <span class="material-symbols-outlined">search</span></button>
        <a class="d-flex justify-content-center align-items-center text-decoration-none link-secondary" href="?"><span style="font-size: 40px;" class="material-symbols-outlined">format_list_bulleted</span></a>
    </form>
    <div class="columns d-grid gap-3 mx-auto mt-3"> 
        <div class="d-flex flex-column gap-3">
            <?php 
                for ($i=0; $i < count($objects); $i+=3) {
                    $sql = "SELECT * FROM Image WHERE Object_Id=? LIMIT 1";
                    $image = $mysqli -> execute_query($sql, [$objects[$i]['Id']]) -> fetch_object();
                    $sql = "SELECT COUNT(*) FROM Image WHERE Object_Id=?";
                    $count = $mysqli -> execute_query($sql, [$objects[$i]['Id']]) -> fetch_object();
                    if(isset($image->Image))
                    echo "<a class='bg-white text-black text-decoration-none p-4 pb-1' href='/objekt/". $objects[$i]['Id'] ."'>
                            <img loading='lazy' class='w-100' src='". $image->Thumbnail ."' />
                            <div class='d-flex justify-content-between align-items-center mt-3'>
                            
                                <p>".$objects[$i]['Objekt']."</p>
                                <p class='fw-lighter text-nowrap'>".$count->{'COUNT(*)'}." Bilder</p>
                            </div>
                        </a>";
                }
            ?>
        </div>
        <div class="d-flex flex-column gap-3">
            <?php 
                for ($i=1; $i < count($objects); $i+=3) { 
                    $sql = "SELECT * FROM Image WHERE Object_Id=? LIMIT 1";
                    $image = $mysqli -> execute_query($sql, [$objects[$i]['Id']]) -> fetch_object();
                    if(isset($image->Image))
                    echo "<a class='bg-white text-black text-decoration-none p-4 pb-1' href='/objekt/". $objects[$i]['Id'] ."'>
                            <img loading='lazy' class='w-100' src='". $image->Thumbnail ."' />
                            <div class='d-flex justify-content-between align-items-center mt-3'>
                                <p>".$objects[$i]['Objekt']."</p>
                                <p class='fw-lighter text-nowrap'>".$count->{'COUNT(*)'}." Bilder</p>
                            </div>
                        </a>";
                }
            ?>
        </div>
        <div class="d-flex flex-column gap-3">
            <?php 
                for ($i=2; $i < count($objects); $i+=3) { 
                    $sql = "SELECT * FROM Image WHERE Object_Id=? LIMIT 1";
                    $image = $mysqli -> execute_query($sql, [$objects[$i]['Id']]) -> fetch_object();
                    if(isset($image->Image))
                    echo "<a class='bg-white text-black text-decoration-none p-4 pb-1' href='/objekt/". $objects[$i]['Id'] ."'>
                            <img loading='lazy' class='w-100' src='". $image->Thumbnail ."' />
                            <div class='d-flex justify-content-between align-items-center mt-3'>
                            
                                <p>".$objects[$i]['Objekt']."</p>
                                <p class='fw-lighter text-nowrap'>".$count->{'COUNT(*)'}." Bilder</p>
                            </div>
                        </a>";
                }
            ?>
        </div>
    </div>
    <nav class="mt-5 <?php if($pages == 0) echo "d-none"; ?>" aria-label="Page navigation example">
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

<style>
@media only screen and (min-width: 420px) {
  .columns {
    grid-template-columns: 1fr 1fr;
  }
}
@media only screen and (min-width: 600px) {
  .columns {
    grid-template-columns: 1fr 1fr 1fr;
  }
}
</style>