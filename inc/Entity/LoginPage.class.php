<?php

class LoginPage  {

    public static $studentName;
    public static $notifications = "";

    static function showHeader() { ?>
        <!doctype html>
        <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
            <link href="css/login.css" rel="stylesheet">
            <title><?=self::$studentName."'s'"?> Shop - Login</title>
        </head>
        <body>            

            <header>
                <h1>Login & Register</h1>
            </header>
            <div class="notification">
                <p>
            <?php
            if(self::$notifications != ""){
                echo self::$notifications;  
            }
            ?>
                </p>
            </div>  
    <?php }

    static function showNotification(String $message)    { 
        self::$notifications.= $message;  
        ?>
        <div class="notification">
            <p><?=self::$notifications?></p>
        </div>  
        <?php    
    }
    
    static function showFooter()    { ?>        
        </body>
        <footer>
            <p> <a href="./10.php">HomePage</a></p>
            </footer>
        </html>
    <?php }

    static function showLoginFrom(){
        ?>
        <fieldset class="login_form">
        <legend>Login</legend>
        <form id="login" method="POST">
            <div><label for="email">Email: </label>
            <input id="email" type="email" name="email" required="true" placeholder="Your Email" pattern="^[\w=+\-\/][\w='+\-\/\.]*@[\w\-]+(\.[\w\-]+)*(\.[\w]{2,6})$"/></div>
            <div><label for="login_pw">Password: </label>
            <input id="login_pw" type="password" name="login_pw" required="true" placeholder="Your Password" pattern="^[\w@#$%\^\&\*\-]+$"/></div>
            <input type="submit" name="login" id="login" value="Login"/>
        </form>
        </fieldset>
        <?php
    }

    static function showRegisterFrom(){
        ?>
        <fieldset class="register_form">
        <legend>Register</legend>
        <form id="register" method="POST">
            <div><label for="email">Email: </label>
            <input id="email" type="email" name="email" required="true" placeholder="Your Email" pattern="^[\w=+\-\/][\w='+\-\/\.]*@[\w\-]+(\.[\w\-]+)*(\.[\w]{2,6})$"/></div>
            <div><label for="username">Username: </label>
            <input id="username" type="text" name="username" required="true" placeholder="Your Username" pattern="[A-Za-z0-9]+"/></div>
            <div><label for="register_pw">Password: </label>
            <input id="register_pw" type="password" name="register_pw" required="true" placeholder="Your Password" pattern="^[\w@#$%\^\&\*\-]+$"/></div>
            <input type="submit" name="register" value="Register"/>
        </form>
        </fieldset>



        <?php
    }

    static function showChangePasswordFrom(){
        ?>
        <fieldset class="ChangePassword_form">
        <legend>Change Password</legend>
        <form id="changepw" method="POST">
            <div><label for="email">Email: </label>
            <input id="email" type="text" name="email" required="true" placeholder="Your Email" pattern="^[\w=+\-\/][\w='+\-\/\.]*@[\w\-]+(\.[\w\-]+)*(\.[\w]{2,6})$"/></div>
            <div><label for="cur_pw">Current Password: </label>
            <input id="cur_pw" type="password" name="cur_pw" required="true" placeholder="Your Current Password" pattern="^[\w@#$%\^\&\*\-]+$"/></div>
            <div><label for="new_pw">New Password: </label>
            <input id="new_pw" type="password" name="new_pw" required="true" placeholder="Your New Password" pattern="^[\w@#$%\^\&\*\-]+$"/></div>
            <input type="submit" name="changepw" value="Change Password"/>
        </form>
        </fieldset>



        <?php
    }
}

?>