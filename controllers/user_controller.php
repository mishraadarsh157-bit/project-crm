<?php


include '../database/userlogics.php';











if(isset($_POST['page_name'])){
    $page_no=$_POST['page_no']??1;    
    $limit=$_POST['limit']??7;
    $odr_id=$_POST['asc_id']??'asc';
    $odr_name=$_POST['asc_name']??'asc';
    $odr_phone=$_POST['asc_phone']??'asc';
    

    $show->showData('users',$page_no,$limit,$odr_id,$odr_name,$odr_phone);


    }






else if(isset($_POST['save_user'])){
   $user_name=$_POST['user_name'];
$user_password=$_POST['user_pass'];
$user_phone=$_POST['user_phone'];
$user_email=$_POST['user_email'];

$insertUser->insertNewUser($user_name,$user_password,$user_phone,$user_email);

}

else if(isset($_POST['update'])){
    $id=$_POST['id'];

    $upd->loadintoForm($id);
}

else if(isset($_POST['update_user'])){
 
    $id=$_POST['id'];
    $name=$_POST['name'];
    $number=$_POST['number'];
    $email=$_POST['email'];
    $status=$_POST['status'];
    $upd->update($id,$name,$number,$email,$status);
}
else if(isset($_POST['delete'])){
    $id=$_POST['id'];
    $del->deleteUser($id);
}
else if(isset($_POST['search'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $number=$_POST['number'];
    $status=$_POST['status'];
    // echo $id,$name,$email,$number,$status;
    $ser->searchUser('users',$id,$name,$email,$number,$status);
    }



?>