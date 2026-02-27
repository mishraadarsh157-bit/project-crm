<?php

include 'database/database.php';

class loginPage
{
    public $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function userInfo($email, $password)
    {
$stmt = $this->conn->prepare("SELECT pass FROM users WHERE email = ?");
$stmt->bind_param("s", $email); 
$stmt->execute();
$result = $stmt->get_result();
if ($user = $result->fetch_assoc()) {
    if ($user && password_verify($password, $user['pass'])) {
        $_SESSION['admin'] = $email;
        echo "/project/home/";
    } else {
        echo "incorrect password";
    }
} else {
    echo "user not found";
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
