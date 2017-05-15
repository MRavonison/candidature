-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Jeu 05 Janvier 2017 à 15:07
-- Version du serveur :  5.5.42
-- Version de PHP :  5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `authentification`
--

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE `task` (
  `idtask` int(4) unsigned NOT NULL,
  `nametask` varchar(50) NOT NULL,
  `namesociety` varchar(50) NOT NULL,
  `deliverydate` date NOT NULL,
  `priorityserv` varchar(25) NOT NULL,
  `prioritycolor` varchar(10) NOT NULL,
  `assigned` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `task`
--

INSERT INTO `task` (`idtask`, `nametask`, `namesociety`, `deliverydate`, `priorityserv`, `prioritycolor`, `assigned`) VALUES
(5, 'Mise à Jour', 'BNP', '2016-12-30', 'Production server', 'Red', 0),
(6, 'Remplacement', 'BNP', '2016-12-30', 'Qualification server', 'Yellow', 1),
(7, 'Intégration', 'LCL', '2016-12-04', 'Production server', 'Orange', 1),
(8, 'Migration REGLISS', 'BNP UMANIS', '2016-12-06', 'Qualification server', 'Orange', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL,
  `idtask` int(4) NOT NULL,
  `statut` int(1) NOT NULL,
  `compte` varchar(100) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `disponibility` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `idtask`, `statut`, `compte`, `firstname`, `mail`, `pass`, `disponibility`) VALUES
(5, 7, 1, 'admin', 'admin', 'admin@', 'admin', NULL),
(8, 6, 0, 'Traore', 'Boubakar', 'traore@gmail.com', 'traore', NULL),
(10, 0, 1, 'toto', 'titi', 'traore@gmail.com', 'toto', NULL),
(11, 0, 0, 'tata', 'tatata', 'traore@gmail.com', 'toto', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`idtask`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `idtask` int(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
