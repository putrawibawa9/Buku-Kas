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
        $query = "SELECT * FROM transaction WHERE category_id = '$category_id' ";  
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

    public function readTwoTable(){
        $conn = $this->getConnection();
        $queryKat = "SELECT * FROM kategori";
        $resultKat = $conn->query($queryKat);

        $queryBin = "SELECT * FROM binatang";
        $resultBin = $conn->query($queryBin);


        if($resultKat && $resultBin){
            $dataKat = $resultKat->fetchAll();
            $dataBin = $resultBin->fetchAll();
            return array('tableKat'=>$dataKat, 'tableTrabs'=>$dataBin);
        }else{
            return false;
        }
    }
    public function readTwoTablepart2($transaction_id){
        $conn = $this->getConnection();
        $queryCat = "SELECT * FROM category JOIN transaction ON category.category_id = transaction.category_id WHERE transaction_id = $transaction_id";
        $resultCat = $conn->query($queryCat);

        $queryTrans = "SELECT * FROM transaction WHERE transaction_id= $transaction_id";
        $resultTrans = $conn->query($queryTrans);



        if($resultCat && $resultTrans){
            $dataCat = $resultCat->fetch();
            $dataTrans = $resultTrans->fetch();
            return array('tableCat'=>$dataCat, 'tableTrans'=>$dataTrans);
        }else{
            return false;
        }
    }

    public function readTwoTablepart3($id_kategori){
        $conn = $this->getConnection();
        $queryKat = "SELECT nama_kategori FROM kategori WHERE id_kategori = $id_kategori";
        $resultKat = $conn->query($queryKat);

        $queryBin = "SELECT * FROM binatang JOIN kategori ON binatang.id_kategori = kategori.id_kategori WHERE kategori.id_kategori = $id_kategori";
        $resultBin = $conn->query($queryBin);

        if($resultKat && $resultBin){
            $dataKat = $resultKat->fetch();
            $dataBin = $resultBin->fetchall();
            return array('tableKat'=>$dataKat, 'tableBin'=>$dataBin);
        }else{
            return false;
    }
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

    public function uploadGambar(){
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile =  $_FILES['gambar']['size'];
        $error =  $_FILES['gambar']['error'];  
        $tmp =  $_FILES['gambar']['tmp_name'];  
      
        //cek apakah user sudah menambah gambar
      
        if($error ===4){
          echo "<script>
              alert ('Silahkan pilih gambar');
                </script>";
                return false;
        }
      
        //cek apakah yang diupload adalah gambar
        $ekstensiGambarValid =['jpg','jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile); 
        $ekstensiGambar = strtolower(end($ekstensiGambar)); 
        if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
          echo "<script>
              alert ('format gambar salah!');
                </script>";
                return false;
        }
      
        //cek jika ukurannya terlalu besar
        if ($ukuranFile > 1000000){
          echo "<script>
              alert ('Ukuran terlalu besar');
                </script>";
        }
      
        //generate nama file random
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
      
      
        //lolos semua hasil cek, lalu dijalankan
        move_uploaded_file($tmp, '../img/'.$namaFileBaru);
      
        return $namaFileBaru;
    }


    public function deleteTransaction($transaction_id){
        $conn = $this->getConnection();
        $query = "DELETE FROM transaction WHERE transaction_id = $transaction_id";
        $result = $conn->exec($query);
        return $result;
}

    public function viewEachCategory($id_kategori){
        $conn = $this->getConnection();
        $query = "SELECT * FROM kategori WHERE id_kategori= $id_kategori";
        $result = $conn->query($query);
        $kategori = $result->fetch();
        return $kategori;
    }

    public function editKategori($nama_kategori,$id_kategori){
        $conn = $this->getConnection();
        $query = "UPDATE kategori SET
        nama_kategori = ?
        WHERE id_kategori = ?";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(1,$nama_kategori);
         $stmt->bindParam(2,$id_kategori);

          //check the progress
    if ($stmt->execute()) {
        echo "
            <script>
            alert('Data berhasil diupdate');
            document.location.href = 'kategori.php';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('Data gagal diupdate');
            document.location.href = 'kategori.php';
            </script>
        ";
    }
    }

}
?>