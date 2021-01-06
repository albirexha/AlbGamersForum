-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2020 at 10:43 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forumidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `anetari`
--

CREATE TABLE `anetari` (
  `anetariid` int(11) NOT NULL,
  `emri_mbiemri` varchar(500) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `roli` int(8) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anetari`
--

INSERT INTO `anetari` (`anetariid`, `emri_mbiemri`, `email`, `username`, `password`, `isActive`, `roli`) VALUES
(23, 'test user', 'user@gmail.com', 'user1', 'user', 0, 1),
(46, 'albi', 'albi@gmail.com', 'albirexha', 'albi', 1, 1),
(47, 'erion', 'erion@gmail.com', 'erion', 'pw1', 1, 1),
(48, 'hysen', 'hysen@gmail.com', 'hysen', 'pw1', 1, 1),
(49, 'ibrahim', 'ibrahim@gmail.com', 'ibrahim', 'pw1', 1, 1),
(50, 'user1', 'user1@gmail.com', 'user1', 'pw1', 0, 2),
(51, 'user2', 'user2@gmail.com', 'user2', 'pw1', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `dhoma_e_pritjes`
--

CREATE TABLE `dhoma_e_pritjes` (
  `ppid` int(11) NOT NULL,
  `anetariid` int(11) NOT NULL,
  `data_e_krijimit` datetime DEFAULT current_timestamp(),
  `teksti_postimit` text NOT NULL,
  `titulli_postimit` varchar(255) NOT NULL,
  `kategoriaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dhoma_e_pritjes`
--

INSERT INTO `dhoma_e_pritjes` (`ppid`, `anetariid`, `data_e_krijimit`, `teksti_postimit`, `titulli_postimit`, `kategoriaid`) VALUES
(45, 51, '2020-12-24 00:45:23', 'Qfare mendoni per Valorant, a mund te rritet ne permasat e CSGO pershembull?', 'Valorant', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategoria`
--

CREATE TABLE `kategoria` (
  `kategoriaid` int(11) NOT NULL,
  `emri_kategoria` varchar(255) NOT NULL,
  `pershkrimi_kategoria` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategoria`
--

INSERT INTO `kategoria` (`kategoriaid`, `emri_kategoria`, `pershkrimi_kategoria`) VALUES
(1, 'PC', 'Lojrat PC'),
(2, 'PS4', 'Lojrat PS4'),
(3, 'PS5', 'Lojrat PS5'),
(4, 'XBOX', 'Lojrat XBOX'),
(5, 'General', 'Kategoria e pergjithshme');

-- --------------------------------------------------------

--
-- Table structure for table `komentet`
--

CREATE TABLE `komentet` (
  `komentiid` int(11) NOT NULL,
  `postimiid` int(11) NOT NULL,
  `anetariid` int(11) NOT NULL,
  `teksti_komentit` text NOT NULL,
  `data_komentit` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentet`
--

INSERT INTO `komentet` (`komentiid`, `postimiid`, `anetariid`, `teksti_komentit`, `data_komentit`) VALUES
(60, 37, 46, 'Nice post!', '2020-12-23 21:21:56'),
(61, 39, 50, 'Faleminderit shume!', '2020-12-23 21:56:53'),
(62, 39, 51, 'Vazhdoni keshtu, faleminderit!', '2020-12-23 21:57:33'),
(63, 38, 51, 'Le shume per te deshiruar...', '2020-12-23 21:57:51'),
(64, 36, 51, 'Shkruani ne shqip nese ka mundesi, faleminderit.', '2020-12-23 21:58:16'),
(65, 41, 46, 'Miresevjen, user2.', '2020-12-23 22:02:57'),
(66, 42, 46, 'Per shkak te sjelljes tende, llogaria juaj eshte pasivizuar.', '2020-12-23 22:10:28'),
(67, 36, 46, 'Postimi mjaft i mire, fillim i mbare.\r\nNese ka mundesi te postoni ne gjuhen shqipe, faleminderit.', '2020-12-23 23:02:28'),
(68, 42, 51, 'Sjellje mjaft e keqe, turp!!!', '2020-12-23 23:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `pelqimet`
--

CREATE TABLE `pelqimet` (
  `pelqimiid` int(11) NOT NULL,
  `anetariid` int(11) NOT NULL,
  `postimiid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelqimet`
--

INSERT INTO `pelqimet` (`pelqimiid`, `anetariid`, `postimiid`) VALUES
(95, 46, 36),
(96, 46, 38),
(98, 50, 37),
(99, 46, 39),
(100, 50, 39),
(101, 51, 39),
(102, 46, 41),
(103, 50, 42),
(104, 46, 42),
(105, 51, 36),
(106, 51, 42);

-- --------------------------------------------------------

--
-- Table structure for table `postimi`
--

CREATE TABLE `postimi` (
  `postimiid` int(11) NOT NULL,
  `anetariid` int(11) NOT NULL,
  `data_e_krijimit` datetime NOT NULL DEFAULT current_timestamp(),
  `teksti_postimit` text NOT NULL,
  `titulli_postimit` varchar(255) NOT NULL,
  `kategoriaid` int(11) NOT NULL,
  `shikime` bigint(20) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postimi`
--

INSERT INTO `postimi` (`postimiid`, `anetariid`, `data_e_krijimit`, `teksti_postimit`, `titulli_postimit`, `kategoriaid`, `shikime`) VALUES
(35, 46, '2020-12-23 21:02:35', 'I mean, thats part of the psychological deal we make with video games, right? We invest in the fiction that we are who we play. In this case, its V — the main character in CD Project Reds massively hyped, massively disappointing open-world pantsless-motorcycle-riding-simulator. V can be anyone. They are you, whoever you want to be. They are me, every minute that I play. And they are wearing that stupid jacket with its stupid slogan which I refuse to take off and which, eventually, will become symbolic to me of everything thats wrong with this game — everything sour and broken at the heart of it. I mean, thats part of the psychological deal we make with video games, right? We invest in the fiction that we are who we play. In this case, its V — the main character in CD Project Reds massively hyped, massively disappointing open-world pantsless-motorcycle-riding-simulator. V can be anyone. They are you, whoever you want to be. They are me, every minute that I play. And they are wearing that stupid jacket with its stupid slogan which I refuse to take off and which, eventually, will become symbolic to me of everything thats wrong with this game — everything sour and broken at the heart of it.I mean, thats part of the psychological deal we make with video games, right? We invest in the fiction that we are who we play. In this case, its V — the main character in CD Project Reds massively hyped, massively disappointing open-world pantsless-motorcycle-riding-simulator. V can be anyone.', 'postim2', 1, 2),
(36, 46, '2020-12-23 21:18:00', 'I mean, that\'s part of the psychological deal we make with video games, right? We invest in the fiction that we are who we play. In this case, it\'s V — the main character in CD Project Red\'s massively hyped, massively disappointing open-world pantsless-motorcycle-riding-simulator. V can be anyone. They are you, whoever you want to be. They are me, every minute that I play. And they are wearing that stupid jacket with its stupid slogan which I refuse to take off and which, eventually, will become symbolic to me of everything that\'s wrong with this game — everything sour and broken at the heart of it.\r\n\r\nI mean, that\'s part of the psychological deal we make with video games, right? We invest in the fiction that we are who we play. In this case, it\'s V — the main character in CD Project Red\'s massively hyped, massively disappointing open-world pantsless-motorcycle-riding-simulator. V can be anyone. They are you, whoever you want to be. They are me, every minute that I play. And they are wearing that stupid jacket with its stupid slogan which I refuse to take off and which, eventually, will become symbolic to me of everything that\'s wrong with this game — everything sour and broken at the heart of it.\r\n\r\nI mean, that\'s part of the psychological deal we make with video games, right? We invest in the fiction that we are who we play. In this case, it\'s V — the main character in CD Project Red\'s massively hyped, massively disappointing open-world pantsless-motorcycle-riding-simulator.', 'cyberpunk fixed', 1, 17),
(37, 46, '2020-12-23 21:19:59', '[ OPERATION BROKEN FANG ]\r\n– Adjusted first person arm models for Operation Broken Fang agents.\r\n– Adjusted end of match animations for Operation Broken Fang master agents.\r\n– Fixed a bug that could allow extra stars to be earned from missions. Going forward players will be correctly limited to receiving the total number of stars available from all unlocked cards.\r\n– Kick player vote is now disabled in Broken Fang Premier pick/ban arenas.\r\n– Fixed kill distance in missions UI to be correctly rounded for display.\r\n\r\n[ MISC ]\r\n– Added 2021 Service Medal to be awarded for outstanding service and achievement starting from January 1, 2021 GMT.\r\n– Donate weapons to teammates in need! Hold the buy menu donation key (CTRL by default) when purchasing a weapon to donate to teammates without dropping your primary weapon. You can change the “Buy Menu Donation Key” in settings.\r\n– Game settings now have a search box to quickly find and jump to any setting or key binding.\r\n– Zeus restrictions in Casual, Wingman, and Competitive modes are now the same as all other weapons.\r\n– Adjusted Retakes clip areas in Inferno, Mirage, Nuke, Train, and Vertigo.', 'CS:GO Update i ri', 1, 17),
(38, 50, '2020-12-23 21:43:16', 'Qfare mendoni per MOD e ri qe u lancua sot per GTA5?', 'GTA5 mod i ri', 2, 19),
(39, 46, '2020-12-23 21:56:17', 'Miresevini ne forumin me te ri, per komunitetin e lojtareve shqiptar.\r\nShpresojme qe te kaloni kohe sa me te mire ketu!', 'MIRESEVINI NE ALB GAMERS', 5, 22),
(41, 51, '2020-12-23 22:02:36', 'Ky eshte postim im i pare ne kete forum, shpresoj qe te kalojme mire se bashku.', 'Postimi im i pare', 5, 13),
(42, 50, '2020-12-23 22:09:57', '*Shan Shan Shan Shan*', 'Sharje', 5, 48);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anetari`
--
ALTER TABLE `anetari`
  ADD PRIMARY KEY (`anetariid`);

--
-- Indexes for table `dhoma_e_pritjes`
--
ALTER TABLE `dhoma_e_pritjes`
  ADD PRIMARY KEY (`ppid`),
  ADD KEY `kategoriaid` (`kategoriaid`),
  ADD KEY `dhoma_e_pritjes_ibfk_1` (`anetariid`);

--
-- Indexes for table `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`kategoriaid`);

--
-- Indexes for table `komentet`
--
ALTER TABLE `komentet`
  ADD PRIMARY KEY (`komentiid`),
  ADD KEY `komentet_ibfk_1` (`anetariid`),
  ADD KEY `komentet_ibfk_2` (`postimiid`);

--
-- Indexes for table `pelqimet`
--
ALTER TABLE `pelqimet`
  ADD PRIMARY KEY (`pelqimiid`),
  ADD KEY `pelqimet_ibfk_1` (`anetariid`),
  ADD KEY `pelqimet_ibfk_2` (`postimiid`);

--
-- Indexes for table `postimi`
--
ALTER TABLE `postimi`
  ADD PRIMARY KEY (`postimiid`),
  ADD KEY `postimi_ibfk_1` (`anetariid`),
  ADD KEY `postimi_ibfk_2` (`kategoriaid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anetari`
--
ALTER TABLE `anetari`
  MODIFY `anetariid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `dhoma_e_pritjes`
--
ALTER TABLE `dhoma_e_pritjes`
  MODIFY `ppid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `kategoriaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `komentet`
--
ALTER TABLE `komentet`
  MODIFY `komentiid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `pelqimet`
--
ALTER TABLE `pelqimet`
  MODIFY `pelqimiid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `postimi`
--
ALTER TABLE `postimi`
  MODIFY `postimiid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dhoma_e_pritjes`
--
ALTER TABLE `dhoma_e_pritjes`
  ADD CONSTRAINT `dhoma_e_pritjes_ibfk_1` FOREIGN KEY (`anetariid`) REFERENCES `anetari` (`anetariid`) ON DELETE CASCADE,
  ADD CONSTRAINT `dhoma_e_pritjes_ibfk_2` FOREIGN KEY (`kategoriaid`) REFERENCES `kategoria` (`kategoriaid`) ON DELETE CASCADE;

--
-- Constraints for table `komentet`
--
ALTER TABLE `komentet`
  ADD CONSTRAINT `komentet_ibfk_1` FOREIGN KEY (`anetariid`) REFERENCES `anetari` (`anetariid`) ON DELETE CASCADE,
  ADD CONSTRAINT `komentet_ibfk_2` FOREIGN KEY (`postimiid`) REFERENCES `postimi` (`postimiid`) ON DELETE CASCADE;

--
-- Constraints for table `pelqimet`
--
ALTER TABLE `pelqimet`
  ADD CONSTRAINT `pelqimet_ibfk_1` FOREIGN KEY (`anetariid`) REFERENCES `anetari` (`anetariid`) ON DELETE CASCADE,
  ADD CONSTRAINT `pelqimet_ibfk_2` FOREIGN KEY (`postimiid`) REFERENCES `postimi` (`postimiid`) ON DELETE CASCADE;

--
-- Constraints for table `postimi`
--
ALTER TABLE `postimi`
  ADD CONSTRAINT `postimi_ibfk_1` FOREIGN KEY (`anetariid`) REFERENCES `anetari` (`anetariid`) ON DELETE CASCADE,
  ADD CONSTRAINT `postimi_ibfk_2` FOREIGN KEY (`kategoriaid`) REFERENCES `kategoria` (`kategoriaid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
