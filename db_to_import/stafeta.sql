-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2023 at 05:43 PM
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

--
-- Dumping data for table `category_challenges`
--

INSERT INTO `category_challenges` (`category_challenge_id`, `category_id`, `challenge_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1);

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
(3, 1, 2, NULL, 500),
(4, 1, 2, NULL, 500),
(5, 1, 3, 120, NULL),
(6, 2, 0, NULL, NULL),
(7, 2, 1, 75, NULL),
(8, 2, 1, 105, NULL),
(9, 2, 1, 110, NULL),
(10, 2, 3, 90, NULL),
(11, 3, 0, NULL, NULL),
(12, 3, 1, 71, NULL),
(13, 3, 1, 151, NULL),
(14, 3, 1, 106, NULL),
(15, 3, 2, NULL, 500),
(16, 3, 2, NULL, 500),
(17, 3, 2, NULL, 500),
(18, 3, 2, NULL, 500),
(19, 3, 2, NULL, 500),
(20, 3, 2, NULL, 500),
(21, 3, 2, NULL, 500),
(22, 3, 2, NULL, 500),
(23, 3, 3, 84, NULL),
(24, 4, 0, NULL, NULL),
(25, 4, 1, 90, NULL),
(26, 4, 1, 125, NULL),
(27, 4, 1, 130, NULL),
(28, 4, 2, NULL, 500),
(29, 4, 2, NULL, 500),
(30, 4, 2, NULL, 500),
(31, 4, 2, NULL, 500),
(32, 4, 2, NULL, 500),
(33, 4, 2, NULL, 500),
(34, 4, 2, NULL, 500),
(35, 4, 3, 105, NULL),
(36, 5, 0, NULL, NULL),
(37, 5, 1, 85, NULL),
(38, 5, 1, 120, NULL),
(39, 5, 1, 125, NULL),
(40, 5, 2, NULL, 500),
(41, 5, 2, NULL, 500),
(42, 5, 2, NULL, 500),
(43, 5, 2, NULL, 500),
(44, 5, 2, NULL, 500),
(45, 5, 2, NULL, 500),
(46, 5, 2, NULL, 500),
(47, 5, 3, 100, NULL),
(48, 6, 0, NULL, NULL),
(49, 6, 1, 80, NULL),
(50, 6, 1, 110, NULL),
(51, 6, 1, 115, NULL),
(52, 6, 2, NULL, 500),
(53, 6, 2, NULL, 500),
(54, 6, 2, NULL, 500),
(55, 6, 2, NULL, 500),
(56, 6, 2, NULL, 500),
(57, 6, 2, NULL, 500),
(58, 6, 2, NULL, 500),
(59, 6, 3, 95, NULL),
(60, 7, 0, NULL, NULL),
(61, 7, 1, 75, NULL),
(62, 7, 1, 105, NULL),
(63, 7, 1, 110, NULL),
(64, 7, 2, NULL, 500),
(65, 7, 2, NULL, 500),
(66, 7, 2, NULL, 500),
(67, 7, 2, NULL, 500),
(68, 7, 2, NULL, 500),
(69, 7, 2, NULL, 500),
(70, 7, 2, NULL, 500),
(71, 7, 3, 90, NULL);

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
(1, 1, 251, NULL),
(2, 1, 1, 30),
(3, 1, 252, NULL),
(4, 3, 251, NULL),
(5, 3, 1, 5),
(6, 3, 2, 30),
(7, 3, 3, 5),
(8, 3, 252, NULL),
(9, 2, 251, NULL),
(10, 2, 1, 5),
(11, 2, 2, 30),
(12, 2, 3, 5),
(13, 2, 252, NULL),
(14, 4, 251, NULL),
(15, 4, 1, 5),
(16, 4, 2, 30),
(17, 4, 3, 5),
(18, 4, 252, NULL),
(19, 5, 251, NULL),
(20, 5, 1, 5),
(21, 5, 2, 30),
(22, 5, 3, 5),
(23, 5, 252, NULL),
(24, 6, 251, NULL),
(25, 6, 1, 5),
(26, 6, 2, 30),
(27, 6, 3, 5),
(28, 6, 252, NULL),
(29, 7, 251, NULL),
(30, 7, 1, 5),
(31, 7, 2, 30),
(32, 7, 3, 5),
(33, 7, 252, NULL);

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
(1, 'Globetrotter', 0),
(3, 'Jnepenii', 0),
(4, 'Asociatia de Turism Gaska Bucuresti', 0),
(5, 'Testoasele', 0),
(6, 'Clubul Alpin Temerarii', 0),
(7, 'Zambete Colorate', 0),
(8, 'Asociatia Schi-Turism Montan Pro-Parang Petrosani', 0),
(9, 'Montan Club Floarea Reginei', 0),
(10, 'Alpin Club Pro-Mont Bucuresti', 0),
(11, 'Cocosul de munte Brasov', 0),
(12, 'Asociatia Drumetii Montane', 0),
(13, 'Buila Vanturarita', 0),
(14, 'Mecanturist', 0),
(15, 'Asociatia Ecologica Arcul Carpatin', 0),
(16, 'Aryas Curtea de Arges', 0),
(17, 'Intrusii', 0);

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
(1, 17, 2, '00:01:26', 260, 0, '4, 5'),
(2, 51, 1, '00:01:14', 280, 0, '11'),
(3, 46, 1, '00:01:06', 280, 0, '11'),
(4, 27, 0, '00:01:12', 300, 0, '0'),
(5, 13, 0, '00:01:30', 300, 0, '0'),
(6, 3, 0, '00:01:34', 300, 0, '0'),
(7, 31, 2, '00:00:56', 260, 0, '9, 14'),
(8, 14, 4, '00:02:00', 220, 0, '4, 5, 11, 15'),
(9, 12, 1, '00:01:52', 280, 0, '2'),
(10, 21, 0, '00:01:53', 300, 0, '0'),
(11, 18, 1, '00:01:27', 280, 0, '12'),
(12, 26, 0, '00:01:32', 300, 0, '0'),
(13, 32, 0, '00:01:22', 300, 0, '0'),
(14, 30, 0, '00:01:49', 300, 0, '0'),
(15, 16, 0, '00:01:38', 300, 0, '0'),
(16, 11, 1, '00:01:35', 280, 0, '11'),
(17, 24, 10, '00:02:30', 100, 0, '1, 3, 4, 6, 9, 10, 11, 12, 13, 14'),
(18, 29, 10, '00:03:51', 100, 0, '1, 2, 4, 6, 7, 9, 10, 11, 14, 15'),
(19, 35, 0, '00:01:10', 300, 0, '0'),
(20, 15, 3, '00:02:11', 240, 0, '6, 9, 12'),
(21, 36, 1, '00:01:34', 280, 0, '2'),
(22, 34, 0, '00:00:57', 300, 0, '0'),
(23, 22, 2, '00:01:18', 260, 0, '9, 10'),
(24, 49, 1, '00:01:18', 280, 0, '10'),
(25, 10, 0, '00:01:30', 300, 0, '0'),
(26, 47, 0, '00:01:25', 300, 0, '0'),
(27, 48, 7, '00:02:51', 160, 0, '2, 3, 5, 6, 8,11, 12'),
(28, 40, 0, '00:01:15', 300, 0, '0'),
(29, 53, 1, '00:02:07', 280, 0, '6'),
(30, 4, 1, '00:02:17', 280, 0, '2'),
(31, 52, 1, '00:01:10', 280, 0, '2'),
(32, 55, 5, '00:02:11', 200, 0, '8, 11, 12, 13, 14'),
(33, 28, 10, '00:00:16', 100, 0, '1, 3, 4, 6, 7, 9, 10, 12, 13, 15'),
(34, 19, 0, '00:01:40', 300, 0, '0'),
(35, 6, 0, '00:01:58', 300, 0, '0'),
(36, 20, 4, '00:01:00', 220, 0, '2, 11, 12, 14'),
(37, 33, 0, '00:01:13', 300, 0, '0'),
(38, 8, 0, '00:02:04', 300, 0, '0'),
(39, 25, 0, '00:01:11', 300, 0, '0'),
(40, 1, 1, '00:01:59', 280, 0, '4'),
(41, 9, 0, '00:01:52', 300, 0, '0'),
(42, 23, 1, '00:01:13', 280, 0, '8'),
(43, 50, 0, '00:01:55', 300, 0, '0'),
(44, 2, 0, '00:01:58', 300, 0, '0'),
(45, 5, 2, '00:01:15', 260, 0, '4, 9'),
(46, 7, 0, '00:02:20', 300, 0, '0'),
(47, 37, 0, '00:00:00', 0, 1, '0'),
(48, 38, 0, '00:00:00', 0, 1, '0'),
(49, 39, 0, '00:00:0s', 0, 1, '0'),
(50, 41, 0, '00:00:00', 0, 1, '0'),
(51, 42, 0, '00:00:00', 0, 1, '0'),
(52, 43, 0, '00:00:00', 0, 1, '0'),
(53, 44, 0, '00:00:00', 0, 1, '0'),
(54, 45, 0, '00:00:00', 0, 1, '0'),
(55, 54, 0, '00:00:00', 0, 1, '0');

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
(1, 'Trofeul Zimbrilor 2019', 'Zimbrul Carpatin', 'Master');

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

--
-- Dumping data for table `orienteering`
--

INSERT INTO `orienteering` (`orienteering_id`, `team_id`, `uuid_card`, `name_participant`, `start`, `finish`, `total`, `abandon`, `missed_posts`, `order_posts`) VALUES
(1, 1, 1, NULL, '00:00:00', '00:00:00', '00:00:00', 0, '1', NULL),
(2, 2, 2, NULL, '00:00:00', '00:41:58', '00:41:58', 0, '0', NULL),
(3, 3, 3, NULL, '00:00:00', '00:35:56', '00:35:56', 0, '0', NULL),
(4, 4, 4, NULL, '00:00:00', '00:32:44', '00:32:44', 0, '0', NULL),
(5, 5, 5, NULL, '00:00:00', '00:26:39', '00:26:39', 0, '0', NULL),
(6, 6, 6, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(7, 7, 7, NULL, '00:00:00', '00:00:00', '00:00:00', 0, '1', NULL),
(8, 8, 8, NULL, '00:00:00', '01:19:47', '01:19:47', 0, '0', NULL),
(9, 9, 9, NULL, '00:00:00', '00:29:29', '00:29:29', 0, '0', NULL),
(10, 10, 10, NULL, '00:00:00', '00:34:16', '00:34:16', 0, '0', NULL),
(11, 11, 11, NULL, '00:00:00', '01:04:27', '01:04:27', 0, '0', NULL),
(12, 12, 12, NULL, '00:00:00', '00:38:01', '00:38:01', 0, '0', NULL),
(13, 13, 13, NULL, '00:00:00', '00:27:03', '00:27:03', 0, '0', NULL),
(14, 14, 14, NULL, '00:00:00', '00:56:32', '00:56:32', 0, '0', NULL),
(15, 15, 15, NULL, '00:00:00', '00:32:47', '00:32:47', 0, '0', NULL),
(16, 16, 16, NULL, '00:00:00', '00:45:11', '00:45:11', 0, '0', NULL),
(17, 17, 17, NULL, '00:00:00', '00:41:06', '00:41:06', 0, '0', NULL),
(18, 18, 18, NULL, '00:00:00', '00:44:44', '00:44:44', 0, '0', NULL),
(19, 19, 19, NULL, '00:00:00', '00:35:48', '00:35:48', 0, '0', NULL),
(20, 20, 20, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(21, 21, 21, NULL, '00:00:00', '01:15:23', '01:15:23', 0, '0', NULL),
(22, 22, 22, NULL, '00:00:00', '00:23:39', '00:23:39', 0, '0', NULL),
(23, 23, 23, NULL, '00:00:00', '00:37:21', '00:37:21', 0, '0', NULL),
(24, 24, 24, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(25, 25, 25, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(26, 26, 26, NULL, '00:00:00', '00:00:00', '00:00:00', 0, '1', NULL),
(27, 27, 27, NULL, '00:00:00', '00:42:14', '00:42:14', 0, '0', NULL),
(28, 28, 28, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(29, 29, 29, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(30, 30, 30, NULL, '00:00:00', '00:24:33', '00:24:33', 0, '0', NULL),
(31, 31, 31, NULL, '00:00:00', '01:02:33', '01:02:33', 0, '0', NULL),
(32, 32, 32, NULL, '00:00:00', '00:45:34', '00:45:34', 0, '0', NULL),
(33, 33, 33, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(34, 34, 34, NULL, '00:00:00', '00:23:49', '00:23:49', 0, '0', NULL),
(35, 35, 35, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(36, 36, 36, NULL, '00:00:00', '00:43:17', '00:43:17', 0, '0', NULL),
(37, 37, 37, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(38, 38, 38, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(39, 39, 39, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(40, 40, 40, NULL, '00:00:00', '00:29:13', '00:29:13', 0, '0', NULL),
(41, 41, 41, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(42, 42, 42, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(43, 43, 43, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(44, 44, 44, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(45, 45, 45, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(46, 46, 46, NULL, '00:00:00', '00:29:10', '00:29:10', 0, '0', NULL),
(47, 47, 47, NULL, '00:00:00', '00:27:26', '00:27:26', 0, '0', NULL),
(48, 48, 48, NULL, '00:00:00', '00:39:40', '00:39:40', 0, '0', NULL),
(49, 49, 49, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(50, 50, 50, NULL, '00:00:00', '00:21:45', '00:21:45', 0, '0', NULL),
(51, 51, 51, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(52, 52, 52, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(53, 53, 53, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(54, 54, 54, '-', '00:00:00', '00:00:00', '00:00:00', 1, '0', NULL),
(55, 55, 58, NULL, '00:00:00', '00:28:34', '00:28:34', 0, '0', NULL);

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

--
-- Dumping data for table `participations`
--

INSERT INTO `participations` (`participation_id`, `team_id`, `category_challenge_id`, `score`, `notes`, `missing_equipment_items`, `missing_footwear`, `abandonment`, `minimum_distance_penalty`, `created_at`, `updated_at`) VALUES
(1, 1, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:10', '2019-07-10 09:25:10'),
(2, 2, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:10', '2019-07-10 09:25:10'),
(3, 3, 1, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:10', '2019-07-10 09:25:10'),
(4, 4, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:10', '2019-07-10 09:25:10'),
(5, 5, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(6, 6, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(7, 7, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(8, 8, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(9, 9, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(10, 10, 3, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(11, 11, 7, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(12, 12, 1, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(13, 13, 1, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(14, 14, 1, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(15, 15, 3, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(16, 16, 7, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(17, 17, 6, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(18, 18, 2, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(19, 19, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(20, 20, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(21, 21, 2, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(22, 22, 3, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(23, 23, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(24, 24, 7, NULL, NULL, 0, 0, 1, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(25, 25, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(26, 26, 5, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(27, 27, 6, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(28, 28, 4, NULL, NULL, 0, 0, 1, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(29, 29, 6, NULL, NULL, 0, 0, 1, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(30, 30, 5, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(31, 31, 1, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(32, 32, 5, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:11', '2019-07-10 09:25:11'),
(33, 33, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(34, 34, 3, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(35, 35, 3, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(36, 36, 3, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(37, 37, 1, NULL, NULL, 0, 0, 1, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(38, 38, 1, NULL, NULL, 0, 0, 1, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(39, 39, 1, NULL, NULL, 0, 0, 1, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(40, 40, 3, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(41, 41, 1, NULL, NULL, 0, 0, 1, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(42, 42, 1, NULL, NULL, 0, 0, 1, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(43, 43, 1, NULL, NULL, 0, 0, 1, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(44, 44, 1, NULL, NULL, 0, 0, 1, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(45, 45, 1, NULL, NULL, 0, 0, 1, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(46, 46, 6, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(47, 47, 3, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(48, 48, 3, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(49, 49, 3, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(50, 50, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(51, 51, 6, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(52, 52, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(53, 53, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(54, 54, 1, NULL, NULL, 0, 0, 1, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12'),
(55, 55, 4, NULL, NULL, 0, 0, 0, 0, '2019-07-10 09:25:12', '2019-07-10 09:25:12');

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
  `uuid_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participation_entries`
--

INSERT INTO `participation_entries` (`entry_id`, `participation_id`, `station_id`, `participant_name`, `time`, `time_start`, `time_finish`, `hits`, `post`, `uuid_id`, `created_at`, `update_at`) VALUES
(1, 1, 24, NULL, NULL, '08:17:45', '08:17:45', NULL, 251, 1, NULL, NULL),
(2, 1, 25, NULL, NULL, '09:42:20', '09:38:18', NULL, 1, 1, NULL, NULL),
(3, 1, 26, NULL, NULL, '12:02:58', '11:42:09', NULL, 2, 1, NULL, NULL),
(4, 1, 27, NULL, NULL, '14:00:51', '13:55:51', NULL, 3, 1, NULL, NULL),
(5, 1, 28, NULL, NULL, '', '', 1, NULL, 1, NULL, NULL),
(6, 1, 29, NULL, NULL, '', '', 1, NULL, 1, NULL, NULL),
(7, 1, 30, NULL, NULL, '', '', 1, NULL, 1, NULL, NULL),
(8, 1, 31, NULL, NULL, '', '', 1, NULL, 1, NULL, NULL),
(9, 1, 32, NULL, NULL, '', '', 1, NULL, 1, NULL, NULL),
(10, 1, 33, NULL, NULL, '', '', 1, NULL, 1, NULL, NULL),
(11, 1, 34, NULL, NULL, '', '', 1, NULL, 1, NULL, NULL),
(12, 1, 35, NULL, NULL, '0', '15:37:20', NULL, 252, 1, NULL, NULL),
(13, 2, 24, NULL, NULL, '08:17:59', '08:17:59', NULL, 251, 2, NULL, NULL),
(14, 2, 25, NULL, NULL, '09:50:22', '09:45:45', NULL, 1, 2, NULL, NULL),
(15, 2, 26, NULL, NULL, '12:34:40', '12:04:40', NULL, 2, 2, NULL, NULL),
(16, 2, 27, NULL, NULL, '14:59:27', '14:56:22', NULL, 3, 2, NULL, NULL),
(17, 2, 28, NULL, NULL, '', '', 1, NULL, 2, NULL, NULL),
(18, 2, 29, NULL, NULL, '', '', 1, NULL, 2, NULL, NULL),
(19, 2, 30, NULL, NULL, '', '', 1, NULL, 2, NULL, NULL),
(20, 2, 31, NULL, NULL, '', '', 1, NULL, 2, NULL, NULL),
(21, 2, 32, NULL, NULL, '', '', 1, NULL, 2, NULL, NULL),
(22, 2, 33, NULL, NULL, '', '', 1, NULL, 2, NULL, NULL),
(23, 2, 34, NULL, NULL, '', '', 1, NULL, 2, NULL, NULL),
(24, 2, 35, NULL, NULL, '0', '16:35:27', NULL, 252, 2, NULL, NULL),
(25, 3, 1, NULL, NULL, '08:28:17', '08:28:17', NULL, 251, 3, NULL, NULL),
(26, 3, 2, NULL, NULL, '10:36:43', '10:17:04', NULL, 1, 3, NULL, NULL),
(27, 3, 3, NULL, NULL, '', '', 1, NULL, 3, NULL, NULL),
(28, 3, 4, NULL, NULL, '', '', 1, NULL, 3, NULL, NULL),
(29, 3, 5, NULL, NULL, '0', '12:10:51', NULL, 252, 3, NULL, NULL),
(30, 4, 24, NULL, NULL, '08:20:37', '08:20:37', NULL, 251, 4, NULL, NULL),
(31, 4, 25, NULL, NULL, '09:45:13', '09:40:14', NULL, 1, 4, NULL, NULL),
(32, 4, 26, NULL, NULL, '11:59:34', '11:32:21', NULL, 2, 4, NULL, NULL),
(33, 4, 27, NULL, NULL, '13:50:59', '13:46:36', NULL, 3, 4, NULL, NULL),
(34, 4, 28, NULL, NULL, '', '', 1, NULL, 4, NULL, NULL),
(35, 4, 29, NULL, NULL, '', '', 1, NULL, 4, NULL, NULL),
(36, 4, 30, NULL, NULL, '', '', 1, NULL, 4, NULL, NULL),
(37, 4, 31, NULL, NULL, '', '', 1, NULL, 4, NULL, NULL),
(38, 4, 32, NULL, NULL, '', '', 1, NULL, 4, NULL, NULL),
(39, 4, 33, NULL, NULL, '', '', 1, NULL, 4, NULL, NULL),
(40, 4, 34, NULL, NULL, '', '', 1, NULL, 4, NULL, NULL),
(41, 4, 35, NULL, NULL, '0', '15:21:58', NULL, 252, 4, NULL, NULL),
(42, 5, 24, NULL, NULL, '08:17:54', '08:17:54', NULL, 251, 5, NULL, NULL),
(43, 5, 25, NULL, NULL, '09:42:02', '09:37:21', NULL, 1, 5, NULL, NULL),
(44, 5, 26, NULL, NULL, '12:14:55', '11:46:06', NULL, 2, 5, NULL, NULL),
(45, 5, 27, NULL, NULL, '14:01:28', '13:56:32', NULL, 3, 5, NULL, NULL),
(46, 5, 28, NULL, NULL, '', '', 1, NULL, 5, NULL, NULL),
(47, 5, 29, NULL, NULL, '', '', 1, NULL, 5, NULL, NULL),
(48, 5, 30, NULL, NULL, '', '', 1, NULL, 5, NULL, NULL),
(49, 5, 31, NULL, NULL, '', '', 1, NULL, 5, NULL, NULL),
(50, 5, 32, NULL, NULL, '', '', 1, NULL, 5, NULL, NULL),
(51, 5, 33, NULL, NULL, '', '', 1, NULL, 5, NULL, NULL),
(52, 5, 34, NULL, NULL, '', '', 1, NULL, 5, NULL, NULL),
(53, 5, 35, NULL, NULL, '0', '15:20:39', NULL, 252, 5, NULL, NULL),
(54, 6, 24, NULL, NULL, '08:17:45', '08:17:45', NULL, 251, 6, NULL, NULL),
(55, 6, 25, NULL, NULL, '10:04:56', '10:00:00', NULL, 1, 6, NULL, NULL),
(56, 6, 26, NULL, NULL, '12:53:16', '12:33:10', NULL, 2, 6, NULL, NULL),
(57, 6, 27, NULL, NULL, '15:25:29', '15:20:29', NULL, 3, 6, NULL, NULL),
(58, 6, 28, NULL, NULL, '', '', 1, NULL, 6, NULL, NULL),
(59, 6, 29, NULL, NULL, '', '', 1, NULL, 6, NULL, NULL),
(60, 6, 30, NULL, NULL, '', '', 1, NULL, 6, NULL, NULL),
(61, 6, 31, NULL, NULL, '', '', 1, NULL, 6, NULL, NULL),
(62, 6, 32, NULL, NULL, '', '', 1, NULL, 6, NULL, NULL),
(63, 6, 33, NULL, NULL, '', '', 1, NULL, 6, NULL, NULL),
(64, 6, 34, NULL, NULL, '', '', 1, NULL, 6, NULL, NULL),
(65, 6, 35, NULL, NULL, '0', '17:58:55', NULL, 252, 6, NULL, NULL),
(66, 7, 24, NULL, NULL, '08:17:58', '08:17:58', NULL, 251, 7, NULL, NULL),
(67, 7, 25, NULL, NULL, '09:47:35', '09:42:50', NULL, 1, 7, NULL, NULL),
(68, 7, 26, NULL, NULL, '12:02:41', '11:39:45', NULL, 2, 7, NULL, NULL),
(69, 7, 27, NULL, NULL, '13:59:29', '13:54:29', NULL, 3, 7, NULL, NULL),
(70, 7, 28, NULL, NULL, '', '', 1, NULL, 7, NULL, NULL),
(71, 7, 29, NULL, NULL, '', '', 1, NULL, 7, NULL, NULL),
(72, 7, 30, NULL, NULL, '', '', 1, NULL, 7, NULL, NULL),
(73, 7, 31, NULL, NULL, '', '', 1, NULL, 7, NULL, NULL),
(74, 7, 32, NULL, NULL, '', '', 1, NULL, 7, NULL, NULL),
(75, 7, 33, NULL, NULL, '', '', 1, NULL, 7, NULL, NULL),
(76, 7, 34, NULL, NULL, '', '', 1, NULL, 7, NULL, NULL),
(77, 7, 35, NULL, NULL, '0', '15:23:58', NULL, 252, 7, NULL, NULL),
(78, 8, 24, NULL, NULL, '08:17:50', '08:17:50', NULL, 251, 8, NULL, NULL),
(79, 8, 25, NULL, NULL, '09:54:03', '09:49:56', NULL, 1, 8, NULL, NULL),
(80, 8, 26, NULL, NULL, '12:48:54', '12:33:53', NULL, 2, 8, NULL, NULL),
(81, 8, 27, NULL, NULL, '15:21:26', '15:17:59', NULL, 3, 8, NULL, NULL),
(82, 8, 28, NULL, NULL, '', '', 1, NULL, 8, NULL, NULL),
(83, 8, 29, NULL, NULL, '', '', 1, NULL, 8, NULL, NULL),
(84, 8, 30, NULL, NULL, '', '', 1, NULL, 8, NULL, NULL),
(85, 8, 31, NULL, NULL, '', '', 1, NULL, 8, NULL, NULL),
(86, 8, 32, NULL, NULL, '', '', 1, NULL, 8, NULL, NULL),
(87, 8, 33, NULL, NULL, '', '', 1, NULL, 8, NULL, NULL),
(88, 8, 34, NULL, NULL, '', '', 1, NULL, 8, NULL, NULL),
(89, 8, 35, NULL, NULL, '0', '16:53:01', NULL, 252, 8, NULL, NULL),
(90, 9, 24, NULL, NULL, '08:17:36', '08:17:36', NULL, 251, 9, NULL, NULL),
(91, 9, 25, NULL, NULL, '09:47:22', '09:42:40', NULL, 1, 9, NULL, NULL),
(92, 9, 26, NULL, NULL, '12:16:26', '11:47:31', NULL, 2, 9, NULL, NULL),
(93, 9, 27, NULL, NULL, '14:03:59', '13:59:51', NULL, 3, 9, NULL, NULL),
(94, 9, 28, NULL, NULL, '', '', 1, NULL, 9, NULL, NULL),
(95, 9, 29, NULL, NULL, '', '', 1, NULL, 9, NULL, NULL),
(96, 9, 30, NULL, NULL, '', '', 1, NULL, 9, NULL, NULL),
(97, 9, 31, NULL, NULL, '', '', 1, NULL, 9, NULL, NULL),
(98, 9, 32, NULL, NULL, '', '', 1, NULL, 9, NULL, NULL),
(99, 9, 33, NULL, NULL, '', '', 1, NULL, 9, NULL, NULL),
(100, 9, 34, NULL, NULL, '', '', 1, NULL, 9, NULL, NULL),
(101, 9, 35, NULL, NULL, '0', '15:38:46', NULL, 252, 9, NULL, NULL),
(102, 10, 11, NULL, NULL, '07:07:12', '07:07:12', NULL, 251, 10, NULL, NULL),
(103, 10, 12, NULL, NULL, '08:17:14', '08:15:01', NULL, 1, 10, NULL, NULL),
(104, 10, 13, NULL, NULL, '10:59:06', '10:34:43', NULL, 2, 10, NULL, NULL),
(105, 10, 14, NULL, NULL, '12:33:49', '12:31:07', NULL, 3, 10, NULL, NULL),
(106, 10, 15, NULL, NULL, '', '', 1, NULL, 10, NULL, NULL),
(107, 10, 16, NULL, NULL, '', '', 1, NULL, 10, NULL, NULL),
(108, 10, 17, NULL, NULL, '', '', 1, NULL, 10, NULL, NULL),
(109, 10, 18, NULL, NULL, '', '', 1, NULL, 10, NULL, NULL),
(110, 10, 19, NULL, NULL, '', '', 1, NULL, 10, NULL, NULL),
(111, 10, 20, NULL, NULL, '', '', 1, NULL, 10, NULL, NULL),
(112, 10, 21, NULL, NULL, '', '', 1, NULL, 10, NULL, NULL),
(113, 10, 22, NULL, NULL, '', '', 1, NULL, 10, NULL, NULL),
(114, 10, 23, NULL, NULL, '0', '13:51:18', NULL, 252, 10, NULL, NULL),
(115, 11, 60, NULL, NULL, '07:20:46', '07:20:46', NULL, 251, 11, NULL, NULL),
(116, 11, 61, NULL, NULL, '09:03:18', '09:00:14', NULL, 1, 11, NULL, NULL),
(117, 11, 62, NULL, NULL, '11:56:01', '11:29:14', NULL, 2, 11, NULL, NULL),
(118, 11, 63, NULL, NULL, '14:11:10', '14:07:11', NULL, 3, 11, NULL, NULL),
(119, 11, 64, NULL, NULL, '', '', 1, NULL, 11, NULL, NULL),
(120, 11, 65, NULL, NULL, '', '', 1, NULL, 11, NULL, NULL),
(121, 11, 66, NULL, NULL, '', '', 1, NULL, 11, NULL, NULL),
(122, 11, 67, NULL, NULL, '', '', 1, NULL, 11, NULL, NULL),
(123, 11, 68, NULL, NULL, '', '', 1, NULL, 11, NULL, NULL),
(124, 11, 69, NULL, NULL, '', '', 1, NULL, 11, NULL, NULL),
(125, 11, 70, NULL, NULL, '', '', 1, NULL, 11, NULL, NULL),
(126, 11, 71, NULL, NULL, '0', '15:50:23', NULL, 252, 11, NULL, NULL),
(127, 12, 1, NULL, NULL, '08:26:47', '08:26:47', NULL, 251, 12, NULL, NULL),
(128, 12, 2, NULL, NULL, '10:44:49', '10:25:36', NULL, 1, 12, NULL, NULL),
(129, 12, 3, NULL, NULL, '', '', 1, NULL, 12, NULL, NULL),
(130, 12, 4, NULL, NULL, '', '', 1, NULL, 12, NULL, NULL),
(131, 12, 5, NULL, NULL, '0', '12:23:37', NULL, 252, 12, NULL, NULL),
(132, 13, 1, NULL, NULL, '08:34:48', '08:34:48', NULL, 251, 13, NULL, NULL),
(133, 13, 2, NULL, NULL, '10:56:32', '10:35:06', NULL, 1, 13, NULL, NULL),
(134, 13, 3, NULL, NULL, '', '', 1, NULL, 13, NULL, NULL),
(135, 13, 4, NULL, NULL, '', '', 1, NULL, 13, NULL, NULL),
(136, 13, 5, NULL, NULL, '0', '12:24:10', NULL, 252, 13, NULL, NULL),
(137, 14, 1, NULL, NULL, '08:36:04', '08:36:04', NULL, 251, 14, NULL, NULL),
(138, 14, 2, NULL, NULL, '10:56:28', '10:35:41', NULL, 1, 14, NULL, NULL),
(139, 14, 3, NULL, NULL, '', '', 1, NULL, 14, NULL, NULL),
(140, 14, 4, NULL, NULL, '', '', 1, NULL, 14, NULL, NULL),
(141, 14, 5, NULL, NULL, '0', '12:24:35', NULL, 252, 14, NULL, NULL),
(142, 15, 11, NULL, NULL, '07:07:06', '07:07:06', NULL, 251, 15, NULL, NULL),
(143, 15, 12, NULL, NULL, '08:01:57', '07:59:13', NULL, 1, 15, NULL, NULL),
(144, 15, 13, NULL, NULL, '10:21:13', '10:03:14', NULL, 2, 15, NULL, NULL),
(145, 15, 14, NULL, NULL, '11:35:20', '11:31:33', NULL, 3, 15, NULL, NULL),
(146, 15, 15, NULL, NULL, '', '', 1, NULL, 15, NULL, NULL),
(147, 15, 16, NULL, NULL, '', '', 1, NULL, 15, NULL, NULL),
(148, 15, 17, NULL, NULL, '', '', 1, NULL, 15, NULL, NULL),
(149, 15, 18, NULL, NULL, '', '', 1, NULL, 15, NULL, NULL),
(150, 15, 19, NULL, NULL, '', '', 1, NULL, 15, NULL, NULL),
(151, 15, 20, NULL, NULL, '', '', 1, NULL, 15, NULL, NULL),
(152, 15, 21, NULL, NULL, '', '', 1, NULL, 15, NULL, NULL),
(153, 15, 22, NULL, NULL, '', '', 1, NULL, 15, NULL, NULL),
(154, 15, 23, NULL, NULL, '0', '12:21:48', NULL, 252, 15, NULL, NULL),
(155, 16, 60, NULL, NULL, '07:20:52', '07:20:52', NULL, 251, 16, NULL, NULL),
(156, 16, 61, NULL, NULL, '08:51:05', '08:49:18', NULL, 1, 16, NULL, NULL),
(157, 16, 62, NULL, NULL, '11:12:29', '10:59:05', NULL, 2, 16, NULL, NULL),
(158, 16, 63, NULL, NULL, '13:03:29', '13:02:43', NULL, 3, 16, NULL, NULL),
(159, 16, 64, NULL, NULL, '', '', 1, NULL, 16, NULL, NULL),
(160, 16, 65, NULL, NULL, '', '', 1, NULL, 16, NULL, NULL),
(161, 16, 66, NULL, NULL, '', '', 1, NULL, 16, NULL, NULL),
(162, 16, 67, NULL, NULL, '', '', 1, NULL, 16, NULL, NULL),
(163, 16, 68, NULL, NULL, '', '', 1, NULL, 16, NULL, NULL),
(164, 16, 69, NULL, NULL, '', '', 1, NULL, 16, NULL, NULL),
(165, 16, 70, NULL, NULL, '', '', 1, NULL, 16, NULL, NULL),
(166, 16, 71, NULL, NULL, '0', '14:05:19', NULL, 252, 16, NULL, NULL),
(167, 17, 48, NULL, NULL, '07:44:52', '07:44:52', NULL, 251, 17, NULL, NULL),
(168, 17, 49, NULL, NULL, '08:52:22', '08:49:21', NULL, 1, 17, NULL, NULL),
(169, 17, 50, NULL, NULL, '10:27:27', '10:16:57', NULL, 2, 17, NULL, NULL),
(170, 17, 51, NULL, NULL, '12:10:00', '12:05:08', NULL, 3, 17, NULL, NULL),
(171, 17, 52, NULL, NULL, '', '', 1, NULL, 17, NULL, NULL),
(172, 17, 53, NULL, NULL, '', '', 1, NULL, 17, NULL, NULL),
(173, 17, 54, NULL, NULL, '', '', 1, NULL, 17, NULL, NULL),
(174, 17, 55, NULL, NULL, '', '', 1, NULL, 17, NULL, NULL),
(175, 17, 56, NULL, NULL, '', '', 1, NULL, 17, NULL, NULL),
(176, 17, 57, NULL, NULL, '', '', 1, NULL, 17, NULL, NULL),
(177, 17, 58, NULL, NULL, '', '', 1, NULL, 17, NULL, NULL),
(178, 17, 59, NULL, NULL, '0', '13:39:29', NULL, 252, 17, NULL, NULL),
(179, 18, 6, NULL, NULL, '07:28:10', '07:28:10', NULL, 251, 18, NULL, NULL),
(180, 18, 7, NULL, NULL, '08:45:12', '08:40:15', NULL, 1, 18, NULL, NULL),
(181, 18, 8, NULL, NULL, '10:35:59', '10:20:22', NULL, 2, 18, NULL, NULL),
(182, 18, 9, NULL, NULL, '12:23:12', '12:18:12', NULL, 3, 18, NULL, NULL),
(183, 18, 10, NULL, NULL, '0', '13:38:33', NULL, 252, 18, NULL, NULL),
(184, 19, 24, NULL, NULL, '08:17:52', '08:17:52', NULL, 251, 19, NULL, NULL),
(185, 19, 25, NULL, NULL, '09:46:10', '09:41:27', NULL, 1, 19, NULL, NULL),
(186, 19, 26, NULL, NULL, '12:18:16', '11:48:16', NULL, 2, 19, NULL, NULL),
(187, 19, 27, NULL, NULL, '14:40:06', '14:36:00', NULL, 3, 19, NULL, NULL),
(188, 19, 28, NULL, NULL, '', '', 1, NULL, 19, NULL, NULL),
(189, 19, 29, NULL, NULL, '', '', 1, NULL, 19, NULL, NULL),
(190, 19, 30, NULL, NULL, '', '', 1, NULL, 19, NULL, NULL),
(191, 19, 31, NULL, NULL, '', '', 1, NULL, 19, NULL, NULL),
(192, 19, 32, NULL, NULL, '', '', 1, NULL, 19, NULL, NULL),
(193, 19, 33, NULL, NULL, '', '', 1, NULL, 19, NULL, NULL),
(194, 19, 34, NULL, NULL, '', '', 1, NULL, 19, NULL, NULL),
(195, 19, 35, NULL, NULL, '0', '16:27:59', NULL, 252, 19, NULL, NULL),
(196, 20, 24, NULL, NULL, '08:17:41', '08:17:41', NULL, 251, 20, NULL, NULL),
(197, 20, 25, NULL, NULL, '09:58:15', '09:53:15', NULL, 1, 20, NULL, NULL),
(198, 20, 26, NULL, NULL, '12:57:24', '12:27:24', NULL, 2, 20, NULL, NULL),
(199, 20, 27, NULL, NULL, '16:37:31', '16:36:30', NULL, 3, 20, NULL, NULL),
(200, 20, 28, NULL, NULL, '', '', 1, NULL, 20, NULL, NULL),
(201, 20, 29, NULL, NULL, '', '', 1, NULL, 20, NULL, NULL),
(202, 20, 30, NULL, NULL, '', '', 1, NULL, 20, NULL, NULL),
(203, 20, 31, NULL, NULL, '', '', 1, NULL, 20, NULL, NULL),
(204, 20, 32, NULL, NULL, '', '', 1, NULL, 20, NULL, NULL),
(205, 20, 33, NULL, NULL, '', '', 1, NULL, 20, NULL, NULL),
(206, 20, 34, NULL, NULL, '', '', 1, NULL, 20, NULL, NULL),
(207, 20, 35, NULL, NULL, '0', '18:02:10', NULL, 252, 20, NULL, NULL),
(208, 21, 6, NULL, NULL, '07:28:11', '07:28:11', NULL, 251, 21, NULL, NULL),
(209, 21, 7, NULL, NULL, '08:54:59', '08:49:59', NULL, 1, 21, NULL, NULL),
(210, 21, 8, NULL, NULL, '11:45:52', '11:23:22', NULL, 2, 21, NULL, NULL),
(211, 21, 9, NULL, NULL, '14:12:33', '14:08:04', NULL, 3, 21, NULL, NULL),
(212, 21, 10, NULL, NULL, '0', '15:41:41', NULL, 252, 21, NULL, NULL),
(213, 22, 11, NULL, NULL, '07:07:10', '07:07:10', NULL, 251, 22, NULL, NULL),
(214, 22, 12, NULL, NULL, '08:15:41', '08:11:20', NULL, 1, 22, NULL, NULL),
(215, 22, 13, NULL, NULL, '11:05:14', '10:41:39', NULL, 2, 22, NULL, NULL),
(216, 22, 14, NULL, NULL, '12:49:54', '12:44:54', NULL, 3, 22, NULL, NULL),
(217, 22, 15, NULL, NULL, '', '', 1, NULL, 22, NULL, NULL),
(218, 22, 16, NULL, NULL, '', '', 1, NULL, 22, NULL, NULL),
(219, 22, 17, NULL, NULL, '', '', 1, NULL, 22, NULL, NULL),
(220, 22, 18, NULL, NULL, '', '', 1, NULL, 22, NULL, NULL),
(221, 22, 19, NULL, NULL, '', '', 1, NULL, 22, NULL, NULL),
(222, 22, 20, NULL, NULL, '', '', 1, NULL, 22, NULL, NULL),
(223, 22, 21, NULL, NULL, '', '', 1, NULL, 22, NULL, NULL),
(224, 22, 22, NULL, NULL, '', '', 1, NULL, 22, NULL, NULL),
(225, 22, 23, NULL, NULL, '0', '14:04:23', NULL, 252, 22, NULL, NULL),
(226, 23, 24, NULL, NULL, '08:17:55', '08:17:55', NULL, 251, 23, NULL, NULL),
(227, 23, 25, NULL, NULL, '10:01:56', '09:56:56', NULL, 1, 23, NULL, NULL),
(228, 23, 26, NULL, NULL, '13:04:40', '12:34:40', NULL, 2, 23, NULL, NULL),
(229, 23, 27, NULL, NULL, '16:39:54', '16:34:54', NULL, 3, 23, NULL, NULL),
(230, 23, 28, NULL, NULL, '', '', 1, NULL, 23, NULL, NULL),
(231, 23, 29, NULL, NULL, '', '', 1, NULL, 23, NULL, NULL),
(232, 23, 30, NULL, NULL, '', '', 1, NULL, 23, NULL, NULL),
(233, 23, 31, NULL, NULL, '', '', 1, NULL, 23, NULL, NULL),
(234, 23, 32, NULL, NULL, '', '', 1, NULL, 23, NULL, NULL),
(235, 23, 33, NULL, NULL, '', '', 1, NULL, 23, NULL, NULL),
(236, 23, 34, NULL, NULL, '', '', 1, NULL, 23, NULL, NULL),
(237, 23, 35, NULL, NULL, '0', '18:17:54', NULL, 252, 23, NULL, NULL),
(238, 24, 60, NULL, NULL, '', '', NULL, 251, 24, NULL, NULL),
(239, 24, 61, NULL, NULL, '', '', NULL, 1, 24, NULL, NULL),
(240, 24, 62, NULL, NULL, '', '', NULL, 2, 24, NULL, NULL),
(241, 24, 63, NULL, NULL, '', '', NULL, 3, 24, NULL, NULL),
(242, 24, 64, NULL, NULL, '', '', 1, NULL, 24, NULL, NULL),
(243, 24, 65, NULL, NULL, '', '', 1, NULL, 24, NULL, NULL),
(244, 24, 66, NULL, NULL, '', '', 1, NULL, 24, NULL, NULL),
(245, 24, 67, NULL, NULL, '', '', 1, NULL, 24, NULL, NULL),
(246, 24, 68, NULL, NULL, '', '', 1, NULL, 24, NULL, NULL),
(247, 24, 69, NULL, NULL, '', '', 1, NULL, 24, NULL, NULL),
(248, 24, 70, NULL, NULL, '', '', 1, NULL, 24, NULL, NULL),
(249, 24, 71, NULL, NULL, '', '', NULL, 252, 24, NULL, NULL),
(250, 25, 24, NULL, NULL, '08:17:37', '08:17:37', NULL, 251, 25, NULL, NULL),
(251, 25, 25, NULL, NULL, '09:59:16', '09:54:16', NULL, 1, 25, NULL, NULL),
(252, 25, 26, NULL, NULL, '12:57:55', '12:27:55', NULL, 2, 25, NULL, NULL),
(253, 25, 27, NULL, NULL, '16:42:52', '16:37:52', NULL, 3, 25, NULL, NULL),
(254, 25, 28, NULL, NULL, '', '', 1, NULL, 25, NULL, NULL),
(255, 25, 29, NULL, NULL, '', '', 1, NULL, 25, NULL, NULL),
(256, 25, 30, NULL, NULL, '', '', 1, NULL, 25, NULL, NULL),
(257, 25, 31, NULL, NULL, '', '', 1, NULL, 25, NULL, NULL),
(258, 25, 32, NULL, NULL, '', '', 1, NULL, 25, NULL, NULL),
(259, 25, 33, NULL, NULL, '', '', 1, NULL, 25, NULL, NULL),
(260, 25, 34, NULL, NULL, '', '', 1, NULL, 25, NULL, NULL),
(261, 25, 35, NULL, NULL, '0', '18:56:25', NULL, 252, 25, NULL, NULL),
(262, 26, 36, NULL, NULL, '07:41:54', '07:41:54', NULL, 251, 26, NULL, NULL),
(263, 26, 37, NULL, NULL, '09:19:57', '09:14:57', NULL, 1, 26, NULL, NULL),
(264, 26, 38, NULL, NULL, '12:12:32', '11:44:01', NULL, 2, 26, NULL, NULL),
(265, 26, 39, NULL, NULL, '14:39:20', '14:34:57', NULL, 3, 26, NULL, NULL),
(266, 26, 40, NULL, NULL, '', '', 1, NULL, 26, NULL, NULL),
(267, 26, 41, NULL, NULL, '', '', 1, NULL, 26, NULL, NULL),
(268, 26, 42, NULL, NULL, '', '', 1, NULL, 26, NULL, NULL),
(269, 26, 43, NULL, NULL, '', '', 1, NULL, 26, NULL, NULL),
(270, 26, 44, NULL, NULL, '', '', 1, NULL, 26, NULL, NULL),
(271, 26, 45, NULL, NULL, '', '', 1, NULL, 26, NULL, NULL),
(272, 26, 46, NULL, NULL, '', '', 1, NULL, 26, NULL, NULL),
(273, 26, 47, NULL, NULL, '0', '16:36:20', NULL, 252, 26, NULL, NULL),
(274, 27, 48, NULL, NULL, '07:44:55', '07:44:55', NULL, 251, 27, NULL, NULL),
(275, 27, 49, NULL, NULL, '09:18:52', '09:17:40', NULL, 1, 27, NULL, NULL),
(276, 27, 50, NULL, NULL, '11:42:54', '11:22:20', NULL, 2, 27, NULL, NULL),
(277, 27, 51, NULL, NULL, '13:35:46', '13:32:01', NULL, 3, 27, NULL, NULL),
(278, 27, 52, NULL, NULL, '', '', 1, NULL, 27, NULL, NULL),
(279, 27, 53, NULL, NULL, '', '', 1, NULL, 27, NULL, NULL),
(280, 27, 54, NULL, NULL, '', '', 1, NULL, 27, NULL, NULL),
(281, 27, 55, NULL, NULL, '', '', 1, NULL, 27, NULL, NULL),
(282, 27, 56, NULL, NULL, '', '', 1, NULL, 27, NULL, NULL),
(283, 27, 57, NULL, NULL, '', '', 1, NULL, 27, NULL, NULL),
(284, 27, 58, NULL, NULL, '', '', 1, NULL, 27, NULL, NULL),
(285, 27, 59, NULL, NULL, '0', '15:09:34', NULL, 252, 27, NULL, NULL),
(286, 28, 24, NULL, NULL, '', '', NULL, 251, 28, NULL, NULL),
(287, 28, 25, NULL, NULL, '', '', NULL, 1, 28, NULL, NULL),
(288, 28, 26, NULL, NULL, '', '', NULL, 2, 28, NULL, NULL),
(289, 28, 27, NULL, NULL, '', '', NULL, 3, 28, NULL, NULL),
(290, 28, 28, NULL, NULL, '', '', 1, NULL, 28, NULL, NULL),
(291, 28, 29, NULL, NULL, '', '', 1, NULL, 28, NULL, NULL),
(292, 28, 30, NULL, NULL, '', '', 1, NULL, 28, NULL, NULL),
(293, 28, 31, NULL, NULL, '', '', 1, NULL, 28, NULL, NULL),
(294, 28, 32, NULL, NULL, '', '', 1, NULL, 28, NULL, NULL),
(295, 28, 33, NULL, NULL, '', '', 1, NULL, 28, NULL, NULL),
(296, 28, 34, NULL, NULL, '', '', 1, NULL, 28, NULL, NULL),
(297, 28, 35, NULL, NULL, '', '', NULL, 252, 28, NULL, NULL),
(298, 29, 48, NULL, NULL, '', '', NULL, 251, 29, NULL, NULL),
(299, 29, 49, NULL, NULL, '', '', NULL, 1, 29, NULL, NULL),
(300, 29, 50, NULL, NULL, '', '', NULL, 2, 29, NULL, NULL),
(301, 29, 51, NULL, NULL, '', '', NULL, 3, 29, NULL, NULL),
(302, 29, 52, NULL, NULL, '', '', 1, NULL, 29, NULL, NULL),
(303, 29, 53, NULL, NULL, '', '', 1, NULL, 29, NULL, NULL),
(304, 29, 54, NULL, NULL, '', '', 1, NULL, 29, NULL, NULL),
(305, 29, 55, NULL, NULL, '', '', 1, NULL, 29, NULL, NULL),
(306, 29, 56, NULL, NULL, '', '', 1, NULL, 29, NULL, NULL),
(307, 29, 57, NULL, NULL, '', '', 1, NULL, 29, NULL, NULL),
(308, 29, 58, NULL, NULL, '', '', 1, NULL, 29, NULL, NULL),
(309, 29, 59, NULL, NULL, '', '', NULL, 252, 29, NULL, NULL),
(310, 30, 36, NULL, NULL, '07:42:25', '07:41:53', NULL, 251, 30, NULL, NULL),
(311, 30, 37, NULL, NULL, '08:58:50', '08:56:34', NULL, 1, 30, NULL, NULL),
(312, 30, 38, NULL, NULL, '11:27:46', '11:07:06', NULL, 2, 30, NULL, NULL),
(313, 30, 39, NULL, NULL, '13:10:57', '13:09:57', NULL, 3, 30, NULL, NULL),
(314, 30, 40, NULL, NULL, '', '', 1, NULL, 30, NULL, NULL),
(315, 30, 41, NULL, NULL, '', '', 1, NULL, 30, NULL, NULL),
(316, 30, 42, NULL, NULL, '', '', 1, NULL, 30, NULL, NULL),
(317, 30, 43, NULL, NULL, '', '', 1, NULL, 30, NULL, NULL),
(318, 30, 44, NULL, NULL, '', '', 1, NULL, 30, NULL, NULL),
(319, 30, 45, NULL, NULL, '', '', 1, NULL, 30, NULL, NULL),
(320, 30, 46, NULL, NULL, '', '', 1, NULL, 30, NULL, NULL),
(321, 30, 47, NULL, NULL, '0', '14:27:53', NULL, 252, 30, NULL, NULL),
(322, 31, 1, NULL, NULL, '08:30:08', '08:30:08', NULL, 251, 31, NULL, NULL),
(323, 31, 2, NULL, NULL, '10:58:01', '10:35:13', NULL, 1, 31, NULL, NULL),
(324, 31, 3, NULL, NULL, '', '', 1, NULL, 31, NULL, NULL),
(325, 31, 4, NULL, NULL, '', '', 1, NULL, 31, NULL, NULL),
(326, 31, 5, NULL, NULL, '0', '12:25:27', NULL, 252, 31, NULL, NULL),
(327, 32, 36, NULL, NULL, '07:41:55', '07:41:55', NULL, 251, 32, NULL, NULL),
(328, 32, 37, NULL, NULL, '08:59:53', '08:58:02', NULL, 1, 32, NULL, NULL),
(329, 32, 38, NULL, NULL, '11:28:09', '11:06:32', NULL, 2, 32, NULL, NULL),
(330, 32, 39, NULL, NULL, '13:09:36', '13:08:56', NULL, 3, 32, NULL, NULL),
(331, 32, 40, NULL, NULL, '', '', 1, NULL, 32, NULL, NULL),
(332, 32, 41, NULL, NULL, '', '', 1, NULL, 32, NULL, NULL),
(333, 32, 42, NULL, NULL, '', '', 1, NULL, 32, NULL, NULL),
(334, 32, 43, NULL, NULL, '', '', 1, NULL, 32, NULL, NULL),
(335, 32, 44, NULL, NULL, '', '', 1, NULL, 32, NULL, NULL),
(336, 32, 45, NULL, NULL, '', '', 1, NULL, 32, NULL, NULL),
(337, 32, 46, NULL, NULL, '', '', 1, NULL, 32, NULL, NULL),
(338, 32, 47, NULL, NULL, '0', '14:28:03', NULL, 252, 32, NULL, NULL),
(339, 33, 24, NULL, NULL, '08:17:39', '08:17:39', NULL, 251, 33, NULL, NULL),
(340, 33, 25, NULL, NULL, '10:02:29', '09:57:29', NULL, 1, 33, NULL, NULL),
(341, 33, 26, NULL, NULL, '12:52:30', '12:29:34', NULL, 2, 33, NULL, NULL),
(342, 33, 27, NULL, NULL, '15:25:19', '15:20:19', NULL, 3, 33, NULL, NULL),
(343, 33, 28, NULL, NULL, '', '', 1, NULL, 33, NULL, NULL),
(344, 33, 29, NULL, NULL, '', '', 1, NULL, 33, NULL, NULL),
(345, 33, 30, NULL, NULL, '', '', 1, NULL, 33, NULL, NULL),
(346, 33, 31, NULL, NULL, '', '', 1, NULL, 33, NULL, NULL),
(347, 33, 32, NULL, NULL, '', '', 1, NULL, 33, NULL, NULL),
(348, 33, 33, NULL, NULL, '', '', 1, NULL, 33, NULL, NULL),
(349, 33, 34, NULL, NULL, '', '', 1, NULL, 33, NULL, NULL),
(350, 33, 35, NULL, NULL, '0', '17:59:37', NULL, 252, 33, NULL, NULL),
(351, 34, 11, NULL, NULL, '07:07:06', '07:07:06', NULL, 251, 34, NULL, NULL),
(352, 34, 12, NULL, NULL, '08:06:48', '08:02:52', NULL, 1, 34, NULL, NULL),
(353, 34, 13, NULL, NULL, '10:38:47', '10:17:04', NULL, 2, 34, NULL, NULL),
(354, 34, 14, NULL, NULL, '12:04:22', '11:59:39', NULL, 3, 34, NULL, NULL),
(355, 34, 15, NULL, NULL, '', '', 1, NULL, 34, NULL, NULL),
(356, 34, 16, NULL, NULL, '', '', 1, NULL, 34, NULL, NULL),
(357, 34, 17, NULL, NULL, '', '', 1, NULL, 34, NULL, NULL),
(358, 34, 18, NULL, NULL, '', '', 1, NULL, 34, NULL, NULL),
(359, 34, 19, NULL, NULL, '', '', 1, NULL, 34, NULL, NULL),
(360, 34, 20, NULL, NULL, '', '', 1, NULL, 34, NULL, NULL),
(361, 34, 21, NULL, NULL, '', '', 1, NULL, 34, NULL, NULL),
(362, 34, 22, NULL, NULL, '', '', 1, NULL, 34, NULL, NULL),
(363, 34, 23, NULL, NULL, '0', '13:08:11', NULL, 252, 34, NULL, NULL),
(364, 35, 11, NULL, NULL, '07:07:14', '07:07:14', NULL, 251, 35, NULL, NULL),
(365, 35, 12, NULL, NULL, '08:40:41', '08:35:41', NULL, 1, 35, NULL, NULL),
(366, 35, 13, NULL, NULL, '12:41:26', '12:19:12', NULL, 2, 35, NULL, NULL),
(367, 35, 14, NULL, NULL, '15:17:10', '15:15:30', NULL, 3, 35, NULL, NULL),
(368, 35, 15, NULL, NULL, '', '', 1, NULL, 35, NULL, NULL),
(369, 35, 16, NULL, NULL, '', '', 1, NULL, 35, NULL, NULL),
(370, 35, 17, NULL, NULL, '', '', 1, NULL, 35, NULL, NULL),
(371, 35, 18, NULL, NULL, '', '', 1, NULL, 35, NULL, NULL),
(372, 35, 19, NULL, NULL, '', '', 1, NULL, 35, NULL, NULL),
(373, 35, 20, NULL, NULL, '', '', 1, NULL, 35, NULL, NULL),
(374, 35, 21, NULL, NULL, '', '', 1, NULL, 35, NULL, NULL),
(375, 35, 22, NULL, NULL, '', '', 1, NULL, 35, NULL, NULL),
(376, 35, 23, NULL, NULL, '0', '18:01:49', NULL, 252, 35, NULL, NULL),
(377, 36, 11, NULL, NULL, '07:07:11', '07:07:11', NULL, 251, 36, NULL, NULL),
(378, 36, 12, NULL, NULL, '08:48:53', '08:44:52', NULL, 1, 36, NULL, NULL),
(379, 36, 13, NULL, NULL, '11:48:55', '11:20:05', NULL, 2, 36, NULL, NULL),
(380, 36, 14, NULL, NULL, '14:55:29', '14:50:29', NULL, 3, 36, NULL, NULL),
(381, 36, 15, NULL, NULL, '', '', 1, NULL, 36, NULL, NULL),
(382, 36, 16, NULL, NULL, '', '', 1, NULL, 36, NULL, NULL),
(383, 36, 17, NULL, NULL, '', '', 1, NULL, 36, NULL, NULL),
(384, 36, 18, NULL, NULL, '', '', 1, NULL, 36, NULL, NULL),
(385, 36, 19, NULL, NULL, '', '', 1, NULL, 36, NULL, NULL),
(386, 36, 20, NULL, NULL, '', '', 1, NULL, 36, NULL, NULL),
(387, 36, 21, NULL, NULL, '', '', 1, NULL, 36, NULL, NULL),
(388, 36, 22, NULL, NULL, '', '', 1, NULL, 36, NULL, NULL),
(389, 36, 23, NULL, NULL, '0', '16:59:35', NULL, 252, 36, NULL, NULL),
(390, 37, 1, NULL, NULL, '', '', NULL, 251, 37, NULL, NULL),
(391, 37, 2, NULL, NULL, '', '', NULL, 1, 37, NULL, NULL),
(392, 37, 3, NULL, NULL, '', '', 1, NULL, 37, NULL, NULL),
(393, 37, 4, NULL, NULL, '', '', 1, NULL, 37, NULL, NULL),
(394, 37, 5, NULL, NULL, '', '', NULL, 252, 37, NULL, NULL),
(395, 38, 1, NULL, NULL, '', '', NULL, 251, 38, NULL, NULL),
(396, 38, 2, NULL, NULL, '', '', NULL, 1, 38, NULL, NULL),
(397, 38, 3, NULL, NULL, '', '', 1, NULL, 38, NULL, NULL),
(398, 38, 4, NULL, NULL, '', '', 1, NULL, 38, NULL, NULL),
(399, 38, 5, NULL, NULL, '', '', NULL, 252, 38, NULL, NULL),
(400, 39, 1, NULL, NULL, '', '', NULL, 251, 39, NULL, NULL),
(401, 39, 2, NULL, NULL, '', '', NULL, 1, 39, NULL, NULL),
(402, 39, 3, NULL, NULL, '', '', 1, NULL, 39, NULL, NULL),
(403, 39, 4, NULL, NULL, '', '', 1, NULL, 39, NULL, NULL),
(404, 39, 5, NULL, NULL, '', '', NULL, 252, 39, NULL, NULL),
(405, 40, 11, NULL, NULL, '07:07:09', '07:07:09', NULL, 251, 40, NULL, NULL),
(406, 40, 12, NULL, NULL, '08:24:07', '08:19:21', NULL, 1, 40, NULL, NULL),
(407, 40, 13, NULL, NULL, '11:39:19', '11:10:04', NULL, 2, 40, NULL, NULL),
(408, 40, 14, NULL, NULL, '13:25:16', '13:20:16', NULL, 3, 40, NULL, NULL),
(409, 40, 15, NULL, NULL, '', '', 1, NULL, 40, NULL, NULL),
(410, 40, 16, NULL, NULL, '', '', 1, NULL, 40, NULL, NULL),
(411, 40, 17, NULL, NULL, '', '', 1, NULL, 40, NULL, NULL),
(412, 40, 18, NULL, NULL, '', '', 1, NULL, 40, NULL, NULL),
(413, 40, 19, NULL, NULL, '', '', 1, NULL, 40, NULL, NULL),
(414, 40, 20, NULL, NULL, '', '', 1, NULL, 40, NULL, NULL),
(415, 40, 21, NULL, NULL, '', '', 1, NULL, 40, NULL, NULL),
(416, 40, 22, NULL, NULL, '', '', 1, NULL, 40, NULL, NULL),
(417, 40, 23, NULL, NULL, '0', '14:53:58', NULL, 252, 40, NULL, NULL),
(418, 41, 1, NULL, NULL, '', '', NULL, 251, 41, NULL, NULL),
(419, 41, 2, NULL, NULL, '', '', NULL, 1, 41, NULL, NULL),
(420, 41, 3, NULL, NULL, '', '', 1, NULL, 41, NULL, NULL),
(421, 41, 4, NULL, NULL, '', '', 1, NULL, 41, NULL, NULL),
(422, 41, 5, NULL, NULL, '', '', NULL, 252, 41, NULL, NULL),
(423, 42, 1, NULL, NULL, '', '', NULL, 251, 42, NULL, NULL),
(424, 42, 2, NULL, NULL, '', '', NULL, 1, 42, NULL, NULL),
(425, 42, 3, NULL, NULL, '', '', 1, NULL, 42, NULL, NULL),
(426, 42, 4, NULL, NULL, '', '', 1, NULL, 42, NULL, NULL),
(427, 42, 5, NULL, NULL, '', '', NULL, 252, 42, NULL, NULL),
(428, 43, 1, NULL, NULL, '', '', NULL, 251, 43, NULL, NULL),
(429, 43, 2, NULL, NULL, '', '', NULL, 1, 43, NULL, NULL),
(430, 43, 3, NULL, NULL, '', '', 1, NULL, 43, NULL, NULL),
(431, 43, 4, NULL, NULL, '', '', 1, NULL, 43, NULL, NULL),
(432, 43, 5, NULL, NULL, '', '', NULL, 252, 43, NULL, NULL),
(433, 44, 1, NULL, NULL, '', '', NULL, 251, 44, NULL, NULL),
(434, 44, 2, NULL, NULL, '', '', NULL, 1, 44, NULL, NULL),
(435, 44, 3, NULL, NULL, '', '', 1, NULL, 44, NULL, NULL),
(436, 44, 4, NULL, NULL, '', '', 1, NULL, 44, NULL, NULL),
(437, 44, 5, NULL, NULL, '', '', NULL, 252, 44, NULL, NULL),
(438, 45, 1, NULL, NULL, '', '', NULL, 251, 45, NULL, NULL),
(439, 45, 2, NULL, NULL, '', '', NULL, 1, 45, NULL, NULL),
(440, 45, 3, NULL, NULL, '', '', 1, NULL, 45, NULL, NULL),
(441, 45, 4, NULL, NULL, '', '', 1, NULL, 45, NULL, NULL),
(442, 45, 5, NULL, NULL, '', '', NULL, 252, 45, NULL, NULL),
(443, 46, 48, NULL, NULL, '07:44:51', '07:44:51', NULL, 251, 46, NULL, NULL),
(444, 46, 49, NULL, NULL, '09:15:02', '09:10:57', NULL, 1, 46, NULL, NULL),
(445, 46, 50, NULL, NULL, '11:47:21', '11:23:12', NULL, 2, 46, NULL, NULL),
(446, 46, 51, NULL, NULL, '13:45:10', '13:40:18', NULL, 3, 46, NULL, NULL),
(447, 46, 52, NULL, NULL, '', '', 1, NULL, 46, NULL, NULL),
(448, 46, 53, NULL, NULL, '', '', 1, NULL, 46, NULL, NULL),
(449, 46, 54, NULL, NULL, '', '', 1, NULL, 46, NULL, NULL),
(450, 46, 55, NULL, NULL, '', '', 1, NULL, 46, NULL, NULL),
(451, 46, 56, NULL, NULL, '', '', 1, NULL, 46, NULL, NULL),
(452, 46, 57, NULL, NULL, '', '', 1, NULL, 46, NULL, NULL),
(453, 46, 58, NULL, NULL, '', '', 1, NULL, 46, NULL, NULL),
(454, 46, 59, NULL, NULL, '0', '15:22:11', NULL, 252, 46, NULL, NULL),
(455, 47, 11, NULL, NULL, '07:07:07', '07:07:07', NULL, 251, 47, NULL, NULL),
(456, 47, 12, NULL, NULL, '08:16:54', '08:14:33', NULL, 1, 47, NULL, NULL),
(457, 47, 13, NULL, NULL, '10:48:56', '10:26:23', NULL, 2, 47, NULL, NULL),
(458, 47, 14, NULL, NULL, '12:17:25', '12:12:55', NULL, 3, 47, NULL, NULL),
(459, 47, 15, NULL, NULL, '', '', 1, NULL, 47, NULL, NULL),
(460, 47, 16, NULL, NULL, '', '', 1, NULL, 47, NULL, NULL),
(461, 47, 17, NULL, NULL, '', '', 1, NULL, 47, NULL, NULL),
(462, 47, 18, NULL, NULL, '', '', 1, NULL, 47, NULL, NULL),
(463, 47, 19, NULL, NULL, '', '', 1, NULL, 47, NULL, NULL),
(464, 47, 20, NULL, NULL, '', '', 1, NULL, 47, NULL, NULL),
(465, 47, 21, NULL, NULL, '', '', 1, NULL, 47, NULL, NULL),
(466, 47, 22, NULL, NULL, '', '', 1, NULL, 47, NULL, NULL),
(467, 47, 23, NULL, NULL, '0', '13:41:17', NULL, 252, 47, NULL, NULL),
(468, 48, 11, NULL, NULL, '07:07:18', '07:07:18', NULL, 251, 48, NULL, NULL),
(469, 48, 12, NULL, NULL, '08:40:04', '08:35:52', NULL, 1, 48, NULL, NULL),
(470, 48, 13, NULL, NULL, '12:29:00', '11:59:00', NULL, 2, 48, NULL, NULL),
(471, 48, 14, NULL, NULL, '14:55:16', '14:50:18', NULL, 3, 48, NULL, NULL),
(472, 48, 15, NULL, NULL, '', '', 1, NULL, 48, NULL, NULL),
(473, 48, 16, NULL, NULL, '', '', 1, NULL, 48, NULL, NULL),
(474, 48, 17, NULL, NULL, '', '', 1, NULL, 48, NULL, NULL),
(475, 48, 18, NULL, NULL, '', '', 1, NULL, 48, NULL, NULL),
(476, 48, 19, NULL, NULL, '', '', 1, NULL, 48, NULL, NULL),
(477, 48, 20, NULL, NULL, '', '', 1, NULL, 48, NULL, NULL),
(478, 48, 21, NULL, NULL, '', '', 1, NULL, 48, NULL, NULL),
(479, 48, 22, NULL, NULL, '', '', 1, NULL, 48, NULL, NULL),
(480, 48, 23, NULL, NULL, '0', '16:42:32', NULL, 252, 48, NULL, NULL),
(481, 49, 11, NULL, NULL, '07:07:12', '07:07:12', NULL, 251, 49, NULL, NULL),
(482, 49, 12, NULL, NULL, '08:36:36', '08:33:37', NULL, 1, 49, NULL, NULL),
(483, 49, 13, NULL, NULL, '12:28:56', '11:58:56', NULL, 2, 49, NULL, NULL),
(484, 49, 14, NULL, NULL, '14:55:14', '14:50:14', NULL, 3, 49, NULL, NULL),
(485, 49, 15, NULL, NULL, '', '', 1, NULL, 49, NULL, NULL),
(486, 49, 16, NULL, NULL, '', '', 1, NULL, 49, NULL, NULL),
(487, 49, 17, NULL, NULL, '', '', 1, NULL, 49, NULL, NULL),
(488, 49, 18, NULL, NULL, '', '', 1, NULL, 49, NULL, NULL),
(489, 49, 19, NULL, NULL, '', '', 1, NULL, 49, NULL, NULL),
(490, 49, 20, NULL, NULL, '', '', 1, NULL, 49, NULL, NULL),
(491, 49, 21, NULL, NULL, '', '', 1, NULL, 49, NULL, NULL),
(492, 49, 22, NULL, NULL, '', '', 1, NULL, 49, NULL, NULL),
(493, 49, 23, NULL, NULL, '0', '16:43:01', NULL, 252, 49, NULL, NULL),
(494, 50, 24, NULL, NULL, '08:17:51', '08:17:51', NULL, 251, 50, NULL, NULL),
(495, 50, 25, NULL, NULL, '09:27:35', '09:25:41', NULL, 1, 50, NULL, NULL),
(496, 50, 26, NULL, NULL, '11:27:50', '11:02:01', NULL, 2, 50, NULL, NULL),
(497, 50, 27, NULL, NULL, '13:09:40', '13:05:05', NULL, 3, 50, NULL, NULL),
(498, 50, 28, NULL, NULL, '', '', 1, NULL, 50, NULL, NULL),
(499, 50, 29, NULL, NULL, '', '', 1, NULL, 50, NULL, NULL),
(500, 50, 30, NULL, NULL, '', '', 1, NULL, 50, NULL, NULL),
(501, 50, 31, NULL, NULL, '', '', 1, NULL, 50, NULL, NULL),
(502, 50, 32, NULL, NULL, '', '', 1, NULL, 50, NULL, NULL),
(503, 50, 33, NULL, NULL, '', '', 1, NULL, 50, NULL, NULL),
(504, 50, 34, NULL, NULL, '', '', 1, NULL, 50, NULL, NULL),
(505, 50, 35, NULL, NULL, '0', '14:28:09', NULL, 252, 50, NULL, NULL),
(506, 51, 48, NULL, NULL, '07:44:56', '07:44:56', NULL, 251, 51, NULL, NULL),
(507, 51, 49, NULL, NULL, '09:06:59', '09:05:05', NULL, 1, 51, NULL, NULL),
(508, 51, 50, NULL, NULL, '11:58:12', '11:30:39', NULL, 2, 51, NULL, NULL),
(509, 51, 51, NULL, NULL, '13:54:03', '13:49:06', NULL, 3, 51, NULL, NULL),
(510, 51, 52, NULL, NULL, '', '', 1, NULL, 51, NULL, NULL),
(511, 51, 53, NULL, NULL, '', '', 1, NULL, 51, NULL, NULL),
(512, 51, 54, NULL, NULL, '', '', 1, NULL, 51, NULL, NULL),
(513, 51, 55, NULL, NULL, '', '', 1, NULL, 51, NULL, NULL),
(514, 51, 56, NULL, NULL, '', '', 1, NULL, 51, NULL, NULL),
(515, 51, 57, NULL, NULL, '', '', 1, NULL, 51, NULL, NULL),
(516, 51, 58, NULL, NULL, '', '', 1, NULL, 51, NULL, NULL),
(517, 51, 59, NULL, NULL, '0', '15:31:57', NULL, 252, 51, NULL, NULL),
(518, 52, 24, NULL, NULL, '08:18:00', '08:18:00', NULL, 251, 52, NULL, NULL),
(519, 52, 25, NULL, NULL, '10:26:00', '10:24:38', NULL, 1, 52, NULL, NULL),
(520, 52, 26, NULL, NULL, '13:59:52', '13:29:52', NULL, 2, 52, NULL, NULL),
(521, 52, 27, NULL, NULL, '16:45:24', '16:43:59', NULL, 3, 52, NULL, NULL),
(522, 52, 28, NULL, NULL, '', '', 1, NULL, 52, NULL, NULL),
(523, 52, 29, NULL, NULL, '', '', 1, NULL, 52, NULL, NULL),
(524, 52, 30, NULL, NULL, '', '', 1, NULL, 52, NULL, NULL),
(525, 52, 31, NULL, NULL, '', '', 1, NULL, 52, NULL, NULL),
(526, 52, 32, NULL, NULL, '', '', 1, NULL, 52, NULL, NULL),
(527, 52, 33, NULL, NULL, '', '', 1, NULL, 52, NULL, NULL),
(528, 52, 34, NULL, NULL, '', '', 1, NULL, 52, NULL, NULL),
(529, 52, 35, NULL, NULL, '0', '18:12:30', NULL, 252, 52, NULL, NULL),
(530, 53, 24, NULL, NULL, '08:18:17', '08:18:17', NULL, 251, 53, NULL, NULL),
(531, 53, 25, NULL, NULL, '10:20:56', '10:15:56', NULL, 1, 53, NULL, NULL),
(532, 53, 26, NULL, NULL, '13:25:55', '12:55:55', NULL, 2, 53, NULL, NULL),
(533, 53, 27, NULL, NULL, '16:36:24', '16:36:24', NULL, 3, 53, NULL, NULL),
(534, 53, 28, NULL, NULL, '', '', 1, NULL, 53, NULL, NULL),
(535, 53, 29, NULL, NULL, '', '', 1, NULL, 53, NULL, NULL),
(536, 53, 30, NULL, NULL, '', '', 1, NULL, 53, NULL, NULL),
(537, 53, 31, NULL, NULL, '', '', 1, NULL, 53, NULL, NULL),
(538, 53, 32, NULL, NULL, '', '', 1, NULL, 53, NULL, NULL),
(539, 53, 33, NULL, NULL, '', '', 1, NULL, 53, NULL, NULL),
(540, 53, 34, NULL, NULL, '', '', 1, NULL, 53, NULL, NULL),
(541, 53, 35, NULL, NULL, '0', '18:13:31', NULL, 252, 53, NULL, NULL),
(542, 54, 1, NULL, NULL, '', '', NULL, 251, 54, NULL, NULL),
(543, 54, 2, NULL, NULL, '', '', NULL, 1, 54, NULL, NULL),
(544, 54, 3, NULL, NULL, '', '', 1, NULL, 54, NULL, NULL),
(545, 54, 4, NULL, NULL, '', '', 1, NULL, 54, NULL, NULL),
(546, 54, 5, NULL, NULL, '', '', NULL, 252, 54, NULL, NULL),
(547, 55, 24, NULL, NULL, '08:20:07', '08:20:07', NULL, 251, 58, NULL, NULL),
(548, 55, 25, NULL, NULL, '09:36:16', '09:31:22', NULL, 1, 58, NULL, NULL),
(549, 55, 26, NULL, NULL, '11:45:27', '11:19:28', NULL, 2, 58, NULL, NULL),
(550, 55, 27, NULL, NULL, '13:31:50', '13:27:44', NULL, 3, 58, NULL, NULL),
(551, 55, 28, NULL, NULL, '', '', 1, NULL, 58, NULL, NULL),
(552, 55, 29, NULL, NULL, '', '', 1, NULL, 58, NULL, NULL),
(553, 55, 30, NULL, NULL, '', '', 1, NULL, 58, NULL, NULL),
(554, 55, 31, NULL, NULL, '', '', 1, NULL, 58, NULL, NULL),
(555, 55, 32, NULL, NULL, '', '', 1, NULL, 58, NULL, NULL),
(556, 55, 33, NULL, NULL, '', '', 1, NULL, 58, NULL, NULL),
(557, 55, 34, NULL, NULL, '', '', 1, NULL, 58, NULL, NULL),
(558, 55, 35, NULL, NULL, '0', '15:07:16', NULL, 252, 58, NULL, NULL);

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
  `uuid_card_raid` mediumint(9) NOT NULL,
  `team_name` varchar(255) DEFAULT NULL,
  `club_id` mediumint(8) UNSIGNED DEFAULT NULL,
  `category_id` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `uuid_card`, `uuid_card_raid`, `team_name`, `club_id`, `category_id`) VALUES
(1, 1, 1, 'Globetrotter', 1, 4),
(2, 2, 2, 'Jnepenii Buzoieni', 3, 4),
(3, 3, 3, 'Paraul Rece', 3, 1),
(4, 4, 4, 'Quantic  Jnepenii', 3, 4),
(5, 5, 5, 'Gaska Zurli', 4, 4),
(6, 6, 6, 'Gaska Plimbareata', 4, 4),
(7, 7, 7, 'Testoasele', 5, 4),
(8, 8, 8, 'Pinguinii Temerari', 6, 4),
(9, 9, 9, 'Zambete Colorate', 7, 4),
(10, 10, 10, 'Pro-Parang', 8, 3),
(11, 11, 11, 'Pro-Parang', 8, 7),
(12, 12, 12, 'Montanierii', 9, 1),
(13, 13, 13, 'Alpin Club Pro-Mont Bucuresti 1', 10, 1),
(14, 14, 14, 'Alpin Club Pro-Mont Bucuresti 2', 10, 1),
(15, 15, 15, 'Alpin Club Pro-Mont Bucuresti ', 10, 3),
(16, 16, 16, 'Alpin Club Pro-Mont Bucuresti ', 10, 7),
(17, 17, 17, 'Alpin Club Pro-Mont Bucuresti', 10, 6),
(18, 18, 18, 'Alpin Club Pro-Mont Bucuresti', 10, 2),
(19, 19, 19, 'Alpin Club Pro-Mont Bucuresti', 10, 4),
(20, 20, 20, 'Curcubeu', 11, 4),
(21, 21, 21, 'Cocosii Juniori', 11, 2),
(22, 22, 22, 'Horinca Racers', 11, 3),
(23, 23, 23, 'Martalogii Intarziati', 11, 4),
(24, 24, 24, 'Pe langa femei', 11, 7),
(25, 25, 25, 'Floare de Coltun', 11, 4),
(26, 26, 26, 'Corifeii', 11, 5),
(27, 27, 27, 'Habarnam', 11, 6),
(28, 28, 28, 'NALA', 11, 4),
(29, 29, 29, 'NALA 2', 11, 6),
(30, 30, 30, 'CURYNYA', 11, 5),
(31, 31, 31, 'Alegria', 11, 1),
(32, 32, 32, 'SAFICO', 11, 5),
(33, 33, 33, 'JMECHERII', 11, 4),
(34, 34, 34, 'COCOSII DIN HASMAS', 11, 3),
(35, 35, 35, 'Maceta', 16, 3),
(36, 36, 36, 'Paleta', 16, 3),
(37, 37, 37, 'Inima Jnepenilor', 3, 1),
(38, 38, 38, 'Steaua Jnepenilor', 3, 1),
(39, 39, 39, 'Vlad Jneapanul', 3, 1),
(40, 40, 40, 'Jnepenii Fantezie', 3, 3),
(41, 41, 41, 'Jnepenii lu\' Para', 3, 1),
(42, 42, 42, 'Jnepenii ATD', 3, 1),
(43, 43, 43, 'Jnpeneiii Bragadinu', 3, 1),
(44, 44, 44, 'Nasii la Jnepeni', 3, 1),
(45, 45, 45, 'Jnepeneii', 3, 1),
(46, 46, 46, 'Jnepenitele Vesele', 3, 6),
(47, 47, 47, 'The Nex', 12, 3),
(48, 48, 48, 'Stim cand am plecat dar nu stim cand ne intarcem', 12, 3),
(49, 49, 49, 'Cum vrei tu pisi', 12, 3),
(50, 50, 50, 'Vuila Banturarita', 13, 4),
(51, 51, 51, 'Pufarinele Salbatice', 13, 6),
(52, 52, 52, 'Mecanturistii Norocosi', 14, 4),
(53, 53, 53, 'Arcasii', 15, 4),
(54, 54, 54, 'Big Foot', 17, 1),
(55, 58, 58, 'Quantic  Cocosul de munte', 11, 4);

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
-- Table structure for table `uuids_raidx`
--

CREATE TABLE `uuids_raidx` (
  `uuid_id` int(8) NOT NULL,
  `uuid_name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `uuids_raidx`
--

INSERT INTO `uuids_raidx` (`uuid_id`, `uuid_name`) VALUES
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
-- Indexes for table `uuids_raidx`
--
ALTER TABLE `uuids_raidx`
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
  MODIFY `station_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `challenge_stations_stages`
--
ALTER TABLE `challenge_stations_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `climbing`
--
ALTER TABLE `climbing`
  MODIFY `climbing_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `club_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
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
  MODIFY `knowledge_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
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
  MODIFY `orienteering_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `orienteering_stages`
--
ALTER TABLE `orienteering_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `participations`
--
ALTER TABLE `participations`
  MODIFY `participation_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `participation_entries`
--
ALTER TABLE `participation_entries`
  MODIFY `entry_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=559;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
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
-- AUTO_INCREMENT for table `uuids_raidx`
--
ALTER TABLE `uuids_raidx`
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
