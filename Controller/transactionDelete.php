<?php

require_once '../Controller/Transaction.php'; 

$transaction = new Transaction;
$transaction_id = $_GET['transaction_id'];

if ($transaction->deleteTransaction($transaction_id)){
    echo "<script>
            alert('data berhasil dihapus');
            document.location.href = '../View/dashboard.php';
      </script>";
}else{
  echo "  <script>
            alert('data gagal dihapus');
            document.location.href = '../View/dashboard.php';
            </script>";
}


?>