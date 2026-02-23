<?php


include '../database/client_logics.php';

if(isset($_POST['page_name'])){

$client->loadClients("client","cities","states");

}

else if(isset($_POST['states'])){

    $client->loadState();}


else if(isset($_POST['city'])){
$state=$_POST['state'] ;
$client->loadCity($state);
}

else if(isset($_POST['insert_client'])=='submit'){
    $c_name=$_POST['client_name'];
    $c_number=$_POST['client_phone'];
    $c_email=$_POST['client_email'];
    $c_address=$_POST['client_address'];
    $c_state=$_POST['client_state'];
    $c_city=$_POST['client_city'];
    $c_pincode=$_POST['client_pincode'];
    $client->insert($c_name,$c_number,$c_email,$c_address,$c_city,$c_state,$c_pincode);

}

?>