<?php
require_once "construct.php";
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
        header("Location: admins/index.php");
    }else{
        $this->error = True;
        header("Location: index.php?error=1");
        exit();
    };
   
    }

public function logout(){
    header("Location: ../index.php");
    exit;
}
}
?>