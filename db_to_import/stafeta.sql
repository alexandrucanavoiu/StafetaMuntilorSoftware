-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2024 at 11:30 PM
-- Server version: 10.5.22-MariaDB-1:10.5.22+maria~deb11
-- PHP Version: 8.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stafetamuntilor`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `order_start` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `order_start`, `created_at`, `updated_at`) VALUES
(1, 'Family', 2, NULL, '2024-03-03 13:17:13'),
(2, 'Juniori', 1, NULL, '2024-03-03 13:17:13'),
(3, 'Elite', 4, NULL, '2024-03-10 07:54:46'),
(4, 'Open', 7, NULL, '2024-03-10 07:54:46'),
(5, 'Veterani', 3, NULL, '2024-03-10 07:54:46'),
(6, 'Feminin', 6, NULL, NULL),
(7, 'Seniori', 5, NULL, '2024-03-10 07:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clubs_stage_rankings`
--

CREATE TABLE `clubs_stage_rankings` (
  `id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `scor` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cultural`
--

CREATE TABLE `cultural` (
  `id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `scor` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `knowledges`
--

CREATE TABLE `knowledges` (
  `id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `wrong_answers` int(11) NOT NULL,
  `time` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `abandon` int(1) NOT NULL,
  `wrong_questions` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizer_stages`
--

CREATE TABLE `organizer_stages` (
  `id` int(11) NOT NULL,
  `software` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `organizer_stages`
--

INSERT INTO `organizer_stages` (`id`, `software`, `created_at`, `updated_at`) VALUES
(1, 'Software Stafeta Muntilor v5.0.0 by Asociatia Drumetii Montane', '2022-10-29 13:33:26', '2024-02-16 20:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `orienteering`
--

CREATE TABLE `orienteering` (
  `id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `finish_time` varchar(255) NOT NULL,
  `total_time` varchar(255) NOT NULL,
  `abandon` int(1) NOT NULL,
  `missed_posts` varchar(500) DEFAULT NULL,
  `order_posts` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orienteering_stations_stages`
--

CREATE TABLE `orienteering_stations_stages` (
  `id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `cnp` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants_stages`
--

CREATE TABLE `participants_stages` (
  `id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants_stage_rankings`
--

CREATE TABLE `participants_stage_rankings` (
  `id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `scor` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `raidmontan_participations`
--

CREATE TABLE `raidmontan_participations` (
  `id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `missing_equipment_items` int(11) NOT NULL,
  `missing_footwear` int(11) NOT NULL,
  `abandon` int(11) NOT NULL,
  `minimum_distance_penalty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `raidmontan_participations_entries`
--

CREATE TABLE `raidmontan_participations_entries` (
  `id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `raidmontan_participations_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `raidmontan_stations_id` int(11) NOT NULL,
  `raidmontan_stations_station_type` int(11) NOT NULL,
  `raidmontan_stations_stages_id` int(11) DEFAULT NULL,
  `time_start` varchar(32) DEFAULT NULL,
  `time_finish` varchar(32) DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `raidmontan_stations`
--

CREATE TABLE `raidmontan_stations` (
  `id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `station_type` tinyint(2) NOT NULL COMMENT '0 = START, 1 = PA, 2 = PFA, 3 = FINISH',
  `maximum_time` mediumint(11) DEFAULT NULL,
  `points` mediumint(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `raidmontan_stations_stages`
--

CREATE TABLE `raidmontan_stations_stages` (
  `id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `time` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE `stages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ong` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `name`, `ong`, `created_at`, `updated_at`) VALUES
(1, 'Trofeul Jnepenilor', 'Asociatia pentru Tineret, Sport, Turism si Ecologie Jnepenii', '2024-03-10 09:11:02', '2024-03-10 07:11:19'),
(2, 'Trofeul Zimbrilor', 'Asociatia Zimbrul Carpatin Pitesti', '2024-03-10 09:11:02', '2024-03-10 09:11:02'),
(3, 'Trofeul Via-Retezat', 'Asociatia de turism montan \"VIA-RETEZAT\"', '2024-03-10 09:11:02', '2024-03-10 09:11:02'),
(4, 'Trofeul Muntilor', 'Asociatia de Turism Gaska Bucuresti', '2024-03-10 09:11:02', '2024-03-10 09:11:02'),
(5, 'Trofeul Hai pe Munte', 'Asociatia de Turism Montan Hai pe Munte! Iasi', '2024-03-10 09:11:02', '2024-03-10 09:11:02'),
(6, 'Trofeul Pro-Parang', 'Asociatia de Schi Turism Montan Pro-Parang', '2024-03-10 09:11:02', '2024-03-10 09:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `uuid_card_orienteering_id` int(11) NOT NULL,
  `uuid_card_raid_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_order_start`
--

CREATE TABLE `team_order_start` (
  `id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `order_date_start` varchar(255) DEFAULT NULL,
  `order_start_minutes` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `team_order_start`
--

INSERT INTO `team_order_start` (`id`, `stage_id`, `order_date_start`, `order_start_minutes`, `created_at`, `updated_at`) VALUES
(1, 1, '11:00:00', 1, '2022-12-26 19:54:46', '2024-02-17 04:29:34'),
(2, 2, '10:00:00', 1, '2022-12-26 19:54:46', '2022-12-27 18:53:23'),
(3, 3, '10:00:00', 1, '2022-12-26 19:54:46', '2022-12-27 18:53:23'),
(4, 4, '10:00:00', 1, '2022-12-26 19:54:46', '2022-12-27 18:53:23'),
(5, 5, '10:00:00', 1, '2022-12-26 19:54:46', '2022-12-27 18:53:23'),
(6, 6, '10:00:00', 1, '2022-12-26 19:54:46', '2022-12-27 18:53:23');

-- --------------------------------------------------------

--
-- Table structure for table `uuids_orienteering`
--

CREATE TABLE `uuids_orienteering` (
  `id` int(8) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `uuids_orienteering`
--

INSERT INTO `uuids_orienteering` (`id`, `name`) VALUES
(2, '03 10 75 C2'),
(72, '03 1F 3D C2'),
(100, '03 63 36 C2'),
(111, '03 6F 36 C2'),
(114, '03 77 36 C2'),
(68, '03 83 35 C2'),
(91, '03 B7 3E C2'),
(77, '03 BF 41 C2'),
(138, '03 D2 3F C2'),
(133, '03 D5 33 C2'),
(58, '03 D8 36 C2'),
(8, '03 DC 37 C2'),
(49, '03 E0 37 C2'),
(83, '03 E4 38 C2'),
(129, '13 1A 38 C2'),
(43, '13 2B 3D C2'),
(107, '13 30 3A C2'),
(67, '13 52 34 C2'),
(93, '13 56 38 C2'),
(82, '13 62 36 C2'),
(74, '13 75 41 C2'),
(70, '13 89 36 C2'),
(79, '13 F0 34 C2'),
(122, '23 0C 35 C2'),
(18, '23 13 3A C2'),
(115, '23 37 38 C2'),
(143, '23 4C 3D C2'),
(112, '23 58 3D C2'),
(140, '23 D4 35 C2'),
(13, '23 F5 35 C2'),
(99, '23 F5 36 C2'),
(40, '33 07 42 C2'),
(39, '33 16 3E C2'),
(123, '33 2C 38 C2'),
(6, '33 3A 3E C2'),
(33, '33 5E 36 C2'),
(21, '33 67 3D C2'),
(132, '33 89 36 C2'),
(113, '33 C1 37 C2'),
(106, '33 F5 36 C2'),
(64, '43 1E 3A C2'),
(20, '43 22 37 C2'),
(37, '43 33 3C C2'),
(52, '43 3A 42 C2'),
(22, '43 6F 3C C2'),
(119, '43 70 74 C2'),
(1, '43 C2 41 C2'),
(59, '43 C8 3A C2'),
(51, '43 D1 37 C2'),
(50, '43 EB 74 C2'),
(54, '53 0B 3A C2'),
(26, '53 3D 75 C2'),
(127, '53 3E 42 C2'),
(92, '53 50 38 C2'),
(63, '53 9F 36 C2'),
(34, '53 AA 41 C2'),
(61, '53 D8 38 C2'),
(84, '53 E2 41 C2'),
(116, '53 E4 3D C2'),
(121, '53 F0 36 C2'),
(53, '63 3E 38 C2'),
(94, '63 49 3E C2'),
(65, '63 9B 37 C2'),
(19, '63 DD 38 C2'),
(23, '63 E5 37 C2'),
(89, '63 EC 38 C2'),
(62, '63 F0 39 C2'),
(105, '73 17 3F C2'),
(71, '73 26 37 C2'),
(9, '73 2A 38 C2'),
(55, '73 30 3A C2'),
(31, '73 35 37 C2'),
(136, '73 3C 36 C2'),
(45, '73 64 38 C2'),
(142, '73 7C 38 C2'),
(38, '73 9A 3A C2'),
(98, '73 A2 38 C2'),
(110, '73 D0 41 C2'),
(102, '73 E2 3D C2'),
(12, '73 FF 41 C2'),
(135, '83 2B 3F C2'),
(124, '83 46 3E C2'),
(95, '83 EF 41 C2'),
(86, '93 28 3A C2'),
(101, '93 29 35 C2'),
(57, '93 40 38 C2'),
(85, '93 51 3D C2'),
(16, '93 5A 3F C2'),
(17, '93 81 35 C2'),
(24, '93 95 74 C2'),
(109, '93 A6 3C C2'),
(15, '93 BF 3D C2'),
(78, '93 CB 36 C2'),
(81, '93 D0 35 C2'),
(104, 'A3 11 36 C2'),
(27, 'A3 16 37 C2'),
(90, 'A3 46 38 C2'),
(48, 'A3 88 35 C2'),
(5, 'A3 EB 74 C2'),
(103, 'A9 AB 89 AB'),
(88, 'A9 C2 89 AB'),
(66, 'B3 75 38 C2'),
(139, 'B3 A1 3F C2'),
(30, 'B3 C5 37 C2'),
(47, 'B3 C5 3F C2'),
(69, 'B3 C9 37 C2'),
(76, 'B3 D0 36 C2'),
(32, 'B3 ED 35 C2'),
(130, 'C3 07 40 C2'),
(44, 'C3 15 42 C2'),
(141, 'C3 65 3D C2'),
(96, 'C3 AD 3B C2'),
(73, 'C3 CD 37 C2'),
(28, 'C3 DB 34 C2'),
(56, 'C3 DC 38 C2'),
(29, 'D3 15 37 C2'),
(80, 'D3 26 3E C2'),
(87, 'D3 31 42 C2'),
(14, 'D3 46 34 C2'),
(46, 'D3 4F 38 C2'),
(128, 'D3 6E 74 C2'),
(120, 'D3 A6 40 C2'),
(144, 'D3 C2 3D C2'),
(75, 'D3 DE 35 C2'),
(134, 'D3 EB 41 C2'),
(60, 'D3 FC 39 C2'),
(3, 'E3 0A 37 C2'),
(118, 'E3 11 36 C2'),
(7, 'E3 28 40 C2'),
(137, 'E3 2D 39 C2'),
(117, 'E3 40 38 C2'),
(36, 'E3 48 3D C2'),
(42, 'E3 4C 3D C2'),
(108, 'E3 5E 36 C2'),
(131, 'E3 64 36 C2'),
(97, 'E3 81 37 C2'),
(35, 'E3 88 39 C2'),
(11, 'E3 90 3D C2'),
(125, 'F3 20 3F C2'),
(41, 'F3 82 36 C2'),
(10, 'F3 94 3D C2'),
(126, 'F3 9B 36 C2'),
(25, 'F3 AA 41 C2'),
(4, 'F9 DD 89 AB');

-- --------------------------------------------------------

--
-- Table structure for table `uuids_raid`
--

CREATE TABLE `uuids_raid` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `uuids_raid`
--

INSERT INTO `uuids_raid` (`id`, `name`) VALUES
(1, '83 39 35 C2'),
(2, '6B FE D0 1F'),
(3, '13 F2 33 C2'),
(4, 'E3 01 40 C2'),
(5, 'F3 1B 35 C2'),
(6, '43 1A 38 C2'),
(7, 'AB 41 E7 1F'),
(8, '9B 2D CC 1F'),
(9, 'BB BA E5 1F'),
(10, 'BB 23 D4 1F'),
(11, '9B 6A CB 1F'),
(12, 'DB A2 DB 1F'),
(13, '7B 01 D5 1F'),
(14, 'FB 56 C7 1F'),
(15, '6B 70 D1 1F'),
(16, '6B 98 D0 1F'),
(17, '3B 56 E2 1F'),
(18, 'FB 17 DA 1F'),
(19, '0B 22 D4 1F'),
(20, '6B 31 E2 1F'),
(21, '9B F0 D6 1F'),
(22, '9B 96 DB 1F'),
(23, 'CB 97 C8 1F'),
(24, '6B C8 E5 1F'),
(25, '13 22 36 C2'),
(26, 'AB D5 DC 1F'),
(27, '1B C5 DA 1F'),
(28, 'DB D3 CB 1F'),
(29, 'DB 78 D2 1F'),
(30, '1B 36 C6 1F'),
(31, '3B F6 C7 1F'),
(32, '0B 48 D9 1F'),
(33, 'AB EC D3 1F'),
(34, '4B C4 E5 1F'),
(35, '8B D1 D5 1F'),
(36, '93 70 74 C2'),
(37, '3B 50 DA 1F'),
(38, 'EB 24 DA 1F'),
(39, '83 75 38 C2'),
(40, '3B 6D E8 1F'),
(41, '8B E6 DF 1F'),
(42, 'C3 33 37 C2'),
(43, 'BB 73 DE 1F'),
(44, 'FB 79 D3 1F'),
(45, 'BB 23 C5 1F'),
(46, 'FB 98 D0 1F'),
(47, 'DB A8 D5 1F'),
(48, 'AB 11 D6 1F'),
(49, '0B 26 E4 1F'),
(50, 'CB 78 D9 1F'),
(51, '4B D8 E0 1F'),
(52, 'DB 8C D7 1F'),
(53, '5B 52 CF 1F'),
(54, 'AB 7E C6 1F'),
(55, '4B 2F C4 1F'),
(56, 'AB AC D2 1F'),
(57, '3B FD C8 1F'),
(58, '7B 6A C4 1F'),
(59, '13 B6 36 C2'),
(60, '13 32 39 C2'),
(61, 'A3 1F 3F C2'),
(62, '33 33 37 C2'),
(63, 'CB 95 CC 1F'),
(64, '8B 88 C4 1F'),
(65, 'CB FA C8 1F'),
(66, 'AB 64 D3 1F'),
(67, 'FB B4 DF 1F'),
(68, '2B CB D7 1F'),
(69, 'EB BD DB 1F'),
(70, '5B 13 DE 1F'),
(71, '2B F5 DA 1F'),
(72, 'CB C8 CF 1F'),
(73, 'EB FA D0 1F'),
(74, 'FB 09 D5 1F'),
(75, '7B A3 DB 1F'),
(76, '5B 45 DF 1F'),
(77, 'DB 97 CC 1F'),
(78, 'CB 75 DE 1F'),
(79, '6B A5 EF 1B'),
(80, 'DB EF CC 1F'),
(81, '7B 77 E3 1F'),
(82, '5B 4C C9 1F'),
(83, 'AB D8 DC 1F'),
(84, '1B F7 D0 1F'),
(85, '5B 75 D9 1F'),
(86, '8B 87 D6 1F'),
(87, '8B F3 C9 1F'),
(88, '1B 61 CD 1F'),
(89, 'FB 39 C6 1F'),
(90, '9B E5 DF 1F'),
(91, '3B 46 D9 1F'),
(92, '3B CF DA 1F'),
(93, 'BB 01 DC 1F'),
(94, '6B 65 CD 1F'),
(95, 'AB FB C8 1F'),
(96, '7B 8D DD 1F'),
(97, 'DB 2A CE 1F'),
(98, '4B 9D C8 1F'),
(99, '2B 3C D4 1F'),
(100, 'BB 0E E2 1F'),
(101, '5B 4E D2 1F'),
(102, 'BB A6 DB 1F'),
(103, 'FB AD C7 1F'),
(104, '5B 4C D2 1F'),
(105, 'CB 3E C4 1F'),
(106, '1B BE E7 1F'),
(107, '2B 0D C7 1F'),
(108, 'AB BA D6 1F'),
(109, '8B 2B C4 1F'),
(110, '5B 48 E7 1F'),
(111, 'AB 44 DF 1F'),
(112, 'A3 D5 36 C2'),
(113, '93 8D 39 C2'),
(114, 'D3 CA 36 C2'),
(115, 'F3 7C 41 C2'),
(116, 'C3 8D 37 C2'),
(117, '33 F0 39 C2'),
(118, '43 01 36 C2'),
(119, '69 1E 8A AB'),
(120, '23 E4 41 C2'),
(121, '73 B7 33 C2'),
(122, '03 4A 42 C2'),
(123, 'A3 DA 3B C2'),
(124, '43 3F 3A C2'),
(125, '73 AA 3D C2'),
(126, '73 E8 37 C2'),
(127, 'B3 FE 35 C2'),
(128, 'D3 E1 35 C2'),
(129, '53 E8 37 C2'),
(130, 'D3 C5 3F C2'),
(131, 'D3 DC 37 C2'),
(132, 'E3 48 37 C2'),
(133, '99 B5 89 AB'),
(134, '23 77 36 C2'),
(135, '69 CF 8C AB'),
(136, '43 E5 33 C2'),
(137, '03 58 37 C2'),
(138, '53 66 3A C2'),
(139, 'F3 17 35 C2'),
(140, 'B3 6B 36 C2'),
(141, 'D3 3F 42 C2'),
(142, '83 0A 40 C2'),
(143, '13 8D 39 C2'),
(144, '43 44 35 C2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clubs_stage_rankings`
--
ALTER TABLE `clubs_stage_rankings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cultural`
--
ALTER TABLE `cultural`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `knowledges`
--
ALTER TABLE `knowledges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizer_stages`
--
ALTER TABLE `organizer_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orienteering`
--
ALTER TABLE `orienteering`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orienteering_stations_stages`
--
ALTER TABLE `orienteering_stations_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cnp` (`cnp`);

--
-- Indexes for table `participants_stages`
--
ALTER TABLE `participants_stages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pa_id` (`participant_id`);

--
-- Indexes for table `participants_stage_rankings`
--
ALTER TABLE `participants_stage_rankings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `raidmontan_participations`
--
ALTER TABLE `raidmontan_participations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raidmontan_participations_entries`
--
ALTER TABLE `raidmontan_participations_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raidmontan_stations`
--
ALTER TABLE `raidmontan_stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raidmontan_stations_stages`
--
ALTER TABLE `raidmontan_stations_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_order_start`
--
ALTER TABLE `team_order_start`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uuids_orienteering`
--
ALTER TABLE `uuids_orienteering`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_name` (`name`);

--
-- Indexes for table `uuids_raid`
--
ALTER TABLE `uuids_raid`
  ADD UNIQUE KEY `A` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clubs_stage_rankings`
--
ALTER TABLE `clubs_stage_rankings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `cultural`
--
ALTER TABLE `cultural`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `knowledges`
--
ALTER TABLE `knowledges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT for table `organizer_stages`
--
ALTER TABLE `organizer_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orienteering`
--
ALTER TABLE `orienteering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `orienteering_stations_stages`
--
ALTER TABLE `orienteering_stations_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participants_stages`
--
ALTER TABLE `participants_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participants_stage_rankings`
--
ALTER TABLE `participants_stage_rankings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=513;

--
-- AUTO_INCREMENT for table `raidmontan_participations`
--
ALTER TABLE `raidmontan_participations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2062;

--
-- AUTO_INCREMENT for table `raidmontan_participations_entries`
--
ALTER TABLE `raidmontan_participations_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29632;

--
-- AUTO_INCREMENT for table `raidmontan_stations`
--
ALTER TABLE `raidmontan_stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `raidmontan_stations_stages`
--
ALTER TABLE `raidmontan_stations_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `team_order_start`
--
ALTER TABLE `team_order_start`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `uuids_orienteering`
--
ALTER TABLE `uuids_orienteering`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `uuids_raid`
--
ALTER TABLE `uuids_raid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
