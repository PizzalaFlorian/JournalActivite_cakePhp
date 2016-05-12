<?php
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

/*Renvoie le premiier occupation*/
function premierOccupation($bdd){
	$requete = $bdd->query("SELECT min(Heuredebut) as  nb FROM occupation");
	$data = $requete->fetch();
	$resultat = $data['nb'];
	$res = explode(" ", $resultat);
	$requete->closeCursor();
	return $res[0];
}

/*renvoie la dernière occupation*/
function dernierOccupation($bdd){
	$requete = $bdd->query("SELECT max(Heuredebut) as  nb FROM occupation");
	$data = $requete->fetch();
	$resultat = $data['nb'];
	$res = explode(" ", $resultat);
	$requete->closeCursor();
	return $res[0];
}

/*affiche le tableau des occupations*/
function tableDonnees($bdd){
	$res = "<table cellpadding=\"0\" cellspacing=\"0\" class=\"display\" id=\"table\"  width=\"100%\">";
	$res.= "<thead><tr><th>Heure début</th><th>Heure Fin</th><th>Durée</th><th>Code Activité</th><th>Code Lieu</th><th>Code Compagnie</th><th>Code Dispositif</th><th>Code Candidat</th></tr></thead><tbody>";
	$requete = $bdd->query("SELECT *, TIMEDIFF(HeureFin,HeureDebut) AS dure FROM occupation");
	while ($data = $requete->fetch()){
		$res.= "<tr><td>".$data['HeureDebut']."</td><td>".$data['HeureFin']."</td><td>".$data['dure']."</td><td>".$data['CodeActivite']."</td><td>".$data['CodeLieux']."</td><td>".$data['CodeCompagnie']."</td><td>".$data['CodeDispositif']."</td><td>".$data['CodeCandidat']."</td></tr>\n";
	}
	$requete->closeCursor();
	$res.="</tbody></table>";
	return $res;
}

/*affiche le tableau des candidats*/
function tableCandidat($bdd){
	$res = "<table cellpadding=\"0\" cellspacing=\"0\" class=\"display\" id=\"table2\"  width=\"100%\">";
	$res.= "<thead><tr><th>Code Candidat</th><th>Age</th><th>Genre Candidat</th><th>Lieu d'étude</th><th>Niveau d'étude</th><th>Diplome préparé</th><th>Etat civil</th><th>Nombre d'enfant</th></tr></thead><tbody>";
	$requete = $bdd->query("SELECT * FROM candidat");
	while ($data = $requete->fetch()){
		$res.= "<tr><td>".$data['CodeCandidat']."</td><td>".$data['Age']."</td><td>".$data['GenreCandidat']."</td><td>".$data['LieuxEtude']."</td><td>".$data['NiveauEtude']."</td><td>".$data['DiplomePrep']."</td><td>".$data['EtatCivil']."</td><td>".$data['NombreEnfant']."</td></tr>\n";
	}
	$requete->closeCursor();
	$res.="</tbody></table>";
	return $res;
}

?>