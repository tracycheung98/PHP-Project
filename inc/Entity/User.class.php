<?php

class User {

    //Properties
    private $id;
    private $email;
    private $username;
    private $password;
    private $admin_flag;

    //Setters
    function setId(string $id){
        $this->id = $id;
    }
    
    function setEmail(string $email){
        $this->email = $email;
    }
    
    function setUserName(string $username){
        $this->username = $username;
    }

    function setPassword(string $password){
        $this->password = $password;
    }
    
    function setAdminFlag(string $admin_flag){
        $this->admin_flag = $admin_flag;
    }
    
    //Getters
    function getId(){
        return $this->id;
    }

    function getEmail(){
        return $this->email;
    }
    
    function getUsername(){
        return $this->username;
    }
    
    function getPassword(){
        return $this->password;
    }
    
    function getAdminFlag(){
        return $this->admin_flag;
    }

    //Verify the password
    function verifyPassword(string $passwordToVerify) {
        //Return a boolean based on verifying if the password given is correct for the current user
        return password_verify($passwordToVerify, $this->password);
    }
}



?>