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

}
?>