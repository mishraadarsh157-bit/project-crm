<?php

include '../project/database/database.php';

class client_master
{

    public $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
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
