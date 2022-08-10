<?php
    include_once("inc/config.inc.php");
    include_once("inc/Entity/Product.class.php");
    include_once("inc/Entity/Category.class.php");
    include_once("inc/Entity/MainPage.class.php");
    include_once("inc/Utility/PDOWrapper.class.php");
    include_once("inc/Utility/ProductDAO.class.php");
    include_once("inc/Utility/CategoryDAO.class.php");
    include_once("inc/Utility/LoginManager.class.php");

    MainPage::$studentName = "Tracy";
    MainPage::$studentID = "300355953";
    CategoryDAO::initialize();
    ProductDAO::initialize();

    // verify login
    if(LoginManager::verifyLogin()){
        if(isset($_POST['logout'])){
            session_unset();
            session_destroy();
            header("Location: 10.php");
            exit;
        }
        MainPage::showHeader();
        MainPage::showLogout();
    }else{
        if(isset($_POST['login']) && !empty($_POST['login'])){
            header("Location: login_10.php");
            exit;
        }
        MainPage::showHeader();
        MainPage::showLogin();
    }

    // shopping cart
    MainPage::showShoppingList();

    $categories = CategoryDAO::getCategories();
    MainPage::showNav($categories);

    // show product list
    if(isset($_GET['catid'])){
        if($_GET['pid']){
            $category = CategoryDAO::getCateoryById($_GET['catid']);
            $product = ProductDAO::getProduct($_GET['pid']);
            MainPage::showProductDetail($category, $product);
        }else{
            $products = ProductDAO::getProductsByCatId($_GET['catid']);
            $category = CategoryDAO::getCateoryById('1');
            MainPage::showProductList($category->getName(), $products);
        }
    }else{
        $products = ProductDAO::getProducts();
        MainPage::showProductList("", $products);
    }
    MainPage::showFooter();

?>