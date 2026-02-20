<?php
include '../database/loginlogics.php';
session_start();

if(isset($_POST["submit"])===TRUE){
$name=$_POST['name'];
$password=$_POST['password'];

$user->userInfo($name,$password);
}

else if(isset($_POST['logout'])){
    $user->logout();
}
?>