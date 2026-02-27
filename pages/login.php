
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
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    *{
        font-family: poppins;
        letter-spacing: 1px;
    }
    
</style>
<body>
    <div class="contaner-fluid m-0 row login_page p-5">
       <div class="login_image col-6 bg-primary rounded ms-5"></div>  <div class="col-5 bg-dark  justify-content-center p-5 rounded">
            <form class="login-form m-5 p-5 ">
                <h1 class="h1 mb-4" align="center">LOGIN</h1>
                Email :
                <input type="email" name="email" id="email" class="form-control from-control-sm rounded mb-3">
                <div id="email_valid"></div>
                Password :
                <input type="password" name="password" id="password" class="form-control from-control-sm rounded mb-3">
                <div id="pass_valid"></div>
                <input type="button" name="submit" id="user_login" value="SUBMIT"  class="btn btn-sm text-white bg-danger w-100 rounded my-3">
           

            </form>
        </div>
       
    </div>
</body>
<script src="http://localhost/project/assets/javascript/jquery.js"></script>

<script src="http://localhost/project/assets/javascript/script.js"></script>
<script src="http://localhost/project/assets/javascript/validations.js"></script>

</html>