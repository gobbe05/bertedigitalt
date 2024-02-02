<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    $mysqli -> close();
    exit();
}

$sql = "SELECT * FROM Articles WHERE Id=?";
$article = $mysqli -> execute_query($sql, [$id]) -> fetch_object();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<div class="mx-auto mt-5" style="max-width: 768px;">
    <a class="btn btn-dark" href="/admin/articles">Back</a>
    <form class="d-flex flex-column gap-2 my-2" action="/admin/editarticle?id=<?php echo $article->Id; ?>" method="POST">
        <div class="form-floating">
            <input value="<?php echo $article->Name ?>" class="form-control" name="name" id="name" />
            <label class="form-label" for="name">Name</label>
        </div>
        <div class="form-floating">
            <textarea style="min-height: 500px;" class="form-control" name="content" id="content"><?php echo $article->Content ?></textarea>
            <label class="form-label" for="content">Content</label>
        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
</div>