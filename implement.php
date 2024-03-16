<?php
require_once "connect.php";

$con = getConnection();


$con->exec("INSERT INTO `favorite` (`id_fav`, `id_user`, `Id_tukang`, `nama`, `alamat`, `deskripsi`, `no_hp`, `norek`, `harga`) VALUES (NULL, '2', '2', 'Mike Tyson', 'Pekuwudan', 'Pekuwudan jaya', '09788889', 'BRI', '20000')");

$con = null;



?>