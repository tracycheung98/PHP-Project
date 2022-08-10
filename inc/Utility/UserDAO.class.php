<?php

// NOTICE THE CHANGES IN PDOWRAPPER's FUNCTION NAMES: getSingleResult() and getSetResult()

class UserDAO   {

    // Create a member to store the PDO agent
    private static $db;  

    // create the init function to start the PDO wrapper
    static function initialize() {
        self::$db = new PDOWrapper("User");
    }
    
    // function to create user
    static function createUser(User $user){
        
        $sql = "INSERT INTO user (username, email, password, admin_flag)
                VALUES (:username, :email, :password, 0)";
        
        // prepare the query
        self::$db->query($sql);
        
        // bind the parameters
        self::$db->bind(':username',trim($user->getUsername()));
        self::$db->bind(':email',trim($user->getEmail()));
        self::$db->bind(':password',password_hash($user->getPassword(),PASSWORD_DEFAULT));

        // execute the query
        self::$db->execute();

        return self::$db->rowCount();
    }

    // get user detail
    static function getUser(string $email)  {
        $sql = "SELECT * from user WHERE email = :email";

        // prepare the query
        self::$db->query($sql);

        // bind the parameters
        self::$db->bind(':email',$email);
        
        // execute the query
        self::$db->execute();
        
        return self::$db->getSingleResult();
    }

    // get user detail
    static function getRegularUsers()  {
        $sql = "SELECT * from user WHERE admin_flag = 0";

        // prepare the query
        self::$db->query($sql);
  
        // execute the query
        self::$db->execute();
        
        return self::$db->getSetResult();
    }

    // check if it is an admin account
    static function checkAdminFlag(String $email)  {
        $sql = "SELECT * from user WHERE email=:email AND admin_flag = 1";

        // prepare the query
        self::$db->query($sql);
        
        // bind the parameters
        self::$db->bind(':email',$email);
            
        // execute the query
        self::$db->execute();
        
        return self::$db->getSingleResult();
    }


    static function updateUserPassword(User $user)    {

        $sql = "UPDATE user SET
        password=:password
        WHERE email=:email";

        self::$db->query($sql);

        // bind the parameters
        self::$db->bind(':email',trim($user->getEmail()));
        self::$db->bind(':password',password_hash($user->getPassword(),PASSWORD_DEFAULT));

        // execute the query
        self::$db->execute();

        return self::$db->rowCount();

    }

    // delete an user
    static function deleteUser(string $id)  {
        $sql = "DELETE from user WHERE id = :id";

        // prepare the query
        self::$db->query($sql);

        // bind the parameters
        self::$db->bind(':id',$id);
        
        // execute the query
        self::$db->execute();
        
        return self::$db->rowCount();
    }
}