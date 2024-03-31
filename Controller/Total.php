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

        public function sumTotalCategory($category_id){
            $conn = $this->getConnection();
            $query = "SELECT SUM(transaction_amount * transaction_price) AS total_sum
            FROM transaction
            JOIN category ON category.category_id = transaction.category_id
            WHERE category_id = '$category_id';";
            $result = $conn->query($query);
            $burger = $result->fetchAll();
            return $burger;
            }
        
     
}