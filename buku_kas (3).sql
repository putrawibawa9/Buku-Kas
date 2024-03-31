-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 05:32 PM
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
('P002', 'Pembayaran Modul-modul', 'income'),
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
(7, 'Pemasukan', '2024-03-01', 'P002', 30, 100000),
(8, 'Pemasukan', '2024-03-02', 'P001', 20, 200000),
(9, 'Pemasukan', '2024-03-14', 'P003', 10, 100000),
(10, 'Pengeluaran', '2024-03-13', 'K001', 30, 500000),
(11, 'Pengeluaran', '2024-03-13', 'K001', 30, 500000),
(12, 'Pengeluaran', '2024-03-14', 'K002', 25, 450000),
(13, 'Pengeluaran', '2024-03-15', 'K003', 40, 600000),
(14, 'Pengeluaran', '2024-03-16', 'K004', 35, 550000),
(15, 'Pengeluaran', '2024-03-17', 'K005', 28, 480000),
(16, 'Pengeluaran', '2024-03-18', 'K006', 32, 520000),
(17, 'Pengeluaran', '2024-03-19', 'K007', 37, 570000),
(18, 'Pengeluaran', '2024-03-20', 'K008', 29, 490000),
(19, 'Pengeluaran', '2024-03-21', 'K009', 31, 510000),
(20, 'Pengeluaran', '2024-03-22', 'K010', 33, 530000),
(21, 'Pengeluaran', '2024-03-23', 'K011', 38, 580000),
(22, 'Pengeluaran', '2024-03-24', 'K012', 27, 470000),
(23, 'Pengeluaran', '2024-03-25', 'K013', 36, 560000),
(24, 'Pengeluaran', '2024-03-26', 'K014', 26, 460000),
(25, 'Pengeluaran', '2024-03-27', 'K015', 34, 540000),
(26, 'Pengeluaran', '2024-03-28', 'K016', 39, 590000),
(27, 'Pengeluaran', '2024-03-29', 'K017', 45, 650000),
(28, 'Pengeluaran', '2024-03-15', 'K001', 20, 100000);

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
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
