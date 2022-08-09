<?php
session_start();
require_once(__DIR__. "./class/database.php");

class Auth extends database{
    public function login($email, $password){
        $checkuser = "SELECT * FROM `user` WHERE `email` = '$email' 
        AND `password`='" . md5($password) . "'";
        $result = $this->dbconnect->query($checkuser);
        if(mysqli_num_rows($result) == 1 && $user_type == 0){
            $_SESSION[user_id] = $userid;
            header("Location: vote.php");
        }
    }
    public function register($firstname, $lastname, $email, $password, $agreement){
        $adduser = "INSERT INTO `user` (`firstname`, `lastname`, `email`, `password`, `agreement`) VALUES ('$firstname', '$lastname', '$email', '" . md5($password) . "', '$agreement')";
        $result = $this->dbconnect->query($adduser);
        if(!$result){
            echo "inserted unsuccessfully";
            // $_SESSION[message] = "Registration Successful. Fill in details to login";
            // header("Location: index.php");
        }
    }
    public function logout(){
        if(session_destroy()){
            header("Location: index.php");
        }
    }
}

?>