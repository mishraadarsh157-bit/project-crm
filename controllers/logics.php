<?php
// include 'database.php';

// class loginPage
// {
//     public $conn;
//     public function __construct($conn)
//     {
//         $this->conn = $conn;
//     }

//     public function userInfo($name, $password)
//     {

//         $sql = "SELECT * from users where binary name='{$name}' and binary pass='{$password}';";
//         $result = mysqli_query($this->conn, $sql);
//         if ($result->num_rows > 0) {
//             while (mysqli_fetch_assoc($result)) {
//                 $_SESSION['admin'] = $name;

//                 echo "home.php";
//             }
//         } else {
//             echo "unknown";
//         }
//     }
//     function logout()
//     {
//         session_unset();
//         session_destroy();
//         echo "logged_out";
//     }
// }
// $user = new loginPage($conn);






class show
{
    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function showData($table,$limit)
    {
        $page = "";
        if (isset($_POST['page_no'])) {
            $page = $_POST["page_no"];
        } else {
            $page = 1;
        }
        
        $offset = ($page - 1) * $limit;

        $seql = "SELECT * FROM $table limit {$offset} , {$limit}";
        $result = mysqli_query($this->conn, $seql);
        $output = "";
        if (mysqli_num_rows($result) > 0) {
            $output = "<table class='table '>
            <tr><td colspan='5'></td>
            <td><select id='limit' class='form-select' value='$limit'>
            <option value='$limit'>LIMIT</option>
            <option value='5'>5</option>
            <option value='10'>10</option>
            <option value='15'>15</option>
            <option value='20'>20</option>
            </select></td>
            </tr>
             
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
            $sql = "select * from $table;";
            $result = mysqli_query($this->conn, $sql);
            $total_records = mysqli_num_rows($result);
            $total_pages = ceil($total_records / $limit);
            $output .= "<div id='pagination' class='text-center mb-5'>";
            $url=basename($_SERVER['PHP_SELF']);
            // if($page>1){
            //     $output .="<a class='' href='" . ($page-1) . "'><</a>";
            // }
            if($total_records > $limit){
            for ($i = 1; $i <= $total_pages; $i++) {

                $output .= "<a class='mx-1 btn btn-sm btn-outline-success' href'' id='{$i}'>{$i}</a>";
            }
            }
            // if($total_pages>$page){
            //     $output .="<a class='' href='" . ($page+1) . "'>></a>";
            // }
            
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

class search{
    public $conn;
    public function __construct($conn){
        $this->conn=$conn;
    }
    public function searchUser($table,$id,$name,$email,$number,$status){

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

            // if ($i < $total_pages) {
            //     $output .= "<a href='' id='" . ($i + 1) . "' class='mx-1 btn btn-sm btn-outline-primary'><i class='bi bi-caret-left'></i></a>";
            // }

            if($total_records > $limit_per_page){
            for ($i = 1; $i <= $total_pages; $i++) {

                $output .= "<a class='mx-1 btn btn-sm btn-outline-primary' href'' id='{$i}'>{$i}</a>";
            }
            }
            // if ($i >= 2) {
            //     $output .= "<a href='' id='" . ($i - 1) . "' class='mx-1 btn btn-sm btn-outline-primary'> <i class='bi bi-caret-right'></i></a>";
            // }
            $output .= "</div>";

            echo $output;
        } else {
            echo "<h1>NO RECORD FOUND</h1>";
        }
    }
    }
        
        
        
        $ser=new search($conn);


?>