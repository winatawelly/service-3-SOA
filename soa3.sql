-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 15, 2019 at 07:38 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soa3`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` varchar(255) NOT NULL,
  `customer_number` varchar(255) NOT NULL,
  `date_made` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_complete` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `tipe` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `month` int(255) NOT NULL,
  `year` int(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'belum_lunas'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_id`, `customer_number`, `date_made`, `date_complete`, `tipe`, `provider`, `price`, `month`, `year`, `status`) VALUES
('billfirstMedia000172019', 'firstMedia000172019', '2019-06-15 10:10:50', '2019-06-15 10:10:58', 'internet', 'firstMedia', 200000, 7, 2019, 'lunas'),
('billfirstMedia000272019', 'firstMedia000272019', '2019-06-15 11:47:00', NULL, 'internet', 'firstMedia', 200000, 7, 2019, 'belum_lunas'),
('billfirstMedia000372019', 'firstMedia000372019', '2019-06-15 11:51:15', '2019-06-15 11:51:42', 'internet', 'firstMedia', 200000, 7, 2019, 'lunas'),
('billfirstMedia000472019', 'firstMedia000472019', '2019-06-15 12:18:50', NULL, 'internet', 'firstMedia', 200000, 7, 2019, 'belum_lunas'),
('billindovision000172019', 'indovision000172019', '2019-06-15 09:34:30', '2019-06-15 10:12:47', 'tv', 'indovision', 200000, 7, 2019, 'lunas'),
('billwinatawellyfirstMedia000172019', 'firstMedia000172019', '2019-06-15 09:03:20', NULL, 'internet', 'firstMedia', 200000, 7, 2019, 'belum_lunas'),
('billwinatawellyindovision000172019', 'indovision000172019', '2019-06-15 09:06:16', NULL, 'tv', 'indovision', 200000, 7, 2019, 'belum_lunas');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_number` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `month` int(255) NOT NULL,
  `year` int(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'belum_lunas'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_number`, `tipe`, `provider`, `price`, `month`, `year`, `status`) VALUES
('firstMedia000072019', 'internet', 'firstMedia', 200000, 7, 2019, 'belum_lunas'),
('firstMedia000172019', 'internet', 'firstMedia', 200000, 7, 2019, 'lunas'),
('firstMedia000272019', 'internet', 'firstMedia', 200000, 7, 2019, 'belum_lunas'),
('firstMedia000372019', 'internet', 'firstMedia', 200000, 7, 2019, 'lunas'),
('firstMedia000472019', 'internet', 'firstMedia', 200000, 7, 2019, 'belum_lunas'),
('indihome000062019', 'internet', 'indihome', 225000, 6, 2019, 'belum_lunas'),
('indihome000072019', 'internet', 'indihome', 200000, 7, 2019, 'belum_lunas'),
('indihome000162019', 'internet', 'indihome', 225000, 6, 2019, 'belum_lunas'),
('indihome000172019', 'internet', 'indihome', 200000, 7, 2019, 'belum_lunas'),
('indihome000262019', 'internet', 'indihome', 225000, 6, 2019, 'belum_lunas'),
('indihome000272019', 'internet', 'indihome', 200000, 7, 2019, 'belum_lunas'),
('indihome000362019', 'internet', 'indihome', 225000, 6, 2019, 'belum_lunas'),
('indihome000372019', 'internet', 'indihome', 200000, 7, 2019, 'belum_lunas'),
('indihome000462019', 'internet', 'indihome', 225000, 6, 2019, 'belum_lunas'),
('indihome000472019', 'internet', 'indihome', 200000, 7, 2019, 'belum_lunas'),
('indovision000072019', 'tv', 'indovision', 200000, 7, 2019, 'belum_lunas'),
('indovision000172019', 'tv', 'indovision', 200000, 7, 2019, 'lunas'),
('indovision000272019', 'tv', 'indovision', 200000, 7, 2019, 'belum_lunas'),
('indovision000372019', 'tv', 'indovision', 200000, 7, 2019, 'belum_lunas'),
('indovision000472019', 'tv', 'indovision', 200000, 7, 2019, 'belum_lunas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
