-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2020 at 02:04 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `horizont_food_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `bestelltes_essen`
--

CREATE TABLE `bestelltes_essen` (
  `be_id` int(11) NOT NULL,
  `b_id` int(11) DEFAULT NULL,
  `e_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bestellung`
--

CREATE TABLE `bestellung` (
  `b_id` int(11) NOT NULL,
  `k_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `gesamtpreis` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `essen`
--

CREATE TABLE `essen` (
  `e_id` int(11) NOT NULL,
  `e_name` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `e_preis` float DEFAULT NULL,
  `kategorie_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `essen`
--

INSERT INTO `essen` (`e_id`, `e_name`, `e_preis`, `kategorie_id`, `description`) VALUES
(2, 'Pizza Margherita', 6.5, 2, 'kase frısh kase'),
(3, 'Pizza Salami', 7, 2, 'Salamı Kase'),
(4, 'Coca Cola', 2, 1, 'soft drınks'),
(5, 'Pizza Salami', 7, 2, 'Halal  kase hanchen'),
(6, 'Coca Cola', 2, 1, '200ml'),
(7, 'Lobster Bisque', 5.95, 2, 'Lorem, deren, trataro, filede, nerada'),
(8, 'Bread barrel', 6.95, 2, 'Lorem, deren, trataro, filede, nerada\r\n'),
(9, 'Crab Cake', 7.95, 2, 'A delicate crab cake served on a toasted roll with lettuce and tartar sauce'),
(10, 'Caesar Selections', 8.95, 2, 'Lorem, deren, trataro, filede, nerada'),
(11, 'Tuscan Grilled', 9.95, 2, 'Grilled chicken with provolone, artichoke hearts, and roasted red pesto'),
(12, 'Mozzarella Stick', 4.95, 2, 'Lorem, deren, trataro, filede, nerada'),
(13, 'Greek Salad', 9.95, 3, 'Fresh spinach, crisp romaine, tomatoes, and Greek olives'),
(14, 'Spinach Salad', 9.95, 3, 'Fresh spinach with mushrooms, hard boiled egg, and warm bacon vinaigrette'),
(15, 'Lobster Roll', 12.95, 2, 'Plump lobster meat, mayo and crisp lettuce on a toasted bulky roll'),
(16, 'ayran', 1.99, 1, 'gesund youghurt wasser salz');

-- --------------------------------------------------------

--
-- Table structure for table `kategorie`
--

CREATE TABLE `kategorie` (
  `kategorie_id` int(11) NOT NULL,
  `kategorie_name` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`kategorie_id`, `kategorie_name`) VALUES
(1, 'Getränke'),
(2, 'Essen'),
(3, 'Salat'),
(4, 'Süsißkeit');

-- --------------------------------------------------------

--
-- Table structure for table `kunden`
--

CREATE TABLE `kunden` (
  `k_id` int(11) NOT NULL,
  `k_vorname` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `k_nachname` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `k_adresse` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `k_telefonnummer` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `k_kommentare` longtext COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `kunden`
--

INSERT INTO `kunden` (`k_id`, `k_vorname`, `k_nachname`, `k_adresse`, `k_telefonnummer`, `k_kommentare`) VALUES
(1, 'Karl', 'Buchmann', 'Bismarkstraße 2, Hannover', '05110000', 'Gute kunde, gibt ab und zu Trinkgeld');

-- --------------------------------------------------------

--
-- Table structure for table `mitarbeiter`
--

CREATE TABLE `mitarbeiter` (
  `m_id` int(11) NOT NULL,
  `m_vorname` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `m_nachname` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `m_position` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `mitarbeiter`
--

INSERT INTO `mitarbeiter` (`m_id`, `m_vorname`, `m_nachname`, `m_position`) VALUES
(1, 'Asim', 'Fachmann', 'Chef'),
(2, 'Ahmad', 'Konigmann', 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `warenkorb`
--

CREATE TABLE `warenkorb` (
  `w_id` int(11) NOT NULL,
  `e_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warenkorb`
--

INSERT INTO `warenkorb` (`w_id`, `e_id`) VALUES
(6, 13),
(7, 15),
(8, 16),
(9, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bestelltes_essen`
--
ALTER TABLE `bestelltes_essen`
  ADD PRIMARY KEY (`be_id`),
  ADD KEY `b_id` (`b_id`,`e_id`),
  ADD KEY `e_id` (`e_id`);

--
-- Indexes for table `bestellung`
--
ALTER TABLE `bestellung`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `k_id` (`k_id`,`m_id`),
  ADD KEY `k_id_2` (`k_id`),
  ADD KEY `m_id` (`m_id`);

--
-- Indexes for table `essen`
--
ALTER TABLE `essen`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `kategorie_id` (`kategorie_id`);

--
-- Indexes for table `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`kategorie_id`);

--
-- Indexes for table `kunden`
--
ALTER TABLE `kunden`
  ADD PRIMARY KEY (`k_id`);

--
-- Indexes for table `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `warenkorb`
--
ALTER TABLE `warenkorb`
  ADD PRIMARY KEY (`w_id`),
  ADD KEY `e_id` (`e_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bestelltes_essen`
--
ALTER TABLE `bestelltes_essen`
  MODIFY `be_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bestellung`
--
ALTER TABLE `bestellung`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `essen`
--
ALTER TABLE `essen`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `kategorie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kunden`
--
ALTER TABLE `kunden`
  MODIFY `k_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `warenkorb`
--
ALTER TABLE `warenkorb`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bestelltes_essen`
--
ALTER TABLE `bestelltes_essen`
  ADD CONSTRAINT `bestelltes_essen_ibfk_1` FOREIGN KEY (`e_id`) REFERENCES `essen` (`e_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bestelltes_essen_ibfk_2` FOREIGN KEY (`b_id`) REFERENCES `bestellung` (`b_id`) ON UPDATE CASCADE;

--
-- Constraints for table `bestellung`
--
ALTER TABLE `bestellung`
  ADD CONSTRAINT `bestellung_ibfk_1` FOREIGN KEY (`k_id`) REFERENCES `kunden` (`k_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bestellung_ibfk_2` FOREIGN KEY (`m_id`) REFERENCES `mitarbeiter` (`m_id`) ON UPDATE CASCADE;

--
-- Constraints for table `essen`
--
ALTER TABLE `essen`
  ADD CONSTRAINT `essen_ibfk_1` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorie` (`kategorie_id`) ON UPDATE CASCADE;

--
-- Constraints for table `warenkorb`
--
ALTER TABLE `warenkorb`
  ADD CONSTRAINT `warenkorb_ibfk_1` FOREIGN KEY (`e_id`) REFERENCES `essen` (`e_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
