<?php

require_once 'classCategory.php';

$id_kategori = $_GET['id_kategori'];

$deleteKategori = new Kategori;


$deleteKategori->deleteKategori($id_kategori);

?>