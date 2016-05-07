INSERT INTO `utilisateur`(`ID`, `login`, `typeUser`, `password`, `email`) VALUES (001,'test','candidat','test','test@gmail.com');
INSERT INTO `utilisateur`(`ID`, `login`, `typeUser`, `password`, `email`) VALUES (002,'toto','candidat','toto','test@gmail.com');
INSERT INTO `utilisateur`(`ID`, `login`, `typeUser`, `password`, `email`) VALUES (003,'boule','candidat','boule','test@gmail.com');
INSERT INTO `utilisateur`(`ID`, `login`, `typeUser`, `password`, `email`) VALUES (004,'bill','candidat','bill','test@gmail.com');
INSERT INTO `utilisateur`(`ID`, `login`, `typeUser`, `password`, `email`) VALUES (005,'JM','chercheur','JM','test@gmail.com');
INSERT INTO `utilisateur`(`ID`, `login`, `typeUser`, `password`, `email`) VALUES (006,'trouve','chercheur','trouve','test@gmail.com');
INSERT INTO `utilisateur`(`ID`, `login`, `typeUser`, `password`, `email`) VALUES (007,'James','admin','Bond','test@gmail.com');

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
