<?php

include '../database/database.php';

class show
{
    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function showData($table,$page_no, $limit, $odr_id, $odr_name, $odr_phone)
    {
        $page = "";
        if (isset($_POST['page_no'])) {
            $page = $_POST["page_no"];
        } else {
            $page = 1;
        }
        $limit = (int) $limit;
        $offset = ($page - 1) * $limit;

        $seql = "SELECT * FROM $table
         order by id $odr_id,name $odr_name,phone $odr_phone
         limit {$offset} , {$limit} 
         ";
        $result = mysqli_query($this->conn, $seql);
        $output = "";
        if (mysqli_num_rows($result) > 0) {
            $output = "<div class='holding-user-table'><table class='table '>
            <tr><td colspan='6' align='right'>
          
            <input type='text' id='invis' value='$page_no' hidden><select id='limit' onchange='limitData()' class='form-select w-25' value='$limit' >
            <option value='$limit'>LIMIT of $limit </option>
            <option value='5'>5</option>
            <option value='10'>10</option>
            <option value='15'>15</option>
            <option value='20'>20</option>
            </select></td>
            </tr>
             
            <tr class='bg-skyblue user-table-tr text-white'>

                        <th class='ps-5 id'>Id 
                        <button class='sort' id='id_asc' value='asc' ><i class='bi bi-arrow-down'></i></button>
                        <button class='sort' id='id_desc' value='id_desc'><i  class='bi bi-arrow-up'></i></button></th>
                       
                        <th class='name'>Name 
                        <button class='sort' id='name_asc' value='asc'><i class='bi bi-arrow-down'></i></button>
                        <button class='sort' id='name_desc' value='id_desc'><i  class='bi bi-arrow-up'></i></button></th>
                       
                        <th class='email'>Email </th>
                        <th class=''>Phone 
                        <button class='sort' id='phone_asc' value='asc'><i class='bi bi-arrow-down'></i></button>
                        <button class='sort phone' id='phone_desc' value='id_desc'><i  class='bi bi-arrow-up'></i></button>
                        </th>
                       
                        <th class='text-center status'>Status</th>
                        <th class='text-center action'>Action</th>
                    </tr>
            <tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $btnClass = ($row['STATUS'] == 'ACTIVE') ? ' btn-outline-success ' : 'btn-outline-danger';
                $output .= "
                <td class='p-2 ps-5 text-muted'>" . $row['id'] . "</td>
                <td class='p-2 pb-0 '>" . $row['name'] . "</td>
                <td class='p-2 pb-0 text-muted'>" . $row['email'] . "</td>
                <td class='p-2 pb-0 text-muted'>" . $row['phone'] . "</td>
                <td class='p-2 pb-0 text-center'><button class='status btn btn-sm $btnClass'>" . $row['STATUS'] . "</button></td>
                <td class='p-2 pb-0 text-center'>
                <button class='btn btn-sm btn-outline-success rounded-pill' name='update' data-bs-toggle='modal' data-bs-target='#myModal' data-uid='{$row['id']}'  id='update' value='update'>
                <i class='bi bi-pencil-square'>
                </i></button>

                <button class='btn btn-sm btn-outline-danger rounded-pill' name='delete' data-did='{$row['id']}'  id='delete' value='delete'>
                <i class='bi bi-trash3'>
                </i></button>

                </td>
                </tr>";
            }
            $output .= "</table></div><hr>";
            $sql = "select * from $table;";
            $result = mysqli_query($this->conn, $sql);
            $total_records = mysqli_num_rows($result);
            $total_pages = ceil($total_records / $limit);
            $output .= "<div id='pagination' style='position:fixed;' class=' mb-5'>";
            $url = 'user_master.php';
                if($page_no>1){
            $output .= "<button class='mx-1 btn btn-sm btn-outline-success'  id='back'><</button>";
                 }
            if ($total_records > $limit) {
                for ($i = 1; $i <= $total_pages; $i++) {
                    if($i>1){
                        continue;
                    }else{
                    $output .= "<a class='mx-1 btn btn-sm btn-outline-success'   href='' id='$i'>{$i}</a>";
                }
                }
            }
            if($page_no<$total_pages){
                    $output .= "<button class='mx-1 btn btn-sm btn-outline-success' href='' id='forward'>></button>";
            }
            $output .= "</div>";

            echo $output;
        } else {
            echo "unable to fetch data";
        }
    }
}

$show = new show($conn);

class user_master
{

    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertNewUser($user_name, $user_password, $user_phone, $user_email)
    {
        $sql = "INSERT INTO users(name,pass,phone,email)
    values('{$user_name}',
    '{$user_password}',{$user_phone},'{$user_email}');";

        $result = mysqli_query($this->conn, $sql);

        if ($result === true) {
            echo "1";
        } else {
            echo "problem in query";
        }
    }
}




$insertUser = new user_master($conn);



class update
{
    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function loadintoForm($id)
    {
        $sql = "Select * from users where id= $id";
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<form><input type='number' id='id' hidden value='{$row['id']}'>";

                echo "<input type='text' placeholder='name'  id='name' class='form-control form-control-sm mb-3' value='{$row['name']}' required><div id='name_valid' class='text-danger mb-3 ''></div>";
                echo "<input type='text' placeholder='number'  id='number' class='form-control form-control-sm mb-3' value='{$row['phone']}' required><div id='number_valid'></div>";
                echo "<input type='text' placeholder='email'  id='email' class='form-control form-control-sm mb-3' value='{$row['email']}' required><div id='email_valid'></div>";

                echo "<select id='status' class='form-control' value='{$row['STATUS']}'>
                <option value='ACTIVE'>ACTIVE</option>
                <option value='INACTIVE'>INACTIVE</option>
                </select>";
                echo  "<input type='button' class='btn btn-outline-primary' id='edit' value='EDIT' >
        <input type='reset' value='RESET' class='btn btn-outline-danger'></form>";
            }
        }
    }


    public function update($id, $name, $number, $email, $status)
    {
        $sql = "Update users set name='$name' , phone='$number' , email ='$email' , STATUS='$status' where id=$id;";
        $result = mysqli_query($this->conn, $sql);
        if ($result == true) {
            echo "1";
        } else {
            echo "not updated";
        }
    }
}


$upd = new update($conn);

class delete
{
    public $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function deleteUser($id)
    {
        $sql = "DELETE from users where id = $id";
        $result = mysqli_query($this->conn, $sql);
        if ($result == true) {
            echo 1;
        } else {
            echo 'not deleted';
        }
    }
}

$del = new delete($conn);

class search
{
    public $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function searchUser($table, $id, $name, $email, $number, $status)
    {

        $limit_per_page = 7;
        $page = "";
        if (isset($_POST['page_no'])) {
            $page = $_POST["page_no"];
        } else {
            $page = 1;
        }
        $offset = ($page - 1) * $limit_per_page;

        $seql = "SELECT * FROM $table
         where id like '%$id%'
         and name like '%$name%' 
         and phone like '%$number%' 
         and email like '%$email%' 
         and STATUS = '$status' 
         limit {$offset} , {$limit_per_page}";
        $result = mysqli_query($this->conn, $seql);
        $output = "";
        if (mysqli_num_rows($result) > 0) {
            $output = "<table class='table table-bordered'>
             
            <tr class='bg-skyblue text-white'>

                        <th class='ps-5'>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class=''>Phone</th>
                        <th class='text-center'>Status</th>
                        <th class='text-center'>Action</th>
                    </tr>
            <tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $btnClass = ($row['STATUS'] == 'ACTIVE') ? ' btn-outline-success ' : 'btn-outline-danger';
                $output .= "
                <td class='ps-5 text-muted'>" . $row['id'] . "</td>
                <td class=''>" . $row['name'] . "</td>
                <td class='text-muted'>" . $row['email'] . "</td>
                <td class='text-muted'>" . $row['phone'] . "</td>
                <td class='text-center'><button class='status btn btn-sm $btnClass'>" . $row['STATUS'] . "</button></td>
                <td class='text-center'>
                <button class='btn btn-sm btn-outline-success rounded-pill' name='update' data-bs-toggle='modal' data-bs-target='#myModal' data-uid='{$row['id']}'  id='update' value='update'>
                <i class='bi bi-pencil-square'>
                </i></button>

                <button class='btn btn-sm btn-outline-danger rounded-pill' name='delete' data-did='{$row['id']}'  id='delete' value='delete'>
                <i class='bi bi-trash3'>
                </i></button>

                </td>
                </tr>";
            }
            $output .= "</table>";
            $sql = "select * from $table
            where id like '%$id%'
         and name like '%$name%' 
         and phone like '%$number%' 
         and email like '%$email%' 
         and STATUS = '$status' 
         limit {$offset} , {$limit_per_page};";
            $result = mysqli_query($this->conn, $sql);
            $total_records = mysqli_num_rows($result);
            $total_pages = ceil($total_records / $limit_per_page);
            $output .= "<div id='pagination' class='text-center mb-5'>";

            if ($total_records > $limit_per_page) {
                for ($i = 1; $i <= $total_pages; $i++) {

                    $output .= "<a class='mx-1 btn btn-sm btn-outline-primary' href'' id='{$i}'>{$i}</a>";
                }
            }
            $output .= "</div>";

            echo $output;
        } else {
            echo "<table class='table'>
            <tr class='bg-skyblue text-white'>

                        <th class='ps-5'>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class=''>Phone</th>
                        <th class='text-center'>Status</th>
                        <th class='text-center'>Action</th>
                    </tr>
            <tr><tr><th class='text-danger text-center' colspan='6'><h1>NO RECORD FOUND</h1></th></tr></table>";
        }
    }
}



$ser = new search($conn);
