-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2024 at 04:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buku/kas`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` varchar(50) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_type`) VALUES
('K001', 'Biaya honor PTK', 'outcome'),
('K002', 'Biaya Operasional Lembaga', 'outcome'),
('K003', 'Biaya Pembelian Media Pembelajaran', 'outcome'),
('K004', 'Biaya Pengembangan Usaha', 'outcome'),
('K005', 'Biaya Renovasi Ruangan', 'outcome'),
('K006', 'Biaya Pemeliharaan', 'outcome'),
('K007', 'Biaya Investasi Sarana', 'outcome'),
('K008', 'Biaya Investasi Prasarana', 'outcome'),
('K009', 'Biaya Investasi SDM', 'outcome'),
('K010', 'Biaya Iuran BPJS Kesehatan', 'outcome'),
('K011', 'Biaya BPJS Ketenagakerjaan', 'outcome'),
('K012', 'Biaya Recruitment Dan Promosi', 'outcome'),
('K013', 'Biaya Kegiatan CSR', 'outcome'),
('K014', 'Biaya Pajak', 'outcome'),
('K015', 'Bunga Bank', 'outcome'),
('K016', 'Biaya Ujian Kompetensi', 'outcome'),
('K017', 'Iuran Desa', 'outcome'),
('P001', 'Pembayaran Peserta Didik', 'income'),
('P002', 'Pembayaran Modul-modul', 'Income'),
('P003', 'Lain-lain', 'income');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `transaction_name` varchar(50) DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `category_id` varchar(50) NOT NULL,
  `transaction_amount` int(11) NOT NULL,
  `transaction_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `transaction_name`, `transaction_date`, `category_id`, `transaction_amount`, `transaction_price`) VALUES
(1, 'Pemasukan', '2024-03-18', 'P001', 202, 12223);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('putra', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
