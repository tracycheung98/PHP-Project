<?php
class Validate {
    static function validateLoginForm(){
        $result = true;
        // email
        if(isset($_POST['email'])){
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            if(!$email){
                $result = false;
                LoginPage::$notifications .= "Please enter a valid email. ";
            }
        }

        return $result;
    }

    static function validateRegisterForm(){
        $result = true;
        // email
        if(isset($_POST['email'])){
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            if(!$email){
                $result = false;
                LoginPage::$notifications .= "Please enter a valid email. ";
            }
        }
        // password
        if(isset($_POST['register_pw'])){
            $password = filter_input(INPUT_POST, 'password', FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[\w@#$%\^\&\*\-]+$/")));
            if(!$password){
                $result = false;
                LoginPage::$notifications .= "Please enter a valid password.";
            }
        }
        return $result;
    }

    static function validateChangePasswordForm(){
        $result = true;
        // email
        if(isset($_POST['email'])){
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            if(!$email){
                $result = false;
                LoginPage::$notifications .= "Please enter a valid email. ";
            }
        }
        // current password
        if(isset($_POST['cur_pw'])){
            $password = filter_input(INPUT_POST, 'cur_pw', FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[\w@#$%\^\&\*\-]+$/")));
            if(!$password){
                $result = false;
                LoginPage::$notifications .= "Please enter a valid password.";
            }
        }

        // new password
        if(isset($_POST['new_pw'])){
            $password = filter_input(INPUT_POST, 'new_pw', FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[\w@#$%\^\&\*\-]+$/")));
            if(!$password){
                $result = false;
                LoginPage::$notifications .= "Please enter a valid password.";
            }
        }
        return $result;
    }

    static function validateNewCategoryFrom(){
        $result = true;
        // name
        if(isset($_POST['cat_name'])){
            $name = filter_input(INPUT_POST, 'cat_name', FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[\w\- ]+$/")));
            if(!$name){
                $result = false;
                AdminPage::$notifications .= "Please enter a valid category name. ";
            }
        }
        return $result;
    }

    static function validateUpdateCategoryFrom(){
        $result = true;
        // One of the categories
        if(isset($_POST['catid_to_update'])){
            if(empty($_POST['catid_to_update'])){
                $result = false;
                AdminPage::$notifications .= "Please choose one of the categories to update. ";
            }
        }
        // name
        if(isset($_POST['new_cat_name'])){
            $name = filter_input(INPUT_POST, 'new_cat_name', FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[\w\- ]+$/")));
            if(!$name){
                $result = false;
                AdminPage::$notifications .= "Please enter a valid category name. ";
            }
        }
        return $result;
    }

    static function validateDeleteCategoryFrom(){
        $result = true;
        // One of the categories
        if(isset($_POST['catid_to_delete'])){
            if(empty($_POST['catid_to_delete'])){
                $result = false;
                AdminPage::$notifications .= "Please choose one of the categories to delete. ";
            }
        }
        return $result;
    }

    static function validateNewProductFrom(){
        $result = true;
        // One of the categories
        if(isset($_POST['catid'])){
            if(empty($_POST['catid'])){
                $result = false;
                AdminPage::$notifications .= "Please choose one of the categories. ";
            }
        }
        // name
        if(isset($_POST['prod_name_to_insert'])){
            $name = filter_input(INPUT_POST, 'prod_name_to_insert', FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[\w\- ]+$/")));
            if(!$name){
                $result = false;
                AdminPage::$notifications .= "Please enter a valid product name. ";
            }
        }
        // price
        if(isset($_POST['prod_price'])){
            $price = filter_input(INPUT_POST, 'prod_price', FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[\d\.]+$/")));
            if(!$price){
                $result = false;
                AdminPage::$notifications .= "Please enter a valid product price. ";
            }
        }

        return $result;
    }

    static function validateUpdateProductFrom(){
        $result = true;
        // One of the products
        if(isset($_POST['prod_name_to_update'])){
            if(empty($_POST['prod_name_to_update'])){
                $result = false;
                AdminPage::$notifications .= "Please choose one of the products to update. ";
            }
        }
        // One of the categories
        if(isset($_POST['new_catid'])){
            if(empty($_POST['new_catid'])){
                $result = false;
                AdminPage::$notifications .= "Please choose one of the categories. ";
            }
        }
        // name
        if(isset($_POST['new_prod_name'])){
            $name = filter_input(INPUT_POST, 'new_prod_name', FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[\w\- ]+$/")));
            if(!$name){
                $result = false;
                AdminPage::$notifications .= "Please enter a valid product name. ";
            }
        }
        // price
        if(isset($_POST['new_prod_price'])){
            $price = filter_input(INPUT_POST, 'new_prod_price', FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[\d\.]+$/")));
            if(!$price){
                $result = false;
                AdminPage::$notifications .= "Please enter a valid product price. ";
            }
        }

        return $result;
    }

    static function validateDeleteProductFrom(){
        $result = true;
        // One of the products
        if(isset($_POST['prod_id_to_delete'])){
            if(empty($_POST['prod_id_to_delete'])){
                $result = false;
                AdminPage::$notifications .= "Please choose one of the products to delete. ";
            }
        }
        return $result;
    }
}



?>