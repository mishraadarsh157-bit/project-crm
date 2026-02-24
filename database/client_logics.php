<?php

include '../database/database.php';

class client_master
{

    public $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function loadClients($table1, $table2, $table3)
    {
        $sql = "SELECT client_id,client_name,phone,client_email,address,name,city,pincode,client_status FROM $table1 inner join $table2 on $table1.city_id=$table2.id inner join $table3 on $table1.state_id= $table3.id";

        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $dbData[] = $row;
            }
        }
        $jsondata = json_encode($dbData);
        echo $jsondata;
    }

    public function insert($table, $params = array())
    {

        $table_columns = implode(',', array_keys($params));
        $table_value = implode("','", $params);
        $sql = "insert into $table ($table_columns)
    values ('$table_value')";
        $result = mysqli_query($this->conn, $sql);
        if ($result == true) {
            echo 1;
        } else {
            echo 0;
        }
    }
    public function update($table, $params = array(), $id)
    {
        $args = array();
        foreach ($params as $key => $value) {
            $args[] = "$key = '$value'";
        }
        $sql = "UPDATE $table SET " . implode(', ', $args) . "where client_id = $id";
        $result = mysqli_query($this->conn, $sql);
        if ($result == true) {
            echo 1;
        } else {
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
    public function loadUpadteform($table1,$table2,$table3, $id)
    {
        $sql = "select * from $table1 inner join $table2 on $table1.state_id = $table2.id inner join $table3 on $table1.city_id =$table3.id where client_id=$id";
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $dbData[] = $row;
            }
        }
        $jsondata = json_encode($dbData);
        echo $jsondata;
    }
}



$client = new client_master($conn);
