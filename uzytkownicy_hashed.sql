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
(1, 'adam', '4RC42wz6JlNtyeRqijov1O32AHB8SlDt42iFqePZlNLC2/LokdF..', 'adam@gmail.com', 213, 5675, 342, 0),
(2, 'marek', '0Ek4ln1bZvuITVjpHpBrNef1JbTVZFF85SGY78X/DgMSk/nkRl8Gi', 'marek@gmail.com', 324, 1123, 4325, 15),
(3, 'anna', 'QwDnwdwUODQAHzx2Z0qZIeMzB1EK8ypDWsDsoHm/H7zdlQsX9pyVm', 'anna@gmail.com', 4536, 17, 120, 25),
(4, 'andrzej', 'jXAberjjzIp1JPe7m53iKekKJzyVU0m2RTbL.FIutXeWd5re/h4By', 'andrzej@gmail.com', 5465, 132, 189, 0),
(5, 'justyna', '.S6UoUNaP0OK7BYu7U/M2..UaWl9W8ejREh4gH75k6oqlVwJKuGLK', 'justyna@gmail.com', 245, 890, 554, 0),
(6, 'kasia', 'irGge1gco.RD5IUuoQ4d6eNpShnCmQCq/U7kgpyU37OH6bA1oBVPi', 'kasia@gmail.com', 267, 980, 109, 12),
(7, 'beata', 'GwIAxMxN5sKTZPWOGT9mSuqBHa3BFFIcUTdQ48Oi.abRwi5lRIlT.', 'beata@gmail.com', 565, 356, 447, 77),
(8, 'jakub', 'c.nbRePgJGwDa9FSx7n15eStaiJG4QBEY1tMVJCO2TbXUEcCHA7L2', 'jakub@gmail.com', 2467, 557, 876, 0),
(9, 'janusz', 'ZUJCBOx.pWLFSjXp8Fj36ugdb2LTJRzmuLqZ9D79V02mRhZuTk.BG', 'janusz@gmail.com', 65, 456, 2467, 0),
(10, 'roman', '4t6K9.WcdKBQ2rHjqJ8tyemLCVLzqGa1Bvs5eVPAkp7SnXzf7tNNO', 'roman@gmail.com', 97, 226, 245, 23);

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
