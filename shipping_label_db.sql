-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 30, 2026 at 08:59 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shipping_label_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` int NOT NULL,
  `sender_name` varchar(100) NOT NULL,
  `sender_contact` varchar(20) NOT NULL,
  `sender_address` text NOT NULL,
  `receiver_name` varchar(100) NOT NULL,
  `receiver_contact` varchar(20) NOT NULL,
  `receiver_address` text NOT NULL,
  `receiver_city` varchar(50) NOT NULL,
  `package_count` int NOT NULL DEFAULT '1',
  `item_description` text,
  `resi_number` varchar(50) DEFAULT NULL,
  `expedition` varchar(50) DEFAULT NULL,
  `resi_photo` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `sender_name`, `sender_contact`, `sender_address`, `receiver_name`, `receiver_contact`, `receiver_address`, `receiver_city`, `package_count`, `item_description`, `resi_number`, `expedition`, `resi_photo`, `created_at`, `updated_at`) VALUES
(2, 'PT PELITA INDONESIA DJAYA', '+62 851-8307-3715', 'Jl. Raya Angkasa No.18, Kelurahan Gunung Sahari Selatan, Kemayoran, Jakarta Pusat 10610.', 'Rahmat Usman', '+62 852-4466-1641', 'Kantor pelni Nabire\r\nJalan frans kasisepo No14 nabire papua tengah', 'NABIRE', 1, 'Router SN: HK30AYFS7D9', '43223', 'Lion Parcel', '45ca1ea077071403177aee044a2b614d.jpeg', '2026-03-30 09:00:27', '2026-03-30 15:17:55'),
(3, 'PT PELITA INDONESIA DJAYA', '+62 851-8307-3715', 'Jl. Raya Angkasa No.18, Kelurahan Gunung Sahari Selatan, Kecamatan Kemayoran, Jakarta Pusat, 10610.', 'FATUR/ABDURRACHMAN BAPA', '-', '-', 'FAK-FAK', 1, '-', '11LP1774323745821', 'Lion Parcel', 'b8493ca8407df27df4d56a98162485ab.jpeg', '2026-03-30 15:48:27', '2026-03-30 15:58:13'),
(4, 'PT PELITA INDONESIA DJAYA', '+62 851-8307-3715', 'Jl. Raya Angkasa No.18, Kelurahan Gunung Sahari Selatan, Kecamatan Kemayoran, Jakarta Pusat, 10610.', 'IRON HUSAIN', '-', 'PT PELNI Cabang Bitung\r\nBitung Sulut, Jl. Sam Ratulangi, Bitung Barat Dua, Maesa, Bitung City, North Sulawesi', 'BITUNG', 1, '-', '11LP17744323745821', 'Lion Parcel', 'b0f4bf053c2b2a301ac10d310e6ba76a.jpeg', '2026-03-30 15:51:07', '2026-03-30 15:56:46'),
(5, 'PT PELITA INDONESIA DJAYA', '+62 851-8307-3715', 'PT PELNI Cabang Bitung\r\nBitung Sulut, Jl. Sam Ratulangi, Bitung Barat Dua, Maesa, Bitung City, North Sulawesi', 'REZA', '-', '-', 'SAMPIT', 1, '-', '11LP1774434067944', 'Lion Parcel', '70a7bb8ea8e101c3ef3e6b3d18997fcc.jpeg', '2026-03-30 15:52:27', '2026-03-30 15:56:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
