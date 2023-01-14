-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2023 at 05:16 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stafeta`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` mediumint(8) UNSIGNED NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `position` smallint(2) UNSIGNED DEFAULT '0',
  `order_start` int(11) NOT NULL DEFAULT '1',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `position`, `order_start`, `updated_at`) VALUES
(1, 'Family', 60, 7, '2019-06-21 15:41:13'),
(2, 'Juniori', 30, 4, '2019-06-21 15:41:13'),
(3, 'Elite', 10, 1, '2019-06-21 15:41:13'),
(4, 'Open', 20, 3, '2019-06-21 15:41:13'),
(5, 'Veterani', 50, 5, '2019-06-21 15:41:13'),
(6, 'Feminin', 40, 6, '2019-06-21 15:41:13'),
(7, 'Seniori', 70, 2, '2019-06-21 15:41:13');

-- --------------------------------------------------------

--
-- Table structure for table `categories_trail`
--

CREATE TABLE `categories_trail` (
  `category_id` mediumint(8) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `position` smallint(2) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `categories_trail`
--

INSERT INTO `categories_trail` (`category_id`, `category_name`, `position`) VALUES
(1, 'Juniori', 10),
(2, 'Junioare', 20),
(3, 'Seniori', 30),
(4, 'Senioare', 40);

-- --------------------------------------------------------

--
-- Table structure for table `category_challenges`
--

CREATE TABLE `category_challenges` (
  `category_challenge_id` mediumint(8) UNSIGNED NOT NULL,
  `category_id` mediumint(8) UNSIGNED NOT NULL,
  `challenge_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `challenge_id` mediumint(8) UNSIGNED NOT NULL,
  `challenge_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`challenge_id`, `challenge_name`) VALUES
(1, 'Raid montan'),
(2, 'Orientare'),
(3, 'Cunostinte turistice'),
(4, 'Cultural');

-- --------------------------------------------------------

--
-- Table structure for table `challenge_stations`
--

CREATE TABLE `challenge_stations` (
  `station_id` mediumint(8) UNSIGNED NOT NULL,
  `category_challenge_id` mediumint(8) UNSIGNED DEFAULT NULL,
  `station_type` tinyint(2) UNSIGNED DEFAULT NULL COMMENT '0 = START, 1 = PA, 2 = PFA, 3 = FINISH',
  `maximum_time` mediumint(8) DEFAULT NULL,
  `score` mediumint(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `challenge_stations_stages`
--

CREATE TABLE `challenge_stations_stages` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `challenge_stations_stages`
--

INSERT INTO `challenge_stations_stages` (`id`, `categories_id`, `post`, `time`) VALUES
(166, 3, 251, NULL),
(167, 3, 10, 10),
(168, 3, 20, 10),
(169, 3, 30, 30),
(170, 3, 40, 10),
(171, 3, 252, NULL),
(175, 2, 251, NULL),
(176, 2, 10, 10),
(177, 2, 20, 30),
(178, 2, 30, 10),
(179, 2, 252, NULL),
(180, 4, 251, NULL),
(181, 4, 10, 10),
(182, 4, 20, 30),
(183, 4, 30, 10),
(184, 4, 252, NULL),
(185, 5, 251, NULL),
(186, 5, 10, 10),
(187, 5, 20, 30),
(188, 5, 30, 10),
(189, 5, 252, NULL),
(190, 6, 251, NULL),
(191, 6, 10, 10),
(192, 6, 20, 30),
(193, 6, 30, 10),
(194, 6, 252, NULL),
(195, 7, 251, NULL),
(196, 7, 10, 10),
(197, 7, 20, 30),
(198, 7, 30, 10),
(199, 7, 252, NULL),
(204, 1, 251, NULL),
(205, 1, 10, 30),
(206, 1, 252, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `climbing`
--

CREATE TABLE `climbing` (
  `climbing_id` int(8) NOT NULL,
  `team_id` mediumint(8) NOT NULL,
  `name_participant` varchar(255) NOT NULL,
  `missed_nods` mediumint(8) DEFAULT NULL,
  `top` varchar(8) DEFAULT NULL,
  `timp` varchar(255) NOT NULL,
  `abandon` mediumint(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `club_id` mediumint(8) UNSIGNED NOT NULL,
  `club_name` varchar(255) NOT NULL,
  `scor_cultural` mediumint(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cross_trail`
--

CREATE TABLE `cross_trail` (
  `id` int(8) NOT NULL,
  `category_id` mediumint(8) NOT NULL,
  `uuid_card` mediumint(8) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `time` time NOT NULL,
  `abandonament` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `cultural`
--

CREATE TABLE `cultural` (
  `cultural_id` int(8) NOT NULL,
  `club_id` mediumint(8) NOT NULL,
  `score` mediumint(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `knowledge`
--

CREATE TABLE `knowledge` (
  `knowledge_id` int(8) NOT NULL,
  `team_id` mediumint(8) NOT NULL,
  `answers` mediumint(8) NOT NULL,
  `time` varchar(255) NOT NULL,
  `scor` mediumint(8) NOT NULL,
  `abandon` mediumint(8) NOT NULL,
  `wrongquestions` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_start`
--

CREATE TABLE `order_start` (
  `id` int(11) NOT NULL,
  `date_start` timestamp NULL DEFAULT NULL,
  `minutes` int(11) NOT NULL DEFAULT '1',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `order_start`
--

INSERT INTO `order_start` (`id`, `date_start`, `minutes`, `updated_at`) VALUES
(1, '2019-06-22 04:30:00', 2, '2019-06-21 15:41:13');

-- --------------------------------------------------------

--
-- Table structure for table `organizer`
--

CREATE TABLE `organizer` (
  `id_organizer` int(1) NOT NULL,
  `name_trophy` varchar(255) NOT NULL,
  `name_organizer` varchar(255) NOT NULL,
  `phase_trophy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organizer`
--

INSERT INTO `organizer` (`id_organizer`, `name_trophy`, `name_organizer`, `phase_trophy`) VALUES
(1, 'Trofeul', 'ONG', 'Master');

-- --------------------------------------------------------

--
-- Table structure for table `orienteering`
--

CREATE TABLE `orienteering` (
  `orienteering_id` int(8) NOT NULL,
  `team_id` mediumint(8) NOT NULL,
  `uuid_card` int(8) NOT NULL,
  `name_participant` varchar(255) DEFAULT NULL,
  `start` varchar(255) NOT NULL,
  `finish` varchar(255) NOT NULL,
  `total` varchar(8) NOT NULL,
  `abandon` mediumint(8) NOT NULL,
  `missed_posts` varchar(255) NOT NULL,
  `order_posts` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orienteering_stages`
--

CREATE TABLE `orienteering_stages` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `participations`
--

CREATE TABLE `participations` (
  `participation_id` mediumint(8) UNSIGNED NOT NULL,
  `team_id` mediumint(8) UNSIGNED NOT NULL,
  `category_challenge_id` mediumint(8) UNSIGNED NOT NULL,
  `score` int(12) DEFAULT NULL,
  `notes` text,
  `missing_equipment_items` tinyint(2) UNSIGNED DEFAULT '0',
  `missing_footwear` tinyint(1) UNSIGNED DEFAULT '0',
  `abandonment` tinyint(1) UNSIGNED DEFAULT '0',
  `minimum_distance_penalty` tinyint(1) UNSIGNED DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `participation_entries`
--

CREATE TABLE `participation_entries` (
  `entry_id` mediumint(8) UNSIGNED NOT NULL,
  `participation_id` mediumint(8) UNSIGNED NOT NULL,
  `station_id` mediumint(8) UNSIGNED DEFAULT NULL,
  `participant_name` varchar(255) DEFAULT NULL,
  `time` varchar(32) DEFAULT NULL,
  `time_start` varchar(32) DEFAULT NULL,
  `time_finish` varchar(32) DEFAULT NULL,
  `hits` tinyint(3) DEFAULT NULL,
  `post` int(11) DEFAULT NULL,
  `uuid_id` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_id` mediumint(8) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` mediumint(8) UNSIGNED NOT NULL,
  `uuid_card` mediumint(8) NOT NULL,
  `uuids_raid_id` int(11) NOT NULL DEFAULT '1',
  `team_name` varchar(255) DEFAULT NULL,
  `club_id` mediumint(8) UNSIGNED DEFAULT NULL,
  `category_id` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uuids`
--

CREATE TABLE `uuids` (
  `uuid_id` int(8) NOT NULL,
  `uuid_name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `uuids`
--

INSERT INTO `uuids` (`uuid_id`, `uuid_name`) VALUES
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
  `uuid_id` int(8) NOT NULL,
  `uuid_name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `uuids_raid`
--

INSERT INTO `uuids_raid` (`uuid_id`, `uuid_name`) VALUES
(2, '03 10 75 10'),
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
(1, '11 C2 41 C2'),
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
-- Table structure for table `uuid_trail`
--

CREATE TABLE `uuid_trail` (
  `uuid_id` int(8) NOT NULL,
  `uuid_name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `uuid_trail`
--

INSERT INTO `uuid_trail` (`uuid_id`, `uuid_name`) VALUES
(1, 'C23846A1'),
(2, 'C23846A2'),
(5, 'C23846A5'),
(6, 'C23846A6'),
(4, 'C23C6F43'),
(3, 'C241E253'),
(13, 'C2420733'),
(9, 'C24231D3'),
(8, 'C2749593'),
(7, 'c454545f'),
(10, 'c4f5ddfdfg'),
(11, 'dcfsfdf'),
(12, 'fdghfhg'),
(14, 'gfgfgfh'),
(17, 'hgghghg'),
(16, 'hghjghg'),
(15, 'hjgjhjhjh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `categories_trail`
--
ALTER TABLE `categories_trail`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category_challenges`
--
ALTER TABLE `category_challenges`
  ADD PRIMARY KEY (`category_challenge_id`),
  ADD KEY `fk_category_challenges_categories_1` (`category_id`),
  ADD KEY `fk_category_challenges_challenges_1` (`challenge_id`);

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`challenge_id`);

--
-- Indexes for table `challenge_stations`
--
ALTER TABLE `challenge_stations`
  ADD PRIMARY KEY (`station_id`),
  ADD KEY `fk_challenge_raid_stations_category_challenges_1` (`category_challenge_id`);

--
-- Indexes for table `challenge_stations_stages`
--
ALTER TABLE `challenge_stations_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `climbing`
--
ALTER TABLE `climbing`
  ADD PRIMARY KEY (`climbing_id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`club_id`);

--
-- Indexes for table `cross_trail`
--
ALTER TABLE `cross_trail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_card` (`uuid_card`);

--
-- Indexes for table `cultural`
--
ALTER TABLE `cultural`
  ADD PRIMARY KEY (`cultural_id`);

--
-- Indexes for table `knowledge`
--
ALTER TABLE `knowledge`
  ADD PRIMARY KEY (`knowledge_id`);

--
-- Indexes for table `order_start`
--
ALTER TABLE `order_start`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizer`
--
ALTER TABLE `organizer`
  ADD PRIMARY KEY (`id_organizer`);

--
-- Indexes for table `orienteering`
--
ALTER TABLE `orienteering`
  ADD PRIMARY KEY (`orienteering_id`);

--
-- Indexes for table `orienteering_stages`
--
ALTER TABLE `orienteering_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participations`
--
ALTER TABLE `participations`
  ADD PRIMARY KEY (`participation_id`),
  ADD KEY `fk_challenge_participation_teams_1` (`team_id`),
  ADD KEY `fk_challenge_participation_category_challenges_1` (`category_challenge_id`);

--
-- Indexes for table `participation_entries`
--
ALTER TABLE `participation_entries`
  ADD PRIMARY KEY (`entry_id`),
  ADD KEY `fk_participation_entries_participations_1` (`participation_id`),
  ADD KEY `fk_participation_entries_challenge_stations_1` (`station_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`,`code`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`),
  ADD UNIQUE KEY `uuid_card` (`uuid_card`),
  ADD KEY `fk_teams_clubs_1` (`club_id`),
  ADD KEY `fk_teams_categories_1` (`category_id`);

--
-- Indexes for table `uuids`
--
ALTER TABLE `uuids`
  ADD PRIMARY KEY (`uuid_id`),
  ADD UNIQUE KEY `uuid_name` (`uuid_name`);

--
-- Indexes for table `uuids_raid`
--
ALTER TABLE `uuids_raid`
  ADD PRIMARY KEY (`uuid_id`),
  ADD UNIQUE KEY `uuid_name` (`uuid_name`);

--
-- Indexes for table `uuid_trail`
--
ALTER TABLE `uuid_trail`
  ADD PRIMARY KEY (`uuid_id`),
  ADD UNIQUE KEY `uuid_name` (`uuid_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `category_challenges`
--
ALTER TABLE `category_challenges`
  MODIFY `category_challenge_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `challenge_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `challenge_stations`
--
ALTER TABLE `challenge_stations`
  MODIFY `station_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `challenge_stations_stages`
--
ALTER TABLE `challenge_stations_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;
--
-- AUTO_INCREMENT for table `climbing`
--
ALTER TABLE `climbing`
  MODIFY `climbing_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `club_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cross_trail`
--
ALTER TABLE `cross_trail`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cultural`
--
ALTER TABLE `cultural`
  MODIFY `cultural_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `knowledge`
--
ALTER TABLE `knowledge`
  MODIFY `knowledge_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_start`
--
ALTER TABLE `order_start`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `organizer`
--
ALTER TABLE `organizer`
  MODIFY `id_organizer` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orienteering`
--
ALTER TABLE `orienteering`
  MODIFY `orienteering_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orienteering_stages`
--
ALTER TABLE `orienteering_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `participations`
--
ALTER TABLE `participations`
  MODIFY `participation_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `participation_entries`
--
ALTER TABLE `participation_entries`
  MODIFY `entry_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uuids`
--
ALTER TABLE `uuids`
  MODIFY `uuid_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
--
-- AUTO_INCREMENT for table `uuids_raid`
--
ALTER TABLE `uuids_raid`
  MODIFY `uuid_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
--
-- AUTO_INCREMENT for table `uuid_trail`
--
ALTER TABLE `uuid_trail`
  MODIFY `uuid_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_challenges`
--
ALTER TABLE `category_challenges`
  ADD CONSTRAINT `fk_category_challenges_categories_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `fk_category_challenges_challenges_1` FOREIGN KEY (`challenge_id`) REFERENCES `challenges` (`challenge_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
