  <?php 
session_start();
if (!isset($_SESSION['admin'])) {
  echo "<script>
   window.location.href = '../pages/login.php';
  </script>";
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROJECT</title>
    <link rel="stylesheet" href="../assets/css/icon.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/javascript/bootstrap.js"></script>
</head>

<body class="text-sm " >

    <?php 
    include_once "header.php";
    ?>
    <div class="body container-fluid row m-0 p-0">
        
    <?php 
    include_once "left_sidebar.php";
    ?>
   



</body>
<script src="../assets/javascript/jquery.js"></script> 
    <script src="../assets/javascript/script.js"></script>
    <script src="../assets/javascript/validations.js"></script>
</html>
 