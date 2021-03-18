-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 18 mars 2021 à 14:49
-- Version du serveur :  10.3.27-MariaDB-log-cll-lve
-- Version de PHP : 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rngqojcu_oktopos`
--

-- --------------------------------------------------------

--
-- Structure de la table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `id_einheit` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `bewertungspreis` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `artikel`
--

INSERT INTO `artikel` (`id`, `id_einheit`, `name`, `code`, `bewertungspreis`) VALUES
(1, 1, 'Motor', 'Motor', 50),
(2, 2, 'Kabel', 'Kabel', 50);

-- --------------------------------------------------------

--
-- Structure de la table `einheit`
--

CREATE TABLE `einheit` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `einheit`
--

INSERT INTO `einheit` (`id`, `name`, `code`) VALUES
(1, 'Stk', 'Stk'),
(2, 'M', 'm');

-- --------------------------------------------------------

--
-- Structure de la table `lager`
--

CREATE TABLE `lager` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lager`
--

INSERT INTO `lager` (`id`, `name`, `code`) VALUES
(1, 'Hamburg', 'hb'),
(2, 'Berlin', 'bl');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `pwd` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `name`, `pwd`, `email`) VALUES
(41, 'admin', 'admin', 'admin', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `warenbewegungen`
--

CREATE TABLE `warenbewegungen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `zeitpunkt` timestamp NULL DEFAULT NULL,
  `art` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_lager` int(11) DEFAULT NULL,
  `id_artikel` int(11) DEFAULT NULL,
  `menge` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `warenbewegungen`
--

INSERT INTO `warenbewegungen` (`id`, `zeitpunkt`, `art`, `id_lager`, `id_artikel`, `menge`, `created_at`, `updated_at`) VALUES
(599, '2021-03-18 04:00:00', 'Warenausgang', 2, 1, 53, NULL, NULL),
(600, '2021-03-18 04:00:00', 'Warenausgang', 2, 2, 13, NULL, NULL),
(601, '2021-03-18 04:00:00', 'Wareneingang', 1, 1, 20, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Index pour la table `einheit`
--
ALTER TABLE `einheit`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Index pour la table `lager`
--
ALTER TABLE `lager`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Index pour la table `warenbewegungen`
--
ALTER TABLE `warenbewegungen`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `einheit`
--
ALTER TABLE `einheit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `lager`
--
ALTER TABLE `lager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `warenbewegungen`
--
ALTER TABLE `warenbewegungen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=602;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
