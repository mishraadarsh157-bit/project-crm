<?php

include 'database/db_logics.php';

switch (true) {

    case isset($_POST['page_name']):
        $table = 'users';
        $page_no = $_POST['page_no'] ?? 1;
        $search = $_POST['search_user'] ?? '';
        $status = $_POST['status'] ?? '';
        $field = $_POST['field'] ?? 'id';
        $order = $_POST['order'] ?? 'asc';
        $limit = $_POST['limit'] ?? 5;
        $offset = ($page_no - 1) * $limit;
        $crud->fetchData($table, $limit, "select * from $table 
    where STATUS like '%$status%' and (
 name like '%$search%' 
    or phone like '%$search%' 
    or email like '%$search%' 
    ) order by $field  $order ", " limit $offset,  $limit");;
        break;

    case isset($_POST['save_user']):
        $table = 'users';
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_pass'];
        $user_phone = $_POST['user_phone'];
        $user_email = $_POST['user_email'];
        $hashedPassword = password_hash($user_password, PASSWORD_DEFAULT);



        $crud->insertData($table, ['name' => $user_name, 'pass' => $hashedPassword, 'phone' => $user_phone, 'email' => $user_email]);

        break;

    case isset($_POST['update']):
        $id = $_POST['id'];

        $crud->fetchData("users", 200, "select * from users where id=$id ", ' limit 200');

        break;

    case isset($_POST['update_user']):
        $table = 'users';
        $id = $_POST['id'];
        $name = $_POST['name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $status = $_POST['status'];
        $crud->modifyData("UPDATE users SET name='$name' , phone='$number' , email ='$email' , STATUS='$status' where id=$id;");

        break;
    case isset($_POST['delete']):
        $id = $_POST['id'];
        $table = 'users';
        $crud->modifyData("delete from $table where id =$id");

        break;



    default:
        break;
}
