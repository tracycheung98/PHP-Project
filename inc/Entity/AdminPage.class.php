<?php

class AdminPage  {

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
            <link href="./css/admin.css" rel="stylesheet">
            <title><?=self::$studentName."'s'"?> Shop - Admin Panel</title>
        </head>
        <body>            
        <div id="grid-container">
            <header>
                <h3>Admin Panel</h3>
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

    static function showNav(){
        ?><nav>
        <ul class="nav flex-column nav-pills">
        <?php
        if ($_GET['page'] == 2) {
            echo '<li class="nav-item">
            <a class="nav-link" aria-current="page" href="'.$_SERVER['PHP_SELF'].'?page=1">Category</a>
            </li>';
            echo '<li class="nav-item">
            <a class="nav-link active" aria-current="page" href="'.$_SERVER['PHP_SELF'].'?page=2">Product</a>
            </li>';
            echo '<li class="nav-item">
            <a class="nav-link" aria-current="page" href="'.$_SERVER['PHP_SELF'].'?page=3">User</a>
            </li>';
        }elseif ($_GET['page'] == 3) {
            echo '<li class="nav-item">
            <a class="nav-link" aria-current="page" href="'.$_SERVER['PHP_SELF'].'?page=1">Category</a>
            </li>';
            echo '<li class="nav-item">
            <a class="nav-link" aria-current="page" href="'.$_SERVER['PHP_SELF'].'?page=2">Product</a>
            </li>';
            echo '<li class="nav-item">
            <a class="nav-link active" aria-current="page" href="'.$_SERVER['PHP_SELF'].'?page=3">User</a>
            </li>';
        }else {
            echo '<li class="nav-item">
            <a class="nav-link active" aria-current="page" href="'.$_SERVER['PHP_SELF'].'?page=1">Category</a>
            </li>';
            echo '<li class="nav-item">
            <a class="nav-link" aria-current="page" href="'.$_SERVER['PHP_SELF'].'?page=2">Product</a>
            </li>';
            echo '<li class="nav-item">
            <a class="nav-link" aria-current="page" href="'.$_SERVER['PHP_SELF'].'?page=3">User</a>
            </li>';
        }
        ?>
        </ul>
        </nav>
        <div class="flex-container">
        <?php
    }

    static function showFooter()    { ?>        
            </div>  
            </div>  
        </body>
        <footer>
            <p> <a href="./10.php">HomePage</a></p>
            </footer>
        </html>
    <?php }

    static function showNewCategoryFrom(){
        ?>
        <fieldset class="category_form">
        <legend>New Category</legend>
        <form id="cat_insert" method="POST">
            <label for="cat_name ">Name *</label>
            <div><input id="cat_name" type="text" name="cat_name" required="true" pattern="^[\w\-]+$"/></div>
            <input type="submit" name="insert_cat" value="Insert new category"/>
        </form>
        </fieldset>
        <?php
    }

    static function showUpdateCategoryFrom(Array $categories){
        ?>
        <fieldset class="category_form">
        <legend>Update Category</legend>
        <form id="cat_update" method ="POST">
            <label for="cat_name">Name *</label>
            <div><select id="cat_list" name="catid_to_update">
                <?php
                    foreach ($categories as $category){
                        echo '<option value="'.$category->getId().'">'.$category->getName().'</option>';
                    }
                ?>
            </select></div>
            <label for="cat_name">New name *</label>
            <div><input id="cat_name" type="text" name="new_cat_name" required="true" pattern="^[\w\- ]+$"/></div>
            
            <input type="submit" name="update_cat" value="Update category"/>
        </form>
        </fieldset>
        <?php
    }

    static function showDeleteCategoryFrom(Array $categories){
        ?>
        <fieldset class="category_form">
        <legend class="category_form">Delete Category</legend>
        <form id="cat_delete" method ="POST">
            <label for="cat_name">Category to delete *</label>
            <div><select id="cat_list" name="catid_to_delete">
                <?php
                    foreach ($categories as $category){
                        echo '<option value="'.$category->getId().'">'.$category->getName().'</option>';
                    }
                ?>
            </select></div>
            <input type="submit" name="delete_cat" value="Delete category"/>
        </form>
        </fieldset>

        <?php
    }

    static function showNewProductFrom(Array $categories){
        ?>
        <fieldset class="product_form">
        <legend>New Product</legend>
        <form id="prod_insert" method ="POST" enctype="multipart/form-data">
            <label for="prod_catid">Category *</label>
            <div><select id="prod_catid" name="catid">
                <?php
                    foreach ($categories as $category){
                        echo '<option value="'.$category->getId().'">'.$category->getName().'</option>';
                    }
                ?>
            </select></div>
            
            <label for="prod_name">Name *</label>
            <div><input id="prod_name" type="text" name="prod_name_to_insert" required="true" pattern="^[\w\- ]+$"/></div>
            
            <label for="prod_name">Price *</label>
            <div><input id="prod_price" type="text" name="prod_price" required="true" pattern="^[\d\.]+$"/></div>
            
            <label for="prod_name">Description</label>
            <div>
                <textarea name="prod_description" rows="3"></textarea>
            </div>
            
            <label for="prod_name">Image *</label>
            <div><input type="file" name="image" required="true" accept=".jpg,.jpeg,.png"/></div>
            <input type="submit" name="insert_prod" value="Insert new product"/>
        </form>
        </fieldset>
        <?php
    }

    static function showUpdateProductFrom(Array $categories, Array $products){
        ?>
        <fieldset class="product_form">
        <legend class="product_form">Update Product</legend>
        <form id="prod_update" method ="POST" enctype ="multipart/form-data">
            <label for="prod_name">Name *</label>
            <div><select id="prod_list" name="prod_name_to_update">
                <?php
                    foreach ($products as $product){
                        echo '<option value="'.$product->getId().'">'.$product->getName().'</option>';
                    }
                ?>
            </select></div>
            <label for="prod_name">New information: </label></br>
            <label for="prod_catid">Category *</label>
            <div><select id="prod_catid" name="new_catid">
                <?php
                    foreach ($categories as $category){
                        echo '<option value="'.$category->getId().'">'.$category->getName().'</option>';
                    }
                ?>
            </select></div>
            
            <label for="prod_name">Name *</label>
            <div><input id="prod_name" type="text" name="new_prod_name" required="true" pattern="^[\w\- ]+$"/></div>
            
            <label for="prod_name">Price *</label>
            <div><input id="prod_price" type="text" name="new_prod_price" required="true" pattern="^[\d\.]+$"/></div>
            
            <label for="prod_name">Description</label>
            <div>
                <textarea name="new_prod_description" rows="3"></textarea>
            </div>
            
            <label for="prod_name">Image *</label>
            <div><input type="file" name="image" required="true" accept=".jpg,.gif,.png"/></div>
            
            <input type="submit" name="update_prod" value="Update product"/>
        </form>
        </fieldset>
        <?php
    }

    static function showDeleteProductFrom(Array $products){
        ?>
        <fieldset class="product_form">
        <legend class="prod_form">Delete Product</legend>
        <form id="prod_delete" method ="POST">
            <label for="prod_name">Product to delete *</label>
            <div><select id="prod_list" name="prod_id_to_delete">
                <?php
                    foreach ($products as $product){
                        echo '<option value="'.$product->getId().'">'.$product->getName().'</option>';
                    }
                ?>
            </select></div>
            <input type="submit" name="delete_prod" value="Delete product"/>

        </form>
        </fieldset>
        
        <?php
    }

    static function showUsersTable(Array $users){
        ?>
        <table>
        <tr>
            <th>Id</th>
            <th>Email</th>
            <th>Username</th>
            <th>Terminate</th>
        </tr>
        <?php
            foreach ($users as $user){
                echo '<tr>';
                echo '<td>'.$user->getId().'</td>';
                echo '<td>'.$user->getEmail().'</td>';
                echo '<td>'.$user->getUserName().'</td>';
                echo '<td><a href="'.$_SERVER['PHP_SELF'].'?page=3&uid='.$user->getId().'">Terminate</a></td>';
                echo '</tr>';
            }
    }

    static function showLogout(){
        ?>
        <div class="user">
        <p>user: <?=$_SESSION['loggedin']?></p>
        <form id="logout" method="POST">
            <input type="submit" name="logout" value="logout"/>
        </form>
        </div>
        
    <?php
    }
}

?>