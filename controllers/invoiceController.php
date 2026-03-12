<?php

include '../project/database/db_logics.php';
include '../project/database/invoiceAPI.php';

$servername = "localhost";
$username = "root";
$password = "";
$database = "usermaster";
$port = "3309";

$conn = new mysqli($servername, $username, $password, $database, $port) or die("not connected to data base");


switch (true) {
    case isset($_POST['invoice']):

        $table = $_POST['invoice'];
        $page = $_POST['page'] ?? 1;
        $search = $_POST['search'];
        $field = $_POST['field'];
        $order = $_POST['order'];
        $limit = $_POST['limit'];
        $offset = ($page - 1) * $limit;
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
        $crud->fetchData('client', 1, "select client_id,client_name,client_email,phone from client 
    where client_name like '%$name%' ", 'limit 1');

        break;



    case isset($_POST['item_name']):
        $itemname = $_POST['item_name']??"";
        $data=array();
        foreach ($itemname as $name) {
            $name = mysqli_real_escape_string($conn, $name);
            
            array_push($data,$invoice->fetchitemData("select * from items where item_name='$name' limit 1"));
            }
            
            $json=json_encode($data);
            echo $json;
            break;
            
            
            
            
            case isset($_POST['invoice_No']):
                $crud->fetchData('invoice', 1, 'select InvoiceNo from invoice order by InvoiceNo desc ', "limit 1");
                break;
                
                case isset($_POST['addInvoice']):
                    $invoiceNo=$_POST['invoiceNo'];
                    $client=$_POST['client'];
                    $item=$_POST['item'];
                    $quantity=$_POST['quantity']??1;
                    echo "this $invoiceNo $client $quantity this";
                    foreach($item as $name){
                $name = mysqli_real_escape_string($conn, $name);
            $crud->modifyData("insert into invoiceitem(LineNo,InvoiceNo,ItemNo,Quantity) values 
            (1,$invoiceNo,$name,$quantity)
            
            ");
            $crud->modifyData("insert into invoice(InvoiceNo,ClientABN,InvDate)
            values($invoiceNo,$client,now())");
            }
            break;
            
            
            
            
            
            default:
        break;
}
