<?php 
include dirname(dirname(dirname(__DIR__))) . '/api/db.php';

$sql = "SELECT * FROM Menus";
$menus = $mysqli -> query($sql) -> fetch_all(MYSQLI_ASSOC);

?>

<nav class="navbar navbar-expand-lg p-4 bg-white">
    <div class="container-fluid">
        <a href="/"><img src="/images/logos/Berte-museum.png" height=64/></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-md-auto me-md-5">
            <?php 
            
            foreach($menus as $key => $menu) {
                $sql = "SELECT * FROM SubMenus WHERE Menu=?";
                $submenus = $mysqli -> execute_query($sql, [$menu['Id']]) -> fetch_all(MYSQLI_ASSOC);
                if(count($submenus) == 0) 
                echo "  <li class='nav-item'>
                            <a class='nav-link' href='/".$menu['Path']."'>".$menu['Name']."</a>
                        </li>";
                else {
                echo "<li class='nav-item dropdown'>
                        <a class='nav-link dropdown-toggle' href='/".$menu['Path']."' role='button' data-bs-toggle='dropdown'>".$menu['Name']."</a>
                        <ul class='dropdown-menu'>";
                foreach($submenus as $key => $submenu) {
                    echo "  <li><a class='dropdown-item' href='/".$menu['Path']."/".$submenu['Path']."'>".$submenu['Name']."</a></li>";
                }
                echo "  </ul>
                    </li>";
                }
            }
            ?>
            </ul>
        </div>
        
    </div>
</nav>