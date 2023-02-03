-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 16, 2023 at 08:14 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `otopark`
--

-- --------------------------------------------------------

--
-- Table structure for table `abone`
--

DROP TABLE IF EXISTS `abone`;
CREATE TABLE IF NOT EXISTS `abone` (
  `plaka` varchar(15) NOT NULL,
  `ad` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `soyad` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `baslangic` text,
  `bitis` text,
  `telno` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`plaka`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `abone`
--

INSERT INTO `abone` (`plaka`, `ad`, `soyad`, `baslangic`, `bitis`, `telno`) VALUES
('41 ADK 647', 'Yusuf', 'Güzeldere', '17-01-23', '17-02-23', '05555555555'),
('06 FL 4139', 'Hamza', 'Morkurt', '10-01-23', '10-02-23', '05366368779'),
('41 E 9047', 'Ammar', 'Eşit', '16-02-23', '15-02-23', '05552222222');

-- --------------------------------------------------------

--
-- Table structure for table `giriscikis`
--

DROP TABLE IF EXISTS `giriscikis`;
CREATE TABLE IF NOT EXISTS `giriscikis` (
  `plaka` varchar(15) DEFAULT NULL,
  `giris` text,
  `cikis` text,
  `ucret` decimal(10,0) DEFAULT NULL,
  KEY `plaka` (`plaka`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `giriscikis`
--

INSERT INTO `giriscikis` (`plaka`, `giris`, `cikis`, `ucret`) VALUES
('41 E 9047', '16-01-23 22:26:26', '16-01-23 22:36:42', '0'),
('41 A 123', '16-01-23 22:26:50', '16-01-23 22:30:19', '3'),
('34 B 4141', '16-01-23 22:27:11', ' ', NULL),
('41 ADK 647', '16-01-23 22:27:27', '16-01-23 22:27:33', '0'),
('41 ADK 647', '10-01-23 12:00:00', '12-01-23 13:00:00', '0'),
('41 E 9047', '12-01-23 12:00:00', '13-01-23 13:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `personel`
--

DROP TABLE IF EXISTS `personel`;
CREATE TABLE IF NOT EXISTS `personel` (
  `parola` varchar(15) DEFAULT NULL,
  `kullaniciadi` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `personel`
--

INSERT INTO `personel` (`parola`, `kullaniciadi`) VALUES
('123', 'Hamza'),
('123', 'Yusuf');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
