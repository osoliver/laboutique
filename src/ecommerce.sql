-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Dim 06 Avril 2014 à 13:59
-- Version du serveur :  5.5.36
-- Version de PHP :  5.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Structure de la table `basket`
--

CREATE TABLE IF NOT EXISTS `basket` (
  `basket_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`basket_id`),
  UNIQUE KEY `basket_id_UNIQUE` (`basket_id`),
  KEY `client_id_idx` (`client_id`),
  KEY `product_basket_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `catalog`
--

CREATE TABLE IF NOT EXISTS `catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `product_id_idx` (`product_id`),
  KEY `category_id_idx` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=176 ;

--
-- Contenu de la table `catalog`
--

INSERT INTO `catalog` (`id`, `product_id`, `category_id`) VALUES
(27, 8, 3),
(28, 8, 5),
(29, 8, 6),
(30, 8, 11),
(31, 10, 3),
(32, 10, 5),
(33, 10, 6),
(34, 10, 11),
(41, 9, 3),
(42, 9, 4),
(43, 9, 5),
(44, 9, 11),
(45, 11, 2),
(46, 11, 3),
(47, 11, 4),
(48, 11, 5),
(49, 11, 9),
(50, 11, 11),
(51, 12, 3),
(52, 12, 4),
(53, 12, 5),
(54, 12, 11),
(55, 13, 2),
(56, 13, 4),
(57, 13, 5),
(58, 13, 11),
(59, 14, 2),
(60, 14, 5),
(61, 14, 8),
(62, 15, 2),
(63, 15, 4),
(64, 15, 5),
(65, 15, 11),
(66, 16, 2),
(67, 16, 4),
(68, 16, 5),
(69, 16, 11),
(70, 17, 3),
(71, 17, 4),
(72, 17, 5),
(73, 17, 11),
(74, 18, 2),
(75, 18, 3),
(76, 18, 8),
(77, 18, 10),
(82, 20, 2),
(83, 20, 3),
(84, 20, 7),
(85, 21, 2),
(86, 21, 3),
(87, 21, 7),
(88, 21, 10),
(92, 22, 2),
(93, 22, 4),
(94, 22, 9),
(95, 23, 2),
(96, 23, 3),
(97, 23, 4),
(98, 23, 5),
(99, 23, 10),
(100, 24, 2),
(101, 24, 3),
(102, 24, 4),
(103, 25, 2),
(104, 25, 3),
(105, 25, 5),
(106, 25, 8),
(107, 26, 3),
(108, 26, 6),
(109, 26, 11),
(110, 27, 2),
(111, 27, 5),
(112, 27, 8),
(113, 19, 3),
(114, 19, 4),
(115, 19, 5),
(116, 19, 11),
(117, 28, 2),
(118, 28, 3),
(119, 28, 5),
(120, 28, 8),
(121, 28, 10),
(122, 29, 2),
(123, 29, 3),
(124, 29, 5),
(125, 29, 8),
(126, 29, 11),
(127, 30, 2),
(128, 30, 5),
(129, 30, 7),
(130, 30, 10),
(131, 31, 2),
(132, 31, 3),
(133, 31, 4),
(134, 31, 10),
(135, 32, 2),
(136, 32, 3),
(137, 32, 4),
(138, 32, 5),
(139, 33, 3),
(140, 33, 4),
(141, 33, 5),
(142, 33, 11),
(143, 34, 2),
(144, 34, 4),
(145, 34, 5),
(146, 34, 7),
(147, 34, 10),
(148, 35, 2),
(149, 35, 4),
(150, 35, 5),
(151, 35, 7),
(152, 35, 11),
(158, 7, 2),
(159, 7, 3),
(160, 7, 4),
(161, 7, 5),
(162, 7, 7),
(169, 6, 2),
(170, 6, 4),
(171, 6, 5),
(172, 6, 10);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(2, 'Homme'),
(3, 'Femme'),
(4, 'Bracelet cuir'),
(5, 'Affichage aiguille'),
(6, 'Bracelet acier'),
(7, 'Affichage digital'),
(8, 'Bracelet nato'),
(9, 'Affichage disque'),
(10, 'Fantaisie'),
(11, 'Classique');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `pwd` varchar(128) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `address` varchar(30) NOT NULL,
  `zipcode` int(5) NOT NULL,
  `city` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `client_id_UNIQUE` (`client_id`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Structure de la table `client_roles`
--

CREATE TABLE IF NOT EXISTS `client_roles` (
  `rights_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`rights_id`),
  UNIQUE KEY `rights_id_UNIQUE` (`rights_id`),
  KEY `client_idx` (`client_id`),
  KEY `role_idx` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Structure de la table `command`
--

CREATE TABLE IF NOT EXISTS `command` (
  `command_id` int(11) NOT NULL AUTO_INCREMENT,
  `command_amount` float NOT NULL,
  `date` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`command_id`),
  UNIQUE KEY `command_id_UNIQUE` (`command_id`),
  KEY `client_id_idx` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `command_id` int(11) NOT NULL,
  PRIMARY KEY (`history_id`),
  UNIQUE KEY `basket_id_UNIQUE` (`history_id`),
  KEY `product_id_idx` (`product_id`),
  KEY `command_id_idx` (`command_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_id_UNIQUE` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `quantity`, `price`) VALUES
(6, 'Aeronef black', 'Montre aux lignes futuristes noire et jaune', 12, 399.89),
(7, 'BIG TV metal target', 'Montre grand ecran au style epure et high tech', 23, 439.5),
(8, 'Churchill acier milanese', 'Montre feminine en acier', 14, 199.89),
(9, 'Churchill acier', 'Montre classique et sobre', 60, 89.9),
(10, 'Churchill gold', 'Classique et rafinee elle saura vous enjouer', 8, 179.5),
(11, 'Duchesse acier mirror', 'Tres belle montre en acier bracelet cuir', 6, 455.2),
(12, 'Duchesse gold', 'Le modele gold de notre la classique Duchesse', 22, 125.2),
(13, 'GDG black acier', 'Allure classique sobre avec son bracelet noir', 11, 89.99),
(14, 'GDG black red', 'Montre noire et bracelet tissu rouge et noir sport', 34, 178.5),
(15, 'GDG Electronic black gold', 'Modele elegant et sobre a la fois', 42, 245.5),
(16, 'Himalaya gold silver', 'Un de nos fameux classiques!', 23, 299.9),
(17, 'Lalla white dune', 'Fine et elegante avec son bracelet cuir', 46, 145.3),
(18, 'Mach 1871', 'Une montre fantaisie mais prestigieuse', 11, 256.4),
(19, 'Marquise acier mirror', 'Pour vosu mesdames la rolls des montres', 63, 455.5),
(20, 'Mermoz full black', 'Utilisation classique et traits fins', 80, 65.8),
(21, 'Mini mafia', 'Une touche de fantaisie et de high tech', 53, 231.1),
(22, 'Mythic brown', 'Dans la mode et dans le cuir', 45, 360.9),
(23, 'Mythic white black', 'Parfaite pour les puristes', 12, 188.4),
(24, 'Mythic white', 'Le modele blanc de la fameuse Mythic', 75, 230.5),
(25, 'Panoramic 1871', 'Classique et tellement belle !', 23, 120.2),
(26, 'Panoramic gold', 'or et classicisme a leur paroxisme', 56, 299.8),
(27, 'Panoramic orange', 'Modele bleu et orange de la panoramic', 80, 150.6),
(28, 'Panoramic red white', 'la panoramic en rouge et blanc', 45, 145.5),
(29, 'Panoramic republique', 'bleu blanc rouge et classico', 56, 155.6),
(30, 'Silver master', 'Une montre qui saura vous rejouir', 85, 230.5),
(31, 'Square chocolat', 'Du chocolat et une montre tout en un', 73, 149.99),
(32, 'T10 mermoz kaki', 'Pour les fans de l&#039;armee', 51, 89.99),
(33, 'T18 classic gold', 'Pour les femmes classiques et belles', 26, 289.99),
(34, 'TV noir', 'Une montre fantaisie et high tech', 64, 140.5),
(35, 'TV rouge', 'Rouge et fine pour vous faire plaisir', 45, 185.5);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `id_UNIQUE` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`role_id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `product_basket` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `client_basket` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `catalog`
--
ALTER TABLE `catalog`
  ADD CONSTRAINT `category_catalog` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_catalog` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `client_roles`
--
ALTER TABLE `client_roles`
  ADD CONSTRAINT `client_roles` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `role_roles` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `command`
--
ALTER TABLE `command`
  ADD CONSTRAINT `client_command` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `command_history` FOREIGN KEY (`command_id`) REFERENCES `command` (`command_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_history` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
