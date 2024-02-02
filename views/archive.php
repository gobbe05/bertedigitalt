<?php 

if(isset($_GET['galleryview']) && $_GET['galleryview'] == 1) {
    include dirname(__DIR__) . '/views/imageview.php';
} else {
    include dirname(__DIR__) . '/views/listview.php';
}

?>