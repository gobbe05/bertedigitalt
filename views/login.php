<?php 

session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    header('Location: /admin');
    exit();
}

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<form class="d-flex flex-column gap-1" action="/login" method="post">
    <h3>Login</h3>
    <div class="form-floating">
        <input type="text" class="form-control" name="username" id="username">
        <label class="form-label" for="username">Username</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" name="password" id="password">
        <label class="form-label" for="password">Password</label>
    </div>
    <button class="btn btn-primary" type="submit">Login</button>
</form>