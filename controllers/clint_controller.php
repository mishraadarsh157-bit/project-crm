<?php


include '../database/clint_logics.php';


if(isset($_POST['states'])){

    $clint->loadState();}
else if(isset($_POST['lodcity'])){
$states=$_POST['states'] ;
$clint->loadCity($states);
}
?>