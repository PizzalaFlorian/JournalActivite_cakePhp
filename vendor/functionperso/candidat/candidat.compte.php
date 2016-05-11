<?php

/*Renvoie le mail du candidat*/
function mailChercheur($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM utilisateur WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['MailCandidat'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie le login du candidat*/
function loginChercheur($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM utilisateur WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['Login'];
	$requete->closeCursor();
	return $resultat;
}


/*Renvoie l'age du candidat*/
function ageCandidat($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM candidat WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['Age'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie le nombre d'enfant du candidat*/
function enfantCandidat($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM candidat WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['NombreEnfant'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie le niveau du candidat*/
function diplomeCandidat($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM candidat WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['NiveauEtude'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie l'état civil du candidat*/
function etatCandidat($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM candidat WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['EtatCivil'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie le lieu d'étude du candidat*/
function lieuCandidat($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM candidat WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['LieuxEtude'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie le dipome d'étude du candidat*/
function nivCandidat($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM candidat WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['DiplomePrep'];
	$requete->closeCursor();
	return $resultat;
}
?>