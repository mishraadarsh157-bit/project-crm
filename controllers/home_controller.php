<?php

include "./database/homelogics.php";

switch (true) {
    case isset($_POST['table']):
        $table = $_POST['table'];
        $id = $_POST['id'];
        $home->fetchTotal($table, $id);
        break;
    case  isset($_POST['status']):
        $table = $_POST['tabl'];
        $id = $_POST['id'];
        $status = $_POST['status'];
        $value = $_POST['value'];
        echo $home->fetchstatusTotal($table, $id, $status, $value);
        break;
    default:
        break;
}
