-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 01, 2025 at 07:32 AM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
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
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `order_start` int NOT NULL DEFAULT '1',
  `points` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `order_start`, `points`, `created_at`, `updated_at`) VALUES
(1, 'Family', 4, 500, NULL, '2024-08-02 15:07:31'),
(2, 'Juniori', 1, 500, NULL, '2024-08-02 15:07:31'),
(3, 'Elite', 3, 500, NULL, '2024-07-19 17:07:20'),
(4, 'Open', 5, 400, NULL, '2024-08-02 15:07:31'),
(5, 'Veterani', 6, 500, NULL, '2024-08-02 15:07:31'),
(6, 'Feminin', 2, 500, NULL, '2024-08-02 15:07:31'),
(7, 'Seniori', 7, 500, NULL, '2024-07-19 17:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stage_id` int DEFAULT '0',
  `climbing` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `name`, `stage_id`, `climbing`, `created_at`, `updated_at`) VALUES
(1, 'Asociatia de Turism si Ecologie Carpatia', 1, 0, '2025-06-01 04:12:44', '2025-06-01 04:12:44'),
(2, 'Asociatia de turism montan \"VIA-RETEZAT\"', 2, 0, '2025-06-01 04:12:56', '2025-06-01 04:12:56'),
(3, 'Clubul de Turism Si Protectia Naturii \"Cocosul de munte\" Brasov', 3, 0, '2025-06-01 04:13:03', '2025-06-01 04:19:38'),
(4, 'Asociatia de Turism Gaska Bucuresti', 4, 0, '2025-06-01 04:13:09', '2025-06-01 04:19:44'),
(5, 'Asociatia Clubul Alpin Temerarii', 5, 0, '2025-06-01 04:13:13', '2025-06-01 04:19:50'),
(10, 'Asociatia pentru Tineret, Sport, Turism si Ecologie Jnepenii', 6, 0, '2025-06-01 04:19:01', '2025-06-01 04:19:01'),
(11, 'Asociatia de Schi Turism Montan Pro-Parang & ATE Carpatia', 7, 0, '2025-06-01 04:20:04', '2025-06-01 04:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `clubs_stage_category_rankings`
--

CREATE TABLE `clubs_stage_category_rankings` (
  `id` int NOT NULL,
  `stage_id` int NOT NULL,
  `category_id` int NOT NULL,
  `club_id` int NOT NULL,
  `scor` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clubs_stage_rankings`
--

CREATE TABLE `clubs_stage_rankings` (
  `id` int NOT NULL,
  `stage_id` int NOT NULL,
  `club_id` int NOT NULL,
  `scor` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cultural`
--

CREATE TABLE `cultural` (
  `id` int NOT NULL,
  `stage_id` int NOT NULL,
  `club_id` int NOT NULL,
  `scor` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `knowledges`
--

CREATE TABLE `knowledges` (
  `id` int NOT NULL,
  `stage_id` int NOT NULL,
  `team_id` int NOT NULL,
  `wrong_answers` int NOT NULL,
  `time` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `abandon` int NOT NULL,
  `wrong_questions` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizer_stages`
--

CREATE TABLE `organizer_stages` (
  `id` int NOT NULL,
  `software` varchar(255) CHARACTER SET utf8mb3 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizer_stages`
--

INSERT INTO `organizer_stages` (`id`, `software`, `created_at`, `updated_at`) VALUES
(1, 'Software Stafeta Muntilor v6.0.0 by Asociatia Drumetii Montane', '2025-05-31 21:00:00', '2025-05-31 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orienteering`
--

CREATE TABLE `orienteering` (
  `id` int NOT NULL,
  `stage_id` int NOT NULL,
  `team_id` int NOT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finish_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abandon` int NOT NULL,
  `missed_posts` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_posts` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orienteering_stations_stages`
--

CREATE TABLE `orienteering_stations_stages` (
  `id` int NOT NULL,
  `stage_id` int NOT NULL,
  `category_id` int NOT NULL,
  `post` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int NOT NULL,
  `ci` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants_stages`
--

CREATE TABLE `participants_stages` (
  `id` int NOT NULL,
  `stage_id` int NOT NULL,
  `participant_id` int NOT NULL,
  `team_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants_stage_rankings`
--

CREATE TABLE `participants_stage_rankings` (
  `id` int NOT NULL,
  `stage_id` int NOT NULL,
  `club_id` int NOT NULL,
  `team_id` int NOT NULL,
  `category_id` int NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `scor` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `raidmontan_participations`
--

CREATE TABLE `raidmontan_participations` (
  `id` int NOT NULL,
  `stage_id` int NOT NULL,
  `team_id` int NOT NULL,
  `missing_equipment_items` int NOT NULL,
  `missing_footwear` int NOT NULL,
  `abandon` int NOT NULL,
  `minimum_distance_penalty` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `raidmontan_participations_entries`
--

CREATE TABLE `raidmontan_participations_entries` (
  `id` int NOT NULL,
  `stage_id` int NOT NULL,
  `raidmontan_participations_id` int NOT NULL,
  `team_id` int NOT NULL,
  `raidmontan_stations_id` int NOT NULL,
  `raidmontan_stations_station_type` int NOT NULL,
  `raidmontan_stations_stages_id` int DEFAULT NULL,
  `time_start` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_finish` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hits` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `raidmontan_stations`
--

CREATE TABLE `raidmontan_stations` (
  `id` int NOT NULL,
  `stage_id` int NOT NULL,
  `category_id` int NOT NULL,
  `station_type` tinyint NOT NULL COMMENT '0 = START, 1 = PA, 2 = PFA, 3 = FINISH',
  `maximum_time` mediumint DEFAULT NULL,
  `points` mediumint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `raidmontan_stations_stages`
--

CREATE TABLE `raidmontan_stations_stages` (
  `id` int NOT NULL,
  `stage_id` int NOT NULL,
  `category_id` int NOT NULL,
  `post` varchar(28) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cod_start` varchar(28) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cod_finish` varchar(28) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE `stages` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `ong` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `name`, `ong`, `created_at`, `updated_at`) VALUES
(1, ' Grand Prix Romania', 'Asociatia de Turism si Ecologie Carpatia', NULL, NULL),
(2, ' Trofeul Via-Retezat', 'Asociatia de turism montan \"VIA-RETEZAT\"', NULL, NULL),
(3, 'Trofeul Cocosul de Munte', 'Clubul de Turism Si Protectia Naturii \"Cocosul de munte\" Brasov', NULL, NULL),
(4, ' Trofeul Muntilor', 'Asociatia de Turism Gaska Bucuresti', NULL, NULL),
(5, ' Trofeul Temerarilor', ' Asociatia Clubul Alpin Temerarii', NULL, NULL),
(6, ' Trofeul Jnepenilor', 'Asociatia pentru Tineret, Sport, Turism si Ecologie Jnepenii', NULL, NULL),
(7, 'Trofeul Pro-Parang', 'Asociatia de Schi Turism Montan Pro-Parang & ATE Carpatia', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int NOT NULL,
  `stage_id` int NOT NULL,
  `number` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `club_id` int NOT NULL,
  `category_id` int NOT NULL,
  `chipno` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_order_start`
--

CREATE TABLE `team_order_start` (
  `id` int NOT NULL,
  `stage_id` int NOT NULL,
  `order_date_start` varchar(255) DEFAULT NULL,
  `order_start_minutes` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_order_start`
--

INSERT INTO `team_order_start` (`id`, `stage_id`, `order_date_start`, `order_start_minutes`, `created_at`, `updated_at`) VALUES
(1, 1, '07:30:00', 1, '2022-12-26 19:54:46', '2024-06-28 17:47:17'),
(2, 2, '10:00:00', 1, '2022-12-26 19:54:46', '2022-12-27 18:53:23'),
(3, 3, '06:00:00', 1, '2022-12-26 19:54:46', '2024-07-19 17:07:20'),
(4, 4, '07:00:00', 1, '2022-12-26 19:54:46', '2024-08-02 15:07:31'),
(5, 5, '10:00:00', 1, '2022-12-26 19:54:46', '2022-12-27 18:53:23'),
(6, 6, '10:00:00', 1, '2022-12-26 19:54:46', '2022-12-27 18:53:23');

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
-- Indexes for table `clubs_stage_category_rankings`
--
ALTER TABLE `clubs_stage_category_rankings`
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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `clubs_stage_category_rankings`
--
ALTER TABLE `clubs_stage_category_rankings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clubs_stage_rankings`
--
ALTER TABLE `clubs_stage_rankings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3244;

--
-- AUTO_INCREMENT for table `cultural`
--
ALTER TABLE `cultural`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `knowledges`
--
ALTER TABLE `knowledges`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizer_stages`
--
ALTER TABLE `organizer_stages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orienteering`
--
ALTER TABLE `orienteering`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orienteering_stations_stages`
--
ALTER TABLE `orienteering_stations_stages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participants_stages`
--
ALTER TABLE `participants_stages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participants_stage_rankings`
--
ALTER TABLE `participants_stage_rankings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `raidmontan_participations`
--
ALTER TABLE `raidmontan_participations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `raidmontan_participations_entries`
--
ALTER TABLE `raidmontan_participations_entries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `raidmontan_stations`
--
ALTER TABLE `raidmontan_stations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `raidmontan_stations_stages`
--
ALTER TABLE `raidmontan_stations_stages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_order_start`
--
ALTER TABLE `team_order_start`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
