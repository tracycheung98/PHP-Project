<?php

class MainPage  {

    public static $studentID;
    public static $studentName;
    public static $notifications;

    
    static function showHeader() { ?>
        <!doctype html>
        <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- PayPal Sandbox -->
            <script src="https://www.paypal.com/sdk/js?client-id=AUA8oEZ26-Fzuy3NVCSVV24Qefg-OHvHNbNfGYbTVUaG0pIffYajwJRafFAmDu5uh1md3XHFkIURzNmL&currency=CAD"></script>
            <!-- jquery -->
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
            <link href="./css/style.css" rel="stylesheet">
            <script src="./js/cart.js"></script>
            <title><?=self::$studentName."'s"?> Shop</title>
        </head>
        <body>
            <header>
                <h1><img src="./images/_Logo.png"><?=self::$studentName."(".self::$studentID.")"?> Shop</h1>
            </header>
            <div id="grid-container">
    <?php }

    
    static function showFooter()    { ?>        
            </main>
            <footer>
            <p> <a href="./admin_10.php?page=1">AdminPanel</a> </p>
            </footer>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        </body>
        </html>
    <?php }

    static function showNav(Array $categories){
        ?><nav>
        <ul class="nav flex-column nav-pills">
        <?php
        if (isset($_GET['catid'])) {
            echo '<li class="nav-item">
            <a class="nav-link" aria-current="page" href="./10.php">Home</a>
            </li>';
        }
        else {
            echo '<li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./10.php">Home</a>
            </li>';
        }
        
        foreach ($categories as $category){
            if (isset($_GET['catid']) && $_GET['catid'] == $category->getId()){
                echo '<li class="nav-item">
                <a class="nav-link active" aria-current="page" href="'.$_SERVER['PHP_SELF'].'?catid='.$category->getId().'">'.$category->getName().'</a>
                </li>';
                
            } else{
                echo '<li class="nav-item">
                <a class="nav-link" aria-current="page" href="'.$_SERVER['PHP_SELF'].'?catid='.$category->getId().'">'.$category->getName().'</a>
                </li>';
            }
        }?>
        </ul>
        </nav>
        <?php
    }

    static function showShoppingList(){
        ?>
        <div class="shopping-list">
            <p class="collapse card">Shopping List:  $<span class="amount"></span></p>
            <div class="expand card">
                <div class="card-body">
                <h5 class="shopping-list-title">Shopping List: (Total: $<span class="amount"> </span>)</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div id="paypal-button-container"></div>
                
                </div>
            </div>
            </div>
        <?php
    }

    static function showLogin(){
        ?>
        <div class="user">
        <p>Hi! Guest </p>
        <form id="login" method="POST">
            <input type="submit" name="login" value="login"/>
        </form>
      </div>
      <?php
    }

    static function showLogout(){
        ?>
        <div class="user">
        <p>Hi! <?=$_SESSION['loggedin']?></p>
        <form id="logout" method="POST">
            <input type="submit" name="logout" value="logout"/>
        </form>
        </div>
        
    <?php
    }
    
    static function showProductList(string $cat_name, Array $products){
        ?>
        <main>
        <?php
        if($cat_name != ""){
            echo '<h3> <a class="title" href="./10.php">Home</a> > '.$cat_name.'</h3>';
        }else{
            echo '<h3 class="title">Home</h3>';
        }
        ?>
        <ul class="product-list">
        <?php
            foreach($products as $product) {
                $product = '<div class="card product-card">
                            <img src="./images/'.$product->getName().'.jpg" class="card-img-top" alt="'.$product->getName().'">
                            <div class="card-body">
                            <h5><a class="card-title" href="./10.php?catid=' . $product->getCategoryId() . '&pid=' . $product->getId() . '">'.$product->getName().'</a></h5>
                            <p class="card-text">$ '.$product->getPrice().'</p>
                            <button name="addToCart" class="btn btn-primary" onClick=addToCart('.$product->getId().',"'.urlencode($product->getName()).'",'.$product->getPrice().')>Add</button>
                            </div>
                            </div>';
                echo $product;
            }
        ?>
        </ul>
        <?php
    
    }

    static function showProductDetail(Category $category, Product $product){
        ?>
        <main>
        <h3>
        <?php
            echo '<a class="title" href="./10.php">Home</a> 
            > <a class="title" href="./10.php?catid='.$category->getId().'">'.$category->getName().'</a> 
            > '.$product->getName();
        ?>
        </h3>
        <ul class="product-info">
        <img src="./images/<?=$product->getName()?>.jpg" alt="<?=$product->getName()?>">
        <h3><?=$product->getName()?><br>$ <?=$product->getPrice()?></h3>
        <p><?=$product->getDescription()?></p>
        <button class="btn btn-primary" onClick="addToCart(<?=$product->getId()?>,<?="'".urlencode($product->getName())."'"?>,<?=$product->getPrice()?>)">Add</button>
        </ul>
        <?php
    
    }

    static function x(){?>
        <input type="hidden" name="cmd" value="_ext-enter">
                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr.php" method="post" id="idofshoppingcart" onsubmit="return mySubmit(this, event);">
                    <!-- <ul id="shoppingCartList"> -->
                    <input type="hidden" name="cmd" value="_cart">
                    <input type="hidden" name="upload" value="1">
                    <input type="hidden" name="business" value="sb-kdfim5788008@business.example.com">
                    <!-- sb-kdfim5788008@business.example.com"> -->
                    <input type="hidden" name="currency_code" value="HKD">
                    <input type="hidden" name="custom" value="0">
                    <input type="hidden" name="invoice" value="0">
                    

                    <input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="checkout" alt="Make payments with PayPal - it's fast, free and secure!">
                    </ul>
                </form>
                <?php
    }

}

?>