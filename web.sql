-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 30 avr. 2018 à 15:37
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `web`
--

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `file1` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `despt` text,
  `categorie` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `prix` varchar(10) NOT NULL,
  `date` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `adresse`, `ville`, `region`, `telephone`, `email`, `password`) VALUES
(1, 'test', 'kevin', '', 'test', 'Alsace', '', 'test123@gmail.com', '$2y$10$OGEf0YRAZ3adyEgKYazxsOMJ0b5nUIj1/wiI3jSkLrM1fImwZPhkG'),
(2, 'test', 'test', 'test', 'test', '', '', 'test2@gmail.com', '$2y$10$6Pyey7V2LoaEP/BZOFpw7ucdXq/Ef9ti0KDSSzzVn7iHPv1npKc9S'),
(4, 'test', 'test', '', 'test', '', '', 'test3@gmail.com', '$2y$10$n5nUJjDbuOluoL5MwyN7GOeswExP/P/XtBfuUhJruGI7Oj4C6e3xa');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
