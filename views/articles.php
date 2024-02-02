<?php 
include(dirname(__DIR__) . '/api/db.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: /admin/login');
    $mysqli -> close();
    exit();
}

$sql = "SELECT * FROM Articles";
$articles = $mysqli -> query($sql) -> fetch_all(MYSQLI_ASSOC);
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<?php include dirname(__DIR__) . '/views/components/header.php'; ?>
<div class="d-flex flex-column gap-3 mx-auto my-5" style="max-width: 768px;">
    <h3>Articles</h3>
    <div>
        <a href="/admin/createarticle" class="btn btn-success">New Article</a>
    </div>    
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($articles as $key => $value) {
                        echo "<tr>
                                <th scope='row'>".$value['Id']."</th>
                                <td>".$value['Name']."</td>
                                <td class='d-flex gap-1'>
                                    <a class='ms-auto btn btn-warning text-white' href='/admin/editarticle/".$value['Id']."'>Edit</a>
                                    <a class='btn btn-danger' href='/admin/deletearticle/".$value['Id']."'>Delete</a>
                                </td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
