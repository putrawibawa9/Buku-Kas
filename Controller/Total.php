<?php
require_once "../Model/connect.php";
class Total extends Connect{
    
    public function readCategoryBased($category_type){
        $conn = $this->getConnection();
        $query = "SELECT * FROM category 
        JOIN transaction ON category.category_id = transaction.category_id
        WHERE category.category_type = '$category_type' ";  
        $result = $conn->query($query);
        $burger = $result->fetchAll();
        return $burger;
        }

}