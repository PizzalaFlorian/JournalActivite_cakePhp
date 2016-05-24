<?php
	echo "Start <br/>";
	//creation d'un user
	$bdd = new PDO('mysql:host=localhost;dbname=bddCake', 'root', 'evuzu');



//========= Script suppression ==============//

	//candidat / user
	/*
		$requete = "DELETE FROM `bddCake`.`users` WHERE Age = '1' ";
		$bdd->query($requete);
		$requete = "DELETE FROM `bddCake`.`users` WHERE email = 'user@user.com' ";
		$bdd->query($requete);
	*/

	// occupation
	/*
		$requete = "DELETE FROM `bddCake`.`occupation` WHERE CodeDispositif = '0' ";
		$bdd->query($requete);
	*/

//========= Script AJOUT User + Candidat ==============//
   

   for($i = 50; $i<53; $i++)
	{
		$requete = "INSERT INTO `bddCake`.`users` (`ID`, `login`, `typeUser`, `password`, `email`) VALUES ('".$i."', 'user".$i."', 'candidat', 'user".$i."', 'user@user.com');";
		$bdd->query($requete);
		$requete = "INSERT INTO `bddCake`.`candidat` (`CodeCandidat`, `NomCandidat`, `PrenomCandidat`, `Age`, `GenreCandidat`, `LieuxEtude`, `NiveauEtude`, `DiplomePrep`, `EtatCivil`, `NombreEnfant`, `ID`) VALUES ('".$i."', 'user".$i."', 'user".$i."', '1', 'H', 'test', 'test', 'test', 'test', '0', '".$i."');";
		$bdd->query($requete);
	}
    echo "<br/>End <br/>";

    

//========= Script AJOUT occupation ==============//
    
   	for($id = 50; $id<53; $id++){
	    for($i = 2;$i < 9; $i++){
			$requete = "INSERT INTO `bddCake`.`occupation` (`CodeOccupation`, `HeureDebut`, `HeureFin`, `CodeCandidat`, `CodeLieux`, `CodeActivite`, `CodeCompagnie`, `CodeDispositif`) VALUES ('', '2016-05-".$i." 00:00:00', '2016-05-".$i." 08:00:00', '".$id."', '1', '10', '0', '0');";
			$bdd->query($requete);
			$requete = "INSERT INTO `bddCake`.`occupation` (`CodeOccupation`, `HeureDebut`, `HeureFin`, `CodeCandidat`, `CodeLieux`, `CodeActivite`, `CodeCompagnie`, `CodeDispositif`) VALUES ('', '2016-05-".$i." 08:00:00', '2016-05-".$i." 08:15:00', '".$id."', '1', '20', '0', '0');";
			$bdd->query($requete);
			$requete = "INSERT INTO `bddCake`.`occupation` (`CodeOccupation`, `HeureDebut`, `HeureFin`, `CodeCandidat`, `CodeLieux`, `CodeActivite`, `CodeCompagnie`, `CodeDispositif`) VALUES ('', '2016-05-".$i." 08:30:00', '2016-05-".$i." 09:00:00', '".$idd."', '1', '40', '0', '0');";
			$bdd->query($requete);
			$requete = "INSERT INTO `bddCake`.`occupation` (`CodeOccupation`, `HeureDebut`, `HeureFin`, `CodeCandidat`, `CodeLieux`, `CodeActivite`, `CodeCompagnie`, `CodeDispositif`) VALUES ('', '2016-05-".$i." 09:00:00', '2016-05-".$i." 12:00:00', '".$id."', '5', '211', '4', '0');";
			$bdd->query($requete);
			$requete = "INSERT INTO `bddCake`.`occupation` (`CodeOccupation`, `HeureDebut`, `HeureFin`, `CodeCandidat`, `CodeLieux`, `CodeActivite`, `CodeCompagnie`, `CodeDispositif`) VALUES ('', '2016-05-".$i." 12:00:00', '2016-05-".$i." 13:00:00', '".$id."', '8', '20', '4', '0');";
			$bdd->query($requete);
			$requete = "INSERT INTO `bddCake`.`occupation` (`CodeOccupation`, `HeureDebut`, `HeureFin`, `CodeCandidat`, `CodeLieux`, `CodeActivite`, `CodeCompagnie`, `CodeDispositif`) VALUES ('', '2016-05-".$i." 13:00:00', '2016-05-".$i." 18:00:00', '".$id."', '5', '251', '4', '0');";
			$bdd->query($requete);
			$requete = "INSERT INTO `bddCake`.`occupation` (`CodeOccupation`, `HeureDebut`, `HeureFin`, `CodeCandidat`, `CodeLieux`, `CodeActivite`, `CodeCompagnie`, `CodeDispositif`) VALUES ('', '2016-05-".$i." 18:00:00', '2016-05-".$i." 20:00:00', '".$id."', '1', '920', '0', '0');";
			$bdd->query($requete);
			$requete = "INSERT INTO `bddCake`.`occupation` (`CodeOccupation`, `HeureDebut`, `HeureFin`, `CodeCandidat`, `CodeLieux`, `CodeActivite`, `CodeCompagnie`, `CodeDispositif`) VALUES ('', '2016-05-".$i." 20:15:00', '2016-05-".$i." 22:00:00', '".$id."', '1', '20', '0', '0');";
			$bdd->query($requete);
			$requete = "INSERT INTO `bddCake`.`occupation` (`CodeOccupation`, `HeureDebut`, `HeureFin`, `CodeCandidat`, `CodeLieux`, `CodeActivite`, `CodeCompagnie`, `CodeDispositif`) VALUES ('', '2016-05-".$i." 22:00:00', '2016-05-".$i." 23:59:00', '".$id."', '1', '10', '0', '0');";
			$bdd->query($requete);
		}
	}



	echo "<br />END<br />";
?>