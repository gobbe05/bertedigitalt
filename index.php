<?php 

require_once __DIR__ . '/router.php';

get("/admin/login", 'views/login.php');
get("/admin/logout", "api/logout.php");
get("/admin/dashboard", "views/admin.php");
get('/admin/editobject/$id', 'views/editobject.php');
get('/admin/editcategory/$id', 'views/editcategory.php');
get('/admin/createobject', "views/createobject.php");
get('/admin/addfiletoobject/$id', 'views/addfiletoobject.php');
get('/admin/createobject/$error', "views/createobject.php");
get('/admin/createcategory', 'views/createcategory.php');
get('/admin/deleteobject/$id', 'api/deleteobject.php');
get('/admin/deletecategory/$id', 'api/deletecategory.php');
get("/archive/listview", "views/listview.php");
get("/archive/imageview", "views/imageview.php");
get('/admin/deletefile/$id', 'api/deletefile.php');
get('/objekt/$uniktid', 'views/object.php');

post("/admin/login", "api/login.php");
post('/admin/createobject', 'api/createobject.php');
post('/admin/createcategory', 'api/createcategory.php');
post('/admin/addfiletoobject', 'api/addfiletoobject.php');
post('/admin/editobject', 'api/editobject.php');
post('/admin/editcategory', 'api/editcategory.php');

any("/404", 'views/404.php');

?>