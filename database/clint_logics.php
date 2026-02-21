<?php

include '../database/database.php';

class clint_master{

    public $conn;
    public function __construct($conn){
        $this->conn=$conn;
    }
    public function insert(){

    }
    public function loadState(){
        $sql='select name from states';
        $result=mysqli_query($this->conn,$sql);
        if(mysqli_num_rows($result)>0){
            echo "<select class='form-select' name='' value='' class='form-select' id='select_state' onchange='loadedcity()'>";
             while ($row = mysqli_fetch_assoc($result)){
                echo "<option value='{$row['name']}'>{$row['name']}</option>";
            }
            echo "</select><input type='text' id='state_name'>";
        }
    }
    public function loadCity($states){
        $sql="select cities.city from cities inner join states on cities.state_id =states.id where states.name = $states";
        $result=mysqli_query($this->conn,$sql);
        if(mysqli_num_rows($result)>0){
            echo "<select name='' class='form-select' id='select_city'>";
            while($row=mysqli_fetch_assoc($result)){
                echo "<option  value='{$row['city']}'>{$row['city']}</option>";
            }
            echo "</select>";
        }
    }
}



$clint=new clint_master($conn);

?>