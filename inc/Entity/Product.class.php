<?php

class Product {

    //Properties
    private $p_id;
    private $p_name;
    private $p_price;
    private $p_description;
    private $cat_id; 
    
    //Setters
    function setId(string $p_id){
        $this->p_id = $p_id;
    }

    function setName(string $p_name){
        $this->p_name = $p_name;
    }
    
    function setPrice(string $p_price){
        $this->p_price = $p_price;
    }

    function setDescription(string $p_description){
        $this->p_description = $p_description;
    }
    
    function setCategoryId(string $cat_id){
        $this->cat_id = $cat_id;
    }
    
    //Getters
    function getId(){
        return $this->p_id;
    }

    function getName(){
        return $this->p_name;
    }

    function getPrice(){
        return $this->p_price;
    }

    function getDescription(){
        return $this->p_description;
    }

    function getCategoryId(){
        return $this->cat_id;
    }
}



?>