<?php

include '../project/database/db_logics.php';
include '../project/database/database.php';
include '../project/database/invoiceAPI.php';
include '../project/controllers/mail.php';
include '../project/controllers/pdf.php';


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
        $crud->fetchData('client', 100, "select client_id,client_name,client_email,phone from client 
    where client_name like '%$name%' ", 'limit 100');
        break;

    case isset($_POST['clientSearch']):
        $name = $_POST['clientSearch'];
        $crud->fetchData('client', 100, "select client_name from client 
    where client_name like '%$name%' ", 'limit 100');
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
        $quantity = $_POST['quantity'];
        $invoice->insertData($invoiceNo, $client, $item, $quantity);
        break;

    case isset($_POST['itemSearch']):
        $item = $_POST['itemSearch'];
        $crud->fetchData('items', 100, "select item_name from items where item_name like '%$item%' ", "");
        break;


    case isset($_POST['update_iv']):
        $invId = $_POST['invId'];
        $crud->fetchData("invoice", 1, "select * from client right join invoice on client_id=ClientABN right join invoiceitem on invoice.InvoiceNo=invoiceitem.InvoiceNo right join items on ItemNo=item_id where invoice.InvoiceNo=$invId", "");
        break;
    case isset($_POST['UpdateInvoice']):
        $invId = $_POST['invoiceNo'];
        $item = $_POST['item'];
        $quantity = $_POST['quantity'];
        $invoice->UpdateData($invId, $item, $quantity);
        break;
    case isset($_POST['fetchMail']):
        $invId = $_POST['InvNo'];
        $crud->fetchData('invoice', 100, "select * from invoice left join client on ClientABN=client_id where InvoiceNo=$invId", "");
        break;
    case isset($_POST['sendMail']):
        $invoiceNo = $_POST['invoiceNo'];
        $name = $_POST['name'];
        $mailId = $_POST['mailId'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $mailer->mailer($invoiceNo, $mailId, $name, $subject, $message);
        break;

    case isset($_POST['makePDF']):
        $invID = $_POST['invId'];
        $pdf->makePdf($invID);
        break;

    default:
        break;
}
