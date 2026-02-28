<?php

include '../project/database/database.php';
class update
{
    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function loadintoForm($id)
    {
        $sql = "Select * from users where id= $id";
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<form><input type='number' id='id' hidden value='{$row['id']}'>";

                echo "<input type='text' placeholder='name'  id='name' class='form-control mb-3' value='{$row['name']}' required><div id='name_valid' class='text-danger mb-3 ''></div>";
                echo "<input type='text' placeholder='number'  id='number' class='form-control mb-3' value='{$row['phone']}' required><div id='number_valid'></div>";
                echo "<input type='text' placeholder='email'  id='email' class='form-control mb-3' value='{$row['email']}' required><div id='email_valid'></div>";

                echo "<select id='status' class='form-select mb-5' value='{$row['STATUS']}'>
                <option value='ACTIVE'>ACTIVE</option>
                <option value='INACTIVE'>INACTIVE</option>
                </select><hr>";
                echo  "<input type='button' class='btn status-btn-green' id='edit' value='EDIT' >
        <input type='reset' value='RESET' class='btn status-btn-red'></form>";
            }
        }
    }
}

$upd = new update($conn);
