-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 03 Février 2016 à 16:38
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `bddCake`
--
CREATE DATABASE IF NOT EXISTS `bddCake` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bddCake`;

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

CREATE TABLE IF NOT EXISTS `activite` (
  `CodeActivite` int(10) unsigned NOT NULL,
  `NomActivite` varchar(255) NOT NULL,
  `DescriptifActivite` text NOT NULL,
  `CodeCategorie` int(10) unsigned NOT NULL,
  PRIMARY KEY (`CodeActivite`),
  KEY `CodeCategorie` (`CodeCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `activite`
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
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `CodeAdmin` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`CodeAdmin`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

CREATE TABLE IF NOT EXISTS `candidat` (
  `CodeCandidat` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Age` int(11) NOT NULL COMMENT 'pas plustot anné de naissance',
  `GenreCandidat` varchar(255) NOT NULL,
  `LieuxEtude` varchar(255) NOT NULL,
  `NiveauEtude` varchar(255) NOT NULL,
  `DiplomePrep` varchar(255) NOT NULL,
  `EtatCivil` varchar(255) NOT NULL,
  `NombreEnfant` int(10) unsigned NOT NULL,
  `ID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`CodeCandidat`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `carnetdebord`
--

CREATE TABLE IF NOT EXISTS `carnetdebord` (
  `CodeEntree` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Sujet` varchar(255) NOT NULL,
  `Commentaire` text NOT NULL,
  `CodeChercheur` int(10) unsigned NOT NULL,
  PRIMARY KEY (`CodeEntree`),
  KEY `CodeChercheur` (`CodeChercheur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `categorieactivite`
--

CREATE TABLE IF NOT EXISTS `categorieactivite` (
  `CodeCategorieActivite` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NomCategorie` varchar(255) NOT NULL,
  PRIMARY KEY (`CodeCategorieActivite`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `categorieactivite`
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
-- Structure de la table `categorielieu`
--

CREATE TABLE IF NOT EXISTS `categorielieu` (
  `CodeCategorieLieux` int(10) unsigned NOT NULL,
  `NomCategorie` varchar(255) NOT NULL,
  PRIMARY KEY (`CodeCategorieLieux`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorielieu`
--

INSERT INTO `categorielieu` (`CodeCategorieLieux`, `NomCategorie`) VALUES
(1, 'lieu'),
(2, 'transport');

-- --------------------------------------------------------

--
-- Structure de la table `chercheur`
--

CREATE TABLE IF NOT EXISTS `chercheur` (
  `CodeChercheur` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NomChercheur` varchar(255) NOT NULL,
  `PrenomChercheur` varchar(255) NOT NULL,
  `ID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`CodeChercheur`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `compagnie`
--

CREATE TABLE IF NOT EXISTS `compagnie` (
  `NomCompagnie` varchar(255) NOT NULL,
  `CodeCompagnie` int(10) unsigned NOT NULL,
  PRIMARY KEY (`CodeCompagnie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `compagnie`
--

INSERT INTO `compagnie` (`NomCompagnie`, `CodeCompagnie`) VALUES
('Seul', 0),
('Partenaire', 1),
('Parents', 2),
('Autre membre de la famille', 3),
('Étudiant de votre promotion', 4),
('Autre personne', 5);

--
-- Structure de la table `dispositif`
--

CREATE TABLE IF NOT EXISTS `dispositif` (
  `CodeDispositif` int(10) unsigned NOT NULL,
  `NomDispositif` varchar(255) NOT NULL,
  PRIMARY KEY (`CodeDispositif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `dispositif`
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
-- Structure de la table `lieu`
--

CREATE TABLE IF NOT EXISTS `lieu` (
  `CodeLieux` int(10) unsigned NOT NULL,
  `NomLieux` varchar(255) NOT NULL,
  `CodeCategorieLieux` int(10) unsigned NOT NULL,
  PRIMARY KEY (`CodeLieux`),
  KEY `CodeCategorieLieux` (`CodeCategorieLieux`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `lieu`
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
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `IDMessage` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DateEnvoi` date NOT NULL,
  `Sujet` varchar(255) NOT NULL,
  `ContenuMessage` text NOT NULL,
  `Lu` tinyint(1) NOT NULL,
  `IDExpediteur` int(10) unsigned NOT NULL,
  `IDRecepteur` int(10) unsigned NOT NULL,
  PRIMARY KEY (`IDMessage`),
  KEY `IDExpediteur` (`IDExpediteur`),
  KEY `IDRecepteur` (`IDRecepteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `occupation`
--

CREATE TABLE IF NOT EXISTS `occupation` (
  `CodeOccupation` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `HeureDebut` datetime NOT NULL,
  `HeureFin` datetime NOT NULL,
  `CodeCandidat` int(10) unsigned NOT NULL,
  `CodeLieux` int(10) unsigned NOT NULL,
  `CodeActivite` int(10) unsigned NOT NULL,
  `CodeCompagnie` int(10) unsigned NOT NULL,
  `CodeDispositif` int(10) unsigned NOT NULL,
  PRIMARY KEY (`CodeOccupation`),
  KEY `CodeCandidat` (`CodeCandidat`),
  KEY `CodeLieux` (`CodeLieux`),
  KEY `CodeCompagnie` (`CodeCompagnie`),
  KEY `CodeDispositif` (`CodeDispositif`),
  KEY `CodeActivite` (`CodeActivite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `typeUser` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `activite`
--
ALTER TABLE `activite`
  ADD CONSTRAINT `activite_ibfk_1` FOREIGN KEY (`CodeCategorie`) REFERENCES `categorieactivite` (`CodeCategorieActivite`);

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`);

--
-- Contraintes pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD CONSTRAINT `candidat_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`);

--
-- Contraintes pour la table `carnetdebord`
--
ALTER TABLE `carnetdebord`
  ADD CONSTRAINT `carnetdebord_ibfk_1` FOREIGN KEY (`CodeChercheur`) REFERENCES `chercheur` (`CodeChercheur`);

--
-- Contraintes pour la table `chercheur`
--
ALTER TABLE `chercheur`
  ADD CONSTRAINT `chercheur_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`);

--
-- Contraintes pour la table `lieu`
--
ALTER TABLE `lieu`
  ADD CONSTRAINT `lieu_ibfk_1` FOREIGN KEY (`CodeCategorieLieux`) REFERENCES `categorielieu` (`CodeCategorieLieux`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`IDRecepteur`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`IDExpediteur`) REFERENCES `users` (`ID`);

--
-- Contraintes pour la table `occupation`
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

INSERT INTO `users`(`ID`, `login`, `typeUser`, `password`, `email`) VALUES (001,'test','candidat','test','test@gmail.com');
INSERT INTO `users`(`ID`, `login`, `typeUser`, `password`, `email`) VALUES (002,'toto','candidat','toto','test@gmail.com');
INSERT INTO `users`(`ID`, `login`, `typeUser`, `password`, `email`) VALUES (003,'boule','candidat','boule','test@gmail.com');
INSERT INTO `users`(`ID`, `login`, `typeUser`, `password`, `email`) VALUES (004,'bill','candidat','bill','test@gmail.com');
INSERT INTO `users`(`ID`, `login`, `typeUser`, `password`, `email`) VALUES (005,'JM','chercheur','JM','test@gmail.com');
INSERT INTO `users`(`ID`, `login`, `typeUser`, `password`, `email`) VALUES (006,'trouve','chercheur','trouve','test@gmail.com');
INSERT INTO `users`(`ID`, `login`, `typeUser`, `password`, `email`) VALUES (007,'James','admin','Bond','test@gmail.com');

INSERT INTO `candidat`(`CodeCandidat`, `Age`, `GenreCandidat`, `LieuxEtude`, `NiveauEtude`, `DiplomePrep`, `EtatCivil`, `NombreEnfant`, `ID`) 
VALUES (001,22,'vache','Grenoble','CAP','Master Macrame','Decede',12,001);
INSERT INTO `candidat`(`CodeCandidat`, `Age`, `GenreCandidat`, `LieuxEtude`, `NiveauEtude`, `DiplomePrep`, `EtatCivil`, `NombreEnfant`, `ID`) 
VALUES (002,19,'tortue','Suez','BAC +2','Master Droit','En couple',0,002);
INSERT INTO `candidat`(`CodeCandidat`, `Age`, `GenreCandidat`, `LieuxEtude`, `NiveauEtude`, `DiplomePrep`, `EtatCivil`, `NombreEnfant`, `ID`) 
VALUES (003,26,'homme','Vienne','BAC+7','L1 jardinage','Celibataire',1,003);
INSERT INTO `candidat`(`CodeCandidat`, `Age`, `GenreCandidat`, `LieuxEtude`, `NiveauEtude`, `DiplomePrep`, `EtatCivil`, `NombreEnfant`, `ID`) 
VALUES (004,11,'chien','Paris','MatSup','CNRS','Union libre',4,004);

INSERT INTO `bddCake`.`chercheur` (`CodeChercheur`, `NomChercheur`, `PrenomChercheur`, `ID`) VALUES (001, 'Dupont', 'Jean', '6');
INSERT INTO `bddCake`.`chercheur` (`CodeChercheur`, `NomChercheur`, `PrenomChercheur`, `ID`) VALUES ('002', 'JM', 'prenom', '5');
