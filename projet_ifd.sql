-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 08 nov. 2020 à 09:45
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_ifd`
--

-- --------------------------------------------------------

--
-- Structure de la table `ami`
--

CREATE TABLE `ami` (
  `ID_Utilisateur` int(11) NOT NULL,
  `ID_ami` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ami`
--

INSERT INTO `ami` (`ID_Utilisateur`, `ID_ami`) VALUES
(2, 1),
(3, 1),
(1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `critique`
--

CREATE TABLE `critique` (
  `Note` float NOT NULL,
  `ID_critique` int(11) NOT NULL,
  `ID_utilisateur` int(11) NOT NULL,
  `Commentaire` varchar(2047) NOT NULL,
  `ID_jeu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `critique`
--

INSERT INTO `critique` (`Note`, `ID_critique`, `ID_utilisateur`, `Commentaire`, `ID_jeu`) VALUES
(16, 1, 1, 'C\'est cool mais c\'est dur', 1),
(20, 2, 1, 'Bon jeu', 3),
(11, 3, 1, 'Long, aucune fin', 2),
(18, 4, 1, 'Bon jeu de guerre !', 4),
(12, 5, 3, 'jeu populaire en ce moment', 1),
(18, 6, 3, 'Un jeu classique indémodable', 5),
(15, 7, 1, 'trop long', 5);

-- --------------------------------------------------------

--
-- Structure de la table `critique_critique`
--

CREATE TABLE `critique_critique` (
  `ID_critique` int(11) NOT NULL,
  `Pouce` tinyint(1) NOT NULL,
  `ID_utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `critique_critique`
--

INSERT INTO `critique_critique` (`ID_critique`, `Pouce`, `ID_utilisateur`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(4, 1, 1),
(2, 1, 2),
(2, 0, 3),
(2, 0, 4),
(2, 0, 5),
(3, 0, 5),
(3, 0, 2),
(3, 0, 4),
(3, 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `Genre` varchar(255) NOT NULL,
  `ID_jeu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`Genre`, `ID_jeu`) VALUES
('Strategie', 1),
('Strategie', 2),
('RPG', 3),
('FPS', 4),
('Societe', 5),
('RPG', 6),
('RPG', 7),
('RPG', 8);

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
--

CREATE TABLE `jeu` (
  `Date_sortie` date NOT NULL,
  `Nb_joueurs_max` int(11) NOT NULL,
  `Prix` float NOT NULL,
  `PEGI` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `Editeur` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `jeu`
--

INSERT INTO `jeu` (`Date_sortie`, `Nb_joueurs_max`, `Prix`, `PEGI`, `ID`, `nom`, `Editeur`) VALUES
('2018-06-15', 10, 0, 3, 1, 'Among us', 'InnerSloth'),
('2012-04-12', 2, 0, 3, 2, 'Candy Crush Saga', 'King'),
('2013-06-14', 1, 15, 7, 3, 'The Last of Us', 'Naughty Dog'),
('2017-11-03', 1, 51, 7, 4, 'Call Of Duty WWII', 'Activision'),
('1935-02-06', 6, 20, 3, 5, 'Monopoly', 'Hasbro'),
('2019-11-15', 1, 50, 3, 6, 'Pokemon Epée', 'Nintendo'),
('2020-03-20', 7, 50, 3, 7, 'Animal Crossing : New Horizons', 'Nintendo'),
('2019-01-11', 4, 50, 3, 8, 'New Super Mario Bros U Deluxe', 'Nintendo');

-- --------------------------------------------------------

--
-- Structure de la table `plateforme`
--

CREATE TABLE `plateforme` (
  `Plateforme` varchar(255) NOT NULL,
  `ID_Jeu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `plateforme`
--

INSERT INTO `plateforme` (`Plateforme`, `ID_Jeu`) VALUES
('Pc', 1),
('Pc', 2),
('Ps4', 3),
('Ps4', 4),
('Table', 5),
('Nintendo', 6),
('Nintendo', 7),
('Nintendo', 8);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `ID` int(11) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Date_naissance` date NOT NULL,
  `Pays` varchar(255) NOT NULL,
  `Ville` varchar(255) NOT NULL,
  `Genre` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Mot_de_passe` varchar(255) NOT NULL,
  `Date_creation` date NOT NULL,
  `Question_secrete` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID`, `Prenom`, `Nom`, `Date_naissance`, `Pays`, `Ville`, `Genre`, `Email`, `Mot_de_passe`, `Date_creation`, `Question_secrete`) VALUES
(1, 'Ondine', 'Lecas', '2001-09-27', 'France', 'Montpellier', 'Femme', 'ondine.lecas3@gmail.com', 'cbac7c3b9559d0e279ec3e516749c491', '2020-11-04', '867a0c3b13bcc25183893c43dc5caf2c'),
(2, 'Jean', 'Dupont', '1997-09-07', 'France', 'Grenoble', 'Non-binaire', 'test@hotmail.fr', '6e1eb235b82a55fc10b09e5108cc351d', '2020-11-04', '2397808a2862ec4f2fec8c5dc75f3009'),
(3, 'Nicolas', 'LECAS', '2001-09-27', 'France', 'Belfort', 'Homme', 'nico.34330@gmail.com', '236d1336e98985dce3a625d46aebfd02', '2020-11-06', '92f4d1161822285b5ced18f3fbab6d9c'),
(4, 'jean', 'dupont', '2020-11-28', 'France', 'Belfort', 'Homme', 'test2@hotmail.com', '4f15a91f3f329dab302bfd62ffb93490', '2020-11-06', '2397808a2862ec4f2fec8c5dc75f3009'),
(5, 'jean', 'dupont', '2020-11-25', 'France', 'belfort', 'Non-binaire', 'test3@hotmail.fr', 'b73e0a0d8afc39e471ed395897aafbc7', '2020-11-06', '867a0c3b13bcc25183893c43dc5caf2c');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ami`
--
ALTER TABLE `ami`
  ADD KEY `ID_Utilisateur` (`ID_Utilisateur`),
  ADD KEY `ID_ami` (`ID_ami`);

--
-- Index pour la table `critique`
--
ALTER TABLE `critique`
  ADD PRIMARY KEY (`ID_critique`),
  ADD KEY `ID_utilisateur` (`ID_utilisateur`),
  ADD KEY `ID_jeu` (`ID_jeu`);

--
-- Index pour la table `critique_critique`
--
ALTER TABLE `critique_critique`
  ADD KEY `ID_critique` (`ID_critique`),
  ADD KEY `ID_utilisateur` (`ID_utilisateur`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD KEY `ID_jeu` (`ID_jeu`);

--
-- Index pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `plateforme`
--
ALTER TABLE `plateforme`
  ADD KEY `ID_Jeu` (`ID_Jeu`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `critique`
--
ALTER TABLE `critique`
  MODIFY `ID_critique` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ami`
--
ALTER TABLE `ami`
  ADD CONSTRAINT `ami_ibfk_1` FOREIGN KEY (`ID_Utilisateur`) REFERENCES `utilisateur` (`ID`),
  ADD CONSTRAINT `ami_ibfk_2` FOREIGN KEY (`ID_ami`) REFERENCES `utilisateur` (`ID`);

--
-- Contraintes pour la table `critique`
--
ALTER TABLE `critique`
  ADD CONSTRAINT `critique_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`ID`),
  ADD CONSTRAINT `critique_ibfk_2` FOREIGN KEY (`ID_jeu`) REFERENCES `jeu` (`ID`);

--
-- Contraintes pour la table `critique_critique`
--
ALTER TABLE `critique_critique`
  ADD CONSTRAINT `critique_critique_ibfk_1` FOREIGN KEY (`ID_critique`) REFERENCES `critique` (`ID_critique`),
  ADD CONSTRAINT `critique_critique_ibfk_2` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`ID`);

--
-- Contraintes pour la table `genre`
--
ALTER TABLE `genre`
  ADD CONSTRAINT `genre_ibfk_1` FOREIGN KEY (`ID_jeu`) REFERENCES `jeu` (`ID`);

--
-- Contraintes pour la table `plateforme`
--
ALTER TABLE `plateforme`
  ADD CONSTRAINT `plateforme_ibfk_1` FOREIGN KEY (`ID_Jeu`) REFERENCES `jeu` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
