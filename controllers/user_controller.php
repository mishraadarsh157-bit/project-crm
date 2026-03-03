<?php
include 'database/userlogics.php';

include 'database/db_logics.php';









if (isset($_POST['page_name'])) {
    $table = 'users';
    $page_no = $_POST['page_no'] ?? 1;
    $search=$_POST['search_user'] ??'';
    $status=$_POST['status']?? '';
    $field=$_POST['field'] ?? 'id';
    $order=$_POST['order'] ?? 'asc';
    $limit = $_POST['limit'] ?? 5;
    $offset= ($page_no -1) * $limit;
    $crud->fetchData($table,$limit,"select * from $table 
    where STATUS like '%$status%' and (
 name like '%$search%' 
    or phone like '%$search%' 
    or email like '%$search%' 
    ) order by $field  $order ", " limit $offset,  $limit");;
}   ////////////>>>>







else if (isset($_POST['save_user'])) {
    $table = 'users';
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_pass'];
    $user_phone = $_POST['user_phone'];
    $user_email = $_POST['user_email'];
    $hashedPassword=password_hash($user_password,PASSWORD_DEFAULT);
   

    // $insertUser->insertNewUser($user_name,$user_password,$user_phone,$user_email);

 $crud->insertData($table, ['name' => $user_name, 'pass' => $hashedPassword, 'phone' => $user_phone, 'email' => $user_email]);
}            /////////////>

else if (isset($_POST['update'])) {
    $id = $_POST['id'];

    $upd->loadintoForm($id);
} 



else if (isset($_POST['update_user'])) {
    $table = 'users';
    $id = $_POST['id'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    // $upd->update($id,$name,$number,$email,$status);
    $crud->modifyData("UPDATE users SET name='$name' , phone='$number' , email ='$email' , STATUS='$status' where id=$id;");
}        ////>>>>>>

else if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $table = 'users';
    // $del->deleteUser($id);///////////////////////
    $crud->modifyData("delete from $table where id =$id");
}    //////>>>>


