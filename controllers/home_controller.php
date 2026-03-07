<?php

include "./database/homelogics.php";

if(isset($_POST['table'])){
    $table=$_POST['table'];
    $id=$_POST['id'];
    $home->fetchTotal($table,$id);
}

else if(isset($_POST['status'])){
    $table=$_POST['tabl'];
    $id=$_POST['id'];
    $status=$_POST['status'];
    $value=$_POST['value'];
   echo $home->fetchstatusTotal($table,$id,$status,$value);
}
?>