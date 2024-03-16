<?php

require_once "../admins/classCategory.php";


$kat = new Kategori;

$kategori = $kat->readKategori();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/public.style.css">

</head>
<body>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="index.php">Buku Kas Putra Bali</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                            <a class="nav-link menu-home" aria-current="page" href="index.php">Home</a>
                            </li>

                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle menu-binatang" href="#" id="binatang-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Category
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="binatang-dropdown">

                                <?php foreach($kategori as $row):?>
                                    <li><a class="dropdown-item" href="binatang.php?id_kategori=<?= $row['id_kategori']?>"> <?= $row['nama_kategori']?></a></li>
                                    <?php endforeach; ?>
                            
                            </ul>


                            </li>

                            <li class="nav-item">
                            <a class="nav-link menu-about" href="about.php">About</a>
                            </li>
                            <li class="nav-item dropdown">
                            </li>
                        </ul>
                        <form class="d-flex ">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            <a class="nav-link active" href="../index.php">Login</a>
                            </li>
                        </ul>
                        </form>
                        </div>
                    </div>
                </nav>
            </div>