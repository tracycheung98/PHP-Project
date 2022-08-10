<?php
    include_once("inc/config.inc.php");
    include_once("inc/Entity/User.class.php");
    include_once("inc/Entity/LoginPage.class.php");
    include_once("inc/Utility/PDOWrapper.class.php");
    include_once("inc/Utility/UserDAO.class.php");
    include_once("inc/Utility/LoginManager.class.php");
    include_once("inc/Utility/Validate.class.php");

    //Start the session
    session_start();

    UserDAO::initialize();
    // Login form is sent
    if(isset($_POST['login']) && !empty($_POST['login'])){
        //Get the current user 
        if(Validate::validateLoginForm()){
            $user = UserDAO::getUser($_POST['email']);
            if(!$user){
                LoginPage::$notifications .= "The email is not registered.";
            }else{
                if($user->verifyPassword($_POST['login_pw'])){
            
                    //Set the user to logged in
                    $_SESSION['loggedin'] = $user->getUserName();
                    $_SESSION['email'] = $user->getEmail();
                    //Use header to send the user to the main page
                    header("Location: 10.php");
                }else{
                    LoginPage::$notifications .="Incorrect password.";
                }
            }
        }
    }
    // Register form is sent
    if(isset($_POST['register']) && !empty($_POST['register'])){
        if(Validate::validateRegisterForm()){
            //Get the current user 
            $user = UserDAO::getUser($_POST['email']);
            if($user){
                // email is already registered
                LoginPage::$notifications .= "The email is already registered.";
            }else{
                $user = new User();
                $user->setEmail($_POST['email']);
                $user->setUserName($_POST['username']);
                $user->setPassword($_POST['register_pw']);
                $result = UserDAO::createUser($user);
                if($result > 0){
                    LoginPage::$notifications .= "Registered successfully.";
                }
            }
        }
    }

    // Change Password form is sent
    if(isset($_POST['changepw']) && !empty($_POST['changepw'])){
        if(Validate::validateChangePasswordForm()){
            //Get the current user 
            $user = UserDAO::getUser($_POST['email']);
            if(!$user){
                // email is already registered
                LoginPage::$notifications .= "The email is not registered.";
            }else{
                if(!$user->verifyPassword($_POST['cur_pw'])){
                    LoginPage::$notifications .="Incorrect current password.";
                }else{
                    $user = new User();
                    $user->setEmail($_POST['email']);
                    $user->setPassword($_POST['new_pw']);
                    $result = UserDAO::updateUserPassword($user);
                    if($result > 0){
                        LoginPage::$notifications .= "Password changed successfully.";
                    }
                }
            }
        }
    }
    
    LoginPage::$studentName = "Tracy";
    LoginPage::showHeader();
    LoginPage::showLoginFrom();
    LoginPage::showRegisterFrom();
    LoginPage::showChangePasswordFrom();
    LoginPage::showFooter();

?>