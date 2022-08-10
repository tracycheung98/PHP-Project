<?php
class ProductDAO   {

    // Create a member to store the PDO agent
    private static $db;  

    // create the init function to start the PDO wrapper
    static function initialize() {
        self::$db = new PDOWrapper("Product");
    }
    
    // function to create product
    static function createProduct(Product $product){

        $sql = "INSERT INTO products (p_name, p_price, p_description, cat_id) VALUES (:name, :price, :description, :cat_id)";
        
        // prepare the query
        self::$db->query($sql);

        // bind the parameters
        self::$db->bind(':name',trim($product->getName()));
        self::$db->bind(':price',trim($product->getPrice()));
        self::$db->bind(':description',trim($product->getDescription()));
        self::$db->bind(':cat_id',trim($product->getCategoryId()));

        // execute the query
        self::$db->execute();

        return self::$db->rowCount();
    }

    // function to get all products in same category
    static function getProductsByCatId(string $cat_id)  {
        
        $sql = "SELECT * from products WHERE cat_id=:cat_id";

        // prepare the query
        self::$db->query($sql);

        // bind the parameters
        self::$db->bind(':cat_id',$cat_id);

        // execute the query
        self::$db->execute();
        
        return self::$db->getSetResult();
    }

    // function to get all products in same category
    static function getProductsByName(string $p_name)  {
        
        $sql = "SELECT * from products WHERE p_name=:p_name";

        // prepare the query
        self::$db->query($sql);

        // bind the parameters
        self::$db->bind(':p_name',$p_name);

        // execute the query
        self::$db->execute();
        
        return self::$db->rowCount();
    }

    // function to get all products
    static function getProducts()  {
        
        $sql = "SELECT * FROM products";

        // prepare the query
        self::$db->query($sql);
        
        // execute the query
        self::$db->execute();
        
        return self::$db->getSetResult();
    }

    // function to get product by p_id
    static function getProduct(String $id)  {
        
        $sql = "SELECT * FROM products WHERE p_id=:p_id";

        // prepare the query
        self::$db->query($sql);

        // bind the parameters
        self::$db->bind(':p_id',$id);

        // execute the query
        self::$db->execute();
        
        return self::$db->getSingleResult();
    }

    // function to update a category
    static function updateProduct(Product $product)    {
        $sql = "UPDATE products SET
        p_name=:name,
        p_price=:price,
        p_description=:description,
        cat_id=:cat_id
        WHERE p_id=:id";

        // prepare the query
        self::$db->query($sql);

        // bind the parameters
        self::$db->bind(':id',trim($product->getId()));
        self::$db->bind(':name',trim($product->getName()));
        self::$db->bind(':price',trim($product->getPrice()));
        self::$db->bind(':description',trim($product->getDescription()));
        self::$db->bind(':cat_id',trim($product->getCategoryId()));

        // execute the query
        self::$db->execute();

        return self::$db->rowCount();

    }


    // function to delete a category
    static function deleteProduct(string $id)  {

        $sql = "DELETE FROM products WHERE p_id = :id";

        // prepare the query
        self::$db->query($sql);
        
        // bind the parameters
        self::$db->bind(':id',trim($id));
        
        // execute the query
        self::$db->execute();

        return self::$db->rowCount();
    }
    
    
}