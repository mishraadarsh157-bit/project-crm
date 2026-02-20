<?php

include 'database.php';

class loginPage
{
    public $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function userInfo($name, $password)
    {

        $sql = "SELECT * from users where binary name='{$name}' and binary pass='{$password}';";
        $result = mysqli_query($this->conn, $sql);
        if ($result->num_rows > 0) {
            while (mysqli_fetch_assoc($result)) {
                $_SESSION['admin'] = $name;

                echo "http://localhost/project/pages/home.php";
            }
        } else {
            echo "unknown";
        }
    }
    function logout()
    {
        session_unset();
        session_destroy();
        echo "logged_out";
    }
}
$user = new loginPage($conn);


?>