<?php
include 'database/loginlogics.php';
session_start();

if(isset($_POST["submit"])===TRUE){
$email=$_POST['email'];

$password=$_POST['password'];

$user->userInfo($email,$password);
}

else if(isset($_POST['logout'])){
    $user->logout();
}
?>