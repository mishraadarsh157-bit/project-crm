<?php
include '../project/config/fpdfFold/fpdf.php';


class pdf
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

    public function makePdf($id)
    {
        $sql = "select * from client right join invoice on client_id=ClientABN left join invoiceitem on invoice.InvoiceNo=invoiceitem.InvoiceNo right join items on ItemNo=item_id where invoice.InvoiceNo=$id";
        $result = mysqli_query($this->conn, $sql);


        if ($result == true) {
            // echO "here 0";
            if (mysqli_num_rows($result) > 0) {
                $pdf = new FPDF();

                $pdf->AddPage();

                $pdf->SetFont('Arial', 'B', 16);
                
                $pdf->Image('./assets/images/demo.png', 160, 10, 30);
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Cell(100, 30, 'INVOICE');
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Cell(100, 10, 'From', 0);
                $pdf->Cell(100, 10, 'For', 0);
                $pdf->Ln();
                $pdf->SetFont('Arial', '', 14);
                
                while ($row = $result->fetch_assoc()) {
                    $pdf->Cell(100, 10, 'AppStack', 0);
                    $pdf->Cell(100, 10, $row['client_name'], 0);
                    $pdf->Ln();
                    
                    $pdf->Cell(100, 10, 'mishraadarsh1232@gmail.com', 0);
                    $pdf->Cell(100, 10, $row['client_email'], 0);
                    $pdf->Ln();
                    
                    $pdf->Cell(100, 10, 'Abcd', 0);
                    $pdf->Cell(40, 10, $row['address'], 0);
                    $pdf->Ln();
                    
                    $pdf->Cell(100, 10, '8383005995', 0);
                    $pdf->Cell(100, 10, $row['phone'], 0);
                    $pdf->Ln();
                    break;
                    }
                    $pdf->Ln();
                    $pdf->SetFont('Arial', 'B', 16);
                    $pdf->Cell(40, 10, 'Item Name', 1);
                    $pdf->Cell(60, 10, 'Quantity', 1);
                    $pdf->Cell(40, 10, 'Price', 1);
                    $pdf->Cell(40, 10, 'Amount', 1);
                    
                    $pdf->Ln();
                $total =0;
                
                $pdf->SetFont('Arial', '', 14);
                while ($row = $result->fetch_assoc()) {
                    $pdf->Cell(40, 10, $row['item_name'], 1);
                    $pdf->Cell(60, 10, $row['Quantity'], 1);
                    $pdf->Cell(40, 10, $row['price'], 1);
                    $pdf->Cell(40, 10, $row['price'] * $row['Quantity'], 1);
                    $qty= $row['Quantity'];
                    $price= $row['price'];
                    $qty=(int) $qty;
                    $total +=$qty * $price ;
                    $pdf->Ln();
                    }
                    $pdf->Cell(40, 10, '', 0);
                    $pdf->Cell(60, 10, '',0);
                    $pdf->SetFont('Arial', 'B', 16);
                    $pdf->Cell(40, 10, 'Balance Due :', 0);
                    $pdf->SetFont('Arial', '', 14);
                    $pdf->Cell(40, 10, $total, 0);
                    $pdf->Line(10, 50, 200, 50); 
                    $pdf->Line(10, 250, 200, 250); 
                    $pdf->Output();
                    }
                    } else {
                        echo 0;
                        }
                        }
                        }
                        
                        $pdf = new pdf();
                        