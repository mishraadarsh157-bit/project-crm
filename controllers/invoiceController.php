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
        $table2 = 'client';
        $table3 = 'items';
        $page = $_POST['page'] ?? 1;
        $search = $_POST['search'];
        $field = $_POST['field'];
        $order = $_POST['order'];
        $limit = $_POST['limit'];
        $offset = ($page - 1) * $limit;
        $crud->fetchData($table, $limit, "select * from $table  inner join $table2 on ClientAbn=client_id 
        where 
        InvoiceNo like '%$search%' or
        InvDate like '%$search%' or
        client_name like '%$search%' or
        client_email like '%$search%' or
        phone like '%$search%' 
         order by $field $order 
         ", " limit $offset ,$limit");
        break;


    case isset($_POST['client_name']):
        $name = $_POST['client_name'];
        $crud->fetchData('client', 1, "select client_id,client_name,client_email,phone from client 
    where client_name like '%$name%' ", 'limit 1');

        break;



    case isset($_POST['item_name']):
        $itemname = $_POST['item_name'] ?? "";
        $data = array();
        foreach ($itemname as $name) {
            $name = mysqli_real_escape_string($conn, $name);

            array_push($data, $invoice->fetchitemData("select * from items where item_name='$name' limit 1"));
        }

        $json = json_encode($data);
        echo $json;
        break;




    case isset($_POST['invoice_No']):
        $crud->fetchData('invoice', 1, 'select InvoiceNo from invoice order by InvoiceNo desc ', "limit 1");
        break;

    case isset($_POST['addInvoice']):
        $invoiceNo = $_POST['invoiceNo'];
        $client = $_POST['client'];
        $item = $_POST['item'];
        $quantity = $_POST['quantity'] ?? 1;
        $invoice->insertData($invoiceNo, $client, $item, $quantity);
        break;

    case isset($_POST['itemSearch']):
        $item = $_POST['itemSearch'];
        $crud->fetchData('items', 100, "select item_name from items where item_name like '%$item%' ", "");
        break;


    case isset($_POST['update_iv']):
        $invId = $_POST['invId'];
        $crud->fetchData("invoice", 1, "select * from client inner join invoice on client_id=ClientABN inner join invoiceitem on invoice.InvoiceNo=invoiceitem.InvoiceNo inner join items on ItemNo=item_id where invoice.InvoiceNo=$invId", "");
        break;
    case isset($_POST['UpdateInvoice']):
        $invId = $_POST['invoiceNo'];
        $item = $_POST['item'];
        $quantity=1;
        $invoice->UpdateData($invId,$item,$quantity);
        break;

    default:
        break;
}
