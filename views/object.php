<?php

include(dirname(__DIR__) . '/api/db.php');

if(!isset($_GET['uniktid'])) {
    header('Location: /archive');
}

$id = $_GET['uniktid'];
$sql = "SELECT * FROM Objekt WHERE Id=? LIMIT 1";
$object = $mysqli -> execute_query($sql, [$id]) -> fetch_object();

$sql = "SELECT * FROM Image WHERE Object_Id=?";
$images = $mysqli -> execute_query($sql, [$id]) -> fetch_all(MYSQLI_ASSOC);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php 
    
        foreach ($images as $key => $image) {
          if($key == 0){
            echo "<div class='carousel-item active' style='height: 300px;'>
                    <img src='". $image['Image'] ."' class='d-block h-100 mx-auto'>
                </div>";
          } else {
            echo "<div class='carousel-item'  style='height: 300px;'>
                    <img src='". $image['Image'] ."' class='d-block h-100 mx-auto'>
                </div>";
          }
        }
    
    ?>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="d-flex flex-column gap-3">
  <div class="d-flex gap-2" style="margin-top: 150px;">
      <?php if($object->Objekt != ""){
        echo "<div class='flex-grow-1'>
                <h3 class='border-bottom pb-2 border-black'>Namn</h3>
                <p>".$object->Objekt."</p>
              </div>";
      } ?>

      <?php if($object->Kategori != ""){
        echo "<div class='flex-grow-1'>
                <h3 class='border-bottom pb-2 border-black'>Kategori</h3>
                <p>".$object->Kategori."</p>
              </div>";
      }?>
    </div>
    <?php if($object->Givare != "" && $object->GivarePublik != 0){
      echo "<div class='d-flex flex-column align-items-start'>
              <h5 class='border-bottom border-black pb-2 pe-3'>Givare</h5>
              <p>".$object->Givare."</p>
            </div>";
    } ?>
    <?php if($object->Notering != ""){
      echo "<div class='d-flex flex-column align-items-start'>
              <h5 class='border-bottom border-black pb-2 pe-3'>Notering</h5>
              <p>".$object->Notering."</p>
            </div>";
    }?>
    <?php if($object->Storlek != ""){
      echo "<div class='d-flex flex-column align-items-start'>
              <h5 class='border-bottom border-black pb-2 pe-3'>Storlek</h5>
              <p>".$object->Storlek."</p>
            </div>";
    }?>
    <?php if($object->Tidsepok != ""){
      echo "<div class='d-flex flex-column align-items-start'>
              <h5 class='border-bottom border-black pb-2 pe-3'>Tidsepok</h5>
              <p>".$object->Tidsepok."</p>
            </div>";
    }?>
    <?php if($object->Story != ""){
      echo "<div class='d-flex flex-column align-items-start'>
              <h5 class='border-bottom border-black pb-2 pe-3'>Story</h5>
              <p>".$object->Story."</p>
            </div>";
    }?>
</div>