-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 30 déc. 2025 à 22:06
-- Version du serveur : 8.4.7
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `registrre`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `instrumentists`
--

DROP TABLE IF EXISTS `instrumentists`;
CREATE TABLE IF NOT EXISTS `instrumentists` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `photo_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `residence` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_instrumentists_role` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `instrumentists`
--

INSERT INTO `instrumentists` (`id`, `photo_path`, `first_name`, `last_name`, `nickname`, `sex`, `birth_date`, `residence`, `phone`, `role_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Elisee', 'KONA', NULL, 'M', '2001-11-01', 'Kové', '92460741', 12, '2025-12-30 17:36:19', '2025-12-30 17:36:19'),
(2, 'instrumentists/MbJx4lu9Q4uydlLWOXAkIZQ2u0KbFGiqIuEkrMdU.jpg', 'Honoré', 'NOMENYO', NULL, 'M', '2002-02-27', 'Cacaveli', '97038738', 11, '2025-12-30 17:36:19', '2025-12-30 20:09:29'),
(3, NULL, 'Jean', 'AGBEMAPLE', 'Kossivi', 'M', '2002-04-17', 'Légbassito', '97030969', 12, '2025-12-30 17:36:19', '2025-12-30 17:36:19'),
(4, NULL, 'Magnim Ange', 'AMANA', NULL, 'M', '2010-01-27', 'Attiémé', '90385379', 12, '2025-12-30 17:36:19', '2025-12-30 17:36:19'),
(5, NULL, 'Joëlle', 'EDORH', NULL, 'F', '2006-06-03', 'Kové', '93771776', 12, '2025-12-30 17:36:19', '2025-12-30 17:36:19'),
(6, NULL, 'Laurenda Tassélissi', 'KONA', NULL, 'F', '2005-10-15', 'Ahonpkoè', '90183064', 10, '2025-12-30 17:36:19', '2025-12-30 18:59:48'),
(7, NULL, 'Daniel', 'GUMEDZOE', NULL, 'M', '2007-06-22', 'Ahonkpoe', '96481332', 12, '2025-12-30 17:36:19', '2025-12-30 17:36:19'),
(8, NULL, 'Gérard Amétépé', 'ALI', NULL, 'M', '2002-12-05', 'Gnamassi', '71781028', 12, '2025-12-30 17:36:19', '2025-12-30 17:36:19'),
(9, NULL, 'Joyce Honorine', 'SENI', NULL, 'F', '2007-05-16', 'Athiomé', '71357534', 12, '2025-12-30 17:36:19', '2025-12-30 17:36:19'),
(10, NULL, 'Edouard', 'ALOHOETE', NULL, 'M', '2006-01-05', 'Sogbossito', '99787147', 12, '2025-12-30 17:36:19', '2025-12-30 19:55:02'),
(11, NULL, 'Akouvi Dorcas', 'ASSOGBAVI', NULL, 'F', '2007-09-20', 'Kové', '90000001', 12, '2025-12-30 17:36:19', '2025-12-30 17:36:19'),
(12, NULL, 'K. Blessing', 'GBEDESSI FOLLY-KLAN', NULL, 'F', '2009-10-31', 'Ahonkpoè', '96632529', 12, '2025-12-30 17:36:19', '2025-12-30 19:26:29'),
(13, NULL, 'Ambroise', 'NOMENYO', NULL, 'M', '1999-12-07', 'Agoè-Sogbossito', '97736626', 3, '2025-12-30 17:36:19', '2025-12-30 19:14:50'),
(14, 'instrumentists/kpZMOIe6wLfXwpvvnBC0I4SrF2MO1mg53jU5sQMH.jpg', 'Oscar Roméo', 'AÏDAM', NULL, 'M', '2006-03-26', 'Ahonpkoè', '71791460', 4, '2025-12-30 19:15:47', '2025-12-30 20:05:22'),
(15, 'instrumentists/0KfWL47Z8FkUt50RpMvguHnNCBET9p2ILv0ZLfud.jpg', 'Osias Ronald', 'AÏDAM', NULL, 'M', '2006-03-26', 'Ahonpkoè', '92317978', 6, '2025-12-30 19:27:32', '2025-12-30 19:36:36'),
(16, NULL, 'Dogbeda', 'DOHOKOU', 'Organisatrice', 'M', '2000-02-02', 'Agoè - Sogbossito', '99 12 03 77‬', 1, '2025-12-30 19:35:32', '2025-12-30 20:27:05'),
(17, 'instrumentists/LrYqsyXrRjusRTfNbyUNIH6VMJcQGTkyNvf6MMjD.jpg', 'Françisco Dzifa', 'AÏDAM', NULL, 'M', '1976-01-13', 'Badou', '93538351', 2, '2025-12-30 19:46:48', '2025-12-30 21:53:58'),
(18, 'instrumentists/cRDac8z8NaM7xma1qts63zVyuA1BdniuRJRAwXOu.jpg', 'Isaac', 'MENSAH', NULL, 'M', '2000-02-02', 'Agoè - Sogbossito', '93 29 77 41', 1, '2025-12-30 19:50:17', '2025-12-30 20:24:05'),
(19, NULL, 'Roi', 'AMANA', NULL, 'M', '2000-02-02', 'Attiémé', '92 28 99 50', 12, '2025-12-30 19:51:32', '2025-12-30 20:22:58'),
(20, NULL, 'Kokou', 'KOFFI', NULL, 'M', '2000-02-02', 'A rendre', '91 26 38 25‬', 9, '2025-12-30 19:52:45', '2025-12-30 20:26:27'),
(21, NULL, 'Bruno', 'AKPAKA', 'Brunette', 'M', '2000-02-02', 'Agoè - Sogbossito', '96 11 19 32', 12, '2025-12-30 19:56:22', '2025-12-30 20:22:11'),
(22, NULL, 'Dominique', 'ALAGBE', NULL, 'M', '2002-08-15', 'A rendre', '70 90 11 50', 12, '2025-12-30 20:19:56', '2025-12-30 20:30:12'),
(23, NULL, 'Kokou Guy', 'KODJILE', NULL, 'M', '2002-12-30', 'Agoè-Sogbossito', '93 38 71 42', 5, '2025-12-30 20:25:26', '2025-12-30 20:25:26'),
(24, NULL, 'Eric', 'DONYO', NULL, 'M', '2025-12-10', 'A rendre', '90550478', 12, '2025-12-30 20:49:01', '2025-12-30 20:49:01'),
(25, NULL, 'O. Jean', 'AFOLABI', NULL, 'M', '2025-12-18', 'A rendre', '92295292', 12, '2025-12-30 21:00:33', '2025-12-30 21:00:33'),
(26, NULL, 'Elie', 'DODEA', NULL, 'M', '2025-12-10', 'A rendre', '90727464', 12, '2025-12-30 21:03:27', '2025-12-30 21:03:27');

-- --------------------------------------------------------

--
-- Structure de la table `instruments`
--

DROP TABLE IF EXISTS `instruments`;
CREATE TABLE IF NOT EXISTS `instruments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('Cuivres','Percussions') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `instruments`
--

INSERT INTO `instruments` (`id`, `name`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Trompette', 'Cuivres', NULL, NULL),
(2, 'Trombone', 'Cuivres', NULL, NULL),
(3, 'Pallette', 'Cuivres', NULL, NULL),
(4, 'Grosse caisse', 'Percussions', NULL, NULL),
(5, 'Caisse claire', 'Percussions', NULL, NULL),
(6, 'Tumba', 'Percussions', NULL, NULL),
(7, 'Cymbales', 'Percussions', NULL, NULL),
(15, 'Tambour', 'Percussions', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `instrument_instrumentist`
--

DROP TABLE IF EXISTS `instrument_instrumentist`;
CREATE TABLE IF NOT EXISTS `instrument_instrumentist` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `instrumentist_id` bigint UNSIGNED NOT NULL,
  `instrument_id` bigint UNSIGNED NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `instrument_instrumentist_instrumentist_id_instrument_id_unique` (`instrumentist_id`,`instrument_id`),
  KEY `instrument_instrumentist_instrument_id_foreign` (`instrument_id`)
) ENGINE=MyISAM AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `instrument_instrumentist`
--

INSERT INTO `instrument_instrumentist` (`id`, `instrumentist_id`, `instrument_id`, `is_primary`, `created_at`, `updated_at`) VALUES
(1, 6, 3, 0, '2025-12-30 18:07:10', '2025-12-30 18:59:48'),
(2, 6, 2, 1, '2025-12-30 18:07:10', '2025-12-30 18:59:48'),
(3, 6, 7, 0, '2025-12-30 18:07:10', '2025-12-30 18:59:48'),
(4, 13, 3, 0, '2025-12-30 18:08:11', '2025-12-30 19:14:50'),
(5, 13, 2, 1, '2025-12-30 18:08:11', '2025-12-30 19:14:50'),
(6, 13, 1, 0, '2025-12-30 18:08:11', '2025-12-30 19:14:50'),
(7, 13, 5, 0, '2025-12-30 18:08:11', '2025-12-30 19:14:50'),
(8, 13, 7, 0, '2025-12-30 18:08:11', '2025-12-30 19:14:50'),
(9, 13, 4, 0, '2025-12-30 18:08:11', '2025-12-30 19:14:50'),
(10, 13, 15, 0, '2025-12-30 18:08:11', '2025-12-30 19:14:50'),
(11, 13, 6, 0, '2025-12-30 18:08:11', '2025-12-30 19:14:50'),
(12, 14, 3, 0, '2025-12-30 19:15:47', '2025-12-30 20:05:22'),
(13, 14, 2, 0, '2025-12-30 19:15:47', '2025-12-30 20:05:22'),
(14, 14, 1, 1, '2025-12-30 19:15:47', '2025-12-30 20:05:22'),
(15, 14, 5, 0, '2025-12-30 19:15:47', '2025-12-30 20:05:22'),
(16, 14, 7, 0, '2025-12-30 19:15:47', '2025-12-30 20:05:22'),
(17, 14, 4, 0, '2025-12-30 19:15:47', '2025-12-30 20:05:22'),
(18, 14, 15, 0, '2025-12-30 19:15:47', '2025-12-30 20:05:22'),
(19, 14, 6, 0, '2025-12-30 19:15:47', '2025-12-30 20:05:22'),
(20, 1, 2, 1, '2025-12-30 19:19:11', '2025-12-30 19:19:11'),
(21, 1, 5, 0, '2025-12-30 19:19:11', '2025-12-30 19:19:11'),
(22, 1, 7, 0, '2025-12-30 19:19:11', '2025-12-30 19:19:11'),
(23, 1, 4, 0, '2025-12-30 19:19:11', '2025-12-30 19:19:11'),
(24, 1, 15, 0, '2025-12-30 19:19:11', '2025-12-30 19:19:11'),
(25, 1, 6, 0, '2025-12-30 19:19:11', '2025-12-30 19:19:11'),
(26, 3, 5, 0, '2025-12-30 19:19:43', '2025-12-30 19:19:43'),
(27, 3, 7, 0, '2025-12-30 19:19:43', '2025-12-30 19:19:43'),
(28, 3, 4, 1, '2025-12-30 19:19:43', '2025-12-30 19:19:43'),
(29, 9, 1, 1, '2025-12-30 19:20:15', '2025-12-30 19:20:15'),
(30, 9, 7, 0, '2025-12-30 19:20:15', '2025-12-30 19:20:15'),
(31, 4, 1, 1, '2025-12-30 19:20:53', '2025-12-30 19:20:53'),
(32, 4, 7, 0, '2025-12-30 19:20:53', '2025-12-30 19:20:53'),
(33, 4, 4, 0, '2025-12-30 19:20:53', '2025-12-30 19:20:53'),
(34, 7, 2, 1, '2025-12-30 19:21:21', '2025-12-30 19:21:21'),
(35, 7, 5, 0, '2025-12-30 19:21:21', '2025-12-30 19:21:21'),
(36, 7, 7, 0, '2025-12-30 19:21:21', '2025-12-30 19:21:21'),
(95, 10, 3, 0, '2025-12-30 19:55:02', '2025-12-30 19:55:02'),
(38, 2, 3, 0, '2025-12-30 19:23:32', '2025-12-30 20:09:29'),
(39, 2, 2, 1, '2025-12-30 19:23:32', '2025-12-30 20:09:29'),
(40, 2, 5, 0, '2025-12-30 19:23:32', '2025-12-30 20:09:29'),
(41, 2, 7, 0, '2025-12-30 19:23:32', '2025-12-30 20:09:29'),
(42, 2, 4, 0, '2025-12-30 19:23:32', '2025-12-30 20:09:29'),
(43, 5, 1, 1, '2025-12-30 19:24:15', '2025-12-30 19:24:15'),
(44, 5, 7, 0, '2025-12-30 19:24:15', '2025-12-30 19:24:15'),
(45, 8, 1, 1, '2025-12-30 19:24:42', '2025-12-30 19:24:42'),
(46, 8, 5, 0, '2025-12-30 19:24:42', '2025-12-30 19:24:42'),
(47, 8, 7, 0, '2025-12-30 19:24:42', '2025-12-30 19:24:42'),
(48, 8, 4, 0, '2025-12-30 19:24:42', '2025-12-30 19:24:42'),
(49, 8, 15, 0, '2025-12-30 19:24:42', '2025-12-30 19:24:42'),
(50, 8, 6, 0, '2025-12-30 19:24:42', '2025-12-30 19:24:42'),
(51, 11, 2, 1, '2025-12-30 19:25:10', '2025-12-30 19:25:10'),
(52, 11, 7, 0, '2025-12-30 19:25:10', '2025-12-30 19:25:10'),
(53, 12, 1, 1, '2025-12-30 19:26:29', '2025-12-30 19:26:29'),
(54, 12, 7, 0, '2025-12-30 19:26:29', '2025-12-30 19:26:29'),
(55, 15, 3, 0, '2025-12-30 19:27:32', '2025-12-30 19:36:36'),
(56, 15, 2, 1, '2025-12-30 19:27:32', '2025-12-30 19:36:36'),
(57, 15, 1, 0, '2025-12-30 19:27:32', '2025-12-30 19:36:36'),
(58, 15, 5, 0, '2025-12-30 19:27:32', '2025-12-30 19:36:36'),
(59, 15, 7, 0, '2025-12-30 19:27:32', '2025-12-30 19:36:37'),
(60, 15, 4, 0, '2025-12-30 19:27:32', '2025-12-30 19:36:37'),
(61, 15, 15, 0, '2025-12-30 19:27:32', '2025-12-30 19:36:37'),
(62, 15, 6, 0, '2025-12-30 19:27:32', '2025-12-30 19:36:37'),
(63, 16, 3, 0, '2025-12-30 19:35:32', '2025-12-30 20:27:05'),
(64, 16, 1, 1, '2025-12-30 19:35:32', '2025-12-30 20:27:05'),
(65, 16, 5, 0, '2025-12-30 19:35:32', '2025-12-30 20:27:05'),
(66, 16, 7, 0, '2025-12-30 19:35:32', '2025-12-30 20:27:05'),
(67, 16, 4, 0, '2025-12-30 19:35:32', '2025-12-30 20:27:05'),
(68, 16, 15, 0, '2025-12-30 19:35:32', '2025-12-30 20:27:05'),
(69, 16, 6, 0, '2025-12-30 19:35:32', '2025-12-30 20:27:05'),
(70, 17, 3, 0, '2025-12-30 19:46:48', '2025-12-30 21:53:58'),
(71, 17, 2, 1, '2025-12-30 19:46:48', '2025-12-30 21:53:58'),
(72, 17, 1, 0, '2025-12-30 19:46:48', '2025-12-30 21:53:58'),
(73, 17, 5, 0, '2025-12-30 19:46:48', '2025-12-30 21:53:58'),
(74, 17, 7, 0, '2025-12-30 19:46:48', '2025-12-30 21:53:58'),
(75, 17, 4, 0, '2025-12-30 19:46:48', '2025-12-30 21:53:58'),
(76, 17, 15, 0, '2025-12-30 19:46:48', '2025-12-30 21:53:58'),
(77, 17, 6, 0, '2025-12-30 19:46:48', '2025-12-30 21:53:58'),
(78, 18, 3, 0, '2025-12-30 19:50:17', '2025-12-30 20:24:05'),
(79, 18, 2, 0, '2025-12-30 19:50:17', '2025-12-30 20:24:05'),
(80, 18, 1, 1, '2025-12-30 19:50:17', '2025-12-30 20:24:05'),
(81, 18, 5, 0, '2025-12-30 19:50:17', '2025-12-30 20:24:05'),
(82, 18, 7, 0, '2025-12-30 19:50:17', '2025-12-30 20:24:05'),
(83, 18, 4, 0, '2025-12-30 19:50:17', '2025-12-30 20:24:05'),
(84, 18, 15, 0, '2025-12-30 19:50:17', '2025-12-30 20:24:05'),
(85, 18, 6, 0, '2025-12-30 19:50:17', '2025-12-30 20:24:05'),
(86, 19, 3, 0, '2025-12-30 19:51:32', '2025-12-30 20:22:58'),
(87, 19, 2, 0, '2025-12-30 19:51:32', '2025-12-30 20:22:58'),
(88, 19, 1, 1, '2025-12-30 19:51:32', '2025-12-30 20:22:58'),
(89, 19, 7, 0, '2025-12-30 19:51:32', '2025-12-30 20:22:58'),
(90, 19, 4, 0, '2025-12-30 19:51:32', '2025-12-30 20:22:58'),
(91, 19, 15, 0, '2025-12-30 19:51:32', '2025-12-30 20:22:58'),
(92, 19, 6, 0, '2025-12-30 19:51:32', '2025-12-30 20:22:58'),
(93, 20, 2, 1, '2025-12-30 19:52:45', '2025-12-30 20:26:27'),
(94, 20, 7, 0, '2025-12-30 19:52:45', '2025-12-30 20:26:27'),
(96, 10, 1, 1, '2025-12-30 19:55:02', '2025-12-30 19:55:02'),
(97, 10, 7, 0, '2025-12-30 19:55:02', '2025-12-30 19:55:02'),
(98, 10, 4, 0, '2025-12-30 19:55:02', '2025-12-30 19:55:02'),
(99, 10, 15, 0, '2025-12-30 19:55:02', '2025-12-30 19:55:02'),
(100, 10, 6, 0, '2025-12-30 19:55:02', '2025-12-30 19:55:02'),
(101, 21, 1, 1, '2025-12-30 19:56:22', '2025-12-30 20:22:11'),
(102, 21, 5, 0, '2025-12-30 19:56:22', '2025-12-30 20:22:11'),
(103, 21, 7, 0, '2025-12-30 19:56:22', '2025-12-30 20:22:11'),
(104, 21, 4, 0, '2025-12-30 19:56:22', '2025-12-30 20:22:11'),
(105, 22, 5, 1, '2025-12-30 20:19:57', '2025-12-30 20:30:12'),
(106, 22, 7, 0, '2025-12-30 20:19:57', '2025-12-30 20:30:12'),
(107, 22, 15, 0, '2025-12-30 20:19:57', '2025-12-30 20:30:12'),
(108, 22, 6, 0, '2025-12-30 20:19:57', '2025-12-30 20:30:12'),
(109, 23, 1, 1, '2025-12-30 20:25:26', '2025-12-30 20:25:26'),
(110, 23, 5, 0, '2025-12-30 20:25:26', '2025-12-30 20:25:26'),
(111, 23, 7, 0, '2025-12-30 20:25:26', '2025-12-30 20:25:26'),
(112, 23, 4, 0, '2025-12-30 20:25:26', '2025-12-30 20:25:26'),
(113, 23, 15, 0, '2025-12-30 20:25:26', '2025-12-30 20:25:26'),
(114, 23, 6, 0, '2025-12-30 20:25:26', '2025-12-30 20:25:26'),
(115, 24, 1, 1, '2025-12-30 20:49:01', '2025-12-30 20:49:01'),
(116, 24, 4, 0, '2025-12-30 20:49:01', '2025-12-30 20:49:01'),
(117, 25, 3, 0, '2025-12-30 21:00:33', '2025-12-30 21:00:33'),
(118, 25, 2, 0, '2025-12-30 21:00:33', '2025-12-30 21:00:33'),
(119, 25, 1, 1, '2025-12-30 21:00:33', '2025-12-30 21:00:33'),
(120, 25, 5, 0, '2025-12-30 21:00:33', '2025-12-30 21:00:33'),
(121, 25, 7, 0, '2025-12-30 21:00:33', '2025-12-30 21:00:33'),
(122, 25, 4, 0, '2025-12-30 21:00:33', '2025-12-30 21:00:33'),
(123, 25, 15, 0, '2025-12-30 21:00:33', '2025-12-30 21:00:33'),
(124, 25, 6, 0, '2025-12-30 21:00:33', '2025-12-30 21:00:33'),
(125, 26, 3, 0, '2025-12-30 21:03:27', '2025-12-30 21:03:27'),
(126, 26, 2, 1, '2025-12-30 21:03:27', '2025-12-30 21:03:27'),
(127, 26, 15, 0, '2025-12-30 21:03:27', '2025-12-30 21:03:27'),
(128, 26, 6, 0, '2025-12-30 21:03:27', '2025-12-30 21:03:27');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_26_124937_create_instruments_table', 1),
(5, '2025_12_26_124939_create_instrumentists_table', 1),
(6, '2025_12_26_132352_drop_instrument_id_from_instrumentists_table', 1),
(7, '2025_12_26_132442_create_instrument_instrumentist_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Président', '2025-12-30 17:41:04', '2025-12-30 17:41:04'),
(2, 'DT principal', '2025-12-30 17:41:04', '2025-12-30 17:41:04'),
(3, 'DT Adjoint', '2025-12-30 17:41:04', '2025-12-30 17:41:04'),
(4, 'DT Alto', '2025-12-30 17:41:04', '2025-12-30 17:41:04'),
(5, 'DT Soprano', '2025-12-30 17:41:04', '2025-12-30 17:41:04'),
(6, 'DT Tenor', '2025-12-30 17:41:04', '2025-12-30 17:41:04'),
(7, 'DT Basse', '2025-12-30 17:41:04', '2025-12-30 17:41:04'),
(8, 'Organisateur', '2025-12-30 17:41:04', '2025-12-30 17:41:04'),
(9, 'Secretaire', '2025-12-30 17:41:04', '2025-12-30 17:41:04'),
(10, 'Trésoriere', '2025-12-30 17:41:04', '2025-12-30 17:41:04'),
(11, 'Chargé spirituel', '2025-12-30 17:41:04', '2025-12-30 17:41:04'),
(12, 'Instrumentiste', '2025-12-30 17:41:04', '2025-12-30 17:41:04');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bP8uquuBGiSIlEEzxdTh2trCyoSbu3vTxsAEY5XD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWxNdjhlcnZ6TVBNYWYwbXc4ZmFBYWptbHZSZ1dQVDNac3JGWUdJYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbnN0cnVtZW50aXN0cyI7czo1OiJyb3V0ZSI7czoyMDoiaW5zdHJ1bWVudGlzdHMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767131641),
('KDbwRzBJgUs2ajDFfqLf1yUSqWFoT1jsvoU04icu', NULL, '192.168.1.67', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmdnelVXYU5oZTBpUUVteHlaOWNJd1FxcmZYTHR6V2laaFNtelRsUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xOTIuMTY4LjEuNjc6ODAwMC9pbnN0cnVtZW50aXN0cyI7czo1OiJyb3V0ZSI7czoyMDoiaW5zdHJ1bWVudGlzdHMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767130423),
('4ZqGFiXQKXBtKtvAYcLus1Fkzr4IKC0RNGIXZbt7', NULL, '192.168.1.66', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiajFSUWhDeWhCM3J6V3JObG5NZk5vb3lMb1dvUld5cEZlV2FrNDBIMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xOTIuMTY4LjEuNjc6ODAwMC9pbnN0cnVtZW50aXN0cyI7czo1OiJyb3V0ZSI7czoyMDoiaW5zdHJ1bWVudGlzdHMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767128659);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
