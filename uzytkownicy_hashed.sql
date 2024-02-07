-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2024 at 07:48 PM
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
-- Database: `osadnicy`
--

-- --------------------------------------------------------

--
-- Table structure for table `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `email` text NOT NULL,
  `drewno` int(11) NOT NULL,
  `kamien` int(11) NOT NULL,
  `zboze` int(11) NOT NULL,
  `dnipremium` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `user`, `pass`, `email`, `drewno`, `kamien`, `zboze`, `dnipremium`) VALUES
(1, 'adam', '21b1c114e9ade36af39a7e1724cb27e7', 'adam@gmail.com', 213, 5675, 342, 0),
(2, 'marek', '22c64ca95223e15ff8fd69e3d82ea16d', 'marek@gmail.com', 324, 1123, 4325, 15),
(3, 'anna', '9b910af3b405fb5fbcf56668911396e6', 'anna@gmail.com', 4536, 17, 120, 25),
(4, 'andrzej', '22c64ca95223e15ff8fd69e3d82ea16d', 'andrzej@gmail.com', 5465, 132, 189, 0),
(5, 'justyna', '536562e06134d516452b1b623d74e665', 'justyna@gmail.com', 245, 890, 554, 0),
(6, 'kasia', 'cead7388dbbc1577f7f100369df61d7f', 'kasia@gmail.com', 267, 980, 109, 12),
(7, 'beata', 'c56d1fdb23f0c76e83adc1fd5b27ae33', 'beata@gmail.com', 565, 356, 447, 77),
(8, 'jakub', '9b593a92fdb9eed0d178ad3aa4e85b01', 'jakub@gmail.com', 2467, 557, 876, 0),
(9, 'janusz', '8e2694c690083ca6db02c985149e7e84', 'janusz@gmail.com', 65, 456, 2467, 0),
(10, 'roman', 'cac8c5833442092a1ffa09329ce1f54b', 'roman@gmail.com', 97, 226, 245, 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
