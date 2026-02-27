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

    public function fetchData($table,$limit,$query)
    {   
         $page = "";
        if (isset($_POST['page_no'])) {
            $page = $_POST["page_no"];
        } else {
            $page = 1;
        }
         $limit = (int) $limit;
        $offset = ($page - 1) * $limit;

        $sql = $query;
          $result = mysqli_query($this->conn, $sql);
        if ($result == false) {
            echo 'no data';
        }
      
        if(mysqli_num_rows($result)>0){
        while ($row = $result->fetch_assoc()) {
        $data[]=$row;
        }
        $dbdata['data']=$data;
        $pagin="select * from $table";
        $result=mysqli_query($this->conn,$pagin);
        $total_records=mysqli_num_rows($result);
        $total_pages=ceil($total_records/$limit);
         $dbdata['total_record']=$total_records;
        $dbdata['total_page']=$total_pages;
        
           }
           else{
            $data[]='no data';
            $dbdata['data']=$data;
           }
       $jsondata = json_encode($dbdata);
        echo $jsondata;
    }

    public function escape_string($value)
    {
        return $this->connection->real_escape_string($value);
    }
    ///////////// insert data

    public function insertData($table, $params = array())
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

