
<?php
session_start();

if (isset($_SESSION['admin'])===true) {
    echo "<script>
   window.location.href = 'http://localhost/project/pages/home.php';
  </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="http://localhost/project/assets/css/bootstrap.css">
    <link rel="stylesheet" href="http://localhost/project/assets/css/style.css">
    <script src="http://localhost/project/assets/javascript/bootstrap.js"></script>
</head>
<style>
</style>
<body class='bg-danger'>
    <div class="contaner-fluid m-0 row login_page p-5">
       <div class="login_image col-6 ms-5"></div> 
        <div class="col-5 login_bg  justify-content-center p-5">
            <form class="login-form m-5 p-5 ">
                <h1 class=" mb-4" align="center">LOGIN</h1>
                Email :
                <input type="email" name="email" id="email" class="form-control from-control-sm rounded mb-3">
                <div class="email_valid text-danger"></div>
                Password :
                <input type="password" name="password" id="password" onchange="login()" class="form-control from-control-sm rounded mb-3">
                <div class="pass_valid text-danger"></div>
                <input type="button" name="submit" id="user_login" onclick="login()" value="SUBMIT"  class="btn btn-sm text-white bg-danger w-100 rounded my-3">
           

            </form>
        </div>
       
    </div>
</body>
<script src="http://localhost/project/assets/javascript/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="http://localhost/project/assets/javascript/validations.js"></script>

<script src="http://localhost/project/assets/javascript/script.js"></script>

</html>