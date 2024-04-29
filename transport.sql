-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 08, 2024 at 08:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transport`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `pic` varchar(225) NOT NULL,
  `position` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `name`, `email`, `password`, `pic`, `position`) VALUES
(1, 'Yan Naing Lin', 'yan@gmail.com', '12345Yan', 'boy3.jpg', 'admin'),
(2, 'Lin Let', 'll@gmail.com', '9999Linn', 'girl2.jpg', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `btickets`
--

CREATE TABLE `btickets` (
  `btid` varchar(20) NOT NULL,
  `numberofseats` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `seatno` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `screenshot` varchar(200) NOT NULL,
  `seen` varchar(5) DEFAULT NULL,
  `bpname` varchar(50) DEFAULT NULL,
  `bpphone` varchar(20) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `btime` time DEFAULT NULL,
  `bcost` int(11) DEFAULT NULL,
  `paymethod` varchar(20) DEFAULT NULL,
  `special` varchar(120) DEFAULT NULL,
  `message` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `btickets`
--

INSERT INTO `btickets` (`btid`, `numberofseats`, `pid`, `seatno`, `cid`, `status`, `screenshot`, `seen`, `bpname`, `bpphone`, `bdate`, `btime`, `bcost`, `paymethod`, `special`, `message`) VALUES
('202403040437311', 3, 30, 2, 6, 'approved', '1709523449_man.jpg', 'Yes', 'Mon', '0989288838', '2024-03-04', '04:37:31', 32000, 'KBZ', '', ''),
('202403040437312', 3, 30, 1, 6, 'approved', '1709523449_man.jpg', 'Yes', 'Mon', '0989288838', '2024-03-04', '04:37:31', 32000, 'KBZ', '', ''),
('202403040437313', 3, 30, 3, 6, 'approved', '1709523449_man.jpg', 'Yes', 'Mon', '0989288838', '2024-03-04', '04:37:31', 32000, 'KBZ', '', ''),
('202403040813301', 2, 65, 1, 7, 'approved', '1709536408_ss.jpg', 'Yes', 'Lin Let', '09766270791', '2024-03-04', '08:13:30', 32000, 'Wave-money', 'I have headache', ''),
('202403040813302', 2, 65, 2, 7, 'approved', '1709536408_ss.jpg', 'Yes', 'Lin Let', '09766270791', '2024-03-04', '08:13:30', 32000, 'Wave-money', 'I have headache', ''),
('202403041011301', 3, 35, 6, 1, 'approved', '1709543482_ss.jpg', 'Yes', 'Lin', '09798884886', '2024-03-04', '10:11:30', 32000, 'KBZ', 'headache', ''),
('202403041011302', 3, 35, 5, 1, 'approved', '1709543482_ss.jpg', 'Yes', 'Lin', '09798884886', '2024-03-04', '10:11:30', 32000, 'KBZ', 'headache', ''),
('202403041011303', 3, 35, 7, 1, 'approved', '1709543482_ss.jpg', 'Yes', 'Lin', '09798884886', '2024-03-04', '10:11:30', 32000, 'KBZ', 'headache', '');

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `busno` varchar(20) NOT NULL,
  `oid` int(11) DEFAULT NULL,
  `maxpassenger` int(11) NOT NULL,
  `bustype` varchar(30) DEFAULT NULL,
  `buscolor` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`busno`, `oid`, `maxpassenger`, `bustype`, `buscolor`) VALUES
('AA-1111', 1, 40, 'Scania', 'White'),
('AA-2222', 2, 44, 'Scania', 'Grey'),
('AA-3333', 1, 44, 'Scania', 'Silver'),
('BB-1111', 1, 40, 'Scania', 'Black'),
('BB-2222', 2, 36, 'Scania', 'Reddish Brown'),
('BB-3333', 2, 40, 'Scania', 'Grey'),
('CC-1111', 3, 40, 'Scania', 'black'),
('CC-2222', 3, 44, 'Scania', 'silver-grey'),
('DD-1111', 4, 40, 'Scania', 'Black'),
('DD-2222', 4, 44, 'Scania', 'Black'),
('EE-1111', 5, 40, 'Scania', 'White'),
('EE-2222', 5, 44, 'Scania', 'White'),
('FF-1111', 6, 40, 'Scania', 'Black'),
('FF-2222', 6, 40, 'Scania', 'Black'),
('GG-1111', 7, 40, 'Scania', 'White'),
('GG-2222', 7, 44, 'Scania', 'Grey'),
('HH-1111', 8, 40, 'Scania', 'Silver'),
('HH-2222', 8, 44, 'Scania', 'Silver'),
('JJ-1111', 9, 40, 'Toyota', 'Black');

-- --------------------------------------------------------

--
-- Table structure for table `cargate`
--

CREATE TABLE `cargate` (
  `cgid` int(11) NOT NULL,
  `town` varchar(50) NOT NULL,
  `cgaddress` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cargate`
--

INSERT INTO `cargate` (`cgid`, `town`, `cgaddress`) VALUES
(1, 'Yangon(Aung Mingalar)', 'Aung Mingalar'),
(2, 'Taunggyi', 'Taunggyi Cargate'),
(3, 'Mandalay', 'Mandalay Cargate'),
(4, 'Pyay', 'Pyay Cargate'),
(5, 'Yangon(DagonAyeyar)', 'Yangon(DagonAyeyar)'),
(6, 'Aunglan', 'Aunglan Cargate'),
(7, 'Bagan', 'Bagan Cargate'),
(8, 'Bago', 'Bago Cargate'),
(9, 'Dawei', 'Dawei Cargate'),
(10, 'Hakha', 'Hakha Cargate'),
(11, 'HeHoe', 'HeHoe Cargate'),
(12, 'Hinthada', 'Hinthada Cargate'),
(13, 'Hpa-An', 'Hpa-An Cargate'),
(14, 'Kalaw', 'Kalaw Cargate'),
(15, 'Kawthaung', 'Kawthaung Cargate'),
(16, 'Keng Tung', 'Keng Tung Cargate'),
(17, 'Kyaikkami', 'Kyaikkami Cargate'),
(18, 'Kyaiktiyo', 'Kyaiktiyo Cargate'),
(19, 'Kyaukse', 'Kyaukse Cargate'),
(20, 'Lashio', 'Lashio Cargate'),
(21, 'Loikaw', 'Loikaw Cargate'),
(22, 'Magway', 'Magway Cargate'),
(23, 'Mawlamyine', 'Mawlamyine Cargate'),
(24, 'Meiktila', 'Meiktila Cargate'),
(25, 'Minbu', 'Minbu Cargate'),
(26, 'Mogok', 'Mogok Cargate'),
(27, 'Muse', 'Muse Cargate'),
(28, 'Mudon', 'Mudon Cargate'),
(29, 'Myaungmya', 'Myaungmya Cargate'),
(30, 'Myawaddy', 'Myawaddy Cargate'),
(31, 'Myitkyina', 'Myitkyina Cargate'),
(32, 'Natmauk', 'Natmauk Cargate'),
(33, 'Naypyitaw(Bowga)', 'Naypyitaw(Bowga)'),
(34, 'Naypyitaw(MyoMa)', 'Naypyitaw(MyoMa)'),
(35, 'Naypyitaw(Thapyaygone))', 'Naypyitaw(Thapyaygone)'),
(36, 'Chaung Thar', 'Chaung Thar Cargate'),
(37, 'Ngapali', 'Ngapali Cargate'),
(38, 'Ngwe Saung', 'Ngwe Saung Cargate'),
(39, 'Pathein', 'Pathein Cargate'),
(40, 'Pyay', 'Pyay Cargate'),
(41, 'Pyin Oo Lwin', 'Pyin Oo Lwin Cargate'),
(42, 'Sagaing', 'Sagaing Cargate'),
(43, 'Mandalay(Zayat Kwin)', 'Mandalay(Zayat Kwin)'),
(44, 'Sittwe', 'Sittwe Cargate'),
(45, 'Tachileik', 'Tachileik Cargate');

-- --------------------------------------------------------

--
-- Table structure for table `cargo_branch`
--

CREATE TABLE `cargo_branch` (
  `branch_name` varchar(50) NOT NULL,
  `division` varchar(30) NOT NULL,
  `branch_phone` varchar(20) DEFAULT NULL,
  `branch_address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cargo_branch`
--

INSERT INTO `cargo_branch` (`branch_name`, `division`, `branch_phone`, `branch_address`) VALUES
(' Hsipaw', 'Shan', NULL, NULL),
('Amarapura', 'Mandalay', NULL, NULL),
('Aungpan', 'Shan', NULL, NULL),
('Bago', 'Bago', NULL, NULL),
('Bhamo', 'Kachin', NULL, NULL),
('Bogale', 'Ayeyarwady', NULL, NULL),
('Chauk', 'Magway', NULL, NULL),
('Chaung-U', 'Sagaing', NULL, NULL),
('Daik-U', 'Bago', NULL, NULL),
('Danubyu', 'Ayeyarwady', NULL, NULL),
('Dawei', 'Tanintharyi', NULL, NULL),
('Gyobingauk', 'Bago', NULL, NULL),
('Hinthada', 'Ayeyarwady', NULL, NULL),
('Hledan', 'Yangon', NULL, NULL),
('Hlegu', 'Yangon', NULL, NULL),
('Hmawbi', 'Yangon', NULL, NULL),
('Homalin', 'Sagaing', NULL, NULL),
('Hopin', 'Kachin', NULL, NULL),
('Hopong', 'Shan', NULL, NULL),
('Hpa-An', 'Karen', NULL, NULL),
('Hpakant', 'Kachin', NULL, NULL),
('Hpayarthonesu', 'Karen', NULL, NULL),
('Kalaw', 'Shan', NULL, NULL),
('Kale', 'Sagaing', NULL, NULL),
('Kanbalu', 'Sagaing', NULL, NULL),
('Katha', 'Sagaing Region', NULL, NULL),
('Kawkareik', 'Karen Region', NULL, NULL),
('Kawlin', 'Sagaing Region', NULL, NULL),
('Kawthong', 'Tanintharyi Region', NULL, NULL),
('Kayan', 'Yangon Region', NULL, NULL),
('Kengtung', 'Shan Region', NULL, NULL),
('Kutkai', 'Shan Region', NULL, NULL),
('Kyaiklat', 'Ayeyarwady Region', NULL, NULL),
('Kyaikto', 'Mon Region', NULL, NULL),
('Kyaukme', 'Shan Region', NULL, NULL),
('Kyaukpadaung', 'Mandalay Region', NULL, NULL),
('Kyaukpyu', 'Rakhine Region', NULL, NULL),
('Kyaukse', 'Mandalay Region', NULL, NULL),
('Kyauktaga', 'Bago Region', NULL, NULL),
('Kyauktann', 'Yangon Region', NULL, NULL),
('Kyonpyaw', 'Ayeyarwady Region', NULL, NULL),
('Labutta', 'Ayeyarwady Region', NULL, NULL),
('Lashio', 'Shan Region', NULL, NULL),
('Latha', 'Yangon', NULL, NULL),
('Laukkaing', 'Shan Region', NULL, NULL),
('Lawksawk', 'Shan Region', NULL, NULL),
('Letpadan', 'Bago Region', NULL, NULL),
('Loikaw', 'Kayah Region', NULL, NULL),
('Madaya', 'Mandalay Region', NULL, NULL),
('Magway', 'Magway Region', NULL, NULL),
('Mandalay', 'Mandalay', NULL, NULL),
('Maubin', 'Ayeyarwady Region', NULL, NULL),
('Mawlamyine', 'Mon Region', NULL, NULL),
('Mawlamyinegyun', 'Ayeyarwady Region', NULL, NULL),
('Meiktila', 'Mandalay Region', NULL, NULL),
('Minbu', 'Magway Region', NULL, NULL),
('Minbya', 'Rakhine Region', NULL, NULL),
('Mogaung', 'Kachin Region', NULL, NULL),
('Mogok', 'Mandalay Region', NULL, NULL),
('Mohnyin', 'Kachin Region', NULL, NULL),
('Mongla', 'Shan Region', NULL, NULL),
('Monywa', 'Sagaing Region', NULL, NULL),
('Mudon', 'Mon Region', NULL, NULL),
('Muse', 'Shan Region', NULL, NULL),
('Myanaung', 'Ayeyarwady Region', NULL, NULL),
('Myauk-U', 'Rakhine Region', NULL, NULL),
('Myaungmya', 'Ayeyarwady Region', NULL, NULL),
('Myawaddy', 'Karen Region', NULL, NULL),
('Myede(Aung-Lan)', 'Magway Region', NULL, NULL),
('Myeik', 'Tanintharyi Region', NULL, NULL),
('Myingyan', 'Mandalay Region', NULL, NULL),
('Myitkyina', 'Kachin Region', NULL, NULL),
('Nankhan', 'Shan Region', NULL, NULL),
('Nansang', 'Shan Region', NULL, NULL),
('Naypyitaw', 'Naypyitaw Region', NULL, NULL),
('Nyaung-U', 'Mandalay Region', NULL, NULL),
('Nyaungdon', 'Ayeyarwady Region', NULL, NULL),
('Nyaunglebin', 'Bago Region', NULL, NULL),
('Pakokku', 'Magway Region', NULL, NULL),
('Panglong', 'Shan Region', NULL, NULL),
('Pantanaw', 'Ayeyarwady Region', NULL, NULL),
('Pathein', 'Ayeyarwady Region', NULL, NULL),
('Paung', 'Mon Region', NULL, NULL),
('Paungde', 'Bago Region', NULL, NULL),
('Phyu', 'Bago Region', NULL, NULL),
('Pyapon', 'Ayeyarwady Region', NULL, NULL),
('Pyawbwe', 'Mandalay Region', NULL, NULL),
('Pyay', 'Bago Region', NULL, NULL),
('Pyin Oo Lwin', 'Mandalay', NULL, NULL),
('Sagaing', 'Sagaing Region', NULL, NULL),
('Shwebo', 'Sagaing Region', NULL, NULL),
('Shwegyin', 'Bago Region', NULL, NULL),
('Sittwe', 'Rakhine Region', NULL, NULL),
('Tachileik', 'Shan Region', NULL, NULL),
('Tahton', 'Mon', NULL, NULL),
('Taikkyi', 'Yangon Region', NULL, NULL),
('Tamu', 'Sagaing Region', NULL, NULL),
('Tanai', 'Kachin Region', NULL, NULL),
('Tangyan', 'Shan Region', NULL, NULL),
('Taungdwingyi', 'Magway Region', NULL, NULL),
('Taunggyi', 'Shan Region', NULL, NULL),
('Taungoo', 'Bago Region', NULL, NULL),
('Thanbyuzayat', 'Mon Region', NULL, NULL),
('Thanlyin', 'Yangon Region', NULL, NULL),
('Thaton', 'Mon Region', NULL, NULL),
('Thayarwady', 'Bago Region', NULL, NULL),
('Thayet', 'Magway Region', NULL, NULL),
('Thazi', 'Mandalay Region', NULL, NULL),
('Thongwa', 'Yangon Region', NULL, NULL),
('Toungup', 'Rakhine Region', NULL, NULL),
('Twantay', 'Yangon Region', NULL, NULL),
('Waingmaw', 'Kachin Region', NULL, NULL),
('Wakema', 'Ayeyarwady Region', NULL, NULL),
('Waw', 'Bago Region', NULL, NULL),
('Wundwin', 'Mandalay Region', NULL, NULL),
('Yamethin', 'Mandalay', NULL, NULL),
('Ye', 'Mon Region', NULL, NULL),
('Ye-U', 'Sagaing Region', NULL, NULL),
('Yedashe', 'Bago Region', NULL, NULL),
('Yenangyaung', 'Magway Region', NULL, NULL),
('Yesagyo', 'Magway Region', NULL, NULL),
('Zalun', 'Ayeyarwady Region', NULL, NULL),
('Zinkyaik', 'Mon', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cargo_plan`
--

CREATE TABLE `cargo_plan` (
  `cpid` int(11) NOT NULL,
  `crid` int(11) NOT NULL,
  `truckno` varchar(20) NOT NULL,
  `cpdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cargo_plan`
--

INSERT INTO `cargo_plan` (`cpid`, `crid`, `truckno`, `cpdate`) VALUES
(1, 1, 'AB-1111', '2024-03-05'),
(2, 2, 'AB-2222', '2024-03-05'),
(3, 3, 'AB-3333', '2024-03-05'),
(4, 4, 'AA-4444', '2024-03-05'),
(5, 5, 'AA-5555', '2024-03-06'),
(6, 6, 'AA-6666', '2024-03-06'),
(7, 7, 'AA-7777', '2024-03-07'),
(8, 8, 'AA-8888', '2024-03-07'),
(9, 9, 'AA-9999', '2024-03-08'),
(10, 10, 'AB-1111', '2024-03-08'),
(11, 11, 'AB-2222', '2024-03-09'),
(12, 12, 'AB-3333', '2024-03-09'),
(13, 13, 'AB-4444', '2024-03-10'),
(14, 14, 'AB-5555', '2024-03-10'),
(15, 15, 'AB-6666', '2024-03-11'),
(16, 16, 'AB-7777', '2024-03-11'),
(17, 17, 'AB-8888', '2024-03-12'),
(18, 18, 'AB-9999', '2024-03-12'),
(19, 19, 'AC-1111', '2024-03-13'),
(20, 20, 'AC-2222', '2024-03-13'),
(21, 21, 'AC-3333', '2024-03-14'),
(22, 22, 'AC-4444', '2024-03-14'),
(23, 23, 'AC-5555', '2024-03-15'),
(24, 24, 'AC-6666', '2024-03-15'),
(25, 25, 'AC-7777', '2024-03-16'),
(26, 26, 'AC-8888', '2024-03-16'),
(27, 27, 'AC-9999', '2024-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `cargo_route`
--

CREATE TABLE `cargo_route` (
  `crid` int(11) NOT NULL,
  `cargo_src` varchar(50) NOT NULL,
  `cargo_dest` varchar(50) NOT NULL,
  `cargo_cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cargo_route`
--

INSERT INTO `cargo_route` (`crid`, `cargo_src`, `cargo_dest`, `cargo_cost`) VALUES
(1, 'Hledan', 'Mandalay', 500),
(2, 'Hledan', 'Pyin Oo Lwin', 600),
(3, 'Hledan', 'Yamethin', 400),
(4, 'Mandalay', 'Hledan', 500),
(5, 'Mandalay', 'Latha', 500),
(6, ' Hsipaw', 'Amarapura', 700),
(7, 'Amarapura', 'Bago', 600),
(8, 'Bago', 'Bhamo', 100),
(9, 'Bhamo', 'Bogale', 1000),
(10, 'Bogale', 'Chauk', 900),
(11, 'Chauk', 'Chaung-U', 500),
(12, 'Chaung-U', 'Daik-U', 1000),
(13, 'Daik-U', 'Danubyu', 400),
(14, 'Danubyu', 'Dawei', 900),
(15, 'Dawei', 'Gyobingauk', 600),
(16, 'Gyobingauk', 'Hinthada', 400),
(17, 'Hinthada', 'Hledan', 300),
(18, 'Hledan', 'Hlegu', 200),
(19, 'Hlegu', 'Hmawbi', 200),
(20, 'Hmawbi', 'Homalin', 1200),
(21, 'Homalin', 'Hopin', 500),
(22, 'Hopin', 'Hopong', 200),
(23, 'Hopong', 'Hpa-An', 700),
(24, 'Hpa-An', 'Hpakant', 800),
(25, 'Hpakant', 'Hpayarthonesu', 800),
(26, 'Hpayarthonesu', 'Kalaw', 700),
(27, 'Kalaw', 'Kale', 400),
(28, 'Kale', 'Kanbalu', 500),
(29, 'Kanbalu', 'Katha', 400),
(30, 'Zalun', 'Yesagyo', 300),
(31, 'Yesagyo', 'Yenangyaung', 500),
(32, 'Yenangyaung', 'Yedashe', 600),
(33, 'Yedashe', 'Ye-U', 700),
(34, 'Ye-U', 'Ye', 500),
(35, 'Ye', 'Yamethin', 800),
(36, 'Yamethin', 'Wundwin', 400),
(37, 'Wundwin', 'Waw', 200),
(38, 'Waw', 'Wakema', 400),
(39, 'Wakema', 'Waingmaw', 900),
(40, 'Waingmaw', 'Twantay', 600),
(41, 'Twantay', 'Toungup', 200),
(42, 'Toungup', 'Thongwa', 300),
(43, 'Thongwa', 'Thazi', 500),
(44, 'Thazi', 'Thayet', 600),
(45, 'Thayet', 'Thayarwady', 400),
(46, 'Thayarwady', 'Thaton', 400),
(47, 'Thaton', 'Thanlyin', 200),
(48, 'Thanlyin', 'Thanbyuzayat', 400),
(49, 'Thanbyuzayat', 'Taungoo', 200),
(50, 'Taungoo', 'Taunggyi', 700),
(51, 'Taunggyi', 'Taungdwingyi', 300),
(52, 'Taungdwingyi', 'Tangyan', 300),
(53, 'Tangyan', 'Tanai', 600),
(54, 'Tanai', 'Tamu', 500),
(55, 'Tamu', 'Taikkyi', 600),
(56, 'Taikkyi', 'Tachileik', 700),
(57, 'Tachileik', 'Sittwe', 900),
(58, 'Sittwe', 'Shwegyin', 1200),
(59, 'Shwegyin', 'Shwebo', 800),
(60, 'Shwebo', 'Sagaing', 200),
(61, 'Sagaing', 'Pyin Oo Lwin', 400),
(62, 'Pyin Oo Lwin', 'Pyay', 400),
(63, 'Pyay', 'Pyawbwe', 300),
(64, 'Pyawbwe', 'Pyapon', 200),
(65, 'Pyapon', 'Phyu', 300),
(66, 'Phyu', 'Paungde', 400),
(67, 'Paungde', 'Paung', 300),
(68, 'Paung', 'Pathein', 500),
(69, 'Pathein', 'Pantanaw', 100),
(70, 'Pantanaw', 'Panglong', 600),
(71, 'Panglong', 'Pakokku', 300),
(72, 'Pakokku', 'Nyaunglebin', 500),
(73, 'Nyaunglebin', 'Nyaungdon', 300),
(74, 'Nyaungdon', 'Nyaung-U', 600),
(75, 'Nyaung-U', 'Naypyitaw', 400),
(76, 'Naypyitaw', 'Nansang', 500),
(77, 'Nansang', 'Nankhan', 300),
(78, 'Nankhan', 'Myitkyina', 400),
(79, 'Myitkyina', 'Myingyan', 500),
(80, 'Myingyan', 'Myeik', 1100),
(81, 'Myeik', 'Myede(Aung-Lan)', 1200),
(82, 'Myede(Aung-Lan)', 'Myawaddy', 600),
(83, 'Myawaddy', 'Myaungmya', 500),
(84, 'Myaungmya', 'Myauk-U', 700),
(85, 'Myauk-U', 'Myanaung', 1300),
(86, 'Myanaung', 'Muse', 700),
(87, 'Muse', 'Mudon', 700),
(88, 'Mudon', 'Monywa', 900),
(89, 'Monywa', 'Mongla', 600),
(90, 'Mongla', 'Mohnyin', 400),
(91, 'Mohnyin', 'Mogok', 400),
(92, 'Mogok', 'Mogaung', 400),
(93, 'Mogaung', 'Minbya', 300),
(94, 'Minbya', 'Minbu', 300),
(95, 'Minbu', 'Meiktila', 300),
(96, 'Meiktila', 'Mawlamyinegyun', 800),
(97, 'Mawlamyinegyun', 'Mawlamyine', 400),
(98, 'Mawlamyine', 'Maubin', 500),
(99, 'Maubin', 'Mandalay', 700),
(100, 'Mandalay', 'Magway', 300),
(101, 'Magway', 'Madaya', 300),
(102, 'Madaya', 'Loikaw', 600),
(103, 'Loikaw', 'Letpadan', 800),
(104, 'Letpadan', 'Lawksawk', 600),
(105, 'Lawksawk', 'Laukkaing', 300),
(106, 'Laukkaing', 'Latha', 1000),
(107, 'Latha', 'Lashio', 900),
(108, 'Lashio', 'Labutta', 1000),
(109, 'Labutta', 'Kyonpyaw', 400),
(110, 'Kyonpyaw', 'Kyauktann', 300),
(111, 'Kyauktann', 'Kyauktaga', 300),
(112, 'Kyauktaga', 'Kyaukse', 800),
(113, 'Kyaukse', 'Kyaukpyu', 1000),
(114, 'Kyaukpyu', 'Kyaukpadaung', 1200),
(115, 'Kyaukpadaung', 'Kyaukme', 500),
(116, 'Kyaukme', 'Kyaikto', 700),
(117, 'Kyaikto', 'Kyaiklat', 400),
(118, 'Kyaiklat', 'Kutkai', 700),
(119, 'Kutkai', 'Kengtung', 400),
(120, 'Kengtung', 'Kayan', 700),
(121, 'Kayan', 'Kawthong', 900),
(122, 'Kawthong', 'Kawlin', 1000),
(123, 'Kawlin', 'Kawkareik', 300),
(124, 'Kawkareik', 'Katha', 700);

-- --------------------------------------------------------

--
-- Table structure for table `cargo_truck`
--

CREATE TABLE `cargo_truck` (
  `truckno` varchar(20) NOT NULL,
  `max_weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cargo_truck`
--

INSERT INTO `cargo_truck` (`truckno`, `max_weight`) VALUES
('AA-1111', 10000),
('AA-2222', 10000),
('AA-3333', 10000),
('AA-4444', 10000),
('AA-5555', 10000),
('AA-6666', 10000),
('AA-7777', 10000),
('AA-8888', 10000),
('AA-9999', 10000),
('AB-1111', 10000),
('AB-2222', 10000),
('AB-3333', 10000),
('AB-4444', 10000),
('AB-5555', 10000),
('AB-6666', 10000),
('AB-7777', 10000),
('AB-8888', 10000),
('AB-9999', 10000),
('AC-1111', 10000),
('AC-2222', 10000),
('AC-3333', 10000),
('AC-4444', 10000),
('AC-5555', 10000),
('AC-6666', 10000),
('AC-7777', 10000),
('AC-8888', 10000),
('AC-9999', 10000),
('AD-1111', 10000),
('AD-2222', 10000),
('AD-3333', 10000),
('AD-4444', 10000),
('AD-5555', 10000),
('AD-6666', 10000),
('AD-7777', 10000),
('AD-8888', 10000),
('AD-9999', 10000),
('AE-1111', 10000),
('AE-2222', 10000),
('AE-3333', 10000),
('AE-4444', 10000),
('AE-5555', 10000),
('AE-6666', 10000),
('AE-7777', 10000),
('AE-8888', 10000),
('AE-9999', 10000),
('AF-1111', 10000),
('AF-2222', 10000),
('AF-3333', 10000),
('AF-4444', 10000),
('AF-5555', 10000),
('AF-6666', 10000),
('AF-7777', 10000),
('AF-8888', 10000),
('AF-9999', 10000),
('AG-1111', 10000),
('AG-2222', 10000),
('AG-3333', 10000),
('AG-4444', 10000),
('AG-5555', 10000),
('AG-6666', 10000),
('AG-7777', 10000),
('AG-8888', 10000),
('AG-9999', 10000),
('AH-1111', 10000),
('AH-2222', 10000),
('AH-3333', 10000),
('AH-4444', 10000),
('AH-5555', 10000),
('AH-6666', 10000),
('AH-7777', 10000),
('AH-8888', 10000),
('AH-9999', 10000),
('AI-1111', 10000),
('AI-2222', 10000),
('AI-3333', 10000),
('AI-4444', 10000),
('AI-5555', 10000),
('AI-6666', 10000),
('AI-7777', 10000),
('AI-8888', 10000),
('AI-9999', 10000),
('AJ-1111', 10000),
('AJ-2222', 10000),
('AJ-3333', 10000),
('AJ-4444', 10000),
('AJ-5555', 10000),
('AJ-6666', 10000),
('AJ-7777', 10000),
('AJ-8888', 10000),
('AJ-9999', 10000),
('AK-1111', 10000),
('AK-2222', 10000),
('AK-3333', 10000),
('AK-4444', 10000),
('AK-5555', 10000),
('AK-6666', 10000),
('AK-7777', 10000),
('AK-8888', 10000),
('AK-9999', 10000),
('AL-1111', 10000),
('AL-2222', 10000),
('AL-3333', 10000),
('AL-4444', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `cost`
--

CREATE TABLE `cost` (
  `costid` int(11) NOT NULL,
  `rid` int(11) DEFAULT NULL,
  `oid` int(11) DEFAULT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cost`
--

INSERT INTO `cost` (`costid`, `rid`, `oid`, `cost`) VALUES
(1, 1, 1, 35000),
(2, 4, 1, 20000),
(3, 2, 2, 23000),
(4, 1, 2, 32000),
(5, 3, 1, 35000),
(6, 6, 1, 23000),
(7, 3, 4, 25000),
(8, 6, 5, 21000),
(9, 1, 5, 32000),
(10, 1, 8, 35000),
(11, 1, 7, 31000),
(12, 2, 4, 22000),
(13, 6, 4, 25000),
(14, 6, 7, 23000),
(15, 27, 1, 27000),
(16, 27, 4, 33000),
(17, 27, 6, 25000),
(18, 22, 1, 24000),
(19, 22, 2, 22000),
(20, 23, 2, 22000),
(21, 24, 2, 22000),
(22, 23, 3, 29000),
(23, 23, 7, 29000),
(24, 24, 8, 22000),
(25, 25, 1, 15000),
(26, 25, 6, 17000),
(27, 25, 5, 17000),
(28, 25, 3, 15000),
(29, 19, 1, 23000),
(30, 19, 5, 23000),
(31, 21, 6, 50000),
(32, 21, 8, 52000),
(33, 29, 3, 27000),
(34, 29, 7, 25000),
(35, 13, 7, 35000),
(36, 13, 6, 30000),
(37, 13, 1, 32000),
(38, 40, 4, 25000),
(39, 44, 5, 17000),
(40, 44, 6, 17000),
(41, 42, 3, 29000),
(42, 41, 2, 29000),
(43, 43, 7, 29000),
(44, 28, 5, 32000),
(45, 28, 4, 35000),
(46, 4, 8, 23000),
(47, 40, 1, 21000),
(48, 39, 2, 20000),
(49, 34, 7, 21000),
(50, 35, 1, 32000),
(51, 35, 2, 33000),
(52, 35, 3, 33000),
(53, 35, 4, 35000),
(54, 33, 1, 23000),
(55, 33, 2, 22000),
(56, 33, 8, 22000),
(57, 34, 1, 25000),
(58, 34, 2, 20000),
(59, 34, 3, 26000),
(60, 34, 8, 22000),
(61, 39, 7, 16000),
(62, 39, 6, 17000),
(63, 39, 1, 19000),
(64, 42, 1, 24000),
(65, 42, 4, 22000),
(66, 42, 2, 24000),
(67, 42, 8, 18000),
(68, 45, 5, 15000),
(69, 45, 4, 17000),
(70, 46, 1, 20000),
(71, 46, 8, 19000),
(72, 47, 1, 24000),
(73, 48, 1, 25000),
(74, 48, 2, 23000),
(75, 1, 9, 35000);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `photo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cid`, `name`, `email`, `password`, `photo`) VALUES
(1, 'mg mg', 'mgmg123@gmail.com', 'mm123MM', 'images.png'),
(2, 'aye aye', 'ayeaye123@gmail.com', 'aa123AA', '6-Girl-Boy-Avatars (3).jpg'),
(3, 'hla hla', 'hlahla123@gmail.com', 'hh123HH', 'download.jpg'),
(4, 'Lin', 'lin@gmail.com', 'Llw@16542', '7de227b5c1ba542afd4e0b1c8c1d9edf.jpg'),
(5, 'May', 'may@gmail.com', '123May123', 'girl2.jpg'),
(6, 'mon mon', 'mon@gmail.com', 'Mon12345', 'girl3.jpg'),
(7, 'LLSYK', 'llsyk@gmail.com', 'Llsyk123', 'df_user.png');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `feedback` varchar(500) DEFAULT NULL,
  `ftime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fid`, `cid`, `feedback`, `ftime`) VALUES
(1, 1, 'Thank you for the memorable journey with this agency.', '2024-02-25 10:27:23'),
(2, 2, 'Good service', '2024-03-01 16:36:05'),
(3, 3, 'Nice service and friendly website.', '2024-03-01 16:36:21'),
(4, 3, 'Safety and fast cargo service.', '2024-03-02 18:54:47'),
(7, 6, 'Hello', '2024-03-04 02:50:47'),
(8, 1, 'This service is usable.', '2024-03-04 03:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `get_cargo_service`
--

CREATE TABLE `get_cargo_service` (
  `gid` varchar(30) NOT NULL,
  `crid` int(11) DEFAULT NULL,
  `cpdate` date NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `totalweight` int(11) NOT NULL,
  `categories` varchar(200) DEFAULT NULL,
  `gdate` date DEFAULT NULL,
  `gtime` time DEFAULT NULL,
  `totalcost` int(11) DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL,
  `sname` varchar(50) DEFAULT NULL,
  `semail` varchar(100) DEFAULT NULL,
  `stele` varchar(20) DEFAULT NULL,
  `rname` varchar(50) DEFAULT NULL,
  `remail` varchar(100) DEFAULT NULL,
  `rtele` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `screenshot` varchar(200) NOT NULL,
  `seen` varchar(5) DEFAULT NULL,
  `paymethod` varchar(20) DEFAULT NULL,
  `message` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `get_cargo_service`
--

INSERT INTO `get_cargo_service` (`gid`, `crid`, `cpdate`, `cid`, `totalweight`, `categories`, `gdate`, `gtime`, `totalcost`, `note`, `sname`, `semail`, `stele`, `rname`, `remail`, `rtele`, `status`, `screenshot`, `seen`, `paymethod`, `message`) VALUES
('g20240303184332', 2, '2024-03-04', 5, 5, 'Clothes, Goods', '2024-03-03', '18:43:32', 3000, '', 'May', 'may@gmail.com', '09782362783', 'LLSYK', 'll@gmail.com', '09265127383', 'disapproved', '1709487809_girl2.jpg', 'No', 'Wave-money', 'not enough money'),
('g20240304074342', 2, '2024-03-05', 6, 3, 'Fragile Items', '2024-03-04', '07:43:42', 1800, '', 'Lin', 'lin@gmail.com', '09785764536', 'Lett', 'lett@gmail.com', '09789098756', 'approved', '1709534619_ss.jpg', 'Yes', 'Wave-money', ''),
('g20240304082308', 2, '2024-03-05', 7, 5, 'Fragile Items, Clothes, Goods', '2024-03-04', '08:23:08', 3000, 'Take Care', 'Yan', 'ynl123@gmail.com', '09898765432', 'MgMg', 'mm123@gmail.com', '09976544448', 'disapproved', '1709536987_images.png', 'Yes', 'KBZ', 'Uploaded screenshot is invalid'),
('g20240304085159', 1, '2024-03-05', 1, 10, 'Dry Food, Fragile Items, Clothes', '2024-03-04', '08:51:59', 5000, 'Take Care!!', 'Aung Aung', 'aung123@gmail.com', '0912345667', 'Mg Mg', 'mg123@gmail.com', '0913575437', 'disapproved', '1709538716_photo_2024-02-29_22-51-34.jpg', 'Yes', 'Wave-money', 'uploaded screenshot is invalid.'),
('g20240304101532', 1, '2024-03-05', 1, 5, 'Dry Food', '2024-03-04', '10:15:32', 2500, 'Take Care!!', 'Aung Aung', 'aung123@gmail.com', '0912468570', 'Kyaw Kyaw', 'kyaw123@gmail.com', '0912357435', 'disapproved', '1709543730_images.png', 'Yes', 'Wave-money', 'uploaded screenshot is invalid.');

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `oid` int(11) NOT NULL,
  `oname` varchar(50) NOT NULL,
  `oemail` varchar(100) NOT NULL,
  `ophone` varchar(20) NOT NULL,
  `olocation` varchar(50) DEFAULT NULL,
  `ophoto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`oid`, `oname`, `oemail`, `ophone`, `olocation`, `ophoto`) VALUES
(1, 'Myat Mandalar Htun', 'myatmandalar123@gmail.com', '09111111', 'Yangon', 'MMDT.png'),
(2, 'Mandalar Min', 'mandalarmin123@gmail.com', '09222222', 'Mandalay', 'mandalarmin.png'),
(3, 'JJ', 'jj@gmail.com', '09783523465', 'Yangon', 'jj.png'),
(4, 'Elite', 'elite@gmail.com', '0988898392', 'yangon', 'elite.png'),
(5, 'Shwe Sin Sat Kyar ', 'shwesin@gmail.com', '09635425162', 'mandalay', 'shwesin.png'),
(6, 'Khaing Manalay', 'kmdy@gmail.com', '09453672541', 'mandalay', 'kmdy.png'),
(7, 'Shwe Taung Yoo', 'styoo@gmail.com', '09527182781', 'Yangon', 'STY.png'),
(8, 'Shwe Mandalar', 'shweMdy@gmail.com', '0929384924', 'mandalay', 'SMDL.png'),
(9, 'JJ1', 'jj123@gmail.com', '09766270791', 'Yangon', 'images.png');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `pid` int(11) NOT NULL,
  `rid` int(11) DEFAULT NULL,
  `busno` varchar(20) DEFAULT NULL,
  `ddate` date DEFAULT NULL,
  `dtime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`pid`, `rid`, `busno`, `ddate`, `dtime`) VALUES
(5, 1, 'AA-1111', '2024-03-06', '09:00:00'),
(1, 1, 'AA-1111', '2024-03-09', '09:00:00'),
(84, 1, 'AA-1111', '2024-03-09', '13:00:00'),
(4, 1, 'AA-2222', '2024-03-05', '08:30:00'),
(63, 1, 'AA-2222', '2024-03-06', '17:00:00'),
(41, 1, 'AA-2222', '2024-03-08', '17:00:00'),
(82, 1, 'AA-2222', '2024-03-09', '17:00:00'),
(58, 1, 'BB-1111', '2024-03-06', '13:00:00'),
(36, 1, 'BB-1111', '2024-03-08', '13:00:00'),
(55, 1, 'BB-2222', '2024-03-06', '09:00:00'),
(62, 1, 'BB-2222', '2024-03-06', '17:00:00'),
(33, 1, 'BB-2222', '2024-03-08', '09:00:00'),
(40, 1, 'BB-2222', '2024-03-08', '17:00:00'),
(6, 1, 'CC-2222', '2024-03-07', '09:00:00'),
(57, 1, 'EE-1111', '2024-03-05', '09:00:00'),
(2, 1, 'EE-1111', '2024-03-06', '09:00:00'),
(35, 1, 'EE-1111', '2024-03-08', '09:00:00'),
(30, 1, 'EE-1111', '2024-03-09', '09:00:00'),
(54, 1, 'EE-2222', '2024-03-05', '09:00:00'),
(7, 1, 'EE-2222', '2024-03-05', '13:00:00'),
(61, 1, 'EE-2222', '2024-03-06', '13:00:00'),
(32, 1, 'EE-2222', '2024-03-07', '09:00:00'),
(39, 1, 'EE-2222', '2024-03-08', '13:00:00'),
(56, 1, 'FF-1111', '2024-03-06', '09:00:00'),
(34, 1, 'FF-1111', '2024-03-08', '09:00:00'),
(11, 1, 'GG-1111', '2024-03-06', '09:00:00'),
(59, 1, 'GG-1111', '2024-03-06', '13:00:00'),
(64, 1, 'GG-1111', '2024-03-06', '17:00:00'),
(37, 1, 'GG-1111', '2024-03-08', '13:00:00'),
(42, 1, 'GG-1111', '2024-03-08', '17:00:00'),
(83, 1, 'GG-1111', '2024-03-09', '17:00:00'),
(60, 1, 'GG-2222', '2024-03-06', '13:00:00'),
(38, 1, 'GG-2222', '2024-03-08', '13:00:00'),
(85, 1, 'GG-2222', '2024-03-09', '13:00:00'),
(10, 1, 'HH-1111', '2024-03-05', '09:00:00'),
(9, 1, 'HH-2222', '2024-03-05', '17:00:00'),
(86, 1, 'JJ-1111', '2024-03-08', '09:00:00'),
(3, 4, 'BB-1111', '2024-03-09', '09:00:00'),
(18, 6, 'AA-1111', '2024-03-07', '09:00:00'),
(12, 6, 'AA-1111', '2024-03-09', '09:00:00'),
(19, 6, 'AA-2222', '2024-03-07', '09:00:00'),
(13, 6, 'AA-2222', '2024-03-09', '09:00:00'),
(20, 6, 'DD-1111', '2024-03-07', '13:00:00'),
(14, 6, 'DD-1111', '2024-03-09', '13:00:00'),
(21, 6, 'DD-2222', '2024-03-06', '13:00:00'),
(15, 6, 'DD-2222', '2024-03-09', '13:00:00'),
(28, 6, 'GG-1111', '2024-03-06', '17:00:00'),
(16, 6, 'GG-1111', '2024-03-09', '17:00:00'),
(22, 25, 'AA-1111', '2024-03-07', '17:00:00'),
(17, 25, 'AA-1111', '2024-03-09', '17:00:00'),
(72, 33, 'AA-3333', '2024-03-06', '09:00:00'),
(75, 33, 'AA-3333', '2024-03-09', '17:00:00'),
(76, 33, 'BB-2222', '2024-03-06', '09:00:00'),
(73, 33, 'BB-3333', '2024-03-09', '09:00:00'),
(74, 33, 'HH-2222', '2024-03-06', '13:00:00'),
(77, 34, 'AA-1111', '2024-03-06', '09:00:00'),
(79, 34, 'BB-2222', '2024-03-09', '13:00:00'),
(78, 34, 'CC-2222', '2024-03-09', '09:00:00'),
(65, 35, 'AA-1111', '2024-03-09', '09:00:00'),
(66, 35, 'BB-2222', '2024-03-09', '13:00:00'),
(71, 35, 'BB-3333', '2024-03-06', '13:00:00'),
(68, 35, 'CC-1111', '2024-03-06', '09:00:00'),
(67, 35, 'CC-2222', '2024-03-06', '17:00:00'),
(70, 35, 'DD-1111', '2024-03-06', '09:00:00'),
(69, 35, 'DD-2222', '2024-03-09', '13:00:00'),
(80, 39, 'AA-1111', '2024-03-09', '09:00:00'),
(81, 39, 'GG-1111', '2024-03-09', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `rid` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `destination` int(11) NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `distance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`rid`, `source`, `destination`, `duration`, `distance`) VALUES
(1, 1, 3, 10, 450),
(2, 1, 4, 6, 200),
(3, 1, 2, 16, 700),
(4, 2, 3, 10, 350),
(5, 1, 6, 8, 215),
(6, 1, 7, 8, 390),
(7, 1, 8, 1, 44),
(8, 1, 9, 11, 385),
(9, 1, 10, 14, 579),
(10, 1, 11, 9, 378),
(11, 1, 12, 3, 102),
(12, 1, 13, 5, 179),
(13, 1, 14, 8, 358),
(14, 1, 15, 25, 790),
(15, 1, 16, 22, 681),
(16, 1, 18, 3, 189),
(17, 1, 20, 16, 625),
(18, 1, 21, 8, 303),
(19, 1, 22, 7, 322),
(20, 1, 23, 5, 192),
(21, 1, 31, 19, 728),
(22, 1, 33, 5, 228),
(23, 1, 34, 5, 228),
(24, 1, 35, 5, 228),
(25, 1, 36, 5, 152),
(26, 1, 40, 6, 180),
(27, 1, 41, 9, 420),
(28, 1, 43, 10, 450),
(29, 1, 42, 8, 384),
(30, 1, 44, 18, 623),
(31, 5, 3, 10, 450),
(32, 5, 7, 8, 390),
(33, 3, 2, 10, 350),
(34, 3, 7, 4, 111),
(35, 3, 1, 10, 450),
(36, 3, 5, 10, 450),
(37, 3, 37, 14, 419),
(38, 3, 41, 1, 40),
(39, 3, 34, 4, 167),
(40, 7, 1, 8, 390),
(41, 33, 1, 5, 228),
(42, 34, 1, 5, 228),
(43, 35, 1, 5, 228),
(44, 36, 1, 5, 152),
(45, 34, 3, 4, 167),
(46, 34, 2, 5, 170),
(47, 34, 7, 4, 160),
(48, 7, 3, 4, 111);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `btickets`
--
ALTER TABLE `btickets`
  ADD PRIMARY KEY (`btid`),
  ADD UNIQUE KEY `pid` (`pid`,`seatno`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`busno`),
  ADD KEY `oid` (`oid`);

--
-- Indexes for table `cargate`
--
ALTER TABLE `cargate`
  ADD PRIMARY KEY (`cgid`);

--
-- Indexes for table `cargo_branch`
--
ALTER TABLE `cargo_branch`
  ADD PRIMARY KEY (`branch_name`);

--
-- Indexes for table `cargo_plan`
--
ALTER TABLE `cargo_plan`
  ADD PRIMARY KEY (`cpid`),
  ADD UNIQUE KEY `crid` (`crid`,`truckno`,`cpdate`),
  ADD KEY `truckno` (`truckno`);

--
-- Indexes for table `cargo_route`
--
ALTER TABLE `cargo_route`
  ADD PRIMARY KEY (`crid`),
  ADD UNIQUE KEY `cargo_src` (`cargo_src`,`cargo_dest`),
  ADD KEY `cargo_dest` (`cargo_dest`);

--
-- Indexes for table `cargo_truck`
--
ALTER TABLE `cargo_truck`
  ADD PRIMARY KEY (`truckno`);

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`costid`),
  ADD UNIQUE KEY `rid` (`rid`,`oid`),
  ADD KEY `oid` (`oid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `get_cargo_service`
--
ALTER TABLE `get_cargo_service`
  ADD PRIMARY KEY (`gid`),
  ADD KEY `crid` (`crid`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `rid` (`rid`,`busno`,`ddate`,`dtime`),
  ADD KEY `busno` (`busno`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`rid`),
  ADD UNIQUE KEY `source` (`source`,`destination`),
  ADD KEY `destination` (`destination`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cargate`
--
ALTER TABLE `cargate`
  MODIFY `cgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
  MODIFY `costid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `btickets`
--
ALTER TABLE `btickets`
  ADD CONSTRAINT `btickets_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `plan` (`pid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `btickets_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `customer` (`cid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `operator` (`oid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cargo_plan`
--
ALTER TABLE `cargo_plan`
  ADD CONSTRAINT `cargo_plan_ibfk_1` FOREIGN KEY (`crid`) REFERENCES `cargo_route` (`crid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cargo_plan_ibfk_2` FOREIGN KEY (`truckno`) REFERENCES `cargo_truck` (`truckno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cargo_route`
--
ALTER TABLE `cargo_route`
  ADD CONSTRAINT `cargo_route_ibfk_1` FOREIGN KEY (`cargo_src`) REFERENCES `cargo_branch` (`branch_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cargo_route_ibfk_2` FOREIGN KEY (`cargo_dest`) REFERENCES `cargo_branch` (`branch_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cost`
--
ALTER TABLE `cost`
  ADD CONSTRAINT `cost_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `route` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cost_ibfk_2` FOREIGN KEY (`oid`) REFERENCES `operator` (`oid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `customer` (`cid`);

--
-- Constraints for table `get_cargo_service`
--
ALTER TABLE `get_cargo_service`
  ADD CONSTRAINT `get_cargo_service_ibfk_1` FOREIGN KEY (`crid`) REFERENCES `cargo_route` (`crid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `plan_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `route` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plan_ibfk_2` FOREIGN KEY (`busno`) REFERENCES `bus` (`busno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`source`) REFERENCES `cargate` (`cgid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `route_ibfk_2` FOREIGN KEY (`destination`) REFERENCES `cargate` (`cgid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
