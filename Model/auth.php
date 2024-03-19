<?php

require_once "connect.php";
class Auth extends Connect{
    public $error =false;
    public $row;

public function register($username, $password){
    $connection = $this->getConnection();

    $query = "INSERT INTO user
    VALUES ('',?,?);";
    $result = $connection->prepare($query);
    $result->execute([$username, $password]);
    return $result;
}
    
public function login ($username, $password){

    $connection = $this->getConnection();

    $query = "SELECT * FROM user WHERE username = ? AND password = ?";
    $result = $connection->prepare($query);

    $result->execute([$username, $password]);
    if($this->row = $result->fetch()){
        $_SESSION['username'] = $username ;
        header("Location: View/dashboard.php");
    }else{
        $this->error = True;
        header("Location: index.php?error=1");
        exit();
    };
   
    }

public static function logout(){
    // Start the session
    session_start();

    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();


    // Redirect the user to the login page or any other appropriate page
    header("Location: ../index.php");
    exit; // Make sure to exit after redirecting to prevent further execution
}
}
?>