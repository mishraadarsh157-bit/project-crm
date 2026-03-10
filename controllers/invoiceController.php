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

require_once '../project/config/Exception.php';
require_once '../project/config/PHPMailer.php';
require_once '../project/config/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
$mail = new PHPMailer(true);
                                                                //$mail->SMTPDebug = 3; // enable only if debugging
// $mail->isSMTP();
// $mail->Host = 'smtp.gmail.com';
// $mail->SMTPAuth = true;
// $mail->Username = 'mishraadarsh1232@gmail.com';
// $mail->Password = 'johjwzisnakerrwf';   // App password
// $mail->SMTPSecure = 'tls';
// $mail->Port = 587;
// $mail->setFrom('mishraadarsh1232@gmail.com', 'Mishra');
// $mail->addAddress('aashujangra017@gmail.com');
// $mail->isHTML(true);
// $mail->Subject = 'Testing topic mail sending';
// $mail->Body    = 'Hello! Mail sent to you at ';
// $mail->AltBody = 'Hello! Mail sent to you';
// if (!$mail->send()) {
//     echo 'Message could not be sent.<br>';
//     echo 'Mailer Error: ' . $mail->ErrorInfo;
// } else {
//     echo 'Message has been sent successfully';
// }