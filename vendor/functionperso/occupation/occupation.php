<?php
	//INSERT INTO occupation (CodeOccupation,HeureDebut,HeureFin,CodeCandidat,CodeLieux,CodeActivite,CodeCompagnie,CodeDispositif) VALUES ('35','2016-03-20 22:30:00','2016-03-20 22:30:00','1','2','10','0','0')

	function add_occupation($bdd, $occupation) {
		$requete = "INSERT INTO occupation (CodeOccupation,HeureDebut,HeureFin,CodeCandidat,CodeLieux,CodeActivite,CodeCompagnie,CodeDispositif) VALUES ('',";
	
		foreach ($occupation as $key => $value)
		{
			$requete = $requete."'".$value."',";
		}
		$requete = substr($requete, 0, -1);
		$requete = $requete.')';
		echo $requete;
		$bdd->query($requete);
	}
	//retourne l'heure et les minute de l'occupation passez en parametre
	// input 	: une occupation
	// output 	: une chaine de caractère au format HH:MM
	function retourneHeure($occupation) {
		$time = explode($occupation->

}
?>