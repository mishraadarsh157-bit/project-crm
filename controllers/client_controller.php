<?php


include '../database/client_logics.php';

include '../database/db_logics.php';

if(isset($_POST['page_name'])){
$table1="client";
$table2="cities";
$table3="states";

// $client->loadClients("client","cities","states");
$crud->fetchData("SELECT client_id,client_name,phone,client_email,address,name,city,pincode,client_status FROM $table1 inner join $table2 on $table1.city_id=$table2.id inner join $table3 on $table1.state_id= $table3.id"
);

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
    

$client->insert("client",['client_name'=>$c_name,'phone'=>$c_number,'client_email'=>$c_email,'address'=>$c_address,'city_id'=>$c_city,'state_id'=>$c_state,'pincode'=>$c_pincode]);
}

else if(isset($_POST['update_c'])){
    $id=$_POST['id'];
    $client->loadUpadteform('client','states','cities',$id);
}


else if(isset($_POST['update_client'])){
    $c_id=$_POST['id'];
    $c_name=$_POST['client_name'];
    $c_number=$_POST['client_phone'];
    $c_email=$_POST['client_email'];
    $c_address=$_POST['client_address'];
    $c_city=$_POST['client_city'];
    $c_state=$_POST['client_state'];
    $c_pincode=$_POST['client_pincode'];
    $c_status=$_POST['client_status'];
    
$client->update("client",['client_name'=>$c_name,'phone'=>$c_number,'client_email'=>$c_email,'address'=>$c_address,'city_id'=>$c_city,'state_id'=>$c_state,'pincode'=>$c_pincode,'client_status'=>$c_status],$c_id);
}


?>