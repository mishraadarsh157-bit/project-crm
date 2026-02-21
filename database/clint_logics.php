<?php

include '../database/database.php';

class clint_master
{

    public $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function insert($c_name,$c_number,$c_address,$c_city,$c_state,$c_pincode) {
    $sql="insert into clint (clint_name,phone,address,city_id,state_id,pincode)
    values ('{$c_name}',$c_number,'{$c_address}',$c_city,$c_state,$c_pincode)";
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
            echo "<select  name='' value='' class='form-select' id='select_state' onchange='loadedState()'>";
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
            echo "<select name='' class='form-select' id='select_city' value''>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option  value='{$row['id']}'>{$row['city']}</option>";
            }
            echo "</select>";
        } else {
            echo 'no cities';
        }
    }
}



$clint = new clint_master($conn);
