-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2023 at 04:38 PM
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
  `position` smallint(2) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `position`) VALUES
(1, 'Family', 60),
(2, 'Juniori', 30),
(3, 'Elite', 10),
(4, 'Open', 20),
(5, 'Veterani', 50),
(6, 'Feminin', 40),
(7, 'Seniori', 70);

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

--
-- Dumping data for table `category_challenges`
--

INSERT INTO `category_challenges` (`category_challenge_id`, `category_id`, `challenge_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 4, 1),
(4, 3, 1),
(5, 7, 1),
(6, 6, 1),
(7, 5, 1);

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

--
-- Dumping data for table `challenge_stations`
--

INSERT INTO `challenge_stations` (`station_id`, `category_challenge_id`, `station_type`, `maximum_time`, `score`) VALUES
(1, 1, 0, NULL, NULL),
(2, 1, 1, 120, NULL),
(3, 1, 2, NULL, 200),
(4, 1, 2, NULL, 500),
(5, 1, 2, NULL, 500),
(6, 1, 2, NULL, 500),
(7, 1, 3, 110, NULL),
(8, 2, 0, NULL, NULL),
(9, 2, 1, 80, NULL),
(10, 2, 1, 150, NULL),
(11, 2, 1, 70, NULL),
(12, 2, 2, NULL, 200),
(13, 2, 2, NULL, 500),
(14, 2, 2, NULL, 500),
(15, 2, 2, NULL, 500),
(16, 2, 2, NULL, 200),
(17, 2, 2, NULL, 500),
(18, 2, 2, NULL, 500),
(19, 2, 3, 80, NULL),
(20, 3, 0, NULL, NULL),
(21, 3, 1, 90, NULL),
(22, 3, 1, 150, NULL),
(23, 3, 1, 80, NULL),
(24, 3, 2, NULL, 200),
(25, 3, 2, NULL, 500),
(26, 3, 2, NULL, 500),
(27, 3, 2, NULL, 500),
(28, 3, 2, NULL, 200),
(29, 3, 2, NULL, 500),
(30, 3, 2, NULL, 500),
(31, 3, 3, 100, NULL),
(32, 4, 0, NULL, NULL),
(33, 4, 1, 50, NULL),
(34, 4, 1, 160, NULL),
(35, 4, 1, 60, NULL),
(36, 4, 3, 60, NULL),
(37, 4, 2, NULL, 200),
(38, 4, 2, NULL, 500),
(39, 4, 2, NULL, 500),
(40, 4, 2, NULL, 200),
(41, 4, 2, NULL, 200),
(42, 4, 2, NULL, 500),
(43, 4, 2, NULL, 500),
(44, 5, 0, NULL, NULL),
(45, 5, 1, 80, NULL),
(46, 5, 1, 150, NULL),
(47, 5, 1, 70, NULL),
(48, 5, 2, NULL, 200),
(49, 5, 2, NULL, 500),
(50, 5, 2, NULL, 500),
(51, 5, 2, NULL, 500),
(52, 5, 2, NULL, 200),
(53, 5, 2, NULL, 500),
(54, 5, 2, NULL, 500),
(55, 5, 3, 80, NULL),
(56, 6, 0, NULL, NULL),
(57, 6, 1, 80, NULL),
(58, 6, 1, 150, NULL),
(59, 6, 1, 70, NULL),
(60, 6, 2, NULL, 200),
(61, 6, 2, NULL, 500),
(62, 6, 2, NULL, 500),
(63, 6, 2, NULL, 500),
(64, 6, 2, NULL, 200),
(65, 6, 2, NULL, 500),
(66, 6, 2, NULL, 500),
(67, 6, 3, 80, NULL),
(68, 7, 0, NULL, NULL),
(69, 7, 1, 90, NULL),
(70, 7, 1, 150, NULL),
(71, 7, 1, 80, NULL),
(72, 7, 2, NULL, 200),
(73, 7, 2, NULL, 500),
(74, 7, 2, NULL, 500),
(75, 7, 2, NULL, 500),
(76, 7, 2, NULL, 200),
(77, 7, 2, NULL, 500),
(78, 7, 2, NULL, 500),
(79, 7, 3, 100, NULL);

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

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`club_id`, `club_name`, `scor_cultural`) VALUES
(1, 'Asociatia Sky Turism Montan Pro-Parang', 0),
(2, 'HAI PE MUNTE IASI', 0),
(3, 'JNEPENII', 0),
(4, 'Alpin Club Pro Mont Bucuresti', 0),
(5, 'Asociatia Eco Sportiva "Sufletul Hasmasului"', 0),
(6, 'Zimbrul Carpatin', 0),
(7, 'Asociatia Drumetii Montane', 0),
(8, 'Cocosul de Munte Brasov', 0),
(9, 'A.E. Soimii Dunareni', 0),
(10, 'Arcul Carpatin Bucuresti', 0),
(11, 'Team 23', 0),
(12, 'Buila Vanturarita', 0),
(13, 'Mont-Del-Mar', 0),
(14, 'Montan Club Floarea Reginei', 0),
(15, 'Mutomanii Veterani', 0),
(16, 'BUILA-VANTURARITA RM. VALCEA', 0),
(18, 'Gaska Bucuresti', 0);

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

--
-- Dumping data for table `knowledge`
--

INSERT INTO `knowledge` (`knowledge_id`, `team_id`, `answers`, `time`, `scor`, `abandon`, `wrongquestions`) VALUES
(1, 57, 2, '00:01:29', 260, 0, '5,14'),
(2, 45, 7, '00:01:42', 160, 0, '1,2,5,6,7,11,14'),
(3, 53, 2, '00:01:50', 260, 0, '8,14'),
(4, 44, 0, '00:01:14', 300, 0, '-'),
(5, 42, 2, '00:01:56', 260, 0, '5,7'),
(6, 43, 1, '00:02:24', 280, 0, '14'),
(7, 54, 1, '00:02:22', 280, 0, '11'),
(8, 46, 6, '00:01:37', 180, 0, '7,8,9,12,13,14'),
(9, 52, 2, '00:01:40', 260, 0, '7,13'),
(10, 47, 0, '00:00:00', 0, 1, '0'),
(11, 48, 0, '00:00:00', 0, 1, '0'),
(12, 49, 0, '00:00:00', 0, 1, '0'),
(13, 59, 0, '00:00:00', 0, 1, '0'),
(14, 41, 0, '00:01:23', 300, 0, '0'),
(15, 40, 0, '00:01:21', 300, 0, '0'),
(16, 39, 0, '00:00:00', 0, 1, '0'),
(17, 21, 1, '00:02:00', 280, 0, '1'),
(18, 22, 3, '00:01:29', 240, 0, '4,5,7'),
(19, 50, 0, '00:00:00', 0, 1, '0'),
(20, 51, 2, '00:03:00', 260, 0, '1,9'),
(21, 25, 3, '00:01:44', 240, 0, '8,12,13'),
(22, 27, 1, '00:01:11', 280, 0, '14'),
(23, 26, 0, '00:01:33', 300, 0, '0'),
(24, 28, 3, '00:01:41', 240, 0, '5,12,13'),
(25, 30, 12, '00:00:11', 60, 0, '1-3,5,7,9-15'),
(26, 29, 2, '00:01:58', 260, 0, '3,7'),
(27, 14, 1, '00:01:26', 280, 0, '4'),
(28, 18, 0, '00:01:57', 300, 0, '0'),
(29, 19, 3, '00:02:17', 240, 0, '1,8,13'),
(30, 55, 1, '00:03:23', 280, 0, '8'),
(31, 20, 3, '00:01:41', 240, 0, '7,8,10'),
(32, 16, 0, '00:02:48', 300, 0, '0'),
(33, 15, 3, '00:01:49', 240, 0, '1,3,5'),
(34, 17, 0, '00:00:00', 0, 1, '0'),
(35, 60, 0, '00:01:14', 300, 0, '0'),
(36, 2, 10, '00:01:42', 100, 0, '1,3,4,5,7-11,14'),
(37, 9, 1, '00:01:24', 280, 0, '13'),
(38, 10, 1, '00:01:55', 280, 0, '1'),
(39, 11, 1, '00:01:36', 280, 0, '13'),
(40, 23, 2, '00:01:28', 260, 0, '7,8'),
(41, 3, 1, '00:03:05', 280, 0, '9'),
(42, 6, 1, '00:01:32', 280, 0, '1'),
(43, 8, 0, '00:01:20', 300, 0, '0'),
(44, 56, 2, '00:02:54', 260, 0, '12,14'),
(45, 12, 2, '00:01:21', 260, 0, '8,13'),
(46, 58, 7, '00:01:33', 160, 0, '2,3,6,8,9,14,115'),
(47, 24, 3, '00:02:32', 240, 0, '1,5,6'),
(48, 7, 0, '00:00:00', 0, 1, '0'),
(49, 1, 0, '00:00:00', 0, 1, '0'),
(50, 4, 0, '00:00:00', 0, 1, '0'),
(51, 5, 0, '00:00:00', 0, 1, '0'),
(52, 32, 0, '00:01:41', 300, 0, '0'),
(53, 37, 0, '00:00:58', 300, 0, '0'),
(54, 31, 2, '00:01:06', 260, 0, '5,7'),
(55, 36, 2, '00:02:06', 260, 0, '7,13'),
(56, 38, 1, '00:02:38', 280, 0, '7'),
(57, 35, 0, '00:01:24', 300, 0, '0'),
(58, 33, 0, '00:00:00', 0, 1, '0'),
(59, 34, 9, '00:02:24', 120, 0, '2,5,6,9,10-13,15');

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
(1, 'Trofeul Multilor', 'Asociatia de Turism  Montan Via Retezat', 'Master');

-- --------------------------------------------------------

--
-- Table structure for table `orienteering`
--

CREATE TABLE `orienteering` (
  `orienteering_id` int(8) NOT NULL,
  `team_id` mediumint(8) NOT NULL,
  `uuid_card` int(8) NOT NULL,
  `name_participant` varchar(255) NOT NULL,
  `start` varchar(255) NOT NULL,
  `finish` varchar(255) NOT NULL,
  `total` varchar(8) NOT NULL,
  `abandon` mediumint(8) NOT NULL,
  `missed_posts` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orienteering`
--

INSERT INTO `orienteering` (`orienteering_id`, `team_id`, `uuid_card`, `name_participant`, `start`, `finish`, `total`, `abandon`, `missed_posts`) VALUES
(1, 1, 43, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0'),
(2, 2, 44, '-', '09:20:16', '09:32:42', '00:12:26', 0, ''),
(3, 3, 45, '-', '08:58:09', '09:09:19', '00:11:10', 0, ''),
(4, 4, 46, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0'),
(5, 5, 47, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0'),
(6, 6, 48, '-', '07:52:56', '08:04:39', '00:11:43', 0, ''),
(7, 7, 49, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0'),
(8, 8, 50, '-', '08:29:05', '08:38:02', '00:08:57', 0, ''),
(9, 9, 51, '-', '08:01:22', '08:07:31', '00:06:09', 0, ''),
(10, 10, 52, '-', '08:13:24', '08:23:04', '00:09:40', 0, ''),
(11, 11, 53, '-', '00:00:00', '00:00:00', '00:00:00', 0, '32'),
(12, 12, 54, '-', '09:45:45', '09:53:20', '00:07:35', 0, ''),
(13, 14, 29, '-', '08:52:38', '09:04:17', '00:11:39', 0, '30'),
(14, 15, 30, '-', '09:04:41', '09:15:35', '00:10:54', 0, ''),
(15, 16, 31, '-', '07:56:16', '08:06:21', '00:10:05', 0, ''),
(16, 17, 32, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0'),
(17, 18, 33, '-', '08:45:50', '09:03:34', '00:17:44', 0, ''),
(18, 19, 34, '-', '08:06:17', '08:25:33', '00:19:16', 0, '31'),
(19, 20, 35, '-', '08:37:58', '08:53:03', '00:15:05', 0, ''),
(20, 21, 39, '-', '08:32:07', '08:48:11', '00:16:04', 0, ''),
(21, 22, 40, '-', '08:22:56', '08:37:11', '00:14:15', 0, ''),
(22, 23, 56, '-', '09:11:14', '09:21:49', '00:10:35', 0, '33'),
(23, 24, 57, '-', '09:14:55', '09:23:37', '00:08:42', 0, '33'),
(24, 25, 58, '-', '08:36:26', '08:50:49', '00:14:23', 0, ''),
(25, 26, 59, '-', '09:17:18', '09:31:26', '00:14:08', 0, ''),
(26, 27, 60, '-', '08:02:49', '08:23:49', '00:21:00', 0, ''),
(27, 28, 61, '-', '09:35:20', '09:55:01', '00:19:41', 0, ''),
(28, 29, 62, '-', '08:42:06', '08:54:27', '00:12:21', 0, ''),
(29, 30, 63, '-', '09:22:47', '09:49:38', '00:26:51', 0, '252'),
(30, 31, 1, '-', '08:54:46', '09:08:32', '00:13:46', 0, ''),
(31, 32, 2, '-', '09:13:08', '09:21:39', '00:08:31', 0, ''),
(32, 33, 3, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0'),
(33, 34, 4, '-', '08:50:19', '09:06:19', '00:16:00', 0, '37'),
(34, 35, 5, '-', '09:01:19', '09:10:57', '00:09:38', 0, ''),
(35, 36, 6, '-', '09:03:37', '09:16:20', '00:12:43', 0, ''),
(36, 37, 7, '-', '09:06:04', '09:16:40', '00:10:36', 0, ''),
(37, 38, 8, '-', '08:43:14', '08:58:26', '00:15:12', 0, ''),
(38, 39, 11, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0'),
(39, 40, 12, '-', '08:09:42', '08:18:54', '00:09:12', 0, ''),
(40, 41, 13, '-', '08:16:05', '08:28:00', '00:11:55', 0, ''),
(41, 42, 17, '-', '08:47:53', '09:00:09', '00:12:16', 0, ''),
(42, 43, 18, '-', '08:44:27', '08:55:16', '00:10:49', 0, '39,252'),
(43, 44, 19, '-', '08:40:49', '08:55:43', '00:14:54', 0, '36,38,39'),
(44, 45, 20, '-', '09:29:59', '09:39:07', '00:09:08', 0, ''),
(45, 46, 21, '-', '09:21:38', '09:29:43', '00:08:05', 0, ''),
(46, 47, 23, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0'),
(47, 48, 22, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0'),
(48, 49, 24, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0'),
(49, 50, 41, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0'),
(50, 51, 42, '-', '09:07:39', '09:18:02', '00:10:23', 0, ''),
(51, 52, 25, '-', '09:18:49', '09:24:43', '00:05:54', 0, ''),
(52, 53, 26, '-', '09:16:09', '09:25:50', '00:09:41', 0, '39'),
(53, 54, 27, '-', '09:02:03', '09:13:12', '00:11:09', 0, ''),
(54, 55, 36, '-', '09:25:41', '09:36:57', '00:11:16', 0, ''),
(55, 56, 66, '-', '09:32:20', '09:42:41', '00:10:21', 0, ''),
(56, 57, 28, '-', '09:42:33', '09:52:33', '00:10:00', 0, ''),
(57, 58, 67, '-', '09:49:37', '10:04:17', '00:14:40', 0, ''),
(58, 59, 144, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0'),
(59, 60, 55, '-', '07:46:16', '07:51:58', '00:05:42', 0, '');

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
  `minimum_distance_penalty` tinyint(1) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participations`
--

INSERT INTO `participations` (`participation_id`, `team_id`, `category_challenge_id`, `score`, `notes`, `missing_equipment_items`, `missing_footwear`, `abandonment`, `minimum_distance_penalty`) VALUES
(1, 53, 3, NULL, NULL, 0, 0, 1, 0),
(2, 44, 3, NULL, NULL, 3, 0, 0, 0),
(3, 43, 3, NULL, NULL, 0, 0, 0, 0),
(4, 52, 3, NULL, NULL, 0, 0, 0, 0),
(5, 42, 3, NULL, NULL, 0, 0, 0, 0),
(6, 46, 3, NULL, NULL, 0, 0, 0, 0),
(7, 54, 3, NULL, NULL, 0, 0, 0, 0),
(8, 57, 3, NULL, NULL, 0, 0, 0, 0),
(9, 45, 3, NULL, NULL, 2, 0, 0, 0),
(10, 47, 3, NULL, NULL, 0, 0, 1, 0),
(11, 48, 3, NULL, NULL, 0, 0, 1, 0),
(12, 49, 3, NULL, NULL, 0, 0, 1, 0),
(13, 59, 3, NULL, NULL, 0, 0, 1, 0),
(14, 40, 2, NULL, NULL, 0, 0, 0, 0),
(15, 41, 2, NULL, NULL, 0, 0, 0, 0),
(16, 39, 2, NULL, NULL, 0, 0, 1, 0),
(17, 50, 7, NULL, NULL, 0, 0, 1, 0),
(18, 22, 7, NULL, NULL, 0, 0, 0, 0),
(19, 51, 7, NULL, NULL, 0, 0, 0, 0),
(20, 21, 7, NULL, NULL, 0, 0, 0, 0),
(21, 35, 1, NULL, NULL, 0, 0, 0, 0),
(22, 36, 1, NULL, NULL, 1, 0, 0, 0),
(23, 38, 1, NULL, NULL, 0, 0, 0, 0),
(24, 32, 1, NULL, NULL, 0, 0, 0, 0),
(25, 37, 1, NULL, NULL, 1, 0, 0, 0),
(26, 34, 1, NULL, NULL, 1, 0, 0, 0),
(27, 31, 1, NULL, NULL, 1, 0, 0, 0),
(28, 33, 1, NULL, NULL, 0, 0, 1, 0),
(29, 28, 6, NULL, NULL, 0, 0, 0, 0),
(30, 29, 6, NULL, NULL, 0, 0, 0, 0),
(31, 27, 6, NULL, NULL, 0, 0, 0, 0),
(32, 25, 6, NULL, NULL, 2, 0, 0, 0),
(33, 26, 6, NULL, NULL, 0, 0, 0, 0),
(34, 30, 6, NULL, NULL, 0, 0, 1, 0),
(35, 55, 5, NULL, NULL, 0, 0, 0, 0),
(36, 15, 5, NULL, NULL, 0, 0, 0, 0),
(37, 14, 5, NULL, NULL, 0, 0, 0, 0),
(38, 18, 5, NULL, NULL, 0, 0, 0, 0),
(39, 19, 5, NULL, NULL, 0, 0, 0, 0),
(40, 16, 5, NULL, NULL, 0, 0, 0, 0),
(41, 20, 5, NULL, NULL, 0, 0, 0, 0),
(42, 17, 5, NULL, NULL, 0, 0, 1, 0),
(43, 3, 4, NULL, NULL, 0, 0, 0, 0),
(44, 23, 4, NULL, NULL, 0, 0, 0, 0),
(45, 24, 4, NULL, NULL, 0, 0, 0, 0),
(46, 56, 4, NULL, NULL, 0, 0, 0, 0),
(47, 6, 4, NULL, NULL, 0, 0, 0, 0),
(48, 12, 4, NULL, NULL, 0, 0, 0, 0),
(49, 11, 4, NULL, NULL, 0, 0, 0, 0),
(50, 10, 4, NULL, NULL, 0, 0, 0, 0),
(51, 60, 4, NULL, NULL, 0, 0, 0, 0),
(52, 9, 4, NULL, NULL, 0, 0, 0, 0),
(53, 58, 4, NULL, NULL, 0, 0, 0, 0),
(54, 1, 4, NULL, NULL, 0, 0, 1, 0),
(55, 2, 4, NULL, NULL, 0, 0, 1, 0),
(56, 4, 4, NULL, NULL, 0, 0, 1, 0),
(57, 5, 4, NULL, NULL, 0, 0, 1, 0),
(58, 7, 4, NULL, NULL, 0, 0, 1, 0),
(59, 8, 4, NULL, NULL, 0, 0, 1, 0);

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
  `hits` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participation_entries`
--

INSERT INTO `participation_entries` (`entry_id`, `participation_id`, `station_id`, `participant_name`, `time`, `time_start`, `time_finish`, `hits`) VALUES
(1, 1, 20, NULL, NULL, '', '', NULL),
(2, 1, 21, NULL, NULL, '', '', NULL),
(3, 1, 22, NULL, NULL, '', '', NULL),
(4, 1, 23, NULL, NULL, '', '', NULL),
(5, 1, 24, NULL, NULL, NULL, NULL, 1),
(6, 1, 25, NULL, NULL, NULL, NULL, 1),
(7, 1, 26, NULL, NULL, NULL, NULL, 1),
(8, 1, 27, NULL, NULL, NULL, NULL, 1),
(9, 1, 28, NULL, NULL, NULL, NULL, 1),
(10, 1, 29, NULL, NULL, NULL, NULL, 1),
(11, 1, 30, NULL, NULL, NULL, NULL, 1),
(12, 1, 31, NULL, NULL, '', '', NULL),
(13, 2, 20, NULL, NULL, '09:00:00', '', NULL),
(14, 2, 21, NULL, NULL, '10:32:00', '10:18:00', NULL),
(15, 2, 22, NULL, NULL, '13:12:00', '12:42:00', NULL),
(16, 2, 23, NULL, NULL, '14:38:00', '14:30:00', NULL),
(17, 2, 24, NULL, NULL, NULL, NULL, 1),
(18, 2, 25, NULL, NULL, NULL, NULL, 1),
(19, 2, 26, NULL, NULL, NULL, NULL, 1),
(20, 2, 27, NULL, NULL, NULL, NULL, 1),
(21, 2, 28, NULL, NULL, NULL, NULL, 1),
(22, 2, 29, NULL, NULL, NULL, NULL, 1),
(23, 2, 30, NULL, NULL, NULL, NULL, 1),
(24, 2, 31, NULL, NULL, '', '16:00:00', NULL),
(25, 3, 20, NULL, NULL, '09:00:00', '', NULL),
(26, 3, 21, NULL, NULL, '10:38:00', '10:18:00', NULL),
(27, 3, 22, NULL, NULL, '12:52:00', '12:22:00', NULL),
(28, 3, 23, NULL, NULL, '14:07:00', '14:00:00', NULL),
(29, 3, 24, NULL, NULL, NULL, NULL, 1),
(30, 3, 25, NULL, NULL, NULL, NULL, 1),
(31, 3, 26, NULL, NULL, NULL, NULL, 1),
(32, 3, 27, NULL, NULL, NULL, NULL, 1),
(33, 3, 28, NULL, NULL, NULL, NULL, 1),
(34, 3, 29, NULL, NULL, NULL, NULL, 1),
(35, 3, 30, NULL, NULL, NULL, NULL, 1),
(36, 3, 31, NULL, NULL, '', '15:16:00', NULL),
(37, 4, 20, NULL, NULL, '09:36:00', '', NULL),
(38, 4, 21, NULL, NULL, '11:04:00', '10:44:00', NULL),
(39, 4, 22, NULL, NULL, '12:57:00', '12:27:00', NULL),
(40, 4, 23, NULL, NULL, '14:07:00', '13:52:00', NULL),
(41, 4, 24, NULL, NULL, NULL, NULL, 1),
(42, 4, 25, NULL, NULL, NULL, NULL, 1),
(43, 4, 26, NULL, NULL, NULL, NULL, 1),
(44, 4, 27, NULL, NULL, NULL, NULL, 1),
(45, 4, 28, NULL, NULL, NULL, NULL, 1),
(46, 4, 29, NULL, NULL, NULL, NULL, 1),
(47, 4, 30, NULL, NULL, NULL, NULL, 1),
(48, 4, 31, NULL, NULL, '', '14:54:00', NULL),
(49, 5, 20, NULL, NULL, '09:10:00', '', NULL),
(50, 5, 21, NULL, NULL, '10:47:00', '10:27:00', NULL),
(51, 5, 22, NULL, NULL, '12:22:00', '12:19:00', NULL),
(52, 5, 23, NULL, NULL, '13:54:00', '13:39:00', NULL),
(53, 5, 24, NULL, NULL, NULL, NULL, 1),
(54, 5, 25, NULL, NULL, NULL, NULL, 1),
(55, 5, 26, NULL, NULL, NULL, NULL, 1),
(56, 5, 27, NULL, NULL, NULL, NULL, 1),
(57, 5, 28, NULL, NULL, NULL, NULL, 1),
(58, 5, 29, NULL, NULL, NULL, NULL, 1),
(59, 5, 30, NULL, NULL, NULL, NULL, 1),
(60, 5, 31, NULL, NULL, '', '15:00:00', NULL),
(61, 6, 20, NULL, NULL, '09:35:00', '', NULL),
(62, 6, 21, NULL, NULL, '10:47:00', '10:27:00', NULL),
(63, 6, 22, NULL, NULL, '12:36:00', '12:06:00', NULL),
(64, 6, 23, NULL, NULL, '13:35:00', '13:21:00', NULL),
(65, 6, 24, NULL, NULL, NULL, NULL, 1),
(66, 6, 25, NULL, NULL, NULL, NULL, 1),
(67, 6, 26, NULL, NULL, NULL, NULL, 1),
(68, 6, 27, NULL, NULL, NULL, NULL, 1),
(69, 6, 28, NULL, NULL, NULL, NULL, 1),
(70, 6, 29, NULL, NULL, NULL, NULL, 1),
(71, 6, 30, NULL, NULL, NULL, NULL, 1),
(72, 6, 31, NULL, NULL, '', '14:21:00', NULL),
(73, 7, 20, NULL, NULL, '09:23:00', '', NULL),
(74, 7, 21, NULL, NULL, '11:54:00', '11:34:00', NULL),
(75, 7, 22, NULL, NULL, '15:35:00', '15:05:00', NULL),
(76, 7, 23, NULL, NULL, '17:04:00', '16:54:00', NULL),
(77, 7, 24, NULL, NULL, NULL, NULL, 1),
(78, 7, 25, NULL, NULL, NULL, NULL, 1),
(79, 7, 26, NULL, NULL, NULL, NULL, 1),
(80, 7, 27, NULL, NULL, NULL, NULL, 1),
(81, 7, 28, NULL, NULL, NULL, NULL, 1),
(82, 7, 29, NULL, NULL, NULL, NULL, 1),
(83, 7, 30, NULL, NULL, NULL, NULL, 1),
(84, 7, 31, NULL, NULL, '', '18:52:00', NULL),
(85, 8, 20, NULL, NULL, '10:02:00', '', NULL),
(86, 8, 21, NULL, NULL, '12:08:00', '11:48:00', NULL),
(87, 8, 22, NULL, NULL, '14:56:00', '14:26:00', NULL),
(88, 8, 23, NULL, NULL, '16:40:00', '16:26:00', NULL),
(89, 8, 24, NULL, NULL, NULL, NULL, 1),
(90, 8, 25, NULL, NULL, NULL, NULL, 1),
(91, 8, 26, NULL, NULL, NULL, NULL, 1),
(92, 8, 27, NULL, NULL, NULL, NULL, 1),
(93, 8, 28, NULL, NULL, NULL, NULL, 1),
(94, 8, 29, NULL, NULL, NULL, NULL, 1),
(95, 8, 30, NULL, NULL, NULL, NULL, 1),
(96, 8, 31, NULL, NULL, '', '18:14:00', NULL),
(97, 9, 20, NULL, NULL, '09:49:00', '', NULL),
(98, 9, 21, NULL, NULL, '12:03:00', '11:43:00', NULL),
(99, 9, 22, NULL, NULL, '14:22:00', '14:07:00', NULL),
(100, 9, 23, NULL, NULL, '16:06:ss', '15:50:00', NULL),
(101, 9, 24, NULL, NULL, NULL, NULL, 1),
(102, 9, 25, NULL, NULL, NULL, NULL, 1),
(103, 9, 26, NULL, NULL, NULL, NULL, 1),
(104, 9, 27, NULL, NULL, NULL, NULL, 0),
(105, 9, 28, NULL, NULL, NULL, NULL, 1),
(106, 9, 29, NULL, NULL, NULL, NULL, 0),
(107, 9, 30, NULL, NULL, NULL, NULL, 1),
(108, 9, 31, NULL, NULL, '', '17:31:00', NULL),
(109, 10, 20, NULL, NULL, '', '', NULL),
(110, 10, 21, NULL, NULL, '', '', NULL),
(111, 10, 22, NULL, NULL, '', '', NULL),
(112, 10, 23, NULL, NULL, '', '', NULL),
(113, 10, 24, NULL, NULL, NULL, NULL, 1),
(114, 10, 25, NULL, NULL, NULL, NULL, 1),
(115, 10, 26, NULL, NULL, NULL, NULL, 1),
(116, 10, 27, NULL, NULL, NULL, NULL, 1),
(117, 10, 28, NULL, NULL, NULL, NULL, 1),
(118, 10, 29, NULL, NULL, NULL, NULL, 1),
(119, 10, 30, NULL, NULL, NULL, NULL, 1),
(120, 10, 31, NULL, NULL, '', '', NULL),
(121, 11, 20, NULL, NULL, '', '', NULL),
(122, 11, 21, NULL, NULL, '', '', NULL),
(123, 11, 22, NULL, NULL, '', '', NULL),
(124, 11, 23, NULL, NULL, '', '', NULL),
(125, 11, 24, NULL, NULL, NULL, NULL, 1),
(126, 11, 25, NULL, NULL, NULL, NULL, 1),
(127, 11, 26, NULL, NULL, NULL, NULL, 1),
(128, 11, 27, NULL, NULL, NULL, NULL, 1),
(129, 11, 28, NULL, NULL, NULL, NULL, 1),
(130, 11, 29, NULL, NULL, NULL, NULL, 1),
(131, 11, 30, NULL, NULL, NULL, NULL, 1),
(132, 11, 31, NULL, NULL, '', '', NULL),
(133, 12, 20, NULL, NULL, '', '', NULL),
(134, 12, 21, NULL, NULL, '', '', NULL),
(135, 12, 22, NULL, NULL, '', '', NULL),
(136, 12, 23, NULL, NULL, '', '', NULL),
(137, 12, 24, NULL, NULL, NULL, NULL, 1),
(138, 12, 25, NULL, NULL, NULL, NULL, 1),
(139, 12, 26, NULL, NULL, NULL, NULL, 1),
(140, 12, 27, NULL, NULL, NULL, NULL, 1),
(141, 12, 28, NULL, NULL, NULL, NULL, 1),
(142, 12, 29, NULL, NULL, NULL, NULL, 1),
(143, 12, 30, NULL, NULL, NULL, NULL, 1),
(144, 12, 31, NULL, NULL, '', '', NULL),
(145, 13, 20, NULL, NULL, '', '', NULL),
(146, 13, 21, NULL, NULL, '', '', NULL),
(147, 13, 22, NULL, NULL, '', '', NULL),
(148, 13, 23, NULL, NULL, '', '', NULL),
(149, 13, 24, NULL, NULL, NULL, NULL, 1),
(150, 13, 25, NULL, NULL, NULL, NULL, 1),
(151, 13, 26, NULL, NULL, NULL, NULL, 1),
(152, 13, 27, NULL, NULL, NULL, NULL, 1),
(153, 13, 28, NULL, NULL, NULL, NULL, 1),
(154, 13, 29, NULL, NULL, NULL, NULL, 1),
(155, 13, 30, NULL, NULL, NULL, NULL, 1),
(156, 13, 31, NULL, NULL, '', '', NULL),
(157, 14, 8, NULL, NULL, '08:24:00', '', NULL),
(158, 14, 9, NULL, NULL, '10:08:00', '09:48:00', NULL),
(159, 14, 10, NULL, NULL, '12:00:00', '11:30:00', NULL),
(160, 14, 11, NULL, NULL, '13:03:00', '12:48:00', NULL),
(161, 14, 12, NULL, NULL, NULL, NULL, 1),
(162, 14, 13, NULL, NULL, NULL, NULL, 1),
(163, 14, 14, NULL, NULL, NULL, NULL, 1),
(164, 14, 15, NULL, NULL, NULL, NULL, 1),
(165, 14, 16, NULL, NULL, NULL, NULL, 1),
(166, 14, 17, NULL, NULL, NULL, NULL, 1),
(167, 14, 18, NULL, NULL, NULL, NULL, 1),
(168, 14, 19, NULL, NULL, '', '13:46:00', NULL),
(169, 15, 8, NULL, NULL, '08:38:00', '', NULL),
(170, 15, 9, NULL, NULL, '10:09:00', '09:49:00', NULL),
(171, 15, 10, NULL, NULL, '11:55:00', '11:25:00', NULL),
(172, 15, 11, NULL, NULL, '12:59:00', '12:45:00', NULL),
(173, 15, 12, NULL, NULL, NULL, NULL, 1),
(174, 15, 13, NULL, NULL, NULL, NULL, 1),
(175, 15, 14, NULL, NULL, NULL, NULL, 1),
(176, 15, 15, NULL, NULL, NULL, NULL, 1),
(177, 15, 16, NULL, NULL, NULL, NULL, 1),
(178, 15, 17, NULL, NULL, NULL, NULL, 1),
(179, 15, 18, NULL, NULL, NULL, NULL, 1),
(180, 15, 19, NULL, NULL, '', '13:45:40', NULL),
(181, 16, 8, NULL, NULL, '', '', NULL),
(182, 16, 9, NULL, NULL, '', '', NULL),
(183, 16, 10, NULL, NULL, '', '', NULL),
(184, 16, 11, NULL, NULL, '', '', NULL),
(185, 16, 12, NULL, NULL, NULL, NULL, 1),
(186, 16, 13, NULL, NULL, NULL, NULL, 1),
(187, 16, 14, NULL, NULL, NULL, NULL, 1),
(188, 16, 15, NULL, NULL, NULL, NULL, 1),
(189, 16, 16, NULL, NULL, NULL, NULL, 1),
(190, 16, 17, NULL, NULL, NULL, NULL, 1),
(191, 16, 18, NULL, NULL, NULL, NULL, 1),
(192, 16, 19, NULL, NULL, '', '', NULL),
(193, 17, 68, NULL, NULL, '', '', NULL),
(194, 17, 69, NULL, NULL, '', '', NULL),
(195, 17, 70, NULL, NULL, '', '', NULL),
(196, 17, 71, NULL, NULL, '', '', NULL),
(197, 17, 72, NULL, NULL, NULL, NULL, 1),
(198, 17, 73, NULL, NULL, NULL, NULL, 1),
(199, 17, 74, NULL, NULL, NULL, NULL, 1),
(200, 17, 75, NULL, NULL, NULL, NULL, 1),
(201, 17, 76, NULL, NULL, NULL, NULL, 1),
(202, 17, 77, NULL, NULL, NULL, NULL, 1),
(203, 17, 78, NULL, NULL, NULL, NULL, 1),
(204, 17, 79, NULL, NULL, '', '', NULL),
(205, 18, 68, NULL, NULL, '08:46:00', '', NULL),
(206, 18, 69, NULL, NULL, '10:40:00', '10:20:00', NULL),
(207, 18, 70, NULL, NULL, '13:12:00', '12:52:00', NULL),
(208, 18, 71, NULL, NULL, '14:40:00', '14:25:00', NULL),
(209, 18, 72, NULL, NULL, NULL, NULL, 1),
(210, 18, 73, NULL, NULL, NULL, NULL, 1),
(211, 18, 74, NULL, NULL, NULL, NULL, 1),
(212, 18, 75, NULL, NULL, NULL, NULL, 1),
(213, 18, 76, NULL, NULL, NULL, NULL, 1),
(214, 18, 77, NULL, NULL, NULL, NULL, 1),
(215, 18, 78, NULL, NULL, NULL, NULL, 1),
(216, 18, 79, NULL, NULL, '', '15:57:00', NULL),
(217, 19, 68, NULL, NULL, '09:25:00', '', NULL),
(218, 19, 69, NULL, NULL, '10:47:00', '10:27:00', NULL),
(219, 19, 70, NULL, NULL, '13:12:00', '12:42:00', NULL),
(220, 19, 71, NULL, NULL, '14:21:00', '14:06:00', NULL),
(221, 19, 72, NULL, NULL, NULL, NULL, 1),
(222, 19, 73, NULL, NULL, NULL, NULL, 1),
(223, 19, 74, NULL, NULL, NULL, NULL, 1),
(224, 19, 75, NULL, NULL, NULL, NULL, 1),
(225, 19, 76, NULL, NULL, NULL, NULL, 1),
(226, 19, 77, NULL, NULL, NULL, NULL, 1),
(227, 19, 78, NULL, NULL, NULL, NULL, 1),
(228, 19, 79, NULL, NULL, '', '15:20:00', NULL),
(229, 20, 68, NULL, NULL, '08:53:00', '', NULL),
(230, 20, 69, NULL, NULL, '10:54:00', '10:34:00', NULL),
(231, 20, 70, NULL, NULL, '13:43:00', '13:13:00', NULL),
(232, 20, 71, NULL, NULL, '15:30:00', '15:21:00', NULL),
(233, 20, 72, NULL, NULL, NULL, NULL, 1),
(234, 20, 73, NULL, NULL, NULL, NULL, 1),
(235, 20, 74, NULL, NULL, NULL, NULL, 1),
(236, 20, 75, NULL, NULL, NULL, NULL, 1),
(237, 20, 76, NULL, NULL, NULL, NULL, 1),
(238, 20, 77, NULL, NULL, NULL, NULL, 1),
(239, 20, 78, NULL, NULL, NULL, NULL, 1),
(240, 20, 79, NULL, NULL, '', '17:02:00', NULL),
(241, 21, 1, NULL, NULL, '09:21:00', '', NULL),
(242, 21, 2, NULL, NULL, '11:46:00', '11:06:00', NULL),
(243, 21, 3, NULL, NULL, NULL, NULL, 1),
(244, 21, 4, NULL, NULL, NULL, NULL, 1),
(245, 21, 5, NULL, NULL, NULL, NULL, 1),
(246, 21, 6, NULL, NULL, NULL, NULL, 1),
(247, 21, 7, NULL, NULL, '', '13:24:00', NULL),
(248, 22, 1, NULL, NULL, '09:20:00', '', NULL),
(249, 22, 2, NULL, NULL, '11:48:00', '11:08:00', NULL),
(250, 22, 3, NULL, NULL, NULL, NULL, 1),
(251, 22, 4, NULL, NULL, NULL, NULL, 1),
(252, 22, 5, NULL, NULL, NULL, NULL, 1),
(253, 22, 6, NULL, NULL, NULL, NULL, 1),
(254, 22, 7, NULL, NULL, '', '13:22:00', NULL),
(255, 23, 1, NULL, NULL, '09:07:00', '', NULL),
(256, 23, 2, NULL, NULL, '11:41:00', '11:14:00', NULL),
(257, 23, 3, NULL, NULL, NULL, NULL, 1),
(258, 23, 4, NULL, NULL, NULL, NULL, 1),
(259, 23, 5, NULL, NULL, NULL, NULL, 1),
(260, 23, 6, NULL, NULL, NULL, NULL, 1),
(261, 23, 7, NULL, NULL, '', '13:12:00', NULL),
(262, 24, 1, NULL, NULL, '09:32:00', '', NULL),
(263, 24, 2, NULL, NULL, '11:34:00', '10:54:00', NULL),
(264, 24, 3, NULL, NULL, NULL, NULL, 1),
(265, 24, 4, NULL, NULL, NULL, NULL, 1),
(266, 24, 5, NULL, NULL, NULL, NULL, 1),
(267, 24, 6, NULL, NULL, NULL, NULL, 1),
(268, 24, 7, NULL, NULL, '', '13:04:00', NULL),
(269, 25, 1, NULL, NULL, '09:23:00', '', NULL),
(270, 25, 2, NULL, NULL, '11:11:00', '10:41:00', NULL),
(271, 25, 3, NULL, NULL, NULL, NULL, 1),
(272, 25, 4, NULL, NULL, NULL, NULL, 1),
(273, 25, 5, NULL, NULL, NULL, NULL, 1),
(274, 25, 6, NULL, NULL, NULL, NULL, 1),
(275, 25, 7, NULL, NULL, '', '12:28:00', NULL),
(276, 26, 1, NULL, NULL, '09:16:00', '', NULL),
(277, 26, 2, NULL, NULL, '12:10:00', '11:30:00', NULL),
(278, 26, 3, NULL, NULL, NULL, NULL, 1),
(279, 26, 4, NULL, NULL, NULL, NULL, 1),
(280, 26, 5, NULL, NULL, NULL, NULL, 1),
(281, 26, 6, NULL, NULL, NULL, NULL, 1),
(282, 26, 7, NULL, NULL, '', '14:31:00', NULL),
(283, 27, 1, NULL, NULL, '09:18:00', '', NULL),
(284, 27, 2, NULL, NULL, '12:13:00', '11:33:00', NULL),
(285, 27, 3, NULL, NULL, NULL, NULL, 1),
(286, 27, 4, NULL, NULL, NULL, NULL, 1),
(287, 27, 5, NULL, NULL, NULL, NULL, 1),
(288, 27, 6, NULL, NULL, NULL, NULL, 1),
(289, 27, 7, NULL, NULL, '', '13:57:00', NULL),
(290, 28, 1, NULL, NULL, '', '', NULL),
(291, 28, 2, NULL, NULL, '', '', NULL),
(292, 28, 3, NULL, NULL, NULL, NULL, 1),
(293, 28, 4, NULL, NULL, NULL, NULL, 1),
(294, 28, 5, NULL, NULL, NULL, NULL, 1),
(295, 28, 6, NULL, NULL, NULL, NULL, 1),
(296, 28, 7, NULL, NULL, '', '', NULL),
(297, 29, 56, NULL, NULL, '10:05:00', '', NULL),
(298, 29, 57, NULL, NULL, '11:54:00', '11:34:00', NULL),
(299, 29, 58, NULL, NULL, '14:04:00', '13:49:00', NULL),
(300, 29, 59, NULL, NULL, '15:33:00', '15:21:00', NULL),
(301, 29, 60, NULL, NULL, NULL, NULL, 1),
(302, 29, 61, NULL, NULL, NULL, NULL, 1),
(303, 29, 62, NULL, NULL, NULL, NULL, 1),
(304, 29, 63, NULL, NULL, NULL, NULL, 1),
(305, 29, 64, NULL, NULL, NULL, NULL, 1),
(306, 29, 65, NULL, NULL, NULL, NULL, 1),
(307, 29, 66, NULL, NULL, NULL, NULL, 1),
(308, 29, 67, NULL, NULL, '', '16:39:00', NULL),
(309, 30, 56, NULL, NULL, '09:10:00', '', NULL),
(310, 30, 57, NULL, NULL, '10:30:00', '10:10:00', NULL),
(311, 30, 58, NULL, NULL, '12:16:00', '11:46:00', NULL),
(312, 30, 59, NULL, NULL, '13:04:00', '13:00:00', NULL),
(313, 30, 60, NULL, NULL, NULL, NULL, 1),
(314, 30, 61, NULL, NULL, NULL, NULL, 1),
(315, 30, 62, NULL, NULL, NULL, NULL, 1),
(316, 30, 63, NULL, NULL, NULL, NULL, 1),
(317, 30, 64, NULL, NULL, NULL, NULL, 1),
(318, 30, 65, NULL, NULL, NULL, NULL, 1),
(319, 30, 66, NULL, NULL, NULL, NULL, 1),
(320, 30, 67, NULL, NULL, '', '13:46:00', NULL),
(321, 31, 56, NULL, NULL, '08:34:00', '', NULL),
(322, 31, 57, NULL, NULL, '10:26:00', '10:06:00', NULL),
(323, 31, 58, NULL, NULL, '12:39:00', '12:09:00', NULL),
(324, 31, 59, NULL, NULL, '14:06:00', '13:51:00', NULL),
(325, 31, 60, NULL, NULL, NULL, NULL, 1),
(326, 31, 61, NULL, NULL, NULL, NULL, 1),
(327, 31, 62, NULL, NULL, NULL, NULL, 1),
(328, 31, 63, NULL, NULL, NULL, NULL, 1),
(329, 31, 64, NULL, NULL, NULL, NULL, 1),
(330, 31, 65, NULL, NULL, NULL, NULL, 1),
(331, 31, 66, NULL, NULL, NULL, NULL, 1),
(332, 31, 67, NULL, NULL, '', '15:08:00', NULL),
(333, 32, 56, NULL, NULL, '08:56:00', '', NULL),
(334, 32, 57, NULL, NULL, '10:53:00', '10:33:00', NULL),
(335, 32, 58, NULL, NULL, '13:23:00', '12:58:00', NULL),
(336, 32, 59, NULL, NULL, '15:32:00', '15:21:00', NULL),
(337, 32, 60, NULL, NULL, NULL, NULL, 1),
(338, 32, 61, NULL, NULL, NULL, NULL, 1),
(339, 32, 62, NULL, NULL, NULL, NULL, 1),
(340, 32, 63, NULL, NULL, NULL, NULL, 1),
(341, 32, 64, NULL, NULL, NULL, NULL, 1),
(342, 32, 65, NULL, NULL, NULL, NULL, 1),
(343, 32, 66, NULL, NULL, NULL, NULL, 1),
(344, 32, 67, NULL, NULL, '', '17:03:00', NULL),
(345, 33, 56, NULL, NULL, '09:36:00', '', NULL),
(346, 33, 57, NULL, NULL, '11:03:00', '10:43:00', NULL),
(347, 33, 58, NULL, NULL, '13:19:00', '12:49:00', NULL),
(348, 33, 59, NULL, NULL, '14:46:00', '14:31:00', NULL),
(349, 33, 60, NULL, NULL, NULL, NULL, 1),
(350, 33, 61, NULL, NULL, NULL, NULL, 1),
(351, 33, 62, NULL, NULL, NULL, NULL, 1),
(352, 33, 63, NULL, NULL, NULL, NULL, 1),
(353, 33, 64, NULL, NULL, NULL, NULL, 1),
(354, 33, 65, NULL, NULL, NULL, NULL, 1),
(355, 33, 66, NULL, NULL, NULL, NULL, 1),
(356, 33, 67, NULL, NULL, '', '15:57:00', NULL),
(357, 34, 56, NULL, NULL, '', '', NULL),
(358, 34, 57, NULL, NULL, '', '', NULL),
(359, 34, 58, NULL, NULL, '', '', NULL),
(360, 34, 59, NULL, NULL, '', '', NULL),
(361, 34, 60, NULL, NULL, NULL, NULL, 1),
(362, 34, 61, NULL, NULL, NULL, NULL, 1),
(363, 34, 62, NULL, NULL, NULL, NULL, 1),
(364, 34, 63, NULL, NULL, NULL, NULL, 1),
(365, 34, 64, NULL, NULL, NULL, NULL, 1),
(366, 34, 65, NULL, NULL, NULL, NULL, 1),
(367, 34, 66, NULL, NULL, NULL, NULL, 1),
(368, 34, 67, NULL, NULL, '', '', NULL),
(369, 35, 44, NULL, NULL, '09:42:00', '', NULL),
(370, 35, 45, NULL, NULL, '11:13:00', '10:53:00', NULL),
(371, 35, 46, NULL, NULL, '13:34:00', '13:04:00', NULL),
(372, 35, 47, NULL, NULL, '14:56:00', '14:41:00', NULL),
(373, 35, 48, NULL, NULL, NULL, NULL, 1),
(374, 35, 49, NULL, NULL, NULL, NULL, 1),
(375, 35, 50, NULL, NULL, NULL, NULL, 1),
(376, 35, 51, NULL, NULL, NULL, NULL, 1),
(377, 35, 52, NULL, NULL, NULL, NULL, 1),
(378, 35, 53, NULL, NULL, NULL, NULL, 1),
(379, 35, 54, NULL, NULL, NULL, NULL, 1),
(380, 35, 55, NULL, NULL, '', '15:59:00', NULL),
(381, 36, 44, NULL, NULL, '09:21:00', '', NULL),
(382, 36, 45, NULL, NULL, '10:44:00', '10:24:00', NULL),
(383, 36, 46, NULL, NULL, '13:00:00', '12:45:00', NULL),
(384, 36, 47, NULL, NULL, '14:32:00', '14:22:00', NULL),
(385, 36, 48, NULL, NULL, NULL, NULL, 1),
(386, 36, 49, NULL, NULL, NULL, NULL, 1),
(387, 36, 50, NULL, NULL, NULL, NULL, 1),
(388, 36, 51, NULL, NULL, NULL, NULL, 1),
(389, 36, 52, NULL, NULL, NULL, NULL, 1),
(390, 36, 53, NULL, NULL, NULL, NULL, 1),
(391, 36, 54, NULL, NULL, NULL, NULL, 1),
(392, 36, 55, NULL, NULL, '', '15:49:00', NULL),
(393, 37, 44, NULL, NULL, '09:10:00', '', NULL),
(394, 37, 45, NULL, NULL, '10:45:00', '10:25:00', NULL),
(395, 37, 46, NULL, NULL, '12:53:00', '12:31:00', NULL),
(396, 37, 47, NULL, NULL, '14:06:00', '13:54:00', NULL),
(397, 37, 48, NULL, NULL, NULL, NULL, 1),
(398, 37, 49, NULL, NULL, NULL, NULL, 1),
(399, 37, 50, NULL, NULL, NULL, NULL, 1),
(400, 37, 51, NULL, NULL, NULL, NULL, 1),
(401, 37, 52, NULL, NULL, NULL, NULL, 1),
(402, 37, 53, NULL, NULL, NULL, NULL, 1),
(403, 37, 54, NULL, NULL, NULL, NULL, 1),
(404, 37, 55, NULL, NULL, '', '15:07:00', NULL),
(405, 38, 44, NULL, NULL, '09:13:00', '', NULL),
(406, 38, 45, NULL, NULL, '10:51:00', '10:31:00', NULL),
(407, 38, 46, NULL, NULL, '12:53:00', '12:38:00', NULL),
(408, 38, 47, NULL, NULL, '14:04:00', '13:49:00', NULL),
(409, 38, 48, NULL, NULL, NULL, NULL, 1),
(410, 38, 49, NULL, NULL, NULL, NULL, 1),
(411, 38, 50, NULL, NULL, NULL, NULL, 1),
(412, 38, 51, NULL, NULL, NULL, NULL, 1),
(413, 38, 52, NULL, NULL, NULL, NULL, 1),
(414, 38, 53, NULL, NULL, NULL, NULL, 1),
(415, 38, 54, NULL, NULL, NULL, NULL, 1),
(416, 38, 55, NULL, NULL, '', '15:03:00', NULL),
(417, 39, 44, NULL, NULL, '08:35:00', '', NULL),
(418, 39, 45, NULL, NULL, '10:17:00', '09:57:00', NULL),
(419, 39, 46, NULL, NULL, '12:19:00', '11:49:00', NULL),
(420, 39, 47, NULL, NULL, '13:25:00', '13:10:00', NULL),
(421, 39, 48, NULL, NULL, NULL, NULL, 1),
(422, 39, 49, NULL, NULL, NULL, NULL, 1),
(423, 39, 50, NULL, NULL, NULL, NULL, 1),
(424, 39, 51, NULL, NULL, NULL, NULL, 1),
(425, 39, 52, NULL, NULL, NULL, NULL, 1),
(426, 39, 53, NULL, NULL, NULL, NULL, 1),
(427, 39, 54, NULL, NULL, NULL, NULL, 1),
(428, 39, 55, NULL, NULL, '', '14:18:00', NULL),
(429, 40, 44, NULL, NULL, '08:12:00', '', NULL),
(430, 40, 45, NULL, NULL, '09:38:00', '09:18:00', NULL),
(431, 40, 46, NULL, NULL, '11:31:00', '11:01:00', NULL),
(432, 40, 47, NULL, NULL, '12:43:00', '12:35:00', NULL),
(433, 40, 48, NULL, NULL, NULL, NULL, 1),
(434, 40, 49, NULL, NULL, NULL, NULL, 1),
(435, 40, 50, NULL, NULL, NULL, NULL, 1),
(436, 40, 51, NULL, NULL, NULL, NULL, 1),
(437, 40, 52, NULL, NULL, NULL, NULL, 1),
(438, 40, 53, NULL, NULL, NULL, NULL, 1),
(439, 40, 54, NULL, NULL, NULL, NULL, 1),
(440, 40, 55, NULL, NULL, '', '13:51:00', NULL),
(441, 41, 44, NULL, NULL, '09:03:00', '', NULL),
(442, 41, 45, NULL, NULL, '10:45:00', '10:25:00', NULL),
(443, 41, 46, NULL, NULL, '13:21:00', '12:51:00', NULL),
(444, 41, 47, NULL, NULL, '14:52:00', '14:42:00', NULL),
(445, 41, 48, NULL, NULL, NULL, NULL, 1),
(446, 41, 49, NULL, NULL, NULL, NULL, 1),
(447, 41, 50, NULL, NULL, NULL, NULL, 1),
(448, 41, 51, NULL, NULL, NULL, NULL, 1),
(449, 41, 52, NULL, NULL, NULL, NULL, 1),
(450, 41, 53, NULL, NULL, NULL, NULL, 1),
(451, 41, 54, NULL, NULL, NULL, NULL, 1),
(452, 41, 55, NULL, NULL, '', '16:36:00', NULL),
(453, 42, 44, NULL, NULL, '', '', NULL),
(454, 42, 45, NULL, NULL, '', '', NULL),
(455, 42, 46, NULL, NULL, '', '', NULL),
(456, 42, 47, NULL, NULL, '', '', NULL),
(457, 42, 48, NULL, NULL, NULL, NULL, 1),
(458, 42, 49, NULL, NULL, NULL, NULL, 1),
(459, 42, 50, NULL, NULL, NULL, NULL, 1),
(460, 42, 51, NULL, NULL, NULL, NULL, 1),
(461, 42, 52, NULL, NULL, NULL, NULL, 1),
(462, 42, 53, NULL, NULL, NULL, NULL, 1),
(463, 42, 54, NULL, NULL, NULL, NULL, 1),
(464, 42, 55, NULL, NULL, '', '', NULL),
(465, 43, 32, NULL, NULL, '09:15:00', '', NULL),
(466, 43, 33, NULL, NULL, '10:45:00', '10:25:00', NULL),
(467, 43, 34, NULL, NULL, '13:57:00', '13:42:00', NULL),
(468, 43, 35, NULL, NULL, '15:10:00', '14:56:00', NULL),
(469, 43, 37, NULL, NULL, NULL, NULL, 1),
(470, 43, 38, NULL, NULL, NULL, NULL, 1),
(471, 43, 39, NULL, NULL, NULL, NULL, 1),
(472, 43, 40, NULL, NULL, NULL, NULL, 1),
(473, 43, 41, NULL, NULL, NULL, NULL, 1),
(474, 43, 42, NULL, NULL, NULL, NULL, 1),
(475, 43, 43, NULL, NULL, NULL, NULL, 1),
(476, 43, 36, NULL, NULL, '', '16:22:00', NULL),
(477, 44, 32, NULL, NULL, '09:32:00', '', NULL),
(478, 44, 33, NULL, NULL, '11:26:00', '11:06:00', NULL),
(479, 44, 34, NULL, NULL, '15:15:00', '14:51:00', NULL),
(480, 44, 35, NULL, NULL, '16:32:00', '16:31:00', NULL),
(481, 44, 37, NULL, NULL, NULL, NULL, 1),
(482, 44, 38, NULL, NULL, NULL, NULL, 1),
(483, 44, 39, NULL, NULL, NULL, NULL, 1),
(484, 44, 40, NULL, NULL, NULL, NULL, 1),
(485, 44, 41, NULL, NULL, NULL, NULL, 1),
(486, 44, 42, NULL, NULL, NULL, NULL, 1),
(487, 44, 43, NULL, NULL, NULL, NULL, 1),
(488, 44, 36, NULL, NULL, '', '17:39:00', NULL),
(489, 45, 32, NULL, NULL, '09:34:00', '', NULL),
(490, 45, 33, NULL, NULL, '11:26:00', '11:06:00', NULL),
(491, 45, 34, NULL, NULL, '15:15:00', '14:51:00', NULL),
(492, 45, 35, NULL, NULL, '16:32:00', '16:31:00', NULL),
(493, 45, 37, NULL, NULL, NULL, NULL, 1),
(494, 45, 38, NULL, NULL, NULL, NULL, 1),
(495, 45, 39, NULL, NULL, NULL, NULL, 1),
(496, 45, 40, NULL, NULL, NULL, NULL, 1),
(497, 45, 41, NULL, NULL, NULL, NULL, 1),
(498, 45, 42, NULL, NULL, NULL, NULL, 1),
(499, 45, 43, NULL, NULL, NULL, NULL, 1),
(500, 45, 36, NULL, NULL, '', '17:39:00', NULL),
(501, 46, 32, NULL, NULL, '09:53:00', '', NULL),
(502, 46, 33, NULL, NULL, '11:27:00', '11:07:00', NULL),
(503, 46, 34, NULL, NULL, '14:55:00', '14:25:00', NULL),
(504, 46, 35, NULL, NULL, '16:38:00', '16:17:00', NULL),
(505, 46, 37, NULL, NULL, NULL, NULL, 1),
(506, 46, 38, NULL, NULL, NULL, NULL, 1),
(507, 46, 39, NULL, NULL, NULL, NULL, 1),
(508, 46, 40, NULL, NULL, NULL, NULL, 1),
(509, 46, 41, NULL, NULL, NULL, NULL, 1),
(510, 46, 42, NULL, NULL, NULL, NULL, 1),
(511, 46, 43, NULL, NULL, NULL, NULL, 1),
(512, 46, 36, NULL, NULL, '', '18:06:00', NULL),
(513, 47, 32, NULL, NULL, '08:10:00', '', NULL),
(514, 47, 33, NULL, NULL, '09:23:00', '09:13:00', NULL),
(515, 47, 34, NULL, NULL, '12:02:00', '11:32:00', NULL),
(516, 47, 35, NULL, NULL, '13:12:00', '12:58:00', NULL),
(517, 47, 37, NULL, NULL, NULL, NULL, 1),
(518, 47, 38, NULL, NULL, NULL, NULL, 1),
(519, 47, 39, NULL, NULL, NULL, NULL, 1),
(520, 47, 40, NULL, NULL, NULL, NULL, 1),
(521, 47, 41, NULL, NULL, NULL, NULL, 1),
(522, 47, 42, NULL, NULL, NULL, NULL, 1),
(523, 47, 43, NULL, NULL, NULL, NULL, 1),
(524, 47, 36, NULL, NULL, '', '14:08:00', NULL),
(525, 48, 32, NULL, NULL, '09:58:00', '', NULL),
(526, 48, 33, NULL, NULL, '10:58:00', '10:38:00', NULL),
(527, 48, 34, NULL, NULL, '13:02:00', '12:32:00', NULL),
(528, 48, 35, NULL, NULL, '13:56:00', '13:41:00', NULL),
(529, 48, 37, NULL, NULL, NULL, NULL, 1),
(530, 48, 38, NULL, NULL, NULL, NULL, 1),
(531, 48, 39, NULL, NULL, NULL, NULL, 1),
(532, 48, 40, NULL, NULL, NULL, NULL, 1),
(533, 48, 41, NULL, NULL, NULL, NULL, 1),
(534, 48, 42, NULL, NULL, NULL, NULL, 1),
(535, 48, 43, NULL, NULL, NULL, NULL, 1),
(536, 48, 36, NULL, NULL, '', '14:18:00', NULL),
(537, 49, 32, NULL, NULL, '08:35:00', '', NULL),
(538, 49, 33, NULL, NULL, '09:50:00', '09:38:00', NULL),
(539, 49, 34, NULL, NULL, '12:15:00', '11:55:00', NULL),
(540, 49, 35, NULL, NULL, '13:25:00', '13:13:00', NULL),
(541, 49, 37, NULL, NULL, NULL, NULL, 1),
(542, 49, 38, NULL, NULL, NULL, NULL, 1),
(543, 49, 39, NULL, NULL, NULL, NULL, 1),
(544, 49, 40, NULL, NULL, NULL, NULL, 1),
(545, 49, 41, NULL, NULL, NULL, NULL, 1),
(546, 49, 42, NULL, NULL, NULL, NULL, 1),
(547, 49, 43, NULL, NULL, NULL, NULL, 1),
(548, 49, 36, NULL, NULL, '', '14:13:00', NULL),
(549, 50, 32, NULL, NULL, '08:24:00', '', NULL),
(550, 50, 33, NULL, NULL, '09:13:00', '09:08:00', NULL),
(551, 50, 34, NULL, NULL, '10:55:00', '10:48:00', NULL),
(552, 50, 35, NULL, NULL, '11:38:00', '11:34:00', NULL),
(553, 50, 37, NULL, NULL, NULL, NULL, 1),
(554, 50, 38, NULL, NULL, NULL, NULL, 1),
(555, 50, 39, NULL, NULL, NULL, NULL, 1),
(556, 50, 40, NULL, NULL, NULL, NULL, 1),
(557, 50, 41, NULL, NULL, NULL, NULL, 1),
(558, 50, 42, NULL, NULL, NULL, NULL, 1),
(559, 50, 43, NULL, NULL, NULL, NULL, 1),
(560, 50, 36, NULL, NULL, '', '12:16:00', NULL),
(561, 51, 32, NULL, NULL, '08:03:00', '', NULL),
(562, 51, 33, NULL, NULL, '08:53:00', '08:33:00', NULL),
(563, 51, 34, NULL, NULL, '10:33:00', '10:17:00', NULL),
(564, 51, 35, NULL, NULL, '11:14:00', '10:59:00', NULL),
(565, 51, 37, NULL, NULL, NULL, NULL, 1),
(566, 51, 38, NULL, NULL, NULL, NULL, 1),
(567, 51, 39, NULL, NULL, NULL, NULL, 1),
(568, 51, 40, NULL, NULL, NULL, NULL, 1),
(569, 51, 41, NULL, NULL, NULL, NULL, 1),
(570, 51, 42, NULL, NULL, NULL, NULL, 1),
(571, 51, 43, NULL, NULL, NULL, NULL, 1),
(572, 51, 36, NULL, NULL, '', '11:38:00', NULL),
(573, 52, 32, NULL, NULL, '08:20:00', '', NULL),
(574, 52, 33, NULL, NULL, '09:24:00', '09:04:00', NULL),
(575, 52, 34, NULL, NULL, '11:14:00', '11:04:00', NULL),
(576, 52, 35, NULL, NULL, '12:10:00', '12:02:00', NULL),
(577, 52, 37, NULL, NULL, NULL, NULL, 1),
(578, 52, 38, NULL, NULL, NULL, NULL, 1),
(579, 52, 39, NULL, NULL, NULL, NULL, 1),
(580, 52, 40, NULL, NULL, NULL, NULL, 1),
(581, 52, 41, NULL, NULL, NULL, NULL, 1),
(582, 52, 42, NULL, NULL, NULL, NULL, 1),
(583, 52, 43, NULL, NULL, NULL, NULL, 1),
(584, 52, 36, NULL, NULL, '', '12:58:00', NULL),
(585, 53, 32, NULL, NULL, '10:10:00', '', NULL),
(586, 53, 33, NULL, NULL, '11:54:00', '11:34:00', NULL),
(587, 53, 34, NULL, NULL, '15:11:00', '14:51:00', NULL),
(588, 53, 35, NULL, NULL, '16:43:00', '16:28:00', NULL),
(589, 53, 37, NULL, NULL, NULL, NULL, 1),
(590, 53, 38, NULL, NULL, NULL, NULL, 1),
(591, 53, 39, NULL, NULL, NULL, NULL, 1),
(592, 53, 40, NULL, NULL, NULL, NULL, 1),
(593, 53, 41, NULL, NULL, NULL, NULL, 1),
(594, 53, 42, NULL, NULL, NULL, NULL, 1),
(595, 53, 43, NULL, NULL, NULL, NULL, 1),
(596, 53, 36, NULL, NULL, '', '18:14:00', NULL),
(597, 54, 32, NULL, NULL, '', '', NULL),
(598, 54, 33, NULL, NULL, '', '', NULL),
(599, 54, 34, NULL, NULL, '', '', NULL),
(600, 54, 35, NULL, NULL, '', '', NULL),
(601, 54, 37, NULL, NULL, NULL, NULL, 1),
(602, 54, 38, NULL, NULL, NULL, NULL, 1),
(603, 54, 39, NULL, NULL, NULL, NULL, 1),
(604, 54, 40, NULL, NULL, NULL, NULL, 1),
(605, 54, 41, NULL, NULL, NULL, NULL, 1),
(606, 54, 42, NULL, NULL, NULL, NULL, 1),
(607, 54, 43, NULL, NULL, NULL, NULL, 1),
(608, 54, 36, NULL, NULL, '', '', NULL),
(609, 55, 32, NULL, NULL, '', '', NULL),
(610, 55, 33, NULL, NULL, '', '', NULL),
(611, 55, 34, NULL, NULL, '', '', NULL),
(612, 55, 35, NULL, NULL, '', '', NULL),
(613, 55, 37, NULL, NULL, NULL, NULL, 1),
(614, 55, 38, NULL, NULL, NULL, NULL, 1),
(615, 55, 39, NULL, NULL, NULL, NULL, 1),
(616, 55, 40, NULL, NULL, NULL, NULL, 1),
(617, 55, 41, NULL, NULL, NULL, NULL, 1),
(618, 55, 42, NULL, NULL, NULL, NULL, 1),
(619, 55, 43, NULL, NULL, NULL, NULL, 1),
(620, 55, 36, NULL, NULL, '', '', NULL),
(621, 56, 32, NULL, NULL, '', '', NULL),
(622, 56, 33, NULL, NULL, '', '', NULL),
(623, 56, 34, NULL, NULL, '', '', NULL),
(624, 56, 35, NULL, NULL, '', '', NULL),
(625, 56, 37, NULL, NULL, NULL, NULL, 1),
(626, 56, 38, NULL, NULL, NULL, NULL, 1),
(627, 56, 39, NULL, NULL, NULL, NULL, 1),
(628, 56, 40, NULL, NULL, NULL, NULL, 1),
(629, 56, 41, NULL, NULL, NULL, NULL, 1),
(630, 56, 42, NULL, NULL, NULL, NULL, 1),
(631, 56, 43, NULL, NULL, NULL, NULL, 1),
(632, 56, 36, NULL, NULL, '', '', NULL),
(633, 57, 32, NULL, NULL, '', '', NULL),
(634, 57, 33, NULL, NULL, '', '', NULL),
(635, 57, 34, NULL, NULL, '', '', NULL),
(636, 57, 35, NULL, NULL, '', '', NULL),
(637, 57, 37, NULL, NULL, NULL, NULL, 1),
(638, 57, 38, NULL, NULL, NULL, NULL, 1),
(639, 57, 39, NULL, NULL, NULL, NULL, 1),
(640, 57, 40, NULL, NULL, NULL, NULL, 1),
(641, 57, 41, NULL, NULL, NULL, NULL, 1),
(642, 57, 42, NULL, NULL, NULL, NULL, 1),
(643, 57, 43, NULL, NULL, NULL, NULL, 1),
(644, 57, 36, NULL, NULL, '', '', NULL),
(645, 58, 32, NULL, NULL, '', '', NULL),
(646, 58, 33, NULL, NULL, '', '', NULL),
(647, 58, 34, NULL, NULL, '', '', NULL),
(648, 58, 35, NULL, NULL, '', '', NULL),
(649, 58, 37, NULL, NULL, NULL, NULL, 1),
(650, 58, 38, NULL, NULL, NULL, NULL, 1),
(651, 58, 39, NULL, NULL, NULL, NULL, 1),
(652, 58, 40, NULL, NULL, NULL, NULL, 1),
(653, 58, 41, NULL, NULL, NULL, NULL, 1),
(654, 58, 42, NULL, NULL, NULL, NULL, 1),
(655, 58, 43, NULL, NULL, NULL, NULL, 1),
(656, 58, 36, NULL, NULL, '', '', NULL),
(657, 59, 32, NULL, NULL, '', '', NULL),
(658, 59, 33, NULL, NULL, '', '', NULL),
(659, 59, 34, NULL, NULL, '', '', NULL),
(660, 59, 35, NULL, NULL, '', '', NULL),
(661, 59, 37, NULL, NULL, NULL, NULL, 1),
(662, 59, 38, NULL, NULL, NULL, NULL, 1),
(663, 59, 39, NULL, NULL, NULL, NULL, 1),
(664, 59, 40, NULL, NULL, NULL, NULL, 1),
(665, 59, 41, NULL, NULL, NULL, NULL, 1),
(666, 59, 42, NULL, NULL, NULL, NULL, 1),
(667, 59, 43, NULL, NULL, NULL, NULL, 1),
(668, 59, 36, NULL, NULL, '', '', NULL);

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
  `team_name` varchar(255) DEFAULT NULL,
  `club_id` mediumint(8) UNSIGNED DEFAULT NULL,
  `category_id` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `uuid_card`, `team_name`, `club_id`, `category_id`) VALUES
(1, 43, 'TZUICA', 8, 3),
(2, 44, 'COCOSII DE MOLDOVA', 8, 3),
(3, 45, 'RETEZATII', 8, 3),
(4, 46, 'SANGE VERDE', 8, 3),
(5, 47, 'PETARDELE', 8, 3),
(6, 48, 'TEAM 23', 11, 3),
(7, 49, 'MONT-DEL-MAR', 13, 3),
(8, 50, 'SOIMII DUNARENI IUBIRE', 9, 3),
(9, 51, 'ELITA ZIMBRILOR', 6, 3),
(10, 52, 'PRO-PARANG SPEED', 1, 3),
(11, 53, 'Alpin Club Pro-Mont Bucuresti', 4, 3),
(12, 54, 'JNEPENII HASMASULUI', 3, 3),
(14, 29, 'HAI PE MUNTE CRC', 2, 7),
(15, 30, 'ZIMBRII ARGESULUI', 6, 7),
(16, 31, 'SOIMII CAMPIONI', 9, 7),
(17, 32, 'SOIMII DULCI', 9, 7),
(18, 33, 'HAI PE MUNTE! PELICANII', 2, 7),
(19, 34, 'PRO-PARANG NOROCEL', 1, 7),
(20, 35, 'COCK-TAIL', 8, 7),
(21, 39, 'COCOSUL MECANIC', 8, 5),
(22, 40, 'PRO-PARANG PITOANCA', 1, 5),
(23, 56, 'Floarea Reginei Roza', 14, 3),
(24, 57, 'Floarea Reginei Gentiana', 14, 3),
(25, 58, 'Felsie', 8, 6),
(26, 59, 'Zimbrutele Vesele', 6, 6),
(27, 60, 'PRO-PARANG Prietenie', 1, 6),
(28, 61, 'Jnepenii Ganditori', 3, 6),
(29, 62, 'HAI PE MUNTE !', 2, 6),
(30, 63, 'FICATS', 8, 6),
(31, 1, 'ALEGRIA', 8, 1),
(32, 2, 'HAI PE MUNTE ! Tudor', 2, 1),
(33, 3, 'Urma Soimilor', 9, 1),
(34, 4, 'Alpin Club Pro-Mont 3', 4, 1),
(35, 5, 'Alpin Club Pro-Mont Bucuresti 1', 4, 1),
(36, 6, 'Alpin Club Pro-Mont Bucuresti 2', 4, 1),
(37, 7, 'Zimbrii Familisti', 6, 1),
(38, 8, 'SOIMII INIMOSI', 9, 1),
(39, 11, 'SOIMII AURII', 9, 2),
(40, 12, 'HAI PE MUNTE !', 2, 2),
(41, 13, 'Zimbrii Rapizi', 6, 2),
(42, 17, 'CE SA VEZI IN JNEPENISI', 3, 4),
(43, 18, 'CE SA VEZI.RO', 3, 4),
(44, 19, 'JNEPENII LINISTITI', 3, 4),
(45, 20, 'JNEPENII SKIORI', 3, 4),
(46, 21, 'JNEPENII HAI-HUI', 3, 4),
(47, 23, 'Cocosul de munte Open 1', 8, 4),
(48, 22, 'Cocosul de munte Open 2', 8, 4),
(49, 24, 'Asociatia Drumetii Montane', 7, 4),
(50, 41, 'Mutomanii Veterani', 15, 5),
(51, 42, 'MUSCHETARII DIN BUILA', 16, 5),
(52, 25, 'BUILA 1', 16, 4),
(53, 26, 'AVENTURARITA', 16, 4),
(54, 27, 'BUILA 2', 16, 4),
(55, 36, 'Arc Force One', 10, 7),
(56, 66, 'Arcul Carpatin Elite 1', 10, 3),
(57, 28, 'TIRIBIMBOFLAX', 10, 4),
(58, 67, 'Sagetile Arcului', 10, 3),
(59, 144, 'Gaska Bucuresti', 18, 4),
(60, 55, 'HAI PE MUNTE !', 2, 3);

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
(103, 'AB89ABA9'),
(88, 'AB89C2A9'),
(4, 'AB89DDF9'),
(133, 'C233D503'),
(14, 'C23446D3'),
(67, 'C2345213'),
(28, 'C234DBC3'),
(79, 'C234F013'),
(122, 'C2350C23'),
(101, 'C2352993'),
(17, 'C2358193'),
(68, 'C2358303'),
(48, 'C23588A3'),
(81, 'C235D093'),
(140, 'C235D423'),
(75, 'C235DED3'),
(32, 'C235EDB3'),
(13, 'C235F523'),
(104, 'C23611A3'),
(118, 'C23611E3'),
(136, 'C2363C73'),
(33, 'C2365E33'),
(108, 'C2365EE3'),
(82, 'C2366213'),
(100, 'C2366303'),
(131, 'C23664E3'),
(111, 'C2366F03'),
(114, 'C2367703'),
(41, 'C23682F3'),
(70, 'C2368913'),
(132, 'C2368933'),
(126, 'C2369BF3'),
(63, 'C2369F53'),
(78, 'C236CB93'),
(76, 'C236D0B3'),
(58, 'C236D803'),
(121, 'C236F053'),
(99, 'C236F523'),
(106, 'C236F533'),
(3, 'C2370AE3'),
(29, 'C23715D3'),
(27, 'C23716A3'),
(20, 'C2372243'),
(71, 'C2372673'),
(31, 'C2373573'),
(97, 'C23781E3'),
(65, 'C2379B63'),
(113, 'C237C133'),
(30, 'C237C5B3'),
(69, 'C237C9B3'),
(73, 'C237CDC3'),
(51, 'C237D143'),
(8, 'C237DC03'),
(49, 'C237E003'),
(23, 'C237E563'),
(129, 'C2381A13'),
(9, 'C2382A73'),
(123, 'C2382C33'),
(115, 'C2383723'),
(53, 'C2383E63'),
(57, 'C2384093'),
(117, 'C23840E3'),
(90, 'C23846A3'),
(46, 'C2384FD3'),
(92, 'C2385053'),
(93, 'C2385613'),
(45, 'C2386473'),
(66, 'C23875B3'),
(142, 'C2387C73'),
(98, 'C238A273'),
(61, 'C238D853'),
(56, 'C238DCC3'),
(19, 'C238DD63'),
(83, 'C238E403'),
(89, 'C238EC63'),
(137, 'C2392DE3'),
(35, 'C23988E3'),
(62, 'C239F063'),
(60, 'C239FCD3'),
(54, 'C23A0B53'),
(18, 'C23A1323'),
(64, 'C23A1E43'),
(86, 'C23A2893'),
(107, 'C23A3013'),
(55, 'C23A3073'),
(38, 'C23A9A73'),
(59, 'C23AC843'),
(96, 'C23BADC3'),
(37, 'C23C3343'),
(22, 'C23C6F43'),
(109, 'C23CA693'),
(72, 'C23D1F03'),
(43, 'C23D2B13'),
(36, 'C23D48E3'),
(143, 'C23D4C23'),
(42, 'C23D4CE3'),
(85, 'C23D5193'),
(112, 'C23D5823'),
(141, 'C23D65C3'),
(21, 'C23D6733'),
(11, 'C23D90E3'),
(10, 'C23D94F3'),
(15, 'C23DBF93'),
(144, 'C23DC2D3'),
(102, 'C23DE273'),
(116, 'C23DE453'),
(39, 'C23E1633'),
(80, 'C23E26D3'),
(6, 'C23E3A33'),
(124, 'C23E4683'),
(94, 'C23E4963'),
(91, 'C23EB703'),
(105, 'C23F1773'),
(125, 'C23F20F3'),
(135, 'C23F2B83'),
(16, 'C23F5A93'),
(139, 'C23FA1B3'),
(47, 'C23FC5B3'),
(138, 'C23FD203'),
(130, 'C24007C3'),
(7, 'C24028E3'),
(120, 'C240A6D3'),
(74, 'C2417513'),
(34, 'C241AA53'),
(25, 'C241AAF3'),
(77, 'C241BF03'),
(1, 'C241C243'),
(110, 'C241D073'),
(84, 'C241E253'),
(134, 'C241EBD3'),
(95, 'C241EF83'),
(12, 'C241FF73'),
(40, 'C2420733'),
(44, 'C24215C3'),
(87, 'C24231D3'),
(52, 'C2423A43'),
(127, 'C2423E53'),
(128, 'C2746ED3'),
(119, 'C2747043'),
(24, 'C2749593'),
(50, 'C274EB43'),
(5, 'C274EBA3'),
(2, 'C2751003'),
(26, 'C2753D53');

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
  MODIFY `category_challenge_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `challenge_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `challenge_stations`
--
ALTER TABLE `challenge_stations`
  MODIFY `station_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `climbing`
--
ALTER TABLE `climbing`
  MODIFY `climbing_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `club_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
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
  MODIFY `knowledge_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `organizer`
--
ALTER TABLE `organizer`
  MODIFY `id_organizer` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orienteering`
--
ALTER TABLE `orienteering`
  MODIFY `orienteering_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `participations`
--
ALTER TABLE `participations`
  MODIFY `participation_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `participation_entries`
--
ALTER TABLE `participation_entries`
  MODIFY `entry_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=669;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `uuids`
--
ALTER TABLE `uuids`
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
