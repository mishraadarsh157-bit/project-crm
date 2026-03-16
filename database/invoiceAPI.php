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

    public function fetchitemData($query)
    {
        $sql = $query;
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                return $dbdata['data'] = $row;
            }
        } else {
        }
    }

    public function insertData($invoiceNo,$client,$item,$quantity)
    {

        try{
        $this->conn->begin_transaction();
            $stmt=$this->conn->prepare("insert into invoice(InvoiceNo,ClientABN,InvDate)
            values(?,?,?)
            ");
            $stmt->bind_param('iis',$invoiceNo,$client,$time);
            $time=date('Y-m-d H:i:s');
            $stmt->execute();
        foreach ($item as $no =>$name) {
            $name = mysqli_real_escape_string($this->conn, $name);
            $stmt2=$this->conn->prepare("insert into invoiceitem(InvoiceNo,ItemNo,Quantity) values (?,?,?)");
            $stmt2->bind_param('iii',$invoiceNo,$name,$quantity[$no]);
            $stmt2->execute();
        }
        $this->conn->commit();
        }
 catch(Exception $e){
$this->conn->rollback();
echo 2;
 }   
}
    public function UpdateData($invoiceNo,$item,$quantity)
    {

        try{
        $this->conn->begin_transaction();
            $stmt=$this->conn->prepare("delete from invoiceitem where InvoiceNo=?
            ");
            $stmt->bind_param('i',$invoiceNo);
            $stmt->execute();
        foreach ($item as $name => $no) {
            $name = mysqli_real_escape_string($this->conn, $name);
            $stmt2=$this->conn->prepare("insert into invoiceitem(InvoiceNo,ItemNo,Quantity) values (?,?,?)");
            $stmt2->bind_param('iii',$invoiceNo,$no,$quantity[$name]);
            $stmt2->execute();
        }
        $this->conn->commit();
        echo 1;
        }
 catch(Exception $e){
$this->conn->rollback();
echo 2;
 }   
}
}
$invoice = new inv();
