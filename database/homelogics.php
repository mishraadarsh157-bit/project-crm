<?php

include "./database/database.php";

class home{
    public $conn;
    public function __construct($conn) {
        $this->conn = $conn;
        }

    public function fetchTotal($table,$id){
    $sql="select count($id) as cid from $table";
    $result=mysqli_query($this->conn,$sql);
    if($result==true){
        if(mysqli_num_rows($result)>0){
            while($row=$result->fetch_array()){
                echo $row['cid'];
            }
        }
    }
    else{
        echo 0;
    }
    }
    public function fetchstatusTotal($table,$id,$status,$value){
        $value=(int) $value;
    $sql="select count($id) as cid from $table where $status= $value";
    $result=mysqli_query($this->conn,$sql);
    if($result==true){
        if(mysqli_num_rows($result)>0){
            while($row=$result->fetch_array()){
                echo $row['cid'];
            }
        }
    }
    else{
        echo 0;
    }
    }
        }

$home=new home($conn);

?>