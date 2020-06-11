-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 11 juin 2020 à 16:17
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `petitesannonces`
--

-- --------------------------------------------------------

--
-- Structure de la table `ads`
--

DROP TABLE IF EXISTS `ads`;
CREATE TABLE IF NOT EXISTS `ads` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `publicationDate` datetime NOT NULL DEFAULT current_timestamp(),
  `imageFileName` varchar(255) DEFAULT NULL,
  `userId` smallint(5) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  KEY `publicationDate` (`publicationDate`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
CREATE TABLE IF NOT EXISTS `annonces` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `descriptif` text NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `idutilisateur` tinyint(3) UNSIGNED NOT NULL,
  `datepublication` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id`, `titre`, `descriptif`, `prix`, `idutilisateur`, `datepublication`) VALUES
(32, 'Titre 2 annonce 2', 'Ma seconde annonce pour le projet \"Petites Annonces\" de Damien P.', '10', 1, '0000-00-00 00:00:00'),
(33, 'Titre 3 annonce 3', 'Ma troisième annonce du projet \"Petites Annonces\" de Damien P.', '50', 1, '0000-00-00 00:00:00'),
(35, 'Titre 1 annonce 1', 'Ma première annonce pour le projet \"Petites Annonce\" Damien P.', '10', 1, '0000-00-00 00:00:00'),
(36, 'Titre 5 annonce 5', 'Ma cinquième annonce pour le projet \"Petites Annonces\" de Damien P.', '7', 1, '0000-00-00 00:00:00'),
(37, 'Titre 4 annonce 4', 'Ma quatrième annonce pour le projet \"Petites Annonces\" de Damien P. concernant la formation du CCI Laxou', '40', 1, '0000-00-00 00:00:00'),
(38, 'titre 02', 'descriptif', '12', 1, '0000-00-00 00:00:00'),
(39, 'Achat Vente masques tissus', 'masques disponibles pour toute la famille', '6', 6, '0000-00-00 00:00:00'),
(40, 'VENTE MECANISME MONTRE', 'A VENDRE MECANISME MONTRE MANUELLE MARQUE CASIO ANNEE 1980', '70', 6, '0000-00-00 00:00:00'),
(41, '44', '44', '44', 33, '2020-06-02 15:46:57'),
(42, '44', '44', '44', 33, '2020-06-02 15:51:14');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `idannonce` tinyint(3) UNSIGNED NOT NULL,
  `urlImage` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `idannonce`, `urlImage`) VALUES
(1, 0, 'uploaded-files\\5ed658517436d.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `hashedPassword` char(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `utilisateur` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwordhash` char(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `utilisateur` (`utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `utilisateur`, `email`, `passwordhash`) VALUES
(3, 'karine', '', '$2y$10$l48nuDvraVNYjeDjfi9G3uPNnl0ea2U8eMMjt27XydU3X0NKNRwS6'),
(17, 'laura', '', '$2y$10$CLjEBoBWYLyoDEISrMzKVOk6pVwDoyOP6RBb4PeFGWdTJeUvvWP..'),
(21, 'benoit', '', '$2y$10$X5G1LYpTlGDl4anLK0crQOSOfL2TmNmS.0.Cl241aK8z5Npf8wJ..'),
(22, 'laurette', '', '$2y$10$WOXkQLKYGu64eKI4gZ.R0.RWOX1EpWpRZIlkhQuIZsipadNXAJyzO'),
(23, 'nom01', '', '$2y$10$OJfgPcFpGC/HIU92JJI0xeA.ZjJOQ87x.AymHrMfBrAQh4lOEnTh6'),
(24, 'nom03', '', '$2y$10$iQK522yysTU.uFJGGzrMLO.VoswxVL8JUcotGP8xqRk2yQ4ClA1Xa'),
(25, 'nom04', '', '$2y$10$Yc0FaKbgmP2i2a7OUGxd.ORQb.k1y6JXJgnnc9VpIPWHnEUyRgLOm'),
(26, 'nom05', '', '$2y$10$oWgKPrwia7YAqPXO0wn3/eEAf0nIG9bAGGrLzOmX9jiNdLUmy4sNu'),
(27, 'nom06', '', '$2y$10$2EM0ST/ppPqSBbk6MXIHGeBV4zQDcIXA.8EeXVmaT3F68rDHu3fra'),
(28, 'nom07', '', '$2y$10$BzG88B9TPkB5vR0j1qsoG.LtJLN6d/BOm7XbK/qRT7Ksqo.XdK1wO'),
(32, 'moi', 'moi@moi.com', '$2y$10$Zr.KDCHUtbrW9JjPSCwDHurJ2OmLUPCu/g1XRJrm5TFviVQ1v1TgS'),
(33, 'toi', 'toi@gmail.com', '$2y$10$ihTEfM2Gku7zJ/XL0694F.C/yvQc7gP/4MhPIMC6lg.XYqa8nGsFe');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
