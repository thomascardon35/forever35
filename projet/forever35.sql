-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 16 juil. 2018 à 09:33
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
-- Base de données :  `forever35`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `refproduct` int(5) UNSIGNED NOT NULL,
  `posteddate` datetime NOT NULL,
  `email` varchar(128) NOT NULL,
  `pseudo` varchar(64) NOT NULL,
  `satisfaction` set('Pas satisfait(e)','Peu satisfait(e)','Assez satisfait(e)','Très satisfait(e)','Exceptionnel') NOT NULL,
  `usercomment` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `refproduct` (`refproduct`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contactmessage`
--

DROP TABLE IF EXISTS `contactmessage`;
CREATE TABLE IF NOT EXISTS `contactmessage` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `datemessage` datetime NOT NULL,
  `gender` varchar(4) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `zipcode` int(5) UNSIGNED ZEROFILL NOT NULL,
  `city` varchar(64) DEFAULT NULL,
  `phone` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `subjectmessage` set('Evénements','Parrainage','Produits','Autres') NOT NULL,
  `usermessage` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `newsevents`
--

DROP TABLE IF EXISTS `newsevents`;
CREATE TABLE IF NOT EXISTS `newsevents` (
  `id` smallint(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `appointementdate` datetime DEFAULT NULL,
  `endtimeevent` time DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `eventtype` varchar(64) DEFAULT NULL,
  `eventdescription` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='newsevents';

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref` int(5) UNSIGNED NOT NULL,
  `category` set('Nouveautés','Santé','Douleur','Peau','Quotidien','Maison Animaux') NOT NULL,
  `categoryforcss` set('new','health','pain','skin','daily','house-animals') NOT NULL,
  `title` varchar(64) NOT NULL,
  `capacity` varchar(128) DEFAULT NULL,
  `composition` varchar(256) DEFAULT NULL,
  `productdescription` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ref` (`ref`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `ref`, `category`, `categoryforcss`, `title`, `capacity`, `composition`, `productdescription`) VALUES
(1, 715, 'Nouveautés', 'new', 'Pulpe d\'Aloe Vera TetraPak', '1L', '99,7% de gel d\'Aloe Vera', 'L\'Aloe vera Forever fait peau neuve ! Riche d\'un savoir-faire de 40ans, Forever a revisité son produit signature et a créé une toute nouvelle version sans conservateur et riche en vitamine C, dans un emballage 100% recyclable. Cette formule optimisée vous apportera toujours plus de bien-être. Le secret, 99,7% de gel d\'Aloe vera, la plante aux milles vertus et une dose synergique de vitamine C, molécule antioxydante aux nombreux bienfaits.'),
(2, 27, 'Santé', 'health', 'Forever Bee Propolis', '60 comprimés', 'Propolis, Miel. Contient du soja.', 'La propolis est une résine collectée et métabolisée par les abeilles mellifères à partir des arbres et utilisée pour protéger la ruche. Cette substance ayant des propriétés anti-microbiennes, la ruche est ainsi protégée de la prolifération de champignons et de bactéries.'),
(5, 36, 'Santé', 'health', 'Forever Royal Jelly', '60 comprimés', '75.5 mg de gelée royale lyophilisée équivalent à 250 mg de gelée royale fraîche par comprimé.', 'Froid, vent et journées plus courtes marquent l\'arrivée de l\'hiver. Forever Royal Jelly est idéale pour se prémunir contre les conséquences de la période hivernale. Forever Royal Jelly renforce en douceur les défenses naturelles de l‘organisme et permet d\'attaquer l\'hiver en forme.'),
(8, 61, 'Peau', 'skin', 'Gelée d\'aloès', '118ml', '84.46 % de gel d\'aloès.', 'Particulièrement riche en Aloe Vera, ce gel transparent non gras possède toutes les vertus de la plante. Il hydrate*, apaise et régénère l\'épiderme. Il est idéal contre les irritations de la peau et les coups de soleil. * Hydratation des couches supérieures de l\'épiderme .'),
(9, 51, 'Peau', 'skin', 'Aloe Propolis Crème', '113g', '74.17 % de gel d\'aloès, 0.55 % de propolis', 'L\'aloès associé à la propolis, font de cette crème à la texture riche, un véritable soin anti-bactérien et réparateur, qui apaise les irritations cutanées. La camomille, l\'allantoïne et les vitamines A et E apportent à la peau douceur et souplesse. Elle peut être utilisée sur les peaux sèches et rugueuses.'),
(10, 63, 'Peau', 'skin', 'Crème Visage Aloès', '118ml', '36.5 % de gel d\'aloès.', 'Ce soin protège, nourrit et réduit les signes du vieillissement cutané. Sa texture fondante, enrichie en collagène et en élastine, hydrate* et raffermit. La peau est souple, douce et apparaît comme \"liftée\".  *Convient aux peaux sensibles.'),
(11, 311, 'Peau', 'skin', 'Soin Hydratant Intense Sonya', '71g', '26 % de gel d\'aloès.', 'Ce soin régénérant agit comme un bain d\'hydratation* et procure à la peau un confort. La peau est raffermie, paraît visiblement plus jeune et lissée. Les rides et ridules sont visiblement réduites apportant confort et tonus tout au long de la journée. * Hydratation des couches supérieures de l\'épiderme. FORMULE OPTIMISÉE'),
(12, 281, 'Peau', 'skin', 'Sérum Nourrissant au Thé Blanc Sonya', '118ml', '37 % de gel d\'aloès.', 'Ce sérum apporte souplesse et préserve l\'élasticité de la peau tout en l\'hydratant* intensément. Il réduit les signes visibles du vieillissement cutané. Sa texture riche et légèrement gélifiée pénètre en profondeur et laisse un confort intense. * Hydratation des couches supérieures de l\'épiderme.'),
(13, 67, 'Quotidien', 'daily', 'Stick Déodorant Aloès', '92.1g', 'Gel d\'aloès.', 'Sans alcool, sans sels d\'aluminium et discrètement parfumé, ce déodorant assure une protection efficace sans tacher vos vêtements. Sa formule à l\'aloès adoucit et hydrate* la peau. *Hydrate les couches supérieures de l\'épiderme.'),
(14, 28, 'Quotidien', 'daily', 'Forever Bright Toothgel', '130g', '35.5 % de gel d\'aloès.', 'Ce gel dentaire, sans fluor et non abrasif, ravive la blancheur de vos dents. Son complexe à la chlorophylle, sans menthol, procure une sensation de fraîcheur naturelle. Sa formule complète à base de propolis et d\'aloès aide à préserver votre l\'hygiène buccale.'),
(15, 1022, 'Quotidien', 'daily', 'Aloé Lèvres', '4.5g', '27.6 % de gel d\'aloès, 20.4 % d\'huile de jojoba.', 'Une formule nourrissante et protectrice pour ce baume à lèvres qui associe Aloe Vera, huile de jojoba et cire d\'abeille. Il apporte un confort revitalisant pour les lèvres les plus desséchées. * Hydratation des couches supérieures de l\'épiderme .'),
(22, 64, 'Douleur', 'pain', 'Emulsion Thermogène - Aloe Heat Lotion', '118ml', '35.9 % de gel d\'aloès.', 'L\'émulsion thermogène procure une étonnante sensation de chaleur localisée. La richesse du gel de la plante d\'Aloès est associée aux extraits d\'Eucalyptus et de Menthol, connus pour leurs propriétés apaisantes. Utilisée comme crème de massage, l’Émulsion Thermogène procure un intense moment de bien-être et de relaxation. NOUVELLE FORMULE'),
(23, 205, 'Douleur', 'pain', 'Aloe MSM Gel', '118ml', '40 % de gel d\'aloès, 15 % MSM.', 'Le methyl sulfonyl méthane (MSM) est une source stable, riche et naturelle de soufre organique. Le soufre est présent en concentration particulièrement élevée dans les articulations où il participe à la production du sulfate de chondroïtine et des glucosamines. Utilisé comme gel de massage, le MSM gel améliore le confort articulaire.');

-- --------------------------------------------------------

--
-- Structure de la table `websiteadmin`
--

DROP TABLE IF EXISTS `websiteadmin`;
CREATE TABLE IF NOT EXISTS `websiteadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(32) NOT NULL,
  `passwordadmin` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `websiteadmin`
--

INSERT INTO `websiteadmin` (`id`, `pseudo`, `passwordadmin`) VALUES
(1, 'tom35240', '$2y$11$d78008703703766a0d0b4OrwNE81NNr/PjxfNTrVNZu3dOH4g8zmC'),
(2, 'forence35', '$2y$11$90adb57c7067cd7a6e9b4uI2Btzhup7CcFXmCead3htnAZ76D6JGO'),
(3, '3wa', '$2y$11$b40d5bb4baa2d93b5dcdeeKDJ9Dpz/lfhKw/uWVIZebhgJKLe3J1a');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `product reference` FOREIGN KEY (`refproduct`) REFERENCES `products` (`ref`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
