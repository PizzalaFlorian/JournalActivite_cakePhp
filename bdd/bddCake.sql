-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2016 at 02:36 PM
-- Server version: 5.6.30-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bddCake`
--
CREATE DATABASE IF NOT EXISTS `bddCake` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bddCake`;

-- --------------------------------------------------------

--
-- Table structure for table `activite`
--

CREATE TABLE IF NOT EXISTS `activite` (
  `CodeActivite` int(10) unsigned NOT NULL,
  `NomActivite` varchar(250) NOT NULL,
  `DescriptifActivite` text NOT NULL,
  `CodeCategorie` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activite`
--

INSERT INTO `activite` (`CodeActivite`, `NomActivite`, `DescriptifActivite`, `CodeCategorie`) VALUES
(10, 'Sommeil', '', 1),
(13, 'Evènements sportifs', '', 13),
(20, 'Repas', '', 1),
(30, 'Habillage – soins du corps', '', 1),
(40, 'Temps personnels', '', 1),
(101, 'Déplacements pour raisons personnelles (soins, relations avec une administration…)', '', 17),
(102, 'Déplacements pour aller/revenir du travail', '', 17),
(103, 'Déplacements pour aller/revenir de l’université', '', 17),
(104, 'Déplacements pour les courses et activités d’achat', '', 17),
(105, 'Transport d’un membre de la famille', '', 17),
(106, 'Déplacements dans un cadre associatif', '', 17),
(107, 'Déplacements liés à la vie sociale', '', 17),
(108, 'Déplacements lies aux activités de loisirs et de divertissement', '', 17),
(109, 'Déplacements pour activités sportives', '', 17),
(110, 'Travail salarié (salarié, indépendant…) ', '', 2),
(120, 'Pauses durant l’activité salariée (café…)', '', 2),
(130, 'Pauses repas pendant l’activité salarié', '', 2),
(140, 'Autres type d’activités liées au travail salarié (hors déplacement)', '', 2),
(211, 'Audition, prise de notes', '', 3),
(212, 'Échanges avec les enseignants', '', 3),
(213, 'Autre type d’activités liées à la participation aux cours magistraux TD/TP', '', 3),
(221, 'Participation au TD (prise de note, lecture…)', '', 3),
(222, 'Présentation d’exposés', '', 3),
(223, 'Devoirs sur table', '', 3),
(224, 'Travail en laboratoire', '', 3),
(225, 'Communications avec les chargés de TD/TP', '', 3),
(226, 'Autre type d’activités de TP/TD', '', 3),
(231, 'Révisions (écriture de fiches, relectures…)', '', 4),
(232, 'Documentation (lecture, recherche documentaire, fiche de lecture…)', '', 4),
(233, 'Préparation (exposé, TD, exercices…)', '', 4),
(234, 'Reprise de cours (suite à une absence, remise en forme…) ', '', 4),
(235, 'Recherche de compléments au cours', '', 4),
(236, 'Planification du travail académique', '', 4),
(237, 'Autre type de travail académique personnel', '', 4),
(241, 'Préparations exposés… ', '', 5),
(242, 'Révisions collectives', '', 5),
(243, 'Échanges sur les cours', '', 5),
(244, 'Autre type de travail de groupe', '', 5),
(251, 'Examen en salle', '', 6),
(252, 'Consultation de copies', '', 6),
(253, 'Consultation d’annales', '', 6),
(261, 'Pause, goûter', '', 7),
(310, 'Préparation des repas ', '', 8),
(320, 'Installation/désinstallation table, vaisselle', '', 8),
(330, 'Nettoyage de la maison', '', 8),
(340, 'Lavage du linge (y compris le repassage)', '', 8),
(350, 'Jardinage et soins des animaux de compagnie, Bricolage, Entretien d’un véhicule', '', 8),
(360, 'Courses, achats', '', 8),
(370, 'Gestion des affaires domestiques (documents officiels, factures, démarches administratives', '', 8),
(410, 'Soins aux enfants ', '', 9),
(420, 'Suivi du travail scolaire', '', 9),
(430, 'Jeux, lectures et discussions avec les enfants', '', 9),
(440, 'Transports des enfants ', '', 9),
(450, 'Aide à un membre de la famille', '', 9),
(510, 'Travail associatif (réunions…)', '', 10),
(521, 'Courses, aides à domicile… ', '', 11),
(522, 'Garde d’enfants ', '', 11),
(523, 'Autre type d’aide aux personnes', '', 11),
(530, 'Activités religieuses ', '', 11),
(540, 'Activités politiques (meeting…)', '', 11),
(550, 'Autres type d’activités associatives, politiques et bénévoles', '', 11),
(610, 'Vie sociale', '', 12),
(620, 'Activités en famille', '', 12),
(630, 'Rencontres avec des amis (visite ou réception)', '', 12),
(640, 'Fêtes', '', 12),
(650, 'Conversations téléphoniques', '', 12),
(661, 'Cinéma', '', 13),
(662, 'Théâtre et concerts', '', 13),
(663, 'Musées, expositions', '', 13),
(664, 'Bibliothèque', '', 13),
(670, 'Autres type d’activités liées à la vie sociale et aux divertissements', '', 13),
(711, 'Marche et randonnée', '', 14),
(712, 'Jogging et course à pieds', '', 14),
(713, 'Vélo, ski, sports de glisse', '', 14),
(714, 'Jeux avec ballons', '', 14),
(715, 'Gymnastique', '', 14),
(716, 'Fitness', '', 14),
(717, 'Sports nautiques (natation…)', '', 14),
(720, 'Autres activités de détente (pêche, chasse, cueillettes…)', '', 14),
(810, 'Pratique d’une activité artistique (musique, peinture…)', '', 15),
(820, 'Correspondance (y compris SMS…)', '', 15),
(831, 'Jeux de société ', '', 16),
(832, 'Jeux électroniques', '', 16),
(833, 'Autres jeux', '', 16),
(840, 'Autre activité de loisir Utilisation des médias', '', 15),
(910, 'Lectures (livres, revues…)', '', 15),
(920, 'TV et vidéos', '', 15),
(930, 'Radio', '', 15),
(940, 'Consultations médias sur supports électroniques (tablettes, ordinateurs…)', '', 15),
(950, 'écoute de musique (autre que radio)', '', 15),
(999, 'Autres temps, temps non spécifié', '', 18);

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `CodeAdmin` int(10) unsigned NOT NULL,
  `ID` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrateur`
--

INSERT INTO `administrateur` (`CodeAdmin`, `ID`) VALUES
(1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `candidat`
--

CREATE TABLE IF NOT EXISTS `candidat` (
  `CodeCandidat` int(10) unsigned NOT NULL,
  `NomCandidat` varchar(250) NOT NULL,
  `PrenomCandidat` varchar(250) NOT NULL,
  `Age` int(11) NOT NULL COMMENT 'pas plustot anné de naissance',
  `GenreCandidat` varchar(250) NOT NULL,
  `LieuxEtude` varchar(250) NOT NULL,
  `NiveauEtude` varchar(250) NOT NULL,
  `DiplomePrep` varchar(250) NOT NULL,
  `EtatCivil` varchar(250) NOT NULL,
  `NombreEnfant` int(10) unsigned NOT NULL,
  `ID` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `candidat`
--

INSERT INTO `candidat` (`CodeCandidat`, `NomCandidat`, `PrenomCandidat`, `Age`, `GenreCandidat`, `LieuxEtude`, `NiveauEtude`, `DiplomePrep`, `EtatCivil`, `NombreEnfant`, `ID`) VALUES
(1, 'Gimenz', 'Patrick', 22, 'vache', 'Grenoble', 'CAP', 'Master Macrame', 'Decede', 12, 9),
(2, 'Boyle', 'Suzanne', 19, 'tortue', 'Suez', 'BAC +2', 'Master Droit', 'En couple', 0, 10),
(3, 'Michel', 'Jean-Jacque', 26, 'homme', 'Vienne', 'BAC+7', 'L1 jardinage', 'Celibataire', 1, 11),
(4, 'Robert', 'Christian', 11, 'chien', 'Paris', 'MatSup', 'CNRS', 'Union libre', 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `carnetdebord`
--

CREATE TABLE IF NOT EXISTS `carnetdebord` (
  `CodeEntree` int(10) unsigned NOT NULL,
  `Date` date NOT NULL,
  `Sujet` varchar(250) NOT NULL,
  `Commentaire` text NOT NULL,
  `CodeChercheur` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categorieactivite`
--

CREATE TABLE IF NOT EXISTS `categorieactivite` (
  `CodeCategorieActivite` int(10) unsigned NOT NULL,
  `NomCategorie` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorieactivite`
--

INSERT INTO `categorieactivite` (`CodeCategorieActivite`, `NomCategorie`) VALUES
(1, 'Soins personnels \r\nActivités principales et secondaires'),
(2, 'Emplois salariés '),
(3, 'Études et travail académique - \r\nCours magistraux '),
(4, 'Études et travail académique - Travail académique personnel '),
(5, 'Études et travail académique - Travail de groupe '),
(6, 'Études et travail académique - Examens '),
(7, 'Études et travail académique - Pauses pendant les activités d’étude'),
(8, 'Activités domestiques '),
(9, 'Activités familiales '),
(10, 'Activités associatives, politiques et bénévoles '),
(11, 'Aides aux personnes '),
(12, 'Vie sociale et divertissements'),
(13, 'Culture et divertissement '),
(14, 'Activités sportives \r\nExercices physiques '),
(15, 'Loisirs '),
(16, 'Jeux'),
(17, 'Déplacements '),
(18, 'Temps non spécifié');

-- --------------------------------------------------------

--
-- Table structure for table `categorielieu`
--

CREATE TABLE IF NOT EXISTS `categorielieu` (
  `CodeCategorieLieux` int(10) unsigned NOT NULL,
  `NomCategorie` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorielieu`
--

INSERT INTO `categorielieu` (`CodeCategorieLieux`, `NomCategorie`) VALUES
(1, 'lieu'),
(2, 'transport');

-- --------------------------------------------------------

--
-- Table structure for table `chercheur`
--

CREATE TABLE IF NOT EXISTS `chercheur` (
  `CodeChercheur` int(10) unsigned NOT NULL,
  `NomChercheur` varchar(250) NOT NULL,
  `PrenomChercheur` varchar(250) NOT NULL,
  `ID` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chercheur`
--

INSERT INTO `chercheur` (`CodeChercheur`, `NomChercheur`, `PrenomChercheur`, `ID`) VALUES
(3, 'Dupont', 'Jean', 13);

-- --------------------------------------------------------

--
-- Table structure for table `compagnie`
--

CREATE TABLE IF NOT EXISTS `compagnie` (
  `NomCompagnie` varchar(250) NOT NULL,
  `CodeCompagnie` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `compagnie`
--

INSERT INTO `compagnie` (`NomCompagnie`, `CodeCompagnie`) VALUES
('Seul', 0),
('Partenaire', 1),
('Parents', 2),
('Autre membre de la famille', 3),
('Étudiant de votre promotion', 4),
('Autre personne', 5);

-- --------------------------------------------------------

--
-- Table structure for table `dispositif`
--

CREATE TABLE IF NOT EXISTS `dispositif` (
  `CodeDispositif` int(10) unsigned NOT NULL,
  `NomDispositif` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dispositif`
--

INSERT INTO `dispositif` (`CodeDispositif`, `NomDispositif`) VALUES
(0, 'Aucun '),
(1, 'Ordinateur '),
(2, 'Tablettes'),
(3, 'Téléphone'),
(4, 'Télévision'),
(5, 'Livre'),
(6, 'Revue scientifique'),
(7, 'Journal, magazine');

-- --------------------------------------------------------

--
-- Table structure for table `lieu`
--

CREATE TABLE IF NOT EXISTS `lieu` (
  `CodeLieux` int(10) unsigned NOT NULL,
  `NomLieux` varchar(250) NOT NULL,
  `CodeCategorieLieux` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lieu`
--

INSERT INTO `lieu` (`CodeLieux`, `NomLieux`, `CodeCategorieLieux`) VALUES
(1, 'Chez soi (domicile personnel de l''étudiant) ', 1),
(2, 'Chez ses parents / un membre de sa famille ', 1),
(3, 'Chez un / des autres étudiants ', 1),
(4, 'Chez un / des amis ', 1),
(5, 'Dans une salle de cours, TD, TP, amphithéâtre', 1),
(6, 'Dans une salle d''étude ', 1),
(7, 'Bibliothèque ', 1),
(8, 'Restaurant universitaire', 1),
(9, 'Autre lieu en lien avec les études (administration, CIO,…)', 1),
(10, 'Autre lieu de restauration (restaurant, bar, café…) ', 1),
(11, 'Terrain et équipement de sport', 1),
(12, 'Lieu de divertissement (cinéma, théâtre, salle de concert) ', 1),
(13, 'Commerces bâtiments publiques (Mairie, administrations, écoles,...) ', 1),
(14, 'Voie publique (rue, route, autoroutes)', 1),
(15, 'Autre lieu ', 1),
(16, 'Voiture personnelle ', 2),
(17, 'Covoiturage', 2),
(18, 'Deux roues à moteur (moto, scooters…) ', 2),
(19, 'Vélo ', 2),
(20, 'Train', 2),
(21, 'Transports en commun (bus, tram, métro)', 2),
(22, 'Avion ', 2),
(23, 'Autre transport', 2);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `IDMessage` int(10) unsigned NOT NULL,
  `DateEnvoi` date NOT NULL,
  `Sujet` varchar(250) NOT NULL,
  `ContenuMessage` text NOT NULL,
  `recepteurLu` tinyint(1) NOT NULL,
  `expediteurLu` tinyint(1) NOT NULL,
  `IDExpediteur` int(10) unsigned NOT NULL,
  `IDRecepteur` int(10) unsigned NOT NULL,
  `userExpediteur` int(10) NOT NULL,
  `userRecepteur` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`IDMessage`, `DateEnvoi`, `Sujet`, `ContenuMessage`, `recepteurLu`, `expediteurLu`, `IDExpediteur`, `IDRecepteur`, `userExpediteur`, `userRecepteur`) VALUES
(1, '2016-05-08', 'test', 'testetetetetettetetete', 0, 0, 1, 2, 0, 0),
(2, '2016-05-08', 'looooooooool', 'loooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooool', 1, 0, 1, 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `occupation`
--

CREATE TABLE IF NOT EXISTS `occupation` (
  `CodeOccupation` bigint(20) unsigned NOT NULL,
  `HeureDebut` datetime NOT NULL,
  `HeureFin` datetime NOT NULL,
  `CodeCandidat` int(10) unsigned NOT NULL,
  `CodeLieux` int(10) unsigned NOT NULL,
  `CodeActivite` int(10) unsigned NOT NULL,
  `CodeCompagnie` int(10) unsigned NOT NULL,
  `CodeDispositif` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `occupation`
--

INSERT INTO `occupation` (`CodeOccupation`, `HeureDebut`, `HeureFin`, `CodeCandidat`, `CodeLieux`, `CodeActivite`, `CodeCompagnie`, `CodeDispositif`) VALUES
(1, '2016-05-09 00:00:00', '2016-05-09 07:00:00', 1, 1, 10, 0, 0),
(7, '2016-05-12 00:45:00', '2016-05-12 14:45:00', 1, 1, 10, 0, 0),
(8, '2016-05-10 01:15:00', '2016-05-10 05:15:00', 1, 1, 10, 0, 0),
(9, '2016-05-11 01:15:00', '2016-05-11 03:15:00', 1, 1, 10, 0, 0),
(10, '2016-05-13 00:45:00', '2016-05-13 18:45:00', 1, 1, 10, 0, 0),
(11, '2016-05-10 05:45:00', '2016-05-10 07:45:00', 1, 1, 10, 0, 0),
(12, '2016-05-14 01:15:00', '2016-05-14 03:15:00', 1, 1, 10, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(10) unsigned NOT NULL,
  `login` varchar(255) NOT NULL,
  `typeUser` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `login`, `typeUser`, `password`, `email`) VALUES
(8, 'halo', 'halo', '$2y$10$OrGBnea9ldqvuZdFWOIPcOn6euVk1HkT3XdbysUOxfrsIdg8HA74i', 'halo@haloha.com'),
(9, 'test', 'candidat', '$2y$10$WKx74nNCFSWYaEAdKvNqi.7ccJgsVoHWFiWcMfaEYzfvxgN.gGWnG', 'test@test.com'),
(10, 'toto', 'candidat', '$2y$10$LlXoTfeYdi1Zq24LhA3dau8PPXpNUsy1xyESVQj/B7RXAzqUhnQPS', 'toto@toto.com'),
(11, 'boule', 'candidat', '$2y$10$70jLgRkEiNnFGZGPNo7f0OsvW1.nbgGNGo2OtBzIR.lwWSpSyuOVe', 'boule@boule.com'),
(12, 'bill', 'candidat', '$2y$10$FcO8VR4QeUKeGX7NozVv6u21KrRoEjZgmYeMduAXLAhEVbFEroAYO', 'bill@bill.com'),
(13, 'trouve', 'chercheur', '$2y$10$R6pvPppREa26Cq8/lbK5q.lKs0LPWrXmi/FMFrZuolnothfh9wQQS', 'trouve@test.com'),
(14, 'admin', 'admin', '$2y$10$JAGmVUjMotic8.HQp/2YKuwNt/TdjzPD3x4eP.Xb.kbFBUCAjJFbC', 'admin@test.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activite`
--
ALTER TABLE `activite`
  ADD PRIMARY KEY (`CodeActivite`),
  ADD KEY `CodeCategorie` (`CodeCategorie`);

--
-- Indexes for table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`CodeAdmin`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `candidat`
--
ALTER TABLE `candidat`
  ADD PRIMARY KEY (`CodeCandidat`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `carnetdebord`
--
ALTER TABLE `carnetdebord`
  ADD PRIMARY KEY (`CodeEntree`),
  ADD KEY `CodeChercheur` (`CodeChercheur`);

--
-- Indexes for table `categorieactivite`
--
ALTER TABLE `categorieactivite`
  ADD PRIMARY KEY (`CodeCategorieActivite`);

--
-- Indexes for table `categorielieu`
--
ALTER TABLE `categorielieu`
  ADD PRIMARY KEY (`CodeCategorieLieux`);

--
-- Indexes for table `chercheur`
--
ALTER TABLE `chercheur`
  ADD PRIMARY KEY (`CodeChercheur`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `compagnie`
--
ALTER TABLE `compagnie`
  ADD PRIMARY KEY (`CodeCompagnie`);

--
-- Indexes for table `dispositif`
--
ALTER TABLE `dispositif`
  ADD PRIMARY KEY (`CodeDispositif`);

--
-- Indexes for table `lieu`
--
ALTER TABLE `lieu`
  ADD PRIMARY KEY (`CodeLieux`),
  ADD KEY `CodeCategorieLieux` (`CodeCategorieLieux`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`IDMessage`),
  ADD KEY `IDExpediteur` (`IDExpediteur`),
  ADD KEY `IDRecepteur` (`IDRecepteur`);

--
-- Indexes for table `occupation`
--
ALTER TABLE `occupation`
  ADD PRIMARY KEY (`CodeOccupation`),
  ADD KEY `CodeCandidat` (`CodeCandidat`),
  ADD KEY `CodeLieux` (`CodeLieux`),
  ADD KEY `CodeCompagnie` (`CodeCompagnie`),
  ADD KEY `CodeDispositif` (`CodeDispositif`),
  ADD KEY `CodeActivite` (`CodeActivite`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `CodeAdmin` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `candidat`
--
ALTER TABLE `candidat`
  MODIFY `CodeCandidat` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `carnetdebord`
--
ALTER TABLE `carnetdebord`
  MODIFY `CodeEntree` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categorieactivite`
--
ALTER TABLE `categorieactivite`
  MODIFY `CodeCategorieActivite` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `chercheur`
--
ALTER TABLE `chercheur`
  MODIFY `CodeChercheur` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `IDMessage` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `occupation`
--
ALTER TABLE `occupation`
  MODIFY `CodeOccupation` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `activite`
--
ALTER TABLE `activite`
  ADD CONSTRAINT `activite_ibfk_1` FOREIGN KEY (`CodeCategorie`) REFERENCES `categorieactivite` (`CodeCategorieActivite`);

--
-- Constraints for table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `candidat`
--
ALTER TABLE `candidat`
  ADD CONSTRAINT `candidat_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `carnetdebord`
--
ALTER TABLE `carnetdebord`
  ADD CONSTRAINT `carnetdebord_ibfk_1` FOREIGN KEY (`CodeChercheur`) REFERENCES `chercheur` (`CodeChercheur`);

--
-- Constraints for table `chercheur`
--
ALTER TABLE `chercheur`
  ADD CONSTRAINT `chercheur_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `lieu`
--
ALTER TABLE `lieu`
  ADD CONSTRAINT `lieu_ibfk_1` FOREIGN KEY (`CodeCategorieLieux`) REFERENCES `categorielieu` (`CodeCategorieLieux`);

--
-- Constraints for table `occupation`
--
ALTER TABLE `occupation`
  ADD CONSTRAINT `occupation_ibfk_1` FOREIGN KEY (`CodeCandidat`) REFERENCES `candidat` (`CodeCandidat`),
  ADD CONSTRAINT `occupation_ibfk_2` FOREIGN KEY (`CodeLieux`) REFERENCES `lieu` (`CodeLieux`),
  ADD CONSTRAINT `occupation_ibfk_3` FOREIGN KEY (`CodeCompagnie`) REFERENCES `compagnie` (`CodeCompagnie`),
  ADD CONSTRAINT `occupation_ibfk_4` FOREIGN KEY (`CodeDispositif`) REFERENCES `dispositif` (`CodeDispositif`),
  ADD CONSTRAINT `occupation_ibfk_5` FOREIGN KEY (`CodeActivite`) REFERENCES `activite` (`CodeActivite`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
