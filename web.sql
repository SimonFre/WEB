-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 09 mai 2018 à 13:47
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
CREATE DATABASE IF NOT EXISTS `web` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `web`;

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `file1` varchar(255) DEFAULT NULL,
  `file2` varchar(255) DEFAULT NULL,
  `file3` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `despt` text,
  `categorie` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`id`, `user_id`, `file1`, `file2`, `file3`, `title`, `despt`, `categorie`, `region`, `prix`, `date`) VALUES
(1, 1, '5af2ecd7df6911.93974844.jpg', '5af2ecd7e0b852.37837919.jpg', '5af2ecd7e18d77.55883107.jpg', 'iPhone 6S', 'Vend iPhone 6s 16go en trÃ¨s bonne Ã©tat mise Ã  part un dÃ©faut en haut Ã  gauche du tÃ©lÃ©phone suite Ã  une chute. Vendu avec boÃ®te et chargeur. DÃ©bloquer tout opÃ©rateur. Ã‰change possible contre S6 edge dans le mÃªme Ã©tats', 'TÃ©lÃ©phonie', 'Alsace', 250, '09/05/2018'),
(2, 1, '5af2ed763a6295.33617525.jpg', '5af2ed763b0cc5.23453268.jpg', '5af2ed763bc6a2.51955835.jpg', 'AUDI Q5 3.0 TDI 240 cv AMBITION', 'Q5 3.0 tdi ambition. Clim auto cuir boite auto radar ar jantes alu. Abs airbag. Gps regulateur etc.......', 'Voitures', 'Alsace', 9490, '09/05/2018'),
(3, 2, '5af2efa77ff149.23064614.jpg', '5af2efa780fec1.29113667.jpg', '5af2efa781ba21.43518993.jpg', 'Lot de megabloks', 'Lot de deux jeux de megabloks', 'Jeux & Jouets', 'Aquitaine', 19, '09/05/2018'),
(4, 2, '5af2f00ed3d7d5.13812212.jpg', '5af2f00ed49298.75941169.jpg', 'NULL', 'SiÃ¨ges auto et rehausseur', 'Ã€ vendre\r\n* SiÃ¨ge auto 9/18kg rÃ©glable (bleu) : 20â‚¬\r\n* SiÃ¨ge auto 15/25kg : 10â‚¬\r\n* Rehausseur : 5â‚¬\r\n* Cadre : 3â‚¬\r\n\r\nPaiement en espÃ¨ces. Contact uniquement par tÃ©lÃ©phone', 'Equipement bÃ©bÃ©', 'Aquitaine', 3, '09/05/2018'),
(5, 3, '5af2f0f526dd43.87139933.jpg', '5af2f0f5275566.95256024.jpg', '5af2f0f527f079.88823157.jpg', 'DUCATI PANIGALE V4 S', 'Vend DUCATI PANIGALE V4 S de janvier 2018 totalisant 2000 km , rÃ©tro rizoma , support de plaque evotech\r\nDucati panigale\r\nKawasaki zx10r\r\nYamaha r1\r\nHonda cbr\r\nAprilia rsv4\r\nBmw s1000rr\r\nMv agusta\r\nSuzuki gsxr\r\nÃ‰tudie toutes propositions', 'Motos', 'Auvergne', 25900, '09/05/2018'),
(6, 3, '5af2f3c5092757.35493561.jpg', '5af2f3c509a141.35119932.jpg', '5af2f3c50af094.11982556.jpg', 'Lave-linge frontal ELECTROLUX EWF1495RB', 'vends cause mutation Lave-linge frontal ELECTROLUX EWF1495RB (Garantie encore 4 ans et 3 mois)\r\n\r\nâ€¢ CapacitÃ© nominale : 9 kg\r\nâ€¢ Vitesse dâ€™essorage : Variable - 1400 tours-min (maximum)\r\nâ€¢ Niveau sonore (lavage) : 54 dB\r\nâ€¢ Laine, fragile, coton, produits synthÃ©tiques, duvet, coton Ã©co, rinÃ§age+, 20 min - 3 kg, Mixte 20, Bleu woolmark\r\nâ€¢ SÃ©curitÃ© enfants, systÃ¨me de protection anti-dÃ©bordement\r\nâ€¢ 2200 Watt\r\nâ€¢ Couleur : Blanc-argent\r\nMarque ELECTROLUX\r\n\r\nNe rÃ©pond pas aux mails', 'ElectromÃ©nager', 'Auvergne', 400, '09/05/2018'),
(7, 4, '5af2f5a659a430.00241221.jpg', '5af2f5a65a0de9.11028866.jpg', '5af2f5a65a8126.80365144.jpg', 'Tente Queshua 2 secondes illumin fresh XXL ', '4 places\r\nÃ‰tat Neuf irrÃ©prochable\r\nServie qq jours il y a 3 ans\r\nPeut Ãªtre montÃ©e et dÃ©montÃ©e rapidement si personne sÃ©rieuse le jour d,une visite\r\nReste fraÃ®che grÃ¢ce Ã  son matÃ©riau rÃ©flÃ©chissant\r\nNombreuses ouvertures avec moustiquaires\r\nSystÃ¨me Sky view pour des nuits Ã©toilÃ©es.\r\nVeilleuses intÃ©grÃ©es dans sÃ©jour et chambre\r\nAutres photos sur demande prises ce jour', 'Equipement Caravaning', 'Basse-Normandie', 100, '09/05/2018');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `adresse`, `ville`, `region`, `telephone`, `email`, `password`) VALUES
(1, 'jdd', 'jdd', '', 'jdd', 'Alsace', '', 'jdd49706@mziqo.com', '$2y$10$dfrBY39rPL6Sp8xUF2kUne5siypaL/wiUXQl5hWZHFc0skj8Lmq3i'),
(2, 'izx', 'izx', '', 'izx', 'Aquitaine', '', 'izx40977@mziqo.com', '$2y$10$ZQDoogh32kKnoN2ea5z7SOkWdjS0nZ2SA9CUp5HawOCgCYkjd3Lny'),
(3, 'sxs', 'sxs', '', 'sxs', 'Auvergne', '', 'sxs25688@mziqo.com', '$2y$10$pQKA16rMkT5xAzpKUBLmEO3FMDfvgpuyc4OFU7Nke0kEZjUp8vEHa'),
(4, 'aci', 'aci', '', 'aci', 'Basse-Normandie', '', 'aci58781@mziqo.com', '$2y$10$zHC3vsX5n3TgSVgMLp/cdO.4jKtUzEOKhoBXfyuVxGHlNrj/Op3US');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
