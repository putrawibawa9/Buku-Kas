<?php
require_once "../Model/connect.php";
class Category extends Connect{
    
    public function readcategory(){
        $conn = $this->getConnection();
        $query = "SELECT * FROM category";
        $result = $conn->query($query);
        $kategori = $result->fetchAll();
        return $kategori;
        }

        public function readCategoryOnType($category_type){
            $conn = $this->getConnection();
            $query = "SELECT * FROM category
            WHERE category_type = '$category_type'";
            $result = $conn->query($query);
            $kategori = $result->fetchAll();
            return $kategori;
            }

            public function sumEachCategory($category_id){
                $conn = $this->getConnection();
                $query = "SELECT 
                SUM(transaction_amount * transaction_price) AS total_amount_K001
                    FROM 
                        `transaction`
                    WHERE 
                category_id = '$category_id';";  
                $result = $conn->query($query);
                $sum = $result->fetch();
                return $sum;
                }
}


?>