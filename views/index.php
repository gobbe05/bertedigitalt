<?php 

include dirname(__DIR__) . '/views/components/content/header.php';

$sql = "SELECT * FROM Articles WHERE Name='Index' LIMIT 1";
$article = $mysqli -> query($sql) -> fetch_object();

$content = $article->Content;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body style="background: #F5F5F5;">
    <div style="max-width: 768px;" class="mx-3 mx-md-auto my-5">
    <?php if($content[0] == "{" && $content[strlen($content)-1] == "}") {
        $file = trim($content, "{");
        $file = trim($file, "}");
        
        include dirname(__DIR__) . "/views/" . $file;
    } else {
        echo $content;
    }
    ?>
</div>
</body>
</html>