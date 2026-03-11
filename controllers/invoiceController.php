<?php

include '../project/database/db_logics.php';


switch (true) {
    case isset($_POST['invoice']):
        
        $table = $_POST['invoice'];
        $page=$_POST['page']??1;
        $search = $_POST['search'];
        $field = $_POST['field'];
        $order = $_POST['order'];
        $limit = $_POST['limit'];
        $offset=($page-1)*$limit;
        $crud->fetchData($table, $limit, "select * from $table where
        invoiceID like '%$search%' or 
         client_name like '%$search%' or
        item_name like '%$search%' or
         itemPrice like '%$search%' 
         order by $field $order 
         ", " limit $offset ,$limit");
        break;


    case isset($_POST['client_name']):
        $name = $_POST['client_name'];
        $crud->fetchData('client', 1, "select client_name,client_email,phone from client 
    where client_name like '%$name%' ", 'limit 1');

        break;
    case isset($_POST['item_name']):
        $name = $_POST['item_name'];
        $crud->fetchData('items', 1, "select item_name,price from items 
    where item_name like '%$name%' ", 'limit 1');
        break;
    default:

        break;
}



















