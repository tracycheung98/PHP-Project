<?php
class CategoryDAO   {

    // Create a member to store the PDO agent
    private static $db;  

    // create the init function to start the PDO wrapper
    static function initialize() {
        self::$db = new PDOWrapper("Category");
    }
    
    // function to create category
    static function createCategory(string $cat_name){

        $sql = "INSERT INTO categories (cat_name) VALUES (:cat_name)";
        
        // prepare the query
        self::$db->query($sql);
        
        // bind the parameters
        self::$db->bind(':cat_name',trim($cat_name));

        // execute the query
        self::$db->execute();

        return self::$db->rowCount();
    }

    // function to get all categories
    static function getCategories()  {
        
        $sql = "SELECT * from categories";

        // prepare the query
        self::$db->query($sql);
        
        // execute the query
        self::$db->execute();
        
        return self::$db->getSetResult();
    }
    
    // function to get category name by cat_id 
    static function getCateoryById(string $cat_id)  {
        
        // you know the drill
        // return the single result query
        $sql = "SELECT * from categories WHERE cat_id = :cat_id";

        // prepare the query
        self::$db->query($sql);

        // bind the parameters
        self::$db->bind(':cat_id',$cat_id);
        
        // execute the query
        self::$db->execute();
        
        return self::$db->getSingleResult();
    }

    // function to get category name by cat_id 
    static function getCategoryByName(string $name)  {
        
        // you know the drill
        // return the single result query
        $sql = "SELECT * from categories WHERE cat_name = :cat_name";

        // prepare the query
        self::$db->query($sql);

        // bind the parameters
        self::$db->bind(':cat_name',$name);
        
        // execute the query
        self::$db->execute();
        
        return self::$db->rowCount();

    }

    // function to update a category
    static function updateCategory(Category $category)    {
        $sql = "UPDATE categories SET
        cat_name=:cat_name
        WHERE cat_id=:cat_id";

        // prepare the query
        self::$db->query($sql);

        // bind the parameters
        self::$db->bind(':cat_id',trim($category->getId()));
        self::$db->bind(':cat_name',trim($category->getName()));

        // execute the query
        self::$db->execute();

        return self::$db->rowCount();

    }


    // function to delete a category
    static function deleteCategory(string $id)  {

        $sql = "DELETE FROM categories WHERE cat_id = :cat_id";

        // prepare the query
        self::$db->query($sql);
        
        // bind the parameters
        self::$db->bind(':cat_id',trim($id));
        
        // execute the query
        self::$db->execute();

        return self::$db->rowCount();
    }
    
    
}