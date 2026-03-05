<?php


include '../project/database/db_logics.php';

if(isset($_POST['submit_item'])){
    $table='items';
    $i_name=$_POST['item_name'];
    $i_price=$_POST['item_price'];
    $i_description=$_POST['item_description'];
    $i_image=basename($_POST['itemimage']);
    echo $i_image;
    // $crud->insertData($table,['item_name'=>$i_name,'price'=>$i_price,'description'=>$i_description,'item_image'=>$i_image]);
}


?>