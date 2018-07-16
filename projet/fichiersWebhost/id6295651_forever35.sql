-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  lun. 16 juil. 2018 à 09:42
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `id6295651_forever35`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `refproduct` int(5) UNSIGNED NOT NULL,
  `posteddate` datetime NOT NULL,
  `email` varchar(128) NOT NULL,
  `pseudo` varchar(64) NOT NULL,
  `satisfaction` set('Pas satisfait(e)','Peu satisfait(e)','Assez satisfait(e)','Très satisfait(e)','Exceptionnel') NOT NULL,
  `usercomment` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `refproduct`, `posteddate`, `email`, `pseudo`, `satisfaction`, `usercomment`) VALUES
(22, 1022, '2018-07-10 15:16:06', 'miaou_sev@hotmail.fr', 'Séverine', 'Très satisfait(e)', 'Super pour l\'hydratation des lèvres!'),
(23, 67, '2018-07-10 15:21:31', 'miaou_sev@hotmail.fr', 'Séverine', 'Très satisfait(e)', 'Super!'),
(25, 36, '2018-07-14 09:06:37', 'cardondelphine@sfr.fr', 'Phine66', 'Très satisfait(e)', 'Très bon produit'),
(26, 67, '2018-07-14 09:13:23', 'Nicocharbonnier@yahoo.fr', 'Nico66', 'Très satisfait(e)', 'La composition du produit est alléchante.'),
(28, 67, '2018-07-14 17:40:37', 'nell02@wanadoo.fr', 'nell', 'Très satisfait(e)', 'La qualité'),
(29, 1022, '2018-07-14 17:45:16', 'Nell02@wanadoo.fr', 'Nell', 'Très satisfait(e)', 'Très utile'),
(30, 64, '2018-07-14 17:54:53', 'Nell02@wanadoo.fr', 'Nell', 'Exceptionnel', 'Très bon produit');

-- --------------------------------------------------------

--
-- Structure de la table `contactmessage`
--

CREATE TABLE `contactmessage` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `datemessage` datetime NOT NULL,
  `gender` varchar(4) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `zipcode` int(5) UNSIGNED ZEROFILL NOT NULL,
  `city` varchar(64) DEFAULT NULL,
  `phone` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `subjectmessage` set('Evénements','Parrainage','Produits','Autres') NOT NULL,
  `usermessage` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `newsevents`
--

CREATE TABLE `newsevents` (
  `id` smallint(11) UNSIGNED NOT NULL,
  `appointementdate` datetime DEFAULT NULL,
  `endtimeevent` time DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `eventtype` varchar(64) DEFAULT NULL,
  `eventdescription` varchar(512) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='newsevents';

--
-- Déchargement des données de la table `newsevents`
--

INSERT INTO `newsevents` (`id`, `appointementdate`, `endtimeevent`, `city`, `eventtype`, `eventdescription`) VALUES
(8, '2018-11-18 10:00:00', '18:00:00', 'Le Theil de Bretagne', 'Les portes ouvertes de la ferme des Mées', ''),
(7, '2018-11-17 14:00:00', '18:00:00', 'Le Theil de Bretagne', 'Les portes ouvertes de la ferme des Mées', ''),
(9, '2018-11-24 14:00:00', '18:00:00', 'Le Theil de Bretagne', 'Les portes ouvertes de la ferme des Mées', ''),
(10, '2018-11-25 10:00:00', '18:00:00', 'Le Theil de Bretagne', 'Les portes ouvertes de la ferme des Mées', '');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `ref` int(5) UNSIGNED NOT NULL,
  `category` set('Nouveautés','Santé','Douleur','Peau','Quotidien','Maison Animaux') NOT NULL,
  `categoryforcss` set('new','health','pain','skin','daily','house-animals') NOT NULL,
  `title` varchar(64) NOT NULL,
  `capacity` varchar(128) DEFAULT NULL,
  `composition` varchar(256) DEFAULT NULL,
  `productdescription` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `ref`, `category`, `categoryforcss`, `title`, `capacity`, `composition`, `productdescription`) VALUES
(1, 715, 'Nouveautés', 'new', 'Pulpe d\'Aloe Vera TetraPak', '1L', '99,7% de gel d\'Aloe Vera', 'L\'Aloe vera Forever fait peau neuve ! Riche d\'un savoir-faire de 40ans, Forever a revisité son produit signature et a créé une toute nouvelle version sans conservateur et riche en vitamine C, dans un emballage 100% recyclable. Cette formule optimisée vous apportera toujours plus de bien-être. Le secret, 99,7% de gel d\'Aloe vera, la plante aux mille vertus et une dose synergique de vitamine C, molécule antioxydante aux nombreux bienfaits.'),
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

CREATE TABLE `websiteadmin` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(32) NOT NULL,
  `passwordadmin` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `websiteadmin`
--

INSERT INTO `websiteadmin` (`id`, `pseudo`, `passwordadmin`) VALUES
(1, 'tom35240', '$2y$11$e77053bc470857f7392b4uEUf/9OI2XJCult7ujPzAGQU7othZELq'),
(2, 'forence35', '$2y$11$90adb57c7067cd7a6e9b4uI2Btzhup7CcFXmCead3htnAZ76D6JGO'),
(3, '3wa', '$2y$11$b40d5bb4baa2d93b5dcdeeKDJ9Dpz/lfhKw/uWVIZebhgJKLe3J1a');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refproduct` (`refproduct`);

--
-- Index pour la table `contactmessage`
--
ALTER TABLE `contactmessage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `newsevents`
--
ALTER TABLE `newsevents`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref` (`ref`);

--
-- Index pour la table `websiteadmin`
--
ALTER TABLE `websiteadmin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `contactmessage`
--
ALTER TABLE `contactmessage`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `newsevents`
--
ALTER TABLE `newsevents`
  MODIFY `id` smallint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `websiteadmin`
--
ALTER TABLE `websiteadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
