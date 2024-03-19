<?php
require_once "../Model/connect.php";
class Transaction extends Connect{
    
    public function readTransaction(){
        $conn = $this->getConnection();
        $query = "SELECT * 
        FROM transaction 
        JOIN category ON category.category_id = transaction.category_id  ";  
        $result = $conn->query($query);
        $burger = $result->fetchAll();
        return $burger;
        }

    public function readTransactionByDateRange($start_date, $end_date){
        $conn = $this->getConnection();
        $query = "SELECT * FROM transaction
        JOIN category ON category.category_id = transaction.category_id
        WHERE transaction_date BETWEEN '$start_date' AND '$end_date';";  
        $result = $conn->query($query);
        $filter = $result->fetchAll();
        return $filter;
    }

    public function readEachTransaction($category_id){
        $conn = $this->getConnection();
        $query = "SELECT * FROM category 
        JOIN transaction ON category.category_id = transaction.category_id
        WHERE category.category_id = '$category_id' ";  
        $result = $conn->query($query);
        $burger = $result->fetchAll();
        return $burger;
        }

    public function readIncome(){
        $conn = $this->getConnection();
        try {
            // Prepare and execute the query to fetch numbers from the database
            $sql = "SELECT * 
            FROM transaction 
            JOIN category ON category.category_id = transaction.category_id 
            WHERE category_type = 'Income';";
            $stmt = $conn->query($sql);
        
            // Check for query success
            if ($stmt) {
                // Fetch all rows as an associative array
                $numbers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                // Calculate the sum using array_sum
                $sum = array_sum(array_column($numbers, 'transaction_price'));
        
                return $sum;
            } else {
                // Handle query error
                echo "Error executing query.";
            }
        } catch (PDOException $e) {
            // Handle PDO exception
            echo "Error: " . $e->getMessage();
        }
        
        // Close the PDO connection
        $your_pdo_connection = null;
        }

    public function readOutcome(){
        $conn = $this->getConnection();
        try {
            // Prepare and execute the query to fetch numbers from the database
            $sql = "SELECT * 
            FROM transaction 
            JOIN category ON category.category_id = transaction.category_id 
            WHERE category_type = 'Outcome';";
            $stmt = $conn->query($sql);
        
            // Check for query success
            if ($stmt) {
                // Fetch all rows as an associative array
                $numbers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                // Calculate the sum using array_sum
                $sum = array_sum(array_column($numbers, 'transaction_price'));
        
                return $sum;
            } else {
                // Handle query error
                echo "Error executing query.";
            }
        } catch (PDOException $e) {
            // Handle PDO exception
            echo "Error: " . $e->getMessage();
        }
        
        // Close the PDO connection
        $your_pdo_connection = null;
        }


    public function addTransaction($data){
        $conn = $this->getConnection();
        $transaction_date = $data['transaction_date'];
        $category_id = $data['category_id'];
        $transaction_name = $data['transaction_name'];
        $transaction_amount = $data['transaction_amount'];
        $transaction_price = $data['transaction_price'];


        $query = "INSERT INTO transaction VALUES 
        ('',?,?,?,?,?)";
    
        $stmt = $conn->prepare($query);
    
        $stmt->bindParam(1,$transaction_name);
        $stmt->bindParam(2,$transaction_date);
        $stmt->bindParam(3,$category_id);
        $stmt->bindParam(4,$transaction_amount);
        $stmt->bindParam(5,$transaction_price);
        $stmt->execute();
        return true;
    }


    public function editTransaction($data){
        $conn = $this->getConnection();
        $transaction_name = $data['transaction_name'];
        $transaction_date = $data['transaction_date'];
        $category_id = $data['category_id'];
        $transaction_amount = $data['transaction_amount'];
        $transaction_price = $data['transaction_price'];
        $transaction_id = $data['transaction_id'];

        $query = "UPDATE transaction SET
        transaction_name = ?,
        transaction_date = ?,
        category_id = ?,
        transaction_amount = ?,
        transaction_price = ?
        WHERE transaction_id = ?
        ";
             $stmt = $conn->prepare($query);
                $stmt->bindParam(1,$transaction_name);
                $stmt->bindParam(2,$transaction_date);
                $stmt->bindParam(3,$category_id);
                $stmt->bindParam(4,$transaction_amount);
                $stmt->bindParam(5,$transaction_price);
                $stmt->bindParam(6,$transaction_id);
                $stmt->execute();
                return true;
    }



    public function deleteTransaction($transaction_id){
        $conn = $this->getConnection();
        $query = "DELETE FROM transaction WHERE transaction_id = $transaction_id";
        $result = $conn->exec($query);
        return $result;
}

    
}
?>