<?php

include '../database/database.php';

class client_master
{

    public $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function loadClients($table1,$table2,$table3){
        $sql="SELECT client_id,client_name,phone,client_email,address,name,city,pincode,client_status FROM $table1 inner join $table2 on $table1.city_id=$table2.id inner join $table3 on $table1.state_id= $table3.id";

        $result=mysqli_query($this->conn,$sql);
        if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){    
        $dbData[]=$row;
        }}
        $jsondata= json_encode($dbData);
        echo $jsondata;      
    }

    public function insert($c_name,$c_number,$c_email,$c_address,$c_city,$c_state,$c_pincode) {
    $sql="insert into client (client_name,phone,client_email,address,city_id,state_id,pincode)
    values ('{$c_name}',$c_number,'{$c_email}','{$c_address}',$c_city,$c_state,$c_pincode)";
    $result=mysqli_query($this->conn,$sql);
    if($result==true){
        echo 1;
    }else{
        echo 0;
    }

    }
    public function loadState()
    {
        $sql = 'select id, name from states';
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<select  name='' value='' class='form-select' id='select_state' onchange='loadedState()'><option value=''>----Select State----</option>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }
            echo "</select>";
        }
    }
    public function loadCity($state)
    {
        $sql = "select cities.id, cities.city from cities inner join states on cities.state_id =states.id where states.id = '$state'";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<select name='' class='form-select' id='select_city' value''><option value=''>----Select City----</option>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option  value='{$row['id']}'>{$row['city']}</option>";
            }
            echo "</select>";
        } else {
            echo 'no cities';
        }
    }
    public function loadUpdateForm($id)
    {
        $sql = "Select * from client where id= $id";
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<form><input type='number' id='id' hidden value='{$row['id']}'>";

                echo "<input type='text' placeholder='name'  id='name' class='form-control form-control-sm mb-3' value='{$row['client_name']}' required><div id='name_valid' class='text-danger mb-3 ''></div>";
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




}



$client = new client_master($conn);
