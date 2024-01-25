<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    exit();
}

$sql = "SELECT COUNT(*) FROM Objekt";
$objectcount = $mysqli -> query($sql) -> fetch_assoc()['COUNT(*)'];
$sql = "SELECT COUNT(*) FROM Image";
$imagecount = $mysqli -> query($sql) -> fetch_assoc()['COUNT(*)'];

?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<?php include dirname(__DIR__) . '/views/components/header.php'; ?>
<div class="mx-5 mt-5">
    <p>Number of objects : <b><?php echo $objectcount; ?></b></p>
    <p>Number of images : <b><?php echo $imagecount; ?></b></p>
    <div id="accordion" class="accordion">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseObject">Objects</button>
            </h2>
            <div id="collapseObject" class="accordion-collapse collapse" data-bs-parent="#accordion">
                <div class="accordion-body">
                    <?php include dirname(__DIR__) . '/views/components/admin/objects.php'; ?>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseCategories">Categories</button>
            </h2>
            <div id="collapseCategories" class="accordion-collapse collapse" data-bs-parent="#accordion">
                <div class="accordion-body">
                    <?php include dirname(__DIR__) . '/views/components/admin/categories.php'; ?>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseImages">Images</button>
            </h2>
            <div id="collapseImages" class="accordion-collapse collapse" data-bs-parent="#accordion">
                <div class="accordion-body">
                    <?php include dirname(__DIR__) . '/views/components/admin/images.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    if(isset($_GET['error'])){
        echo "
        <div class='alert alert-danger fixed-bottom m-5'>
            ". $_GET['error'] ."
        </div>";
    }
    if(isset($_GET['message'])){
        echo "
        <div class='alert alert-success fixed-bottom m-5'>
            ". $_GET['message'] ."
        </div>";
    }
    
    ?>
<script>
    const alert = document.querySelector(".alert");
    setTimeout(() => {
        alert.remove()
    }, 3000)
</script>