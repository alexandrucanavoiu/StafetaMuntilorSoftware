-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2023 at 04:16 PM
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
(6, 'Feminin', 40);

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
(1, 4, 1),
(2, 1, 1),
(4, 6, 1),
(5, 2, 1),
(6, 5, 1),
(7, 3, 1);

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
(2, 1, 1, 130, NULL),
(3, 1, 1, 60, NULL),
(4, 1, 1, 50, NULL),
(5, 1, 1, 180, NULL),
(6, 1, 3, 50, NULL),
(7, 2, 0, NULL, NULL),
(10, 2, 3, 20, NULL),
(11, 4, 0, NULL, NULL),
(12, 4, 1, 120, NULL),
(13, 4, 1, 50, NULL),
(14, 4, 1, 40, NULL),
(15, 4, 1, 170, NULL),
(16, 4, 3, 40, NULL),
(17, 2, 1, 140, NULL),
(20, 5, 0, NULL, NULL),
(21, 5, 1, 115, NULL),
(22, 5, 1, 45, NULL),
(23, 5, 1, 35, NULL),
(24, 5, 1, 150, NULL),
(25, 5, 2, NULL, 200),
(26, 5, 2, NULL, 200),
(27, 5, 2, NULL, 200),
(28, 5, 2, NULL, 200),
(29, 5, 2, NULL, 200),
(30, 5, 2, NULL, 200),
(31, 5, 3, 20, NULL),
(32, 6, 0, NULL, NULL),
(33, 6, 1, 120, NULL),
(34, 6, 1, 50, NULL),
(35, 6, 1, 40, NULL),
(36, 6, 1, 170, NULL),
(37, 6, 2, NULL, 200),
(38, 6, 2, NULL, 200),
(39, 6, 2, NULL, 200),
(40, 6, 2, NULL, 200),
(41, 6, 2, NULL, 200),
(42, 6, 2, NULL, 200),
(43, 6, 3, 40, NULL),
(44, 7, 0, NULL, NULL),
(45, 7, 1, 30, NULL),
(46, 7, 1, 45, NULL),
(47, 7, 1, 15, NULL),
(48, 7, 1, 125, NULL),
(49, 7, 2, NULL, 200),
(50, 7, 2, NULL, 200),
(51, 7, 2, NULL, 200),
(52, 7, 2, NULL, 200),
(53, 7, 2, NULL, 200),
(54, 7, 2, NULL, 200),
(55, 7, 3, 15, NULL),
(56, 1, 2, NULL, 200),
(57, 1, 2, NULL, 200),
(58, 1, 2, NULL, 200),
(59, 1, 2, NULL, 200),
(60, 1, 2, NULL, 200),
(61, 1, 2, NULL, 200),
(62, 4, 2, NULL, 200),
(63, 4, 2, NULL, 200),
(64, 4, 2, NULL, 200),
(65, 4, 2, NULL, 200),
(66, 4, 2, NULL, 200),
(67, 4, 2, NULL, 200),
(68, 2, 1, 80, NULL),
(69, 2, 2, NULL, 200),
(70, 2, 2, NULL, 200);

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
(1, 'Asociatia EcoTuristica "Soimii Dunareni"', 0),
(2, 'Clopos', 0),
(3, 'Hai pe Munte! Iasi', 20),
(4, 'Pro-Parang Petrosani', 0),
(5, 'Zimbrul Carpatin Pitesti', 0),
(6, 'Montan Club "Floarea Reginei"', 10),
(7, 'MecanTurist Galati', 0),
(8, 'Gaska Bucuresti', 10),
(9, 'IA SI urca!', 25),
(10, 'Podgorenii Vrancei', 10),
(11, 'Asociatia de Turism Montan "Cocosul de Munte" Brasov', 30),
(12, 'Sageata Muntilor - Talmaciu', 0),
(13, 'Jnepenii', 0),
(14, 'CTEM Nordic Grup Sibiu', 10),
(15, 'Hai-Hui-Tg-Jiu', 0),
(16, 'CTE Buila Vanturarita', 0);

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
(1, 44, 2, '00:01:21', 260, 0, '1,8'),
(2, 78, 6, '00:01:35', 180, 0, '1,2,7,9,10,14'),
(3, 80, 3, '00:02:31', 240, 0, '7,9,14'),
(4, 79, 0, '00:01:27', 300, 0, '0'),
(5, 45, 0, '00:01:28', 300, 0, '0'),
(6, 8, 0, '00:01:16', 300, 0, '0'),
(7, 46, 1, '00:01:15', 280, 0, '13'),
(8, 29, 5, '00:02:17', 200, 0, '6,7,11,14,15'),
(9, 52, 5, '00:02:39', 200, 0, '3,6,7,12,14'),
(10, 21, 0, '00:00:59', 300, 0, '0'),
(11, 27, 0, '00:01:37', 300, 0, '0'),
(12, 57, 0, '00:01:45', 300, 0, '0'),
(13, 3, 3, '00:02:05', 240, 0, '5,6,9'),
(14, 17, 2, '00:00:56', 260, 0, '5,8'),
(15, 83, 2, '00:01:39', 260, 0, '7,14'),
(16, 47, 2, '00:01:35', 260, 0, '1,5'),
(17, 51, 1, '00:01:52', 280, 0, '3'),
(18, 54, 4, '00:02:07', 220, 0, '1,4,6,9'),
(19, 18, 0, '00:01:11', 300, 0, '0'),
(20, 32, 9, '00:04:27', 120, 0, '1,3,6,8,10,11,13,14,15'),
(21, 15, 0, '00:00:56', 300, 0, '0'),
(22, 25, 0, '00:01:06', 300, 0, '0'),
(23, 43, 0, '00:01:33', 300, 0, '0'),
(24, 16, 1, '00:01:35', 280, 0, '12'),
(25, 42, 0, '00:01:23', 300, 0, '0'),
(26, 82, 4, '00:03:37', 220, 0, '9,13,14,15'),
(27, 14, 3, '00:01:10', 240, 0, '13,14,15'),
(28, 60, 0, '00:01:40', 300, 0, '0'),
(29, 26, 1, '00:01:04', 280, 0, '9'),
(30, 38, 0, '00:01:44', 300, 0, '0'),
(31, 5, 4, '00:02:22', 220, 0, '6,7,12,14'),
(32, 75, 0, '00:01:33', 300, 0, '0'),
(33, 84, 2, '00:01:56', 260, 0, '7,9'),
(34, 10, 0, '00:01:12', 300, 0, '0'),
(35, 85, 4, '00:03:09', 220, 0, '1,9,11,14'),
(36, 55, 0, '00:01:30', 300, 0, '0'),
(37, 33, 2, '00:03:03', 260, 0, '7,9'),
(38, 36, 1, '00:01:30', 280, 0, '4'),
(39, 64, 0, '00:01:15', 300, 0, '0'),
(40, 37, 0, '00:00:59', 300, 0, '0'),
(41, 9, 0, '00:01:02', 300, 0, '0'),
(42, 77, 0, '00:01:33', 300, 0, '0'),
(43, 73, 1, '00:01:20', 280, 0, '11'),
(44, 22, 0, '00:01:23', 300, 0, '0'),
(45, 61, 0, '00:01:39', 300, 0, '0'),
(46, 62, 0, '00:02:15', 300, 0, '0'),
(47, 72, 1, '00:02:07', 280, 0, '5'),
(48, 48, 1, '00:02:05', 280, 0, '5'),
(49, 19, 0, '00:01:23', 300, 0, '0'),
(50, 28, 3, '00:02:59', 240, 0, '4,5,9'),
(51, 76, 0, '00:01:55', 300, 0, '0'),
(52, 2, 0, '00:02:18', 300, 0, '0'),
(53, 1, 2, '00:01:26', 260, 0, '9,13'),
(54, 59, 2, '00:03:30', 260, 0, '8,9'),
(55, 6, 0, '00:01:07', 300, 0, '0'),
(56, 20, 1, '00:01:13', 280, 0, '14'),
(57, 50, 2, '00:01:45', 260, 0, '7,8'),
(58, 30, 0, '00:00:00', 0, 1, '0'),
(59, 56, 1, '00:02:35', 280, 0, '8'),
(60, 74, 1, '00:01:34', 280, 0, '13'),
(61, 41, 2, '00:01:13', 260, 0, '7,8'),
(62, 7, 1, '00:01:08', 280, 0, '9'),
(63, 70, 0, '00:01:19', 300, 0, '0'),
(64, 53, 2, '00:01:37', 260, 0, '7,13'),
(65, 11, 1, '00:01:09', 280, 0, '7'),
(66, 31, 7, '00:01:59', 160, 0, '2,3,6,7,8,9,14'),
(67, 39, 2, '00:01:23', 260, 0, '7,9'),
(68, 40, 0, '00:01:50', 300, 0, '0'),
(69, 35, 1, '00:01:42', 280, 0, '1'),
(70, 34, 0, '00:01:57', 300, 0, '0'),
(71, 13, 0, '00:01:22', 300, 0, '0'),
(72, 12, 2, '00:01:36', 260, 0, '7,13'),
(73, 24, 3, '00:01:58', 240, 0, '1,2,7'),
(74, 58, 1, '00:01:56', 280, 0, '12'),
(75, 4, 0, '00:01:25', 300, 0, '0'),
(76, 23, 0, '00:02:25', 300, 0, '0'),
(77, 81, 0, '00:00:00', 0, 1, '0');

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
(1, 'Numele Trofeului', 'Asociatia Organizatoare', 'Amical');

-- --------------------------------------------------------

--
-- Table structure for table `orienteering`
--

CREATE TABLE `orienteering` (
  `orienteering_id` int(8) NOT NULL,
  `team_id` mediumint(8) NOT NULL,
  `name_participant` varchar(255) NOT NULL,
  `start` varchar(255) NOT NULL,
  `finish` varchar(255) NOT NULL,
  `total` varchar(8) NOT NULL,
  `abandon` mediumint(8) NOT NULL,
  `missed_posts` mediumint(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orienteering`
--

INSERT INTO `orienteering` (`orienteering_id`, `team_id`, `name_participant`, `start`, `finish`, `total`, `abandon`, `missed_posts`) VALUES
(1, 44, 'The Le coq sportif', '07:46:00', '08:12:10', '00:26:10', 0, 0),
(2, 18, 'Hai pe munte Iasi! Buco Vikings', '07:34:00', '07:51:12', '00:17:12', 0, 0),
(3, 83, 'Buila Vanturarita 1', '07:29:00', '07:41:46', '00:12:46', 0, 0),
(4, 32, 'Terezianu', '07:20:00', '07:59:08', '00:39:08', 0, 0),
(5, 8, 'Gaska Preafericitilor', '07:16:00', '07:35:20', '00:19:20', 0, 0),
(6, 47, 'Echipa Castigatoare', '07:05:00', '07:32:19', '00:27:19', 0, 0),
(7, 15, 'Hai pe munte Iasi! D.E.C.A.T', '07:11:00', '07:21:25', '00:10:25', 0, 0),
(8, 80, 'Animale preistorice', '08:08:00', '08:48:48', '00:40:48', 0, 0),
(9, 57, 'IA SI urca 3', '07:17:00', '07:53:38', '00:36:38', 0, 0),
(10, 21, 'Jnepenii Bucurosi', '07:23:00', '07:45:18', '00:22:18', 0, 0),
(11, 25, 'Montan Club Floarea Reginei 3', '07:14:00', '07:33:58', '00:19:58', 0, 0),
(12, 51, 'Podgorenii Vrancei 1', '07:22:00', '07:44:37', '00:22:37', 0, 0),
(13, 3, 'Pro-Parang Crinul de Piatra', '07:15:00', '07:34:08', '00:19:08', 0, 0),
(14, 29, 'Open Fire', '07:21:00', '07:59:34', '00:38:34', 0, 0),
(15, 78, 'Zimbrii Relaxati', '07:52:00', '08:06:41', '00:14:41', 0, 0),
(16, 42, '777', '07:27:00', '07:41:31', '00:14:31', 0, 0),
(17, 16, 'Hai pe munte Iasi! Papusele', '07:25:00', '07:49:29', '00:24:29', 0, 0),
(18, 81, 'Hai Hui Tg-Jiu', '00:00:00', '00:00:00', '00:00:00', 1, 0),
(19, 27, 'Montan Club Floarea Reginei 5', '07:38:00', '07:51:20', '00:13:20', 0, 0),
(20, 52, 'Podgorenii Vrancei 2', '07:30:00', '07:54:48', '00:24:48', 0, 0),
(21, 79, 'Zimbrii Tineri', '07:48:00', '08:09:20', '00:21:20', 0, 0),
(22, 43, 'Castravetii', '07:36:00', '07:46:01', '00:10:01', 0, 0),
(23, 17, 'Hai pe munte Iasi! Happy', '07:40:00', '07:53:09', '00:13:09', 0, 0),
(24, 54, 'Podgorenii Vrancei 4', '07:32:00', '07:52:51', '00:20:51', 0, 0),
(25, 45, 'Cocosul de munte MDF', '07:54:00', '08:18:25', '00:24:25', 0, 0),
(26, 46, '3 Sud-est', '07:56:00', '08:08:01', '00:12:01', 0, 0),
(27, 82, 'Zimbrii Furiosi', '09:12:00', '09:37:43', '00:25:43', 0, 0),
(28, 85, 'Buila-Vanturarita 1', '08:46:00', '09:07:58', '00:21:58', 0, 0),
(29, 84, 'Buila Vanturarita 2', '08:48:00', '09:07:52', '00:19:52', 0, 0),
(30, 36, 'Cocosul de munte 1', '08:52:00', '08:56:16', '00:04:16', 0, 0),
(31, 64, 'Soimii cei mai tari', '08:54:00', '09:06:12', '00:12:12', 0, 0),
(32, 33, 'Slow', '08:50:00', '09:06:01', '00:16:01', 0, 0),
(33, 9, 'Gasca Lesinata', '08:56:00', '09:06:26', '00:10:26', 0, 0),
(34, 10, 'Hai pe munte Iasi!', '08:58:00', '09:07:46', '00:09:46', 0, 0),
(35, 55, 'IA SI urca 1', '09:14:00', '09:25:36', '00:11:36', 0, 0),
(36, 22, 'Jnepenii cu Cuc', '09:16:00', '09:26:06', '00:10:06', 0, 0),
(37, 73, 'Zimbrii Ros-albastri', '09:10:00', '09:20:51', '00:10:51', 0, 0),
(38, 37, 'Sange Verde', '09:06:00', '09:15:17', '00:09:17', 0, 0),
(39, 77, 'Zimbrii Zburatori', '09:04:00', '09:15:10', '00:11:10', 0, 0),
(40, 48, 'Curajoasele', '09:20:00', '09:55:44', '00:35:44', 0, 0),
(41, 59, 'Soimii curajosi', '09:28:00', '09:49:18', '00:21:18', 0, 0),
(42, 1, 'Samanicus', '09:26:00', '09:48:10', '00:22:10', 0, 0),
(43, 30, 'Nordic U.K.', '00:00:00', '00:00:00', '00:00:00', 1, 0),
(44, 20, 'Hai pe munte Iasi! Mara', '09:32:00', '09:52:43', '00:20:43', 0, 0),
(45, 6, 'Mis Mecan Turist', '09:39:00', '09:54:36', '00:15:36', 0, 0),
(46, 28, 'Montan Club Floarea Reginei 6', '09:02:00', '09:25:12', '00:23:12', 0, 0),
(47, 76, 'Zimbrii negri', '09:18:00', '09:35:54', '00:17:54', 0, 0),
(48, 72, 'Cucuietii', '08:44:00', '09:14:55', '00:30:55', 0, 0),
(49, 61, 'Soimii Campioni', '09:34:00', '09:48:36', '00:14:36', 0, 0),
(50, 2, 'Baxtus', '09:24:00', '09:48:52', '00:24:52', 0, 0),
(51, 19, 'Hai pe munte Iasi! Petru', '09:30:00', '09:48:53', '00:18:53', 0, 0),
(52, 62, 'Soimii Viitorului', '09:36:00', '09:51:43', '00:15:43', 0, 0),
(53, 50, 'Alegria', '09:46:00', '10:01:14', '00:15:14', 0, 0),
(54, 58, 'Soimii Dunareni Iubire', '08:26:00', '08:37:41', '00:11:41', 0, 0),
(55, 34, 'Curinia', '08:32:00', '08:46:19', '00:14:19', 0, 0),
(56, 12, 'Forever Young', '08:22:00', '08:38:17', '00:16:17', 0, 0),
(57, 23, 'Floarea Reginei 1', '08:40:00', '09:04:21', '00:24:21', 0, 0),
(58, 4, 'Pro-Parang Inteleptii', '08:34:00', '08:51:44', '00:17:44', 0, 0),
(59, 35, 'Fitnes', '08:30:00', '08:46:04', '00:16:04', 0, 0),
(60, 13, 'Hai pe munte Iasi! oldies but goldies', '08:38:00', '09:05:20', '00:27:20', 0, 0),
(61, 24, 'Floarea Reginei 2', '08:42:00', '09:04:14', '00:22:14', 0, 0),
(62, 39, 'Puicutele', '07:42:00', '07:53:23', '00:11:23', 0, 0),
(63, 70, 'Soimitele vesele', '08:04:00', '08:18:54', '00:14:54', 0, 0),
(64, 31, 'Fetitele Powerpuff', '07:44:00', '08:10:14', '00:26:14', 0, 0),
(65, 7, 'Gaska Fericita', '08:00:00', '08:09:14', '00:09:14', 0, 0),
(66, 11, 'Hai pe munte Iasi!', '08:06:00', '08:24:14', '00:18:14', 0, 0),
(67, 41, 'Ficats', '08:02:00', '08:19:04', '00:17:04', 0, 0),
(68, 56, 'IA SI urca 2', '08:10:00', '08:36:56', '00:26:56', 0, 0),
(69, 53, 'Podgorenii Vrancei 3', '08:18:00', '08:40:37', '00:22:37', 0, 0),
(70, 74, 'Zimbrutele', '07:50:00', '08:10:24', '00:20:24', 0, 0),
(71, 40, 'Nehotaratele', '08:12:00', '08:48:36', '00:36:36', 0, 0),
(72, 38, 'Duracell Revine', '08:14:00', '08:35:14', '00:21:14', 0, 0),
(73, 60, 'Soimii Aurii', '08:24:00', '09:05:00', '00:41:00', 0, 0),
(74, 14, 'Hai pe munte Iasi!', '08:16:00', '08:27:31', '00:11:31', 0, 0),
(75, 26, 'Floarea Reginei 4', '08:28:00', '08:46:21', '00:18:21', 0, 0),
(76, 5, 'Pro-Parang Pokemonii', '08:20:00', '08:46:32', '00:26:32', 0, 0),
(77, 75, 'Zimbrii de Constanta', '08:36:00', '08:46:01', '00:10:01', 0, 0);

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
(1, 15, 1, NULL, NULL, 0, 0, 0, 0),
(2, 81, 1, NULL, NULL, 0, 0, 1, 0),
(3, 48, 2, NULL, NULL, 0, 0, 0, 0),
(4, 59, 2, NULL, NULL, 0, 0, 0, 0),
(5, 1, 2, NULL, NULL, 0, 0, 0, 0),
(6, 30, 2, NULL, NULL, 0, 0, 1, 0),
(7, 20, 2, NULL, NULL, 0, 0, 0, 0),
(8, 6, 2, NULL, NULL, 0, 0, 0, 0),
(9, 28, 2, NULL, NULL, 0, 0, 0, 0),
(10, 76, 2, NULL, NULL, 0, 0, 0, 0),
(11, 72, 2, NULL, NULL, 0, 0, 0, 0),
(12, 61, 2, NULL, NULL, 0, 0, 0, 0),
(13, 2, 2, NULL, NULL, 0, 0, 0, 0),
(14, 19, 2, NULL, NULL, 0, 0, 0, 0),
(15, 62, 2, NULL, NULL, 0, 0, 0, 0),
(16, 50, 2, NULL, NULL, 0, 0, 0, 0),
(17, 39, 4, NULL, NULL, 0, 0, 0, 0),
(18, 70, 4, NULL, NULL, 0, 0, 0, 0),
(19, 31, 4, NULL, NULL, 0, 0, 0, 0),
(20, 7, 4, NULL, NULL, 0, 0, 0, 0),
(21, 11, 4, NULL, NULL, 0, 0, 0, 0),
(22, 41, 4, NULL, NULL, 0, 0, 0, 0),
(23, 51, 1, NULL, NULL, 0, 0, 0, 0),
(24, 38, 5, NULL, NULL, 0, 0, 0, 0),
(25, 60, 5, NULL, NULL, 0, 0, 0, 0),
(26, 14, 5, NULL, NULL, 0, 0, 0, 0),
(27, 26, 5, NULL, NULL, 0, 0, 0, 0),
(28, 5, 5, NULL, NULL, 0, 0, 0, 0),
(29, 75, 5, NULL, NULL, 0, 0, 0, 0),
(30, 58, 6, NULL, NULL, 0, 0, 0, 0),
(31, 34, 6, NULL, NULL, 0, 0, 0, 0),
(32, 12, 6, NULL, NULL, 0, 0, 0, 0),
(33, 23, 6, NULL, NULL, 0, 0, 0, 0),
(34, 4, 6, NULL, NULL, 0, 0, 0, 0),
(35, 35, 6, NULL, NULL, 0, 0, 0, 0),
(36, 13, 6, NULL, NULL, 0, 0, 0, 0),
(37, 24, 6, NULL, NULL, 0, 0, 0, 0),
(38, 56, 4, NULL, NULL, 0, 0, 0, 0),
(39, 74, 4, NULL, NULL, 0, 0, 0, 0),
(40, 53, 4, NULL, NULL, 0, 0, 0, 0),
(41, 40, 4, NULL, NULL, 0, 0, 0, 0),
(42, 84, 7, NULL, NULL, 0, 0, 1, 0),
(43, 85, 7, NULL, NULL, 0, 0, 1, 0),
(44, 36, 7, NULL, NULL, 0, 0, 0, 0),
(45, 64, 7, NULL, NULL, 0, 0, 0, 0),
(46, 33, 7, NULL, NULL, 0, 0, 1, 0),
(47, 9, 7, NULL, NULL, 0, 0, 1, 0),
(48, 10, 7, NULL, NULL, 0, 0, 0, 0),
(49, 55, 7, NULL, NULL, 0, 0, 0, 0),
(50, 22, 7, NULL, NULL, 0, 0, 0, 0),
(51, 73, 7, NULL, NULL, 0, 0, 0, 0),
(52, 37, 7, NULL, NULL, 0, 0, 0, 0),
(53, 77, 7, NULL, NULL, 0, 0, 0, 0),
(54, 47, 1, NULL, NULL, 0, 0, 0, 0),
(55, 8, 1, NULL, NULL, 0, 0, 0, 0),
(56, 32, 1, NULL, NULL, 0, 0, 1, 0),
(57, 80, 1, NULL, NULL, 0, 0, 0, 0),
(58, 57, 1, NULL, NULL, 0, 0, 0, 0),
(59, 21, 1, NULL, NULL, 0, 0, 0, 0),
(60, 25, 1, NULL, NULL, 0, 0, 0, 0),
(61, 3, 1, NULL, NULL, 0, 0, 0, 0),
(62, 29, 1, NULL, NULL, 0, 0, 0, 0),
(63, 78, 1, NULL, NULL, 0, 0, 0, 0),
(64, 83, 1, NULL, NULL, 0, 0, 0, 0),
(65, 42, 1, NULL, NULL, 0, 0, 0, 0),
(66, 16, 1, NULL, NULL, 0, 0, 0, 0),
(67, 27, 1, NULL, NULL, 0, 0, 0, 0),
(68, 52, 1, NULL, NULL, 0, 0, 0, 0),
(69, 79, 1, NULL, NULL, 0, 0, 0, 0),
(70, 43, 1, NULL, NULL, 0, 0, 0, 0),
(71, 17, 1, NULL, NULL, 0, 0, 0, 0),
(72, 54, 1, NULL, NULL, 0, 0, 0, 0),
(73, 44, 1, NULL, NULL, 0, 0, 0, 0),
(74, 18, 1, NULL, NULL, 0, 0, 0, 0),
(75, 45, 1, NULL, NULL, 0, 0, 0, 0),
(76, 46, 1, NULL, NULL, 0, 0, 0, 0),
(77, 82, 1, NULL, NULL, 0, 0, 0, 0);

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
(1, 1, 1, NULL, NULL, '07:24:00', '', NULL),
(2, 1, 2, NULL, NULL, '08:26:00', '08:16:00', NULL),
(3, 1, 3, NULL, NULL, '09:20:00', '09:00:00', NULL),
(4, 1, 4, NULL, NULL, '10:12:00', '09:42:00', NULL),
(5, 1, 5, NULL, NULL, '11:36:00', '11:26:00', NULL),
(6, 1, 6, NULL, NULL, '', '11:54:00', NULL),
(7, 2, 1, NULL, NULL, '00:00:00', '', NULL),
(8, 2, 2, NULL, NULL, '00:00:00', '00:00:00', NULL),
(9, 2, 3, NULL, NULL, '00:00:00', '00:00:00', NULL),
(10, 2, 4, NULL, NULL, '00:00:00', '00:00:00', NULL),
(11, 2, 5, NULL, NULL, '00:00:00', '00:00:00', NULL),
(12, 2, 6, NULL, NULL, '', '00:00:00', NULL),
(13, 3, 7, NULL, NULL, '09:57:00', '', NULL),
(14, 3, 8, NULL, NULL, NULL, NULL, 1),
(15, 3, 9, NULL, NULL, NULL, NULL, 1),
(16, 3, 10, NULL, NULL, '', '13:34:00', NULL),
(17, 4, 7, NULL, NULL, '09:51:00', '', NULL),
(18, 4, 8, NULL, NULL, NULL, NULL, 1),
(19, 4, 9, NULL, NULL, '12:41:00', '12:36:00', NULL),
(20, 4, 10, NULL, NULL, '', '12:54:00', NULL),
(21, 5, 7, NULL, NULL, '09:49:00', '', NULL),
(22, 5, 8, NULL, NULL, NULL, NULL, 1),
(23, 5, 9, NULL, NULL, NULL, NULL, 1),
(24, 5, 10, NULL, NULL, '', '13:21:00', NULL),
(25, 6, 7, NULL, NULL, '00:00:00', '', NULL),
(26, 6, 8, NULL, NULL, NULL, NULL, 1),
(27, 6, 9, NULL, NULL, '', '', NULL),
(28, 6, 10, NULL, NULL, '', '00:00:00', NULL),
(29, 7, 7, NULL, NULL, '09:54:00', '', NULL),
(30, 7, 8, NULL, NULL, NULL, NULL, 1),
(31, 7, 9, NULL, NULL, NULL, NULL, 1),
(32, 7, 10, NULL, NULL, '', '12:57:00', NULL),
(33, 8, 7, NULL, NULL, '09:57:00', '', NULL),
(34, 8, 8, NULL, NULL, NULL, NULL, 1),
(35, 8, 9, NULL, NULL, NULL, NULL, 1),
(36, 8, 10, NULL, NULL, '', '12:36:00', NULL),
(37, 9, 7, NULL, NULL, '09:27:00', '', NULL),
(38, 9, 8, NULL, NULL, NULL, NULL, 1),
(39, 9, 9, NULL, NULL, NULL, NULL, 1),
(40, 9, 10, NULL, NULL, '', '13:15:00', NULL),
(41, 10, 7, NULL, NULL, '09:42:00', '', NULL),
(42, 10, 8, NULL, NULL, NULL, NULL, 1),
(43, 10, 9, NULL, NULL, NULL, NULL, 1),
(44, 10, 10, NULL, NULL, '', '13:11:00', NULL),
(45, 11, 7, NULL, NULL, '09:18:00', '', NULL),
(46, 11, 8, NULL, NULL, NULL, NULL, 1),
(47, 11, 9, NULL, NULL, NULL, NULL, 1),
(48, 11, 10, NULL, NULL, '', '12:14:00', NULL),
(49, 12, 7, NULL, NULL, '09:52:00', '', NULL),
(50, 12, 8, NULL, NULL, NULL, NULL, 1),
(51, 12, 9, NULL, NULL, NULL, NULL, 1),
(52, 12, 10, NULL, NULL, '', '12:34:00', NULL),
(53, 13, 7, NULL, NULL, '09:50:00', '', NULL),
(54, 13, 8, NULL, NULL, NULL, NULL, 1),
(55, 13, 9, NULL, NULL, NULL, NULL, 1),
(56, 13, 10, NULL, NULL, '', '13:21:00', NULL),
(57, 14, 7, NULL, NULL, '09:52:00', '', NULL),
(58, 14, 8, NULL, NULL, NULL, NULL, 1),
(59, 14, 9, NULL, NULL, NULL, NULL, 1),
(60, 14, 10, NULL, NULL, '', '13:16:00', NULL),
(61, 15, 7, NULL, NULL, '09:53:00', '', NULL),
(62, 15, 8, NULL, NULL, NULL, NULL, 1),
(63, 15, 9, NULL, NULL, NULL, NULL, 1),
(64, 15, 10, NULL, NULL, '', '13:08:00', NULL),
(65, 16, 7, NULL, NULL, '10:25:00', '', NULL),
(66, 16, 8, NULL, NULL, NULL, NULL, 1),
(67, 16, 9, NULL, NULL, NULL, NULL, 1),
(68, 16, 10, NULL, NULL, '', '14:16:00', NULL),
(69, 17, 11, NULL, NULL, '07:55:00', '', NULL),
(70, 17, 12, NULL, NULL, '09:12:00', '09:02:00', NULL),
(71, 17, 13, NULL, NULL, '10:20:00', '10:00:00', NULL),
(72, 17, 14, NULL, NULL, '11:27:00', '10:57:00', NULL),
(73, 17, 15, NULL, NULL, '13:22:00', '13:12:00', NULL),
(74, 17, 16, NULL, NULL, '', '13:47:00', NULL),
(75, 18, 11, NULL, NULL, '08:22:00', '', NULL),
(76, 18, 12, NULL, NULL, '10:01:00', '09:51:00', NULL),
(77, 18, 13, NULL, NULL, '11:43:00', '11:23:00', NULL),
(78, 18, 14, NULL, NULL, '13:12:00', '12:42:00', NULL),
(79, 18, 15, NULL, NULL, '17:05:00', '16:55:00', NULL),
(80, 18, 16, NULL, NULL, '', '17:45:00', NULL),
(81, 19, 11, NULL, NULL, '08:12:00', '', NULL),
(82, 19, 12, NULL, NULL, '10:21:00', '10:11:00', NULL),
(83, 19, 13, NULL, NULL, '12:22:00', '12:02:00', NULL),
(84, 19, 14, NULL, NULL, '13:38:00', '13:23:00', NULL),
(85, 19, 15, NULL, NULL, '17:13:00', '17:03:00', NULL),
(86, 19, 16, NULL, NULL, '', '18:12:00', NULL),
(87, 20, 11, NULL, NULL, '08:11:00', '', NULL),
(88, 20, 12, NULL, NULL, '09:28:00', '09:18:00', NULL),
(89, 20, 13, NULL, NULL, '10:33:00', '10:13:00', NULL),
(90, 20, 14, NULL, NULL, '11:34:00', '11:04:00', NULL),
(91, 20, 15, NULL, NULL, '13:19:00', '13:09:00', NULL),
(92, 20, 16, NULL, NULL, '', '13:44:00', NULL),
(93, 21, 11, NULL, NULL, '08:26:00', '', NULL),
(94, 21, 12, NULL, NULL, '09:38:00', '09:28:00', NULL),
(95, 21, 13, NULL, NULL, '10:56:00', '10:36:00', NULL),
(96, 21, 14, NULL, NULL, '11:45:00', '11:25:00', NULL),
(97, 21, 15, NULL, NULL, '13:49:00', '13:39:00', NULL),
(98, 21, 16, NULL, NULL, '', '14:14:00', NULL),
(99, 22, 11, NULL, NULL, '08:20:00', '', NULL),
(100, 22, 12, NULL, NULL, '09:58:00', '09:48:00', NULL),
(101, 22, 13, NULL, NULL, '11:29:00', '11:09:00', NULL),
(102, 22, 14, NULL, NULL, '12:36:00', '12:06:00', NULL),
(103, 22, 15, NULL, NULL, '15:37:00', '15:27:00', NULL),
(104, 22, 16, NULL, NULL, '', '16:18:00', NULL),
(105, 4, 18, NULL, NULL, '11:46:00', '11:16:00', NULL),
(106, 4, 19, NULL, NULL, '12:41:00', '12:36:00', NULL),
(107, 4, 17, NULL, NULL, '11:46:00', '11:16:00', NULL),
(108, 23, 1, NULL, NULL, '07:46:00', '', NULL),
(109, 23, 2, NULL, NULL, '08:55:00', '08:50:00', NULL),
(110, 23, 3, NULL, NULL, '10:18:00', '09:58:00', NULL),
(111, 23, 4, NULL, NULL, '11:17:00', '11:02:00', NULL),
(112, 23, 5, NULL, NULL, '13:13:00', '13:03:00', NULL),
(113, 23, 56, NULL, NULL, NULL, NULL, 1),
(114, 23, 57, NULL, NULL, NULL, NULL, 1),
(115, 23, 58, NULL, NULL, NULL, NULL, 1),
(116, 23, 59, NULL, NULL, NULL, NULL, 1),
(117, 23, 60, NULL, NULL, NULL, NULL, 1),
(118, 23, 61, NULL, NULL, NULL, NULL, 1),
(119, 23, 6, NULL, NULL, '', '13:37:00', NULL),
(120, 24, 20, NULL, NULL, '08:37:00', '', NULL),
(121, 24, 21, NULL, NULL, '09:27:00', '09:26:00', NULL),
(122, 24, 22, NULL, NULL, '10:20:00', '10:00:00', NULL),
(123, 24, 23, NULL, NULL, '10:59:00', '10:44:00', NULL),
(124, 24, 24, NULL, NULL, '12:30:00', '12:20:00', NULL),
(125, 24, 25, NULL, NULL, NULL, NULL, 1),
(126, 24, 26, NULL, NULL, NULL, NULL, 1),
(127, 24, 27, NULL, NULL, NULL, NULL, 1),
(128, 24, 28, NULL, NULL, NULL, NULL, 1),
(129, 24, 29, NULL, NULL, NULL, NULL, 1),
(130, 24, 30, NULL, NULL, NULL, NULL, 1),
(131, 24, 31, NULL, NULL, '', '12:47:00', NULL),
(132, 25, 20, NULL, NULL, '09:07:00', '', NULL),
(133, 25, 21, NULL, NULL, '10:14:00', '10:04:00', NULL),
(134, 25, 22, NULL, NULL, '11:15:00', '10:55:00', NULL),
(135, 25, 23, NULL, NULL, '12:14:00', '11:44:00', NULL),
(136, 25, 24, NULL, NULL, '14:01:00', '13:51:00', NULL),
(137, 25, 25, NULL, NULL, NULL, NULL, 1),
(138, 25, 26, NULL, NULL, NULL, NULL, 1),
(139, 25, 27, NULL, NULL, NULL, NULL, 1),
(140, 25, 28, NULL, NULL, NULL, NULL, 1),
(141, 25, 29, NULL, NULL, NULL, NULL, 1),
(142, 25, 30, NULL, NULL, NULL, NULL, 1),
(143, 25, 31, NULL, NULL, '', '14:27:00', NULL),
(144, 26, 20, NULL, NULL, '08:28:00', '', NULL),
(145, 26, 21, NULL, NULL, '09:54:00', '09:44:00', NULL),
(146, 26, 22, NULL, NULL, '11:20:00', '11:00:00', NULL),
(147, 26, 23, NULL, NULL, '12:31:00', '12:01:00', NULL),
(148, 26, 24, NULL, NULL, '15:29:00', '15:19:00', NULL),
(149, 26, 25, NULL, NULL, NULL, NULL, 1),
(150, 26, 26, NULL, NULL, NULL, NULL, 1),
(151, 26, 27, NULL, NULL, NULL, NULL, 1),
(152, 26, 28, NULL, NULL, NULL, NULL, 1),
(153, 26, 29, NULL, NULL, NULL, NULL, 1),
(154, 26, 30, NULL, NULL, NULL, NULL, 1),
(155, 26, 31, NULL, NULL, '', '16:05:00', NULL),
(156, 27, 20, NULL, NULL, '08:52:00', '', NULL),
(157, 27, 21, NULL, NULL, '10:30:00', '10:20:00', NULL),
(158, 27, 22, NULL, NULL, '12:11:00', '11:51:00', NULL),
(159, 27, 23, NULL, NULL, '13:11:00', '12:41:00', NULL),
(160, 27, 24, NULL, NULL, '16:52:00', '16:42:00', NULL),
(161, 27, 25, NULL, NULL, NULL, NULL, 1),
(162, 27, 26, NULL, NULL, NULL, NULL, 1),
(163, 27, 27, NULL, NULL, NULL, NULL, 1),
(164, 27, 28, NULL, NULL, NULL, NULL, 1),
(165, 27, 29, NULL, NULL, NULL, NULL, 1),
(166, 27, 30, NULL, NULL, NULL, NULL, 1),
(167, 27, 31, NULL, NULL, '', '17:34:00', NULL),
(168, 28, 20, NULL, NULL, '08:50:00', '', NULL),
(169, 28, 21, NULL, NULL, '10:16:00', '10:06:00', NULL),
(170, 28, 22, NULL, NULL, '11:43:00', '11:23:00', NULL),
(171, 28, 23, NULL, NULL, '12:48:00', '12:28:00', NULL),
(172, 28, 24, NULL, NULL, '15:41:00', '15:31:00', NULL),
(173, 28, 25, NULL, NULL, NULL, NULL, 1),
(174, 28, 26, NULL, NULL, NULL, NULL, 1),
(175, 28, 27, NULL, NULL, NULL, NULL, 1),
(176, 28, 28, NULL, NULL, NULL, NULL, 1),
(177, 28, 29, NULL, NULL, NULL, NULL, 1),
(178, 28, 30, NULL, NULL, NULL, NULL, 1),
(179, 28, 31, NULL, NULL, '', '16:20:00', NULL),
(180, 29, 20, NULL, NULL, '08:47:00', '', NULL),
(181, 29, 21, NULL, NULL, '10:34:00', '10:24:00', NULL),
(182, 29, 22, NULL, NULL, '12:18:00', '11:58:00', NULL),
(183, 29, 23, NULL, NULL, '13:45:00', '13:15:00', NULL),
(184, 29, 24, NULL, NULL, '17:08:00', '16:58:00', NULL),
(185, 29, 25, NULL, NULL, NULL, NULL, 1),
(186, 29, 26, NULL, NULL, NULL, NULL, 1),
(187, 29, 27, NULL, NULL, NULL, NULL, 1),
(188, 29, 28, NULL, NULL, NULL, NULL, 1),
(189, 29, 29, NULL, NULL, NULL, NULL, 1),
(190, 29, 30, NULL, NULL, NULL, NULL, 1),
(191, 29, 31, NULL, NULL, '', '18:08:00', NULL),
(192, 30, 32, NULL, NULL, '08:40:00', '', NULL),
(193, 30, 33, NULL, NULL, '10:01:00', '09:51:00', NULL),
(194, 30, 34, NULL, NULL, '11:08:00', '10:52:00', NULL),
(195, 30, 35, NULL, NULL, '12:16:00', '11:46:00', NULL),
(196, 30, 36, NULL, NULL, '14:20:00', '14:10:00', NULL),
(197, 30, 37, NULL, NULL, NULL, NULL, 1),
(198, 30, 38, NULL, NULL, NULL, NULL, 1),
(199, 30, 39, NULL, NULL, NULL, NULL, 1),
(200, 30, 40, NULL, NULL, NULL, NULL, 1),
(201, 30, 41, NULL, NULL, NULL, NULL, 1),
(202, 30, 42, NULL, NULL, NULL, NULL, 1),
(203, 30, 43, NULL, NULL, '', '14:48:00', NULL),
(204, 31, 32, NULL, NULL, '08:47:00', '', NULL),
(205, 31, 33, NULL, NULL, '10:04:00', '09:54:00', NULL),
(206, 31, 34, NULL, NULL, '11:04:00', '10:49:00', NULL),
(207, 31, 35, NULL, NULL, '12:07:00', '11:37:00', NULL),
(208, 31, 36, NULL, NULL, '13:47:00', '13:37:00', NULL),
(209, 31, 37, NULL, NULL, NULL, NULL, 1),
(210, 31, 38, NULL, NULL, NULL, NULL, 1),
(211, 31, 39, NULL, NULL, NULL, NULL, 1),
(212, 31, 40, NULL, NULL, NULL, NULL, 1),
(213, 31, 41, NULL, NULL, NULL, NULL, 1),
(214, 31, 42, NULL, NULL, NULL, NULL, 1),
(215, 31, 43, NULL, NULL, '', '14:12:00', NULL),
(216, 32, 32, NULL, NULL, '08:41:00', '', NULL),
(217, 32, 33, NULL, NULL, '10:11:00', '10:01:00', NULL),
(218, 32, 34, NULL, NULL, '11:19:00', '10:59:00', NULL),
(219, 32, 35, NULL, NULL, '12:23:00', '11:53:00', NULL),
(220, 32, 36, NULL, NULL, '14:54:00', '14:44:00', NULL),
(221, 32, 37, NULL, NULL, NULL, NULL, 1),
(222, 32, 38, NULL, NULL, NULL, NULL, 1),
(223, 32, 39, NULL, NULL, NULL, NULL, 1),
(224, 32, 40, NULL, NULL, NULL, NULL, 1),
(225, 32, 41, NULL, NULL, NULL, NULL, 1),
(226, 32, 42, NULL, NULL, NULL, NULL, 1),
(227, 32, 43, NULL, NULL, '', '15:22:00', NULL),
(228, 33, 32, NULL, NULL, '09:06:00', '', NULL),
(229, 33, 33, NULL, NULL, '10:23:00', '10:13:00', NULL),
(230, 33, 34, NULL, NULL, '11:32:00', '11:12:00', NULL),
(231, 33, 35, NULL, NULL, '12:41:00', '12:11:00', NULL),
(232, 33, 36, NULL, NULL, '14:35:00', '14:25:00', NULL),
(233, 33, 37, NULL, NULL, NULL, NULL, 1),
(234, 33, 38, NULL, NULL, NULL, NULL, 1),
(235, 33, 39, NULL, NULL, NULL, NULL, 1),
(236, 33, 40, NULL, NULL, NULL, NULL, 1),
(237, 33, 41, NULL, NULL, NULL, NULL, 1),
(238, 33, 42, NULL, NULL, NULL, NULL, 1),
(239, 33, 43, NULL, NULL, '', '15:06:00', NULL),
(240, 34, 32, NULL, NULL, '08:52:00', '', NULL),
(241, 34, 33, NULL, NULL, '10:16:00', '10:06:00', NULL),
(242, 34, 34, NULL, NULL, '11:49:00', '11:29:00', NULL),
(243, 34, 35, NULL, NULL, '13:12:00', '12:42:00', NULL),
(244, 34, 36, NULL, NULL, '15:45:00', '15:35:00', NULL),
(245, 34, 37, NULL, NULL, NULL, NULL, 1),
(246, 34, 38, NULL, NULL, NULL, NULL, 1),
(247, 34, 39, NULL, NULL, NULL, NULL, 1),
(248, 34, 40, NULL, NULL, NULL, NULL, 1),
(249, 34, 41, NULL, NULL, NULL, NULL, 1),
(250, 34, 42, NULL, NULL, NULL, NULL, 1),
(251, 34, 43, NULL, NULL, '', '16:20:00', NULL),
(252, 35, 32, NULL, NULL, '08:47:00', '', NULL),
(253, 35, 33, NULL, NULL, '10:12:00', '10:02:00', NULL),
(254, 35, 34, NULL, NULL, '11:20:00', '11:00:00', NULL),
(255, 35, 35, NULL, NULL, '12:33:00', '12:03:00', NULL),
(256, 35, 36, NULL, NULL, '14:53:00', '14:52:00', NULL),
(257, 35, 37, NULL, NULL, NULL, NULL, 1),
(258, 35, 38, NULL, NULL, NULL, NULL, 1),
(259, 35, 39, NULL, NULL, NULL, NULL, 1),
(260, 35, 40, NULL, NULL, NULL, NULL, 1),
(261, 35, 41, NULL, NULL, NULL, NULL, 1),
(262, 35, 42, NULL, NULL, NULL, NULL, 1),
(263, 35, 43, NULL, NULL, '', '15:26:00', NULL),
(264, 36, 32, NULL, NULL, '09:06:00', '', NULL),
(265, 36, 33, NULL, NULL, '10:37:00', '10:27:00', NULL),
(266, 36, 34, NULL, NULL, '11:58:00', '11:38:00', NULL),
(267, 36, 35, NULL, NULL, '13:06:00', '12:46:00', NULL),
(268, 36, 36, NULL, NULL, '15:38:00', '15:28:00', NULL),
(269, 36, 37, NULL, NULL, NULL, NULL, 1),
(270, 36, 38, NULL, NULL, NULL, NULL, 1),
(271, 36, 39, NULL, NULL, NULL, NULL, 1),
(272, 36, 40, NULL, NULL, NULL, NULL, 1),
(273, 36, 41, NULL, NULL, NULL, NULL, 1),
(274, 36, 42, NULL, NULL, NULL, NULL, 1),
(275, 36, 43, NULL, NULL, '', '16:15:00', NULL),
(276, 37, 32, NULL, NULL, '09:06:00', '', NULL),
(277, 37, 33, NULL, NULL, '10:23:00', '10:13:00', NULL),
(278, 37, 34, NULL, NULL, '11:26:00', '11:06:00', NULL),
(279, 37, 35, NULL, NULL, '12:23:00', '11:53:00', NULL),
(280, 37, 36, NULL, NULL, '14:21:00', '14:11:00', NULL),
(281, 37, 37, NULL, NULL, NULL, NULL, 1),
(282, 37, 38, NULL, NULL, NULL, NULL, 1),
(283, 37, 39, NULL, NULL, NULL, NULL, 1),
(284, 37, 40, NULL, NULL, NULL, NULL, 1),
(285, 37, 41, NULL, NULL, NULL, NULL, 1),
(286, 37, 42, NULL, NULL, NULL, NULL, 1),
(287, 37, 43, NULL, NULL, '', '14:52:00', NULL),
(288, 17, 62, NULL, NULL, NULL, NULL, 1),
(289, 17, 63, NULL, NULL, NULL, NULL, 1),
(290, 17, 64, NULL, NULL, NULL, NULL, 1),
(291, 17, 65, NULL, NULL, NULL, NULL, 1),
(292, 17, 66, NULL, NULL, NULL, NULL, 1),
(293, 17, 67, NULL, NULL, NULL, NULL, 1),
(294, 18, 62, NULL, NULL, NULL, NULL, 1),
(295, 18, 63, NULL, NULL, NULL, NULL, 1),
(296, 18, 64, NULL, NULL, NULL, NULL, 1),
(297, 18, 65, NULL, NULL, NULL, NULL, 1),
(298, 18, 66, NULL, NULL, NULL, NULL, 1),
(299, 18, 67, NULL, NULL, NULL, NULL, 1),
(300, 19, 62, NULL, NULL, NULL, NULL, 1),
(301, 19, 63, NULL, NULL, NULL, NULL, 1),
(302, 19, 64, NULL, NULL, NULL, NULL, 1),
(303, 19, 65, NULL, NULL, NULL, NULL, 1),
(304, 19, 66, NULL, NULL, NULL, NULL, 1),
(305, 19, 67, NULL, NULL, NULL, NULL, 1),
(306, 20, 62, NULL, NULL, NULL, NULL, 1),
(307, 20, 63, NULL, NULL, NULL, NULL, 1),
(308, 20, 64, NULL, NULL, NULL, NULL, 1),
(309, 20, 65, NULL, NULL, NULL, NULL, 1),
(310, 20, 66, NULL, NULL, NULL, NULL, 1),
(311, 20, 67, NULL, NULL, NULL, NULL, 1),
(312, 21, 62, NULL, NULL, NULL, NULL, 1),
(313, 21, 63, NULL, NULL, NULL, NULL, 1),
(314, 21, 64, NULL, NULL, NULL, NULL, 1),
(315, 21, 65, NULL, NULL, NULL, NULL, 1),
(316, 21, 66, NULL, NULL, NULL, NULL, 1),
(317, 21, 67, NULL, NULL, NULL, NULL, 1),
(318, 22, 62, NULL, NULL, NULL, NULL, 1),
(319, 22, 63, NULL, NULL, NULL, NULL, 1),
(320, 22, 64, NULL, NULL, NULL, NULL, 1),
(321, 22, 65, NULL, NULL, NULL, NULL, 1),
(322, 22, 66, NULL, NULL, NULL, NULL, 1),
(323, 22, 67, NULL, NULL, NULL, NULL, 1),
(324, 38, 11, NULL, NULL, '08:41:00', '', NULL),
(325, 38, 12, NULL, NULL, '09:57:00', '09:47:00', NULL),
(326, 38, 13, NULL, NULL, '10:56:00', '10:46:00', NULL),
(327, 38, 14, NULL, NULL, '11:54:00', '11:34:00', NULL),
(328, 38, 15, NULL, NULL, '14:05:00', '13:55:00', NULL),
(329, 38, 62, NULL, NULL, NULL, NULL, 1),
(330, 38, 63, NULL, NULL, NULL, NULL, 1),
(331, 38, 64, NULL, NULL, NULL, NULL, 1),
(332, 38, 65, NULL, NULL, NULL, NULL, 1),
(333, 38, 66, NULL, NULL, NULL, NULL, 1),
(334, 38, 67, NULL, NULL, NULL, NULL, 1),
(335, 38, 16, NULL, NULL, '', '14:29:00', NULL),
(336, 39, 11, NULL, NULL, '08:41:00', '', NULL),
(337, 39, 12, NULL, NULL, '10:34:00', '10:24:00', NULL),
(338, 39, 13, NULL, NULL, '12:18:00', '11:58:00', NULL),
(339, 39, 14, NULL, NULL, '13:45:00', '13:15:00', NULL),
(340, 39, 15, NULL, NULL, '17:09:00', '16:59:00', NULL),
(341, 39, 62, NULL, NULL, NULL, NULL, 1),
(342, 39, 63, NULL, NULL, NULL, NULL, 1),
(343, 39, 64, NULL, NULL, NULL, NULL, 1),
(344, 39, 65, NULL, NULL, NULL, NULL, 1),
(345, 39, 66, NULL, NULL, NULL, NULL, 1),
(346, 39, 67, NULL, NULL, NULL, NULL, 1),
(347, 39, 16, NULL, NULL, '', '18:08:00', NULL),
(348, 40, 11, NULL, NULL, '08:12:00', '', NULL),
(349, 40, 12, NULL, NULL, '10:01:00', '09:51:00', NULL),
(350, 40, 13, NULL, NULL, '11:33:00', '11:23:00', NULL),
(351, 40, 14, NULL, NULL, '12:55:00', '12:45:00', NULL),
(352, 40, 15, NULL, NULL, '16:06:00', '16:01:00', NULL),
(353, 40, 62, NULL, NULL, NULL, NULL, 1),
(354, 40, 63, NULL, NULL, NULL, NULL, 1),
(355, 40, 64, NULL, NULL, NULL, NULL, 1),
(356, 40, 65, NULL, NULL, NULL, NULL, 1),
(357, 40, 66, NULL, NULL, NULL, NULL, 1),
(358, 40, 67, NULL, NULL, NULL, NULL, 1),
(359, 40, 16, NULL, NULL, '', '16:54:00', NULL),
(360, 41, 11, NULL, NULL, '08:49:00', '', NULL),
(361, 41, 12, NULL, NULL, '10:12:00', '10:02:00', NULL),
(362, 41, 13, NULL, NULL, '11:26:00', '11:06:00', NULL),
(363, 41, 14, NULL, NULL, '12:33:00', '12:03:00', NULL),
(364, 41, 15, NULL, NULL, '14:37:00', '14:27:00', NULL),
(365, 41, 62, NULL, NULL, NULL, NULL, 1),
(366, 41, 63, NULL, NULL, NULL, NULL, 1),
(367, 41, 64, NULL, NULL, NULL, NULL, 1),
(368, 41, 65, NULL, NULL, NULL, NULL, 1),
(369, 41, 66, NULL, NULL, NULL, NULL, 1),
(370, 41, 67, NULL, NULL, NULL, NULL, 1),
(371, 41, 16, NULL, NULL, '', '15:05:00', NULL),
(372, 42, 44, NULL, NULL, '', '', NULL),
(373, 42, 45, NULL, NULL, '', '', NULL),
(374, 42, 46, NULL, NULL, '', '', NULL),
(375, 42, 47, NULL, NULL, '', '', NULL),
(376, 42, 48, NULL, NULL, '', '', NULL),
(377, 42, 49, NULL, NULL, NULL, NULL, 1),
(378, 42, 50, NULL, NULL, NULL, NULL, 1),
(379, 42, 51, NULL, NULL, NULL, NULL, 1),
(380, 42, 52, NULL, NULL, NULL, NULL, 1),
(381, 42, 53, NULL, NULL, NULL, NULL, 1),
(382, 42, 54, NULL, NULL, NULL, NULL, 1),
(383, 42, 55, NULL, NULL, '', '', NULL),
(384, 43, 44, NULL, NULL, '', '', NULL),
(385, 43, 45, NULL, NULL, '', '', NULL),
(386, 43, 46, NULL, NULL, '', '', NULL),
(387, 43, 47, NULL, NULL, '', '', NULL),
(388, 43, 48, NULL, NULL, '', '', NULL),
(389, 43, 49, NULL, NULL, NULL, NULL, 1),
(390, 43, 50, NULL, NULL, NULL, NULL, 1),
(391, 43, 51, NULL, NULL, NULL, NULL, 1),
(392, 43, 52, NULL, NULL, NULL, NULL, 1),
(393, 43, 53, NULL, NULL, NULL, NULL, 1),
(394, 43, 54, NULL, NULL, NULL, NULL, 1),
(395, 43, 55, NULL, NULL, '', '', NULL),
(396, 44, 44, NULL, NULL, '09:01:00', '', NULL),
(397, 44, 45, NULL, NULL, '09:51:00', '09:45:00', NULL),
(398, 44, 46, NULL, NULL, '10:53:00', '10:43:00', NULL),
(399, 44, 47, NULL, NULL, '11:28:00', '11:13:00', NULL),
(400, 44, 48, NULL, NULL, '12:48:00', '12:38:00', NULL),
(401, 44, 49, NULL, NULL, NULL, NULL, 1),
(402, 44, 50, NULL, NULL, NULL, NULL, 1),
(403, 44, 51, NULL, NULL, NULL, NULL, 1),
(404, 44, 52, NULL, NULL, NULL, NULL, 1),
(405, 44, 53, NULL, NULL, NULL, NULL, 1),
(406, 44, 54, NULL, NULL, NULL, NULL, 1),
(407, 44, 55, NULL, NULL, '', '13:05:00', NULL),
(408, 45, 44, NULL, NULL, '09:09:00', '', NULL),
(409, 45, 45, NULL, NULL, '10:24:00', '10:14:00', NULL),
(410, 45, 46, NULL, NULL, '12:06:00', '11:51:00', NULL),
(411, 45, 47, NULL, NULL, '13:17:00', '12:47:00', NULL),
(412, 45, 48, NULL, NULL, '15:14:00', '15:04:00', NULL),
(413, 45, 49, NULL, NULL, NULL, NULL, 1),
(414, 45, 50, NULL, NULL, NULL, NULL, 1),
(415, 45, 51, NULL, NULL, NULL, NULL, 1),
(416, 45, 52, NULL, NULL, NULL, NULL, 1),
(417, 45, 53, NULL, NULL, NULL, NULL, 1),
(418, 45, 54, NULL, NULL, NULL, NULL, 1),
(419, 45, 55, NULL, NULL, '', '15:45:00', NULL),
(420, 46, 44, NULL, NULL, '', '', NULL),
(421, 46, 45, NULL, NULL, '', '', NULL),
(422, 46, 46, NULL, NULL, '', '', NULL),
(423, 46, 47, NULL, NULL, '', '', NULL),
(424, 46, 48, NULL, NULL, '', '', NULL),
(425, 46, 49, NULL, NULL, NULL, NULL, 1),
(426, 46, 50, NULL, NULL, NULL, NULL, 1),
(427, 46, 51, NULL, NULL, NULL, NULL, 1),
(428, 46, 52, NULL, NULL, NULL, NULL, 1),
(429, 46, 53, NULL, NULL, NULL, NULL, 1),
(430, 46, 54, NULL, NULL, NULL, NULL, 1),
(431, 46, 55, NULL, NULL, '', '', NULL),
(432, 47, 44, NULL, NULL, '', '', NULL),
(433, 47, 45, NULL, NULL, '', '', NULL),
(434, 47, 46, NULL, NULL, '', '', NULL),
(435, 47, 47, NULL, NULL, '', '', NULL),
(436, 47, 48, NULL, NULL, '', '', NULL),
(437, 47, 49, NULL, NULL, NULL, NULL, 1),
(438, 47, 50, NULL, NULL, NULL, NULL, 1),
(439, 47, 51, NULL, NULL, NULL, NULL, 1),
(440, 47, 52, NULL, NULL, NULL, NULL, 1),
(441, 47, 53, NULL, NULL, NULL, NULL, 1),
(442, 47, 54, NULL, NULL, NULL, NULL, 1),
(443, 47, 55, NULL, NULL, '', '', NULL),
(444, 48, 44, NULL, NULL, '09:12:00', '', NULL),
(445, 48, 45, NULL, NULL, '10:09:00', '09:59:00', NULL),
(446, 48, 46, NULL, NULL, '11:18:00', '11:03:00', NULL),
(447, 48, 47, NULL, NULL, '12:13:00', '11:43:00', NULL),
(448, 48, 48, NULL, NULL, '13:30:00', '13:20:00', NULL),
(449, 48, 49, NULL, NULL, NULL, NULL, 1),
(450, 48, 50, NULL, NULL, NULL, NULL, 1),
(451, 48, 51, NULL, NULL, NULL, NULL, 1),
(452, 48, 52, NULL, NULL, NULL, NULL, 1),
(453, 48, 53, NULL, NULL, NULL, NULL, 1),
(454, 48, 54, NULL, NULL, NULL, NULL, 1),
(455, 48, 55, NULL, NULL, '', '13:47:00', NULL),
(456, 49, 44, NULL, NULL, '09:26:00', '', NULL),
(457, 49, 45, NULL, NULL, '10:13:00', '10:08:00', NULL),
(458, 49, 46, NULL, NULL, '11:25:00', '11:05:00', NULL),
(459, 49, 47, NULL, NULL, '11:58:00', '11:38:00', NULL),
(460, 49, 48, NULL, NULL, '13:20:00', '13:10:00', NULL),
(461, 49, 49, NULL, NULL, NULL, NULL, 1),
(462, 49, 50, NULL, NULL, NULL, NULL, 1),
(463, 49, 51, NULL, NULL, NULL, NULL, 1),
(464, 49, 52, NULL, NULL, NULL, NULL, 1),
(465, 49, 53, NULL, NULL, NULL, NULL, 1),
(466, 49, 54, NULL, NULL, NULL, NULL, 1),
(467, 49, 55, NULL, NULL, '', '13:36:00', NULL),
(468, 50, 44, NULL, NULL, '09:29:00', '', NULL),
(469, 50, 45, NULL, NULL, '10:31:00', '10:21:00', NULL),
(470, 50, 46, NULL, NULL, '11:56:00', '11:41:00', NULL),
(471, 50, 47, NULL, NULL, '12:53:00', '12:23:00', NULL),
(472, 50, 48, NULL, NULL, '14:21:00', '14:11:00', NULL),
(473, 50, 49, NULL, NULL, NULL, NULL, 1),
(474, 50, 50, NULL, NULL, NULL, NULL, 1),
(475, 50, 51, NULL, NULL, NULL, NULL, 1),
(476, 50, 52, NULL, NULL, NULL, NULL, 1),
(477, 50, 53, NULL, NULL, NULL, NULL, 1),
(478, 50, 54, NULL, NULL, NULL, NULL, 1),
(479, 50, 55, NULL, NULL, '', '14:39:00', NULL),
(480, 51, 44, NULL, NULL, '09:24:00', '', NULL),
(481, 51, 45, NULL, NULL, '10:25:00', '10:15:00', NULL),
(482, 51, 46, NULL, NULL, '11:37:00', '11:22:00', NULL),
(483, 51, 47, NULL, NULL, '12:33:00', '12:03:00', NULL),
(484, 51, 48, NULL, NULL, '13:54:00', '13:44:00', NULL),
(485, 51, 49, NULL, NULL, NULL, NULL, 1),
(486, 51, 50, NULL, NULL, NULL, NULL, 1),
(487, 51, 51, NULL, NULL, NULL, NULL, 1),
(488, 51, 52, NULL, NULL, NULL, NULL, 1),
(489, 51, 53, NULL, NULL, NULL, NULL, 1),
(490, 51, 54, NULL, NULL, NULL, NULL, 1),
(491, 51, 55, NULL, NULL, '', '14:12:00', NULL),
(492, 52, 44, NULL, NULL, '09:17:00', '', NULL),
(493, 52, 45, NULL, NULL, '10:17:00', '10:07:00', NULL),
(494, 52, 46, NULL, NULL, '11:26:00', '11:11:00', NULL),
(495, 52, 47, NULL, NULL, '12:23:00', '11:53:00', NULL),
(496, 52, 48, NULL, NULL, '13:37:00', '13:27:00', NULL),
(497, 52, 49, NULL, NULL, NULL, NULL, 1),
(498, 52, 50, NULL, NULL, NULL, NULL, 1),
(499, 52, 51, NULL, NULL, NULL, NULL, 1),
(500, 52, 52, NULL, NULL, NULL, NULL, 1),
(501, 52, 53, NULL, NULL, NULL, NULL, 1),
(502, 52, 54, NULL, NULL, NULL, NULL, 1),
(503, 52, 55, NULL, NULL, '', '14:03:00', NULL),
(504, 53, 44, NULL, NULL, '09:17:00', '', NULL),
(505, 53, 45, NULL, NULL, '10:24:00', '10:16:00', NULL),
(506, 53, 46, NULL, NULL, '11:34:00', '11:24:00', NULL),
(507, 53, 47, NULL, NULL, '12:39:00', '12:09:00', NULL),
(508, 53, 48, NULL, NULL, '14:21:00', '14:11:00', NULL),
(509, 53, 49, NULL, NULL, NULL, NULL, 1),
(510, 53, 50, NULL, NULL, NULL, NULL, 1),
(511, 53, 51, NULL, NULL, NULL, NULL, 1),
(512, 53, 52, NULL, NULL, NULL, NULL, 1),
(513, 53, 53, NULL, NULL, NULL, NULL, 1),
(514, 53, 54, NULL, NULL, NULL, NULL, 1),
(515, 53, 55, NULL, NULL, '', '14:47:00', NULL),
(516, 3, 18, NULL, NULL, '12:10:00', '11:40:00', NULL),
(517, 3, 19, NULL, NULL, '13:18:00', '13:13:00', NULL),
(518, 3, 17, NULL, NULL, '12:10:00', '11:40:00', NULL),
(519, 5, 18, NULL, NULL, '12:00:00', '11:30:00', NULL),
(520, 5, 19, NULL, NULL, '13:05:00', '13:00:00', NULL),
(521, 5, 17, NULL, NULL, '12:00:00', '11:30:00', NULL),
(522, 6, 18, NULL, NULL, '', '', NULL),
(523, 6, 19, NULL, NULL, '', '', NULL),
(524, 6, 17, NULL, NULL, '00:00:00', '00:00:00', NULL),
(525, 7, 18, NULL, NULL, '11:55:00', '11:25:00', NULL),
(526, 7, 19, NULL, NULL, '12:46:00', '12:41:00', NULL),
(527, 7, 17, NULL, NULL, '11:55:00', '11:25:00', NULL),
(528, 8, 18, NULL, NULL, '11:47:00', '11:17:00', NULL),
(529, 8, 19, NULL, NULL, '12:25:00', '12:20:00', NULL),
(530, 8, 17, NULL, NULL, '11:47:00', '11:17:00', NULL),
(531, 9, 18, NULL, NULL, '11:49:00', '11:19:00', NULL),
(532, 9, 19, NULL, NULL, '13:01:00', '12:56:00', NULL),
(533, 9, 17, NULL, NULL, '11:49:00', '11:19:00', NULL),
(534, 10, 18, NULL, NULL, '11:55:00', '11:25:00', NULL),
(535, 10, 19, NULL, NULL, '12:59:00', '12:54:00', NULL),
(536, 10, 17, NULL, NULL, '11:55:00', '11:25:00', NULL),
(537, 11, 18, NULL, NULL, '11:09:00', '10:39:00', NULL),
(538, 11, 19, NULL, NULL, '11:59:00', '11:54:00', NULL),
(539, 11, 17, NULL, NULL, '11:09:00', '10:39:00', NULL),
(540, 12, 18, NULL, NULL, '11:42:00', '11:12:00', NULL),
(541, 12, 19, NULL, NULL, '12:24:00', '12:19:00', NULL),
(542, 12, 17, NULL, NULL, '11:42:00', '11:12:00', NULL),
(543, 13, 18, NULL, NULL, '12:01:00', '11:31:00', NULL),
(544, 13, 19, NULL, NULL, '13:05:00', '13:00:00', NULL),
(545, 13, 17, NULL, NULL, '12:01:00', '11:31:00', NULL),
(546, 14, 18, NULL, NULL, '11:59:00', '11:29:00', NULL),
(547, 14, 19, NULL, NULL, '13:03:00', '12:58:00', NULL),
(548, 14, 17, NULL, NULL, '11:59:00', '11:29:00', NULL),
(549, 15, 18, NULL, NULL, '11:59:00', '11:29:00', NULL),
(550, 15, 19, NULL, NULL, '12:54:00', '12:45:00', NULL),
(551, 15, 17, NULL, NULL, '11:59:00', '11:29:00', NULL),
(552, 16, 18, NULL, NULL, '12:55:00', '12:36:00', NULL),
(553, 16, 19, NULL, NULL, '14:01:00', '13:56:00', NULL),
(554, 16, 17, NULL, NULL, '12:55:00', '12:36:00', NULL),
(555, 12, 68, NULL, NULL, '12:24:00', '12:19:00', NULL),
(556, 12, 69, NULL, NULL, NULL, NULL, 1),
(557, 12, 70, NULL, NULL, NULL, NULL, 1),
(558, 16, 68, NULL, NULL, '14:01:00', '13:56:00', NULL),
(559, 16, 69, NULL, NULL, NULL, NULL, 1),
(560, 16, 70, NULL, NULL, NULL, NULL, 1),
(561, 15, 68, NULL, NULL, '12:54:00', '12:49:00', NULL),
(562, 15, 69, NULL, NULL, NULL, NULL, 1),
(563, 15, 70, NULL, NULL, NULL, NULL, 1),
(564, 14, 68, NULL, NULL, '13:03:00', '12:58:00', NULL),
(565, 14, 69, NULL, NULL, NULL, NULL, 1),
(566, 14, 70, NULL, NULL, NULL, NULL, 1),
(567, 13, 68, NULL, NULL, '13:05:00', '13:00:00', NULL),
(568, 13, 69, NULL, NULL, NULL, NULL, 1),
(569, 13, 70, NULL, NULL, NULL, NULL, 1),
(570, 11, 68, NULL, NULL, '11:59:00', '11:54:00', NULL),
(571, 11, 69, NULL, NULL, NULL, NULL, 1),
(572, 11, 70, NULL, NULL, NULL, NULL, 1),
(573, 10, 68, NULL, NULL, '12:59:00', '12:54:00', NULL),
(574, 10, 69, NULL, NULL, NULL, NULL, 1),
(575, 10, 70, NULL, NULL, NULL, NULL, 1),
(576, 9, 68, NULL, NULL, '13:01:00', '12:56:00', NULL),
(577, 9, 69, NULL, NULL, NULL, NULL, 1),
(578, 9, 70, NULL, NULL, NULL, NULL, 1),
(579, 8, 68, NULL, NULL, '12:25:00', '12:20:00', NULL),
(580, 8, 69, NULL, NULL, NULL, NULL, 1),
(581, 8, 70, NULL, NULL, NULL, NULL, 1),
(582, 7, 68, NULL, NULL, '12:46:00', '12:41:00', NULL),
(583, 7, 69, NULL, NULL, NULL, NULL, 1),
(584, 7, 70, NULL, NULL, NULL, NULL, 1),
(585, 6, 68, NULL, NULL, '00:00:00', '00:00:00', NULL),
(586, 6, 69, NULL, NULL, NULL, NULL, 1),
(587, 6, 70, NULL, NULL, NULL, NULL, 1),
(588, 5, 68, NULL, NULL, '13:05:00', '13:00:00', NULL),
(589, 5, 69, NULL, NULL, NULL, NULL, 1),
(590, 5, 70, NULL, NULL, NULL, NULL, 1),
(591, 4, 68, NULL, NULL, '12:41:00', '12:36:00', NULL),
(592, 4, 69, NULL, NULL, NULL, NULL, 1),
(593, 4, 70, NULL, NULL, NULL, NULL, 1),
(594, 3, 68, NULL, NULL, '13:18:00', '13:13:00', NULL),
(595, 3, 69, NULL, NULL, NULL, NULL, 1),
(596, 3, 70, NULL, NULL, NULL, NULL, 1),
(597, 54, 1, NULL, NULL, '07:35:00', '', NULL),
(598, 54, 2, NULL, NULL, '09:00:00', '08:50:00', NULL),
(599, 54, 3, NULL, NULL, '10:16:00', '09:56:00', NULL),
(600, 54, 4, NULL, NULL, '11:25:00', '10:55:00', NULL),
(601, 54, 5, NULL, NULL, '13:49:00', '13:39:00', NULL),
(602, 54, 56, NULL, NULL, NULL, NULL, 1),
(603, 54, 57, NULL, NULL, NULL, NULL, 1),
(604, 54, 58, NULL, NULL, NULL, NULL, 1),
(605, 54, 59, NULL, NULL, NULL, NULL, 1),
(606, 54, 60, NULL, NULL, NULL, NULL, 1),
(607, 54, 61, NULL, NULL, NULL, NULL, 1),
(608, 54, 6, NULL, NULL, '', '14:18:00', NULL),
(609, 55, 1, NULL, NULL, '07:37:00', '', NULL),
(610, 55, 2, NULL, NULL, '09:13:00', '09:03:00', NULL),
(611, 55, 3, NULL, NULL, '10:48:00', '10:28:00', NULL),
(612, 55, 4, NULL, NULL, '12:06:00', '11:36:00', NULL),
(613, 55, 5, NULL, NULL, '14:54:00', '14:44:00', NULL),
(614, 55, 56, NULL, NULL, NULL, NULL, 1),
(615, 55, 57, NULL, NULL, NULL, NULL, 1),
(616, 55, 58, NULL, NULL, NULL, NULL, 1),
(617, 55, 59, NULL, NULL, NULL, NULL, 1),
(618, 55, 60, NULL, NULL, NULL, NULL, 1),
(619, 55, 61, NULL, NULL, NULL, NULL, 1),
(620, 55, 6, NULL, NULL, '', '15:30:00', NULL),
(621, 56, 1, NULL, NULL, '', '', NULL),
(622, 56, 2, NULL, NULL, '', '', NULL),
(623, 56, 3, NULL, NULL, '', '', NULL),
(624, 56, 4, NULL, NULL, '', '', NULL),
(625, 56, 5, NULL, NULL, '', '', NULL),
(626, 56, 56, NULL, NULL, NULL, NULL, 1),
(627, 56, 57, NULL, NULL, NULL, NULL, 1),
(628, 56, 58, NULL, NULL, NULL, NULL, 1),
(629, 56, 59, NULL, NULL, NULL, NULL, 1),
(630, 56, 60, NULL, NULL, NULL, NULL, 1),
(631, 56, 61, NULL, NULL, NULL, NULL, 1),
(632, 56, 6, NULL, NULL, '', '', NULL),
(633, 1, 56, NULL, NULL, NULL, NULL, 1),
(634, 1, 57, NULL, NULL, NULL, NULL, 1),
(635, 1, 58, NULL, NULL, NULL, NULL, 1),
(636, 1, 59, NULL, NULL, NULL, NULL, 1),
(637, 1, 60, NULL, NULL, NULL, NULL, 1),
(638, 1, 61, NULL, NULL, NULL, NULL, 1),
(639, 57, 1, NULL, NULL, '08:50:00', '', NULL),
(640, 57, 2, NULL, NULL, '10:11:00', '10:01:00', NULL),
(641, 57, 3, NULL, NULL, '11:22:00', '11:02:00', NULL),
(642, 57, 4, NULL, NULL, '12:31:00', '12:01:00', NULL),
(643, 57, 5, NULL, NULL, '15:10:00', '15:00:00', NULL),
(644, 57, 56, NULL, NULL, NULL, NULL, 1),
(645, 57, 57, NULL, NULL, NULL, NULL, 1),
(646, 57, 58, NULL, NULL, NULL, NULL, 1),
(647, 57, 59, NULL, NULL, NULL, NULL, 1),
(648, 57, 60, NULL, NULL, NULL, NULL, 1),
(649, 57, 61, NULL, NULL, NULL, NULL, 1),
(650, 57, 6, NULL, NULL, '', '15:57:00', NULL),
(651, 58, 1, NULL, NULL, '07:59:00', '', NULL),
(652, 58, 2, NULL, NULL, '09:23:00', '09:13:00', NULL),
(653, 58, 3, NULL, NULL, '10:44:00', '10:24:00', NULL),
(654, 58, 4, NULL, NULL, '11:46:00', '11:26:00', NULL),
(655, 58, 5, NULL, NULL, '14:11:00', '14:06:00', NULL),
(656, 58, 56, NULL, NULL, NULL, NULL, 1),
(657, 58, 57, NULL, NULL, NULL, NULL, 1),
(658, 58, 58, NULL, NULL, NULL, NULL, 1),
(659, 58, 59, NULL, NULL, NULL, NULL, 1),
(660, 58, 60, NULL, NULL, NULL, NULL, 1),
(661, 58, 61, NULL, NULL, NULL, NULL, 1),
(662, 58, 6, NULL, NULL, '', '14:55:00', NULL),
(663, 59, 1, NULL, NULL, '07:46:00', '', NULL),
(664, 59, 2, NULL, NULL, '09:04:00', '08:54:00', NULL),
(665, 59, 3, NULL, NULL, '10:19:00', '09:59:00', NULL),
(666, 59, 4, NULL, NULL, '11:22:00', '10:52:00', NULL),
(667, 59, 5, NULL, NULL, '13:49:00', '13:39:00', NULL),
(668, 59, 56, NULL, NULL, NULL, NULL, 1),
(669, 59, 57, NULL, NULL, NULL, NULL, 1),
(670, 59, 58, NULL, NULL, NULL, NULL, 1),
(671, 59, 59, NULL, NULL, NULL, NULL, 1),
(672, 59, 60, NULL, NULL, NULL, NULL, 1),
(673, 59, 61, NULL, NULL, NULL, NULL, 1),
(674, 59, 6, NULL, NULL, '', '14:10:00', NULL),
(675, 60, 1, NULL, NULL, '07:36:00', '', NULL),
(676, 60, 2, NULL, NULL, '09:00:00', '08:50:00', NULL),
(677, 60, 3, NULL, NULL, '10:08:00', '09:48:00', NULL),
(678, 60, 4, NULL, NULL, '11:13:00', '10:43:00', NULL),
(679, 60, 5, NULL, NULL, '13:22:00', '13:12:00', NULL),
(680, 60, 56, NULL, NULL, NULL, NULL, 1),
(681, 60, 57, NULL, NULL, NULL, NULL, 1),
(682, 60, 58, NULL, NULL, NULL, NULL, 1),
(683, 60, 59, NULL, NULL, NULL, NULL, 1),
(684, 60, 60, NULL, NULL, NULL, NULL, 1),
(685, 60, 61, NULL, NULL, NULL, NULL, 1),
(686, 60, 6, NULL, NULL, '', '13:53:00', NULL),
(687, 61, 1, NULL, NULL, '07:38:00', '', NULL),
(688, 61, 2, NULL, NULL, '09:04:00', '08:54:00', NULL),
(689, 61, 3, NULL, NULL, '10:28:00', '10:08:00', NULL),
(690, 61, 4, NULL, NULL, '11:40:00', '11:10:00', NULL),
(691, 61, 5, NULL, NULL, '14:10:00', '14:00:00', NULL),
(692, 61, 56, NULL, NULL, NULL, NULL, 1),
(693, 61, 57, NULL, NULL, NULL, NULL, 1),
(694, 61, 58, NULL, NULL, NULL, NULL, 1),
(695, 61, 59, NULL, NULL, NULL, NULL, 1),
(696, 61, 60, NULL, NULL, NULL, NULL, 1),
(697, 61, 61, NULL, NULL, NULL, NULL, 1),
(698, 61, 6, NULL, NULL, '', '14:51:00', NULL),
(699, 62, 1, NULL, NULL, '08:02:00', '', NULL),
(700, 62, 2, NULL, NULL, '10:10:00', '09:53:00', NULL),
(701, 62, 3, NULL, NULL, '11:58:00', '11:38:00', NULL),
(702, 62, 4, NULL, NULL, '13:33:00', '13:03:00', NULL),
(703, 62, 5, NULL, NULL, '16:53:00', '16:43:00', NULL),
(704, 62, 56, NULL, NULL, NULL, NULL, 1),
(705, 62, 57, NULL, NULL, NULL, NULL, 1),
(706, 62, 58, NULL, NULL, NULL, NULL, 1),
(707, 62, 59, NULL, NULL, NULL, NULL, 1),
(708, 62, 60, NULL, NULL, NULL, NULL, 1),
(709, 62, 61, NULL, NULL, NULL, NULL, 1),
(710, 62, 6, NULL, NULL, '', '17:36:00', NULL),
(711, 63, 1, NULL, NULL, '08:08:00', '', NULL),
(712, 63, 2, NULL, NULL, '10:14:00', '10:04:00', NULL),
(713, 63, 3, NULL, NULL, '11:42:00', '11:22:00', NULL),
(714, 63, 4, NULL, NULL, '13:03:00', '12:33:00', NULL),
(715, 63, 5, NULL, NULL, '15:52:00', '15:42:00', NULL),
(716, 63, 56, NULL, NULL, NULL, NULL, 1),
(717, 63, 57, NULL, NULL, NULL, NULL, 1),
(718, 63, 58, NULL, NULL, NULL, NULL, 1),
(719, 63, 59, NULL, NULL, NULL, NULL, 1),
(720, 63, 60, NULL, NULL, NULL, NULL, 1),
(721, 63, 61, NULL, NULL, NULL, NULL, 1),
(722, 63, 6, NULL, NULL, '', '16:30:00', NULL),
(723, 64, 1, NULL, NULL, '07:44:00', '', NULL),
(724, 64, 2, NULL, NULL, '08:40:00', '08:30:00', NULL),
(725, 64, 3, NULL, NULL, '09:36:00', '09:16:00', NULL),
(726, 64, 4, NULL, NULL, '10:32:00', '10:02:00', NULL),
(727, 64, 5, NULL, NULL, '11:57:00', '11:47:00', NULL),
(728, 64, 56, NULL, NULL, NULL, NULL, 1),
(729, 64, 57, NULL, NULL, NULL, NULL, 1),
(730, 64, 58, NULL, NULL, NULL, NULL, 1),
(731, 64, 59, NULL, NULL, NULL, NULL, 1),
(732, 64, 60, NULL, NULL, NULL, NULL, 1),
(733, 64, 61, NULL, NULL, NULL, NULL, 0),
(734, 64, 6, NULL, NULL, '', '12:24:00', NULL),
(735, 65, 1, NULL, NULL, '07:43:00', '', NULL),
(736, 65, 2, NULL, NULL, '09:25:00', '09:15:00', NULL),
(737, 65, 3, NULL, NULL, '10:38:00', '10:18:00', NULL),
(738, 65, 4, NULL, NULL, '11:45:00', '11:15:00', NULL),
(739, 65, 5, NULL, NULL, '14:08:00', '13:58:00', NULL),
(740, 65, 56, NULL, NULL, NULL, NULL, 1),
(741, 65, 57, NULL, NULL, NULL, NULL, 1),
(742, 65, 58, NULL, NULL, NULL, NULL, 1),
(743, 65, 59, NULL, NULL, NULL, NULL, 1),
(744, 65, 60, NULL, NULL, NULL, NULL, 1),
(745, 65, 61, NULL, NULL, NULL, NULL, 1),
(746, 65, 6, NULL, NULL, '', '14:51:00', NULL),
(747, 66, 1, NULL, NULL, '07:52:00', '', NULL),
(748, 66, 2, NULL, NULL, '08:52:00', '08:49:00', NULL),
(749, 66, 3, NULL, NULL, '10:11:00', '09:51:00', NULL),
(750, 66, 4, NULL, NULL, '10:50:00', '10:40:00', NULL),
(751, 66, 5, NULL, NULL, '12:45:00', '12:35:00', NULL),
(752, 66, 56, NULL, NULL, NULL, NULL, 1),
(753, 66, 57, NULL, NULL, NULL, NULL, 1),
(754, 66, 58, NULL, NULL, NULL, NULL, 1),
(755, 66, 59, NULL, NULL, NULL, NULL, 1),
(756, 66, 60, NULL, NULL, NULL, NULL, 1),
(757, 66, 61, NULL, NULL, NULL, NULL, 1),
(758, 66, 6, NULL, NULL, '', '13:07:00', NULL),
(759, 67, 1, NULL, NULL, '07:54:00', '', NULL),
(760, 67, 2, NULL, NULL, '09:20:00', '09:10:00', NULL),
(761, 67, 3, NULL, NULL, '10:34:00', '10:14:00', NULL),
(762, 67, 4, NULL, NULL, '11:40:00', '11:10:00', NULL),
(763, 67, 5, NULL, NULL, '14:12:00', '14:02:00', NULL),
(764, 67, 56, NULL, NULL, NULL, NULL, 1),
(765, 67, 57, NULL, NULL, NULL, NULL, 1),
(766, 67, 58, NULL, NULL, NULL, NULL, 1),
(767, 67, 59, NULL, NULL, NULL, NULL, 1),
(768, 67, 60, NULL, NULL, NULL, NULL, 1),
(769, 67, 61, NULL, NULL, NULL, NULL, 1),
(770, 67, 6, NULL, NULL, '', '14:50:00', NULL),
(771, 2, 56, NULL, NULL, NULL, NULL, 1),
(772, 2, 57, NULL, NULL, NULL, NULL, 1),
(773, 2, 58, NULL, NULL, NULL, NULL, 1),
(774, 2, 59, NULL, NULL, NULL, NULL, 1),
(775, 2, 60, NULL, NULL, NULL, NULL, 1),
(776, 2, 61, NULL, NULL, NULL, NULL, 1),
(777, 68, 1, NULL, NULL, '07:56:00', '', NULL),
(778, 68, 2, NULL, NULL, '09:12:00', '09:07:00', NULL),
(779, 68, 3, NULL, NULL, '10:19:00', '10:09:00', NULL),
(780, 68, 4, NULL, NULL, '11:24:00', '10:04:00', NULL),
(781, 68, 5, NULL, NULL, '13:36:00', '13:26:00', NULL),
(782, 68, 56, NULL, NULL, NULL, NULL, 1),
(783, 68, 57, NULL, NULL, NULL, NULL, 1),
(784, 68, 58, NULL, NULL, NULL, NULL, 1),
(785, 68, 59, NULL, NULL, NULL, NULL, 1),
(786, 68, 60, NULL, NULL, NULL, NULL, 1),
(787, 68, 61, NULL, NULL, NULL, NULL, 1),
(788, 68, 6, NULL, NULL, '', '14:06:00', NULL),
(789, 69, 1, NULL, NULL, '08:11:00', '', NULL),
(790, 69, 2, NULL, NULL, '09:34:00', '09:24:00', NULL),
(791, 69, 3, NULL, NULL, '10:50:00', '10:30:00', NULL),
(792, 69, 4, NULL, NULL, '12:01:00', '11:31:00', NULL),
(793, 69, 5, NULL, NULL, '14:32:00', '14:22:00', NULL),
(794, 69, 56, NULL, NULL, NULL, NULL, 1),
(795, 69, 57, NULL, NULL, NULL, NULL, 1),
(796, 69, 58, NULL, NULL, NULL, NULL, 1),
(797, 69, 59, NULL, NULL, NULL, NULL, 1),
(798, 69, 60, NULL, NULL, NULL, NULL, 1),
(799, 69, 61, NULL, NULL, NULL, NULL, 1),
(800, 69, 6, NULL, NULL, '', '15:13:00', NULL),
(801, 70, 1, NULL, NULL, '07:48:00', '', NULL),
(802, 70, 2, NULL, NULL, '08:59:00', '08:49:00', NULL),
(803, 70, 3, NULL, NULL, '10:03:00', '09:43:00', NULL),
(804, 70, 4, NULL, NULL, '11:01:00', '10:31:00', NULL),
(805, 70, 5, NULL, NULL, '12:44:00', '12:34:00', NULL),
(806, 70, 56, NULL, NULL, NULL, NULL, 1),
(807, 70, 57, NULL, NULL, NULL, NULL, 1),
(808, 70, 58, NULL, NULL, NULL, NULL, 1),
(809, 70, 59, NULL, NULL, NULL, NULL, 1),
(810, 70, 60, NULL, NULL, NULL, NULL, 1),
(811, 70, 61, NULL, NULL, NULL, NULL, 1),
(812, 70, 6, NULL, NULL, '', '13:15:00', NULL),
(813, 71, 1, NULL, NULL, '07:55:00', '', NULL),
(814, 71, 2, NULL, NULL, '09:24:00', '09:14:00', NULL),
(815, 71, 3, NULL, NULL, '10:46:00', '10:26:00', NULL),
(816, 71, 4, NULL, NULL, '12:00:00', '11:30:00', NULL),
(817, 71, 5, NULL, NULL, '14:20:00', '14:10:00', NULL),
(818, 71, 56, NULL, NULL, NULL, NULL, 1),
(819, 71, 57, NULL, NULL, NULL, NULL, 1),
(820, 71, 58, NULL, NULL, NULL, NULL, 1),
(821, 71, 59, NULL, NULL, NULL, NULL, 1),
(822, 71, 60, NULL, NULL, NULL, NULL, 1),
(823, 71, 61, NULL, NULL, NULL, NULL, 1),
(824, 71, 6, NULL, NULL, '', '14:49:00', NULL),
(825, 72, 1, NULL, NULL, '07:54:00', '', NULL),
(826, 72, 2, NULL, NULL, '09:44:00', '09:41:00', NULL),
(827, 72, 3, NULL, NULL, '11:42:00', '11:22:00', NULL),
(828, 72, 4, NULL, NULL, '12:24:00', '12:04:00', NULL),
(829, 72, 5, NULL, NULL, '14:38:00', '14:28:00', NULL),
(830, 72, 56, NULL, NULL, NULL, NULL, 1),
(831, 72, 57, NULL, NULL, NULL, NULL, 1),
(832, 72, 58, NULL, NULL, NULL, NULL, 1),
(833, 72, 59, NULL, NULL, NULL, NULL, 1),
(834, 72, 60, NULL, NULL, NULL, NULL, 1),
(835, 72, 61, NULL, NULL, NULL, NULL, 1),
(836, 72, 6, NULL, NULL, '', '15:14:00', NULL),
(837, 73, 1, NULL, NULL, '08:13:00', '', NULL),
(838, 73, 2, NULL, NULL, '10:11:00', '10:01:00', NULL),
(839, 73, 3, NULL, NULL, '12:02:00', '11:42:00', NULL),
(840, 73, 4, NULL, NULL, '13:39:00', '13:09:00', NULL),
(841, 73, 5, NULL, NULL, '16:57:00', '16:47:00', NULL),
(842, 73, 56, NULL, NULL, NULL, NULL, 1),
(843, 73, 57, NULL, NULL, NULL, NULL, 1),
(844, 73, 58, NULL, NULL, NULL, NULL, 1),
(845, 73, 59, NULL, NULL, NULL, NULL, 1),
(846, 73, 60, NULL, NULL, NULL, NULL, 1),
(847, 73, 61, NULL, NULL, NULL, NULL, 1),
(848, 73, 6, NULL, NULL, '', '17:35:00', NULL),
(849, 74, 1, NULL, NULL, '07:58:00', '', NULL),
(850, 74, 2, NULL, NULL, '08:58:00', '08:48:00', NULL),
(851, 74, 3, NULL, NULL, '10:05:00', '09:50:00', NULL),
(852, 74, 4, NULL, NULL, '11:06:00', '10:36:00', NULL),
(853, 74, 5, NULL, NULL, '12:38:00', '12:28:00', NULL),
(854, 74, 56, NULL, NULL, NULL, NULL, 1),
(855, 74, 57, NULL, NULL, NULL, NULL, 1),
(856, 74, 58, NULL, NULL, NULL, NULL, 1),
(857, 74, 59, NULL, NULL, NULL, NULL, 1),
(858, 74, 60, NULL, NULL, NULL, NULL, 1),
(859, 74, 61, NULL, NULL, NULL, NULL, 1),
(860, 74, 6, NULL, NULL, '', '13:03:00', NULL),
(861, 75, 1, NULL, NULL, '08:20:00', '', NULL),
(862, 75, 2, NULL, NULL, '10:00:00', '09:50:00', NULL),
(863, 75, 3, NULL, NULL, '11:30:00', '11:10:00', NULL),
(864, 75, 4, NULL, NULL, '12:37:00', '12:22:00', NULL),
(865, 75, 5, NULL, NULL, '15:48:00', '13:58:00', NULL),
(866, 75, 56, NULL, NULL, NULL, NULL, 1),
(867, 75, 57, NULL, NULL, NULL, NULL, 1),
(868, 75, 58, NULL, NULL, NULL, NULL, 1),
(869, 75, 59, NULL, NULL, NULL, NULL, 1),
(870, 75, 60, NULL, NULL, NULL, NULL, 1),
(871, 75, 61, NULL, NULL, NULL, NULL, 1),
(872, 75, 6, NULL, NULL, '', '16:37:00', NULL),
(873, 76, 1, NULL, NULL, '08:09:00', '', NULL),
(874, 76, 2, NULL, NULL, '09:26:00', '09:16:00', NULL),
(875, 76, 3, NULL, NULL, '10:20:00', '10:10:00', NULL),
(876, 76, 4, NULL, NULL, '11:22:00', '10:52:00', NULL),
(877, 76, 5, NULL, NULL, '13:37:00', '13:27:00', NULL),
(878, 76, 56, NULL, NULL, NULL, NULL, 1),
(879, 76, 57, NULL, NULL, NULL, NULL, 1),
(880, 76, 58, NULL, NULL, NULL, NULL, 1),
(881, 76, 59, NULL, NULL, NULL, NULL, 1),
(882, 76, 60, NULL, NULL, NULL, NULL, 1),
(883, 76, 61, NULL, NULL, NULL, NULL, 1),
(884, 76, 6, NULL, NULL, '', '14:18:00', NULL),
(885, 77, 1, NULL, NULL, '09:40:00', '', NULL),
(886, 77, 2, NULL, NULL, '11:14:00', '11:04:00', NULL),
(887, 77, 3, NULL, NULL, '13:40:00', '13:20:00', NULL),
(888, 77, 4, NULL, NULL, '15:08:00', '14:48:00', NULL),
(889, 77, 5, NULL, NULL, '18:10:00', '18:00:00', NULL),
(890, 77, 56, NULL, NULL, NULL, NULL, 1),
(891, 77, 57, NULL, NULL, NULL, NULL, 1),
(892, 77, 58, NULL, NULL, NULL, NULL, 1),
(893, 77, 59, NULL, NULL, NULL, NULL, 1),
(894, 77, 60, NULL, NULL, NULL, NULL, 1),
(895, 77, 61, NULL, NULL, NULL, NULL, 1),
(896, 77, 6, NULL, NULL, '', '19:12:00', NULL);

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
  `team_name` varchar(255) DEFAULT NULL,
  `club_id` mediumint(8) UNSIGNED DEFAULT NULL,
  `category_id` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `club_id`, `category_id`) VALUES
(1, 'Samanicus', 2, 1),
(2, 'Baxtus', 2, 1),
(3, 'Pro-Parang Crinul de Piatra', 4, 4),
(4, 'Pro-Parang Inteleptii', 4, 5),
(5, 'Pro-Parang Pokemonii', 4, 2),
(6, 'Mis Mecan Turist', 7, 1),
(7, 'GasKa Fericita', 8, 6),
(8, 'Gaska Preafericitilor', 8, 4),
(9, 'Gasca Lesinata', 8, 3),
(10, 'Hai pe munte Iasi!', 3, 3),
(11, 'Hai pe munte Iasi!', 3, 6),
(12, 'Hai pe munte Iasi! Forever Young', 3, 5),
(13, 'Hai pe munte Iasi! Oldies but goldies', 3, 5),
(14, 'Hai pe munte Iasi!', 3, 2),
(15, 'Hai pe munte Iasi! D.E.C.A.T', 3, 4),
(16, 'Hai pe munte Iasi! Papusele', 3, 4),
(17, 'Hai pe munte Iasi! Happy', 3, 4),
(18, 'Hai pe munte Iasi! Buco Vikings', 3, 4),
(19, 'Hai pe munte Iasi! Petru', 3, 1),
(20, 'Hai pe munte Iasi! Mara', 3, 1),
(21, 'Jnepenii Bucurosi', 13, 4),
(22, 'Jnepenii cu cuc', 13, 3),
(23, 'Montan Club Floarea Reginei 1', 6, 5),
(24, 'Montan Club Floarea Reginei 2', 6, 5),
(25, 'Montan Club Floarea Reginei 3', 6, 4),
(26, 'Montan Club Floarea Reginei 4', 6, 2),
(27, 'Montan Club Floarea Reginei 5', 6, 4),
(28, 'Montan Club Floarea Reginei 6', 6, 1),
(29, 'Open Fire', 12, 4),
(30, 'Nordic U.K', 14, 1),
(31, 'Fetitele Powerpuff', 14, 6),
(32, 'Terezian', 14, 4),
(33, 'Slow', 14, 3),
(34, 'Curinia', 11, 5),
(35, 'Fitnes', 11, 5),
(36, 'Cocosul de munte 1', 11, 3),
(37, 'Sange Verde', 11, 3),
(38, 'Duracell Revine', 11, 2),
(39, 'Puicutele', 11, 6),
(40, 'Nehotaratele', 11, 6),
(41, 'Ficats', 11, 6),
(42, '777', 11, 4),
(43, 'Castravetii', 11, 4),
(44, 'The Le Coq Sportif', 11, 4),
(45, 'MDF', 11, 4),
(46, '3 Sud-est', 11, 4),
(47, 'Echipa Castigatoare', 11, 4),
(48, 'Curajoasele', 11, 1),
(50, 'Alegria', 11, 1),
(51, 'Podgorenii Vrancei 1', 10, 4),
(52, 'Podgorenii Vrancei 2', 10, 4),
(53, 'Podgorenii Vrancei 3', 10, 6),
(54, 'Podgorenii Vrancei 4', 10, 4),
(55, 'IA SI urca 1', 9, 3),
(56, 'IA SI urca 2', 9, 6),
(57, 'IA SI urca 3', 9, 4),
(58, 'Soimii Dunareni Iubirea', 1, 5),
(59, 'Soimii Curajosi', 1, 1),
(60, 'Soimii Aurii', 1, 2),
(61, 'Soimii Campioni', 1, 1),
(62, 'Soimii Viitorului', 1, 1),
(64, 'Soimii cei mai tari', 1, 3),
(70, 'Soimitele Vesele', 1, 6),
(72, 'Cucuietii', 11, 1),
(73, 'Zimbrii ros-albastri', 5, 3),
(74, 'Zimbrutele', 5, 6),
(75, 'Zimbrii de Constanta', 5, 2),
(76, 'Zimbrii negrii', 5, 1),
(77, 'Zimbrii Zburatori', 5, 3),
(78, 'Zimbrii Relaxati', 5, 4),
(79, 'Zimbrii Tineri', 5, 4),
(80, 'Animale Preistorice', 15, 4),
(81, 'Hai- Hui-TG- JIU', 15, 4),
(82, 'Zimbrii Furiosi', 5, 4),
(83, 'CTE Buila Vanturarita 1', 16, 4),
(84, 'Buila Vanturarita 2', 16, 3),
(85, 'Buila Vanturarita 1', 16, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
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
  ADD KEY `fk_teams_clubs_1` (`club_id`),
  ADD KEY `fk_teams_categories_1` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `station_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `climbing`
--
ALTER TABLE `climbing`
  MODIFY `climbing_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `club_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `cultural`
--
ALTER TABLE `cultural`
  MODIFY `cultural_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `knowledge`
--
ALTER TABLE `knowledge`
  MODIFY `knowledge_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `organizer`
--
ALTER TABLE `organizer`
  MODIFY `id_organizer` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orienteering`
--
ALTER TABLE `orienteering`
  MODIFY `orienteering_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `participations`
--
ALTER TABLE `participations`
  MODIFY `participation_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `participation_entries`
--
ALTER TABLE `participation_entries`
  MODIFY `entry_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=897;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
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
