<?php

class db
{
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $database = "usermaster";
    public $port = "3309";
    protected $connection;
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database, $this->port) or die("not connected to data base");
    }

    ///////// crud operations

    /////////read data

    public function fetchData($query)
    {
        $sql = $query;
          $result = mysqli_query($this->conn, $sql);
        if ($result == false) {
            return false;
        }
        if(mysqli_num_rows($result)>1){
        $dbdata = array();
        while ($row = $result->fetch_assoc()) {
            $dbdata[] = $row;
        }
           }
       $jsondata = json_encode($dbdata);
        echo $jsondata;
    }

    public function escape_string($value)
    {
        return $this->connection->real_escape_string($value);
    }
    ///////////// insert data

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


    ////////// delete data ///////// update data

    public function modifyData($query)
    {
        $sql = $query;
        $result = mysqli_query($this->conn, $sql);
        if ($result == true) {
            echo 1;
        } else {
            echo 0;
        }
    }
    





    }
$crud=new db();