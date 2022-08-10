<?php
    include_once("inc/config.inc.php");
    include_once("inc/Entity/Product.class.php");
    include_once("inc/Entity/Category.class.php");
    include_once("inc/Entity/User.class.php");
    include_once("inc/Entity/AdminPage.class.php");
    include_once("inc/Utility/PDOWrapper.class.php");
    include_once("inc/Utility/ProductDAO.class.php");
    include_once("inc/Utility/CategoryDAO.class.php");
    include_once("inc/Utility/UserDAO.class.php");
    include_once("inc/Utility/LoginManager.class.php");
    include_once("inc/Utility/Validate.class.php");

    AdminPage::$studentName = "Tracy";
    
    CategoryDAO::initialize();
    ProductDAO::initialize();
    UserDAO::initialize();
    
    
    // verify login
    if(LoginManager::verifyLogin()){
        
        $result = UserDAO::checkAdminFlag($_SESSION['email']);
        if($result == null){
            header("refresh: 3; url=10.php");
            echo "<h1>You are not admin."."<br/>";
            echo "Access denied."."<br/>";
            echo "Redirecting to the main page..."."<br/></h1>";
            exit;
        }else{            
            AdminPage::showHeader();
            AdminPage::showLogout();
        }
        if(isset($_POST['logout'])){
            session_unset();
            session_destroy();
            header("Location: 10.php");
            exit;
        }
    }else{
        header("Location: login_10.php");
        exit;
    }

    // New Category form is sent
    if(isset($_POST['insert_cat']) && !empty($_POST['insert_cat'])){
        if(Validate::validateNewCategoryFrom()){
            $result = CategoryDAO::getCategoryByName($_POST['cat_name']);
            if($result){
                // category name is already used
                AdminPage::showNotification("The category name is already used.");
            }else{ 
                $result = CategoryDAO::createCategory($_POST['cat_name']);
                if($result > 0){
                    AdminPage::showNotification("Category created.");
                }
            }
        }
    }

    // Update Category form is sent
    if(isset($_POST['update_cat']) && !empty($_POST['update_cat'])){
        if(Validate::validateUpdateCategoryFrom()){
            $result = CategoryDAO::getCategoryByName($_POST['new_cat_name']);
            if($result){
                // category name is already used
                AdminPage::showNotification("The category name is already used.");
            }else{ 
                $category = new Category();
                $category->setId($_POST['catid_to_update']);
                $category->setName($_POST['new_cat_name']);
                $result = CategoryDAO::updateCategory($category);
                if($result > 0){
                    AdminPage::showNotification("Category updated.");
                }
            }
        }
    }

    // Delete Category form is sent
    if(isset($_POST['delete_cat']) && !empty($_POST['delete_cat'])){
        if(Validate::validateDeleteCategoryFrom()){
            $result = CategoryDAO::deleteCategory($_POST['catid_to_delete']);
            if($result > 0){
                AdminPage::showNotification("Category deleted.");
            
            }
        }
    }

    // New Product form is sent
    if(isset($_POST['insert_prod']) && !empty($_POST['insert_prod']) && empty($_FILES['file'])){
        if(Validate::validateNewProductFrom()){
            $result = ProductDAO::getProductsByName($_POST['prod_name_to_insert']);
            if($result){
                // category name is already used
                AdminPage::showNotification("The product name is already used.");
            }else{ 
                // upload the picture
                // Check if is an image
                $status = 1;
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !== false) {
                    $status = 1;
                } else {
                    AdminPage::showNotification("File is not an image.");
                    $status = 0;
                }

                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                    AdminPage::showNotification("Image size is too large.");
                    $status = 0;
                }

                // After checking
                if ($status == 0) {
                        AdminPage::showNotification("There was an error uploading the image.");
                } else {
                    $path = "./images/".$_POST['prod_name_to_insert'].".jpg";
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $path)) {
                        $product = new Product();
                        $product->setName($_POST['prod_name_to_insert']);
                        $product->setPrice($_POST['prod_price']);
                        $product->setDescription($_POST['prod_description']);
                        $product->setCategoryId($_POST['catid']);
                        
                        $result = ProductDAO::createProduct($product);
                        if($result == 1){
                            AdminPage::showNotification("Product created.");
                        }
                    } else {
                        AdminPage::showNotification("There was an error uploading the image.");
                    }
                }
            }
        }
    }
    // Update Product form is sent
    if(isset($_POST['update_prod']) && !empty($_POST['update_prod']) && empty($_FILES['file'])){
        if(Validate::validateUpdateProductFrom()){
            $result = ProductDAO::getProductsByName($_POST['new_prod_name']);
            if($result){
                // category name is already used
                AdminPage::showNotification("The product name is already used.");
            }else{ 
                // upload the picture
                // Check if is an image
                $status = 1;
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !== false) {
                    $status = 1;
                } else {
                    AdminPage::showNotification("File is not an image.");
                    $status = 0;
                }

                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                    AdminPage::showNotification("Image size is too large.");
                    $status = 0;
                }

                // After checking
                if ($status == 0) {
                        AdminPage::showNotification("There was an error uploading the image.");
                } else {
                    // delete old image
                    $old_product_name = ProductDAO::getProduct($_POST['prod_name_to_update'])->getName();
                    $old_image_path = "./images/".$old_product_name.".jpg";
                    if(unlink($old_image_path)){
                        $path = "./images/".$_POST['new_prod_name'].".jpg";
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $path)) {
                            $product = new Product();
                            $product->setId($_POST['prod_name_to_update']);
                            $product->setName($_POST['new_prod_name']);
                            $product->setPrice($_POST['new_prod_price']);
                            $product->setDescription($_POST['new_prod_description']);
                            $product->setCategoryId($_POST['new_catid']);
                            
                            $result = ProductDAO::updateProduct($product);
                            if($result == 1){
                                AdminPage::showNotification("Product updated.");
                            }
                        } else {
                            AdminPage::showNotification("There was an error uploading the image.");
                        }
                    }
                }
            }
        }
    }

    // Delete Product form is sent
    if(isset($_POST['delete_prod']) && !empty($_POST['delete_prod'])){
        if(Validate::validateDeleteProductFrom()){
            $old_product_name = ProductDAO::getProduct($_POST['prod_id_to_delete'])->getName();
            $old_image_path = "./images/".$old_product_name.".jpg";
            if(unlink($old_image_path)){
                $result = ProductDAO::deleteProduct($_POST['prod_id_to_delete']);
                if($result > 0){
                    AdminPage::showNotification("Product deleted.");
                }
            }
        }
    }

    // Terminating account is requested
    if(isset($_GET['uid']) && !empty($_GET['uid'])){
        $result = UserDAO::deleteUser($_GET['uid']);
        if($result > 0){
            AdminPage::$notifications .= "Account is terminated.";
        }
    }

    $categories = CategoryDAO::getCategories();
    $products = ProductDAO::getProducts();
    $users = UserDAO::getRegularUsers();
    AdminPage::showNav();

    if($_GET['page'] == 2){
        AdminPage::showNewProductFrom($categories);
        AdminPage::showUpdateProductFrom($categories, $products);
        AdminPage::showDeleteProductFrom($products);
    }elseif($_GET['page'] == 3){
        AdminPage::showUsersTable($users);
    }else{
        AdminPage::showNewCategoryFrom();
        AdminPage::showUpdateCategoryFrom($categories);
        AdminPage::showDeleteCategoryFrom($categories);
    }

    AdminPage::showFooter();

?>