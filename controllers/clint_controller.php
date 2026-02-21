<?php


include '../database/clint_logics.php';


if(isset($_POST['states'])){

    $clint->loadState();}


else if(isset($_POST['city'])){
$state=$_POST['state'] ;
$clint->loadCity($state);
}

else if(isset($_POST['insert_clint'])=='submit'){
    $c_name=$_POST['clint_name'];
    $c_number=$_POST['clint_phone'];
    $c_address=$_POST['clint_address'];
    $c_state=$_POST['clint_state'];
    $c_city=$_POST['clint_city'];
    $c_pincode=$_POST['clint_pincode'];
    $clint->insert($c_name,$c_number,$c_address,$c_state,$c_city,$c_pincode);

}
?>