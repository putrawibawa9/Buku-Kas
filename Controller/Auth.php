<?php
require_once "../Model/connect.php";
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
        header("Location: ../View/dashboard.php");
    }else{
        $this->error = True;
        header("Location: ../View/dashboard.php");
        exit();
    };
   
    }

public function logout(){
    header("Location: ../index.php");
    exit;
}
}
?>