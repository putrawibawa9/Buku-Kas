<?php

require_once 'classBurger.php';

$burger = new Burger;
$id_binatang = $_GET['id_binatang'];

if ($burger->deleteBurger($id_binatang)){
    echo "<script>
            alert('data berhasil dihapus');
            document.location.href = 'burger.php';
      </script>";
}else{
  echo "  <script>
            alert('data gagal dihapus');
            document.location.href = 'burger.php';
            </script>";
}


?>