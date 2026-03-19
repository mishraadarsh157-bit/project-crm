<?php

include "./database/database.php";

class home
{
    public $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function dashboardData(){
$data=[];
    $sql1="select count(id) as id from users";
        $result1=mysqli_query($this->conn,$sql1);
        if($result1==true){
            if(mysqli_num_rows($result1)>0){
                while($row=$result1->fetch_assoc()){
                    $data[]=$row;
                    
                }
       
            }
        }
        
    $sql1="select count(client_id) as client_id from client";
        $result1=mysqli_query($this->conn,$sql1);
        if($result1==true){
            if(mysqli_num_rows($result1)>0){
                while($row=$result1->fetch_assoc()){
                    $data[]=$row;
                    
                }
       
            }
        }
        
    $sql1="select count(item_id) as item_id from items";
        $result1=mysqli_query($this->conn,$sql1);
        if($result1==true){
            if(mysqli_num_rows($result1)>0){
                while($row=$result1->fetch_assoc()){
                    $data[]=$row;
                    
                }
       
            }
        }
        
    $sql1="select count(InvoiceNo) as InvoiceNo from Invoice";
        $result1=mysqli_query($this->conn,$sql1);
        if($result1==true){
            if(mysqli_num_rows($result1)>0){
                while($row=$result1->fetch_assoc()){
                    $data[]=$row;
                    
                }
       
            }
        }
    $sql1="select count(STATUS) as Uactive from users where STATUS=1";
        $result1=mysqli_query($this->conn,$sql1);
        if($result1==true){
            if(mysqli_num_rows($result1)>0){
                while($row=$result1->fetch_assoc()){
                    $data[]=$row;
                    
                }
       
            }
        }
        
    $sql1="select count(STATUS) as Uinactive from users where STATUS !=1";
        $result1=mysqli_query($this->conn,$sql1);
        if($result1==true){
            if(mysqli_num_rows($result1)>0){
                while($row=$result1->fetch_assoc()){
                    $data[]=$row;
                    
                }
       
            }
        }
    $sql1="select count(client_status) as Cactive from client where client_status=1";
        $result1=mysqli_query($this->conn,$sql1);
        if($result1==true){
            if(mysqli_num_rows($result1)>0){
                while($row=$result1->fetch_assoc()){
                    $data[]=$row;
                    
                }
       
            }
        }
        
    $sql1="select count(client_status) as Cinactive from client where client_status !=1";
        $result1=mysqli_query($this->conn,$sql1);
        if($result1==true){
            if(mysqli_num_rows($result1)>0){
                while($row=$result1->fetch_assoc()){
                    $data[]=$row;
                    
                }
       
            }
        }
        $dash['data']=$data;
        $jsondata = json_encode($dash);
        echo $jsondata;
        
        }
}

$home = new home($conn);
