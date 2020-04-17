-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 17 avr. 2020 à 17:19
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `FOL 49`
--

-- --------------------------------------------------------

--
-- Structure de la table `Contrat`
--

CREATE TABLE `Contrat` (
  `num_securite` int(11) NOT NULL,
  `type_contrat` varchar(5) COLLATE utf8_bin NOT NULL,
  `date_embauche` date NOT NULL,
  `classification` varchar(30) COLLATE utf8_bin NOT NULL,
  `groupe` varchar(10) COLLATE utf8_bin NOT NULL,
  `coefficient` float NOT NULL,
  `fonction` varchar(30) COLLATE utf8_bin NOT NULL,
  `lieu_travail` varchar(30) COLLATE utf8_bin NOT NULL,
  `volume_horaire` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `enfant`
--

CREATE TABLE `enfant` (
  `num_securite` int(11) NOT NULL,
  `nom` varchar(30) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(30) COLLATE utf8_bin NOT NULL,
  `date_de_naissance` date NOT NULL,
  `sexe` varchar(5) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `num_securite` int(11) NOT NULL,
  `mot_de_passe` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `Salarie`
--

CREATE TABLE `Salarie` (
  `num_securite` int(11) NOT NULL,
  `nom` varchar(30) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(30) COLLATE utf8_bin NOT NULL,
  `date_de_naissance` date NOT NULL,
  `lieu_de_naissance` varchar(30) COLLATE utf8_bin NOT NULL,
  `adresse` varchar(30) COLLATE utf8_bin NOT NULL,
  `telephone` int(10) NOT NULL,
  `adresse_mail` varchar(30) COLLATE utf8_bin NOT NULL,
  `enfants` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `Structure`
--

CREATE TABLE `Structure` (
  `nom_structure` varchar(30) COLLATE utf8_bin NOT NULL,
  `responsable` varchar(30) COLLATE utf8_bin NOT NULL,
  `num_securite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Contrat`
--
ALTER TABLE `Contrat`
  ADD KEY `cle3` (`num_securite`);

--
-- Index pour la table `enfant`
--
ALTER TABLE `enfant`
  ADD KEY `cle1` (`num_securite`);

--
-- Index pour la table `Salarie`
--
ALTER TABLE `Salarie`
  ADD PRIMARY KEY (`num_securite`);

--
-- Index pour la table `Structure`
--
ALTER TABLE `Structure`
  ADD KEY `cle4` (`num_securite`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Contrat`
--
ALTER TABLE `Contrat`
  ADD CONSTRAINT `cle3` FOREIGN KEY (`num_securite`) REFERENCES `Salarie` (`num_securite`);

--
-- Contraintes pour la table `enfant`
--
ALTER TABLE `enfant`
  ADD CONSTRAINT `cle1` FOREIGN KEY (`num_securite`) REFERENCES `Salarie` (`num_securite`);

--
-- Contraintes pour la table `Structure`
--
ALTER TABLE `Structure`
  ADD CONSTRAINT `cle4` FOREIGN KEY (`num_securite`) REFERENCES `Salarie` (`num_securite`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
