<?php
function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
}


/*Renvoie le nom du chercheur*/
function nomChercheur($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM chercheur WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['PrenomChercheur']." ".$data['NomChercheur'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie le nombre de candidats inscrits à l'étude*/
function nombreCandidat($bdd){
	$requete = $bdd->query("SELECT count(*) as  nb FROM candidat");
	$data = $requete->fetch();
	$resultat = $data['nb'];
	$requete->closeCursor();
	return $resultat;
}	

/*Renvoie le nombre d'ocupations*/
function nombreOccupation($bdd){
	$requete = $bdd->query("SELECT count(*) as  nb FROM occupation");
	$data = $requete->fetch();
	$resultat = $data['nb'];
	$requete->closeCursor();
	return $resultat;
}

function premierOccupation($bdd){
	$requete = $bdd->query("SELECT min(Heuredebut) as  nb FROM occupation");
	$data = $requete->fetch();
	$resultat = $data['nb'];
	$res = explode(" ", $resultat);
	$requete->closeCursor();
	return $res[0];
}

function dernierOccupation($bdd){
	$requete = $bdd->query("SELECT max(Heuredebut) as  nb FROM occupation");
	$data = $requete->fetch();
	$resultat = $data['nb'];
	$res = explode(" ", $resultat);
	$requete->closeCursor();
	return $res[0];
}	
?>
