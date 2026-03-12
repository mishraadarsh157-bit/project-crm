<?php

class inv
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

    public function fetchitemData($query){
    $sql=$query;
$result = mysqli_query($this->conn, $sql);
 if(mysqli_num_rows($result)>0){
        while ($row = $result->fetch_assoc()) {
            return $dbdata['data']=$row;
        }

        }
        else{

        }
     
    }
    }

    $invoice=new inv();
?>