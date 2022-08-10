<?php

class Category {

    //Properties
    private $cat_id;
    private $cat_name;
    
    //Setters
    function setId(string $cat_id){
        $this->cat_id = $cat_id;
    }
    
    function setName(string $cat_name){
        $this->cat_name = $cat_name;
    }
    
    //Getters
    function getId(){
        return $this->cat_id;
    }

    function getName(){
        return $this->cat_name;
    }
}



?>