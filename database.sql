-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 12, 2019 at 05:58 AM
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
-- Database: `service3`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `bill_id` varchar(255) NOT NULL,
  `total` int(255) NOT NULL,
  `month` int(2) NOT NULL,
  `date_made` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_completed` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `username`, `type`, `provider`, `bill_id`, `total`, `month`, `date_made`, `date_completed`, `status`) VALUES
(57, 'winatawelly12', 'internet', 'indihome', '123123123', 200000, 6, '2019-06-03 19:10:19', '2019-06-03 19:10:29', 'completed'),
(58, 'winatawe123', 'internet', 'indihome', '1311111', 200000, 6, '2019-06-05 00:35:56', NULL, ''),
(59, 'winatawelly12', 'tv', 'indovision', '123123123111', 200000, 6, '2019-06-05 00:44:10', '2019-06-05 00:44:24', 'completed'),
(60, 'admin', 'internet', 'boom', '12131415', 200000, 6, '2019-06-08 19:54:29', NULL, 'pending'),
(61, 'admiin', 'internet', 'boom', '12131415', 200000, 6, '2019-06-08 19:56:04', NULL, 'pending'),
(62, 'agam', 'internet', 'indihome', '123123', 200000, 6, '2019-06-10 22:05:17', NULL, 'pending'),
(63, 'thomas', 'internet', 'indovision', '123123', 200000, 6, '2019-06-10 22:07:35', '2019-06-10 22:07:39', 'completed'),
(64, 'agam', 'tv', 'tvone', '1234567', 200000, 6, '2019-06-10 22:15:47', NULL, 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD UNIQUE KEY `index_name` (`username`,`bill_id`,`month`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
