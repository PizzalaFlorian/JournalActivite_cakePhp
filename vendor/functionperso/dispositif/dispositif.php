<?php

	/* Renvoie un tableau d'objet php contenant la liste des dispositifs de la BDD */
	/* 			- Si $codeDispo est renseigné, la fonction retourne la liste complete des dispositifs ayant pour codeLieux $codeDispo. */
	/* 			- Si $codeDispo n'est pas renseigné, la fonction retourne la liste complete des dispositifs. */
	function get_dispositif($bdd, $codeDispositif = "%"){
		if($codeDispositif == '%'){$option = "";}
		else{$option = " WHERE CodeDispositif = ".$codeDispositif;}
		$requete = "SELECT * FROM dispositif".$option;

		$sth = $bdd->prepare($requete);
		$sth->execute();
		
		while ($reponse = $sth->fetch(PDO::FETCH_ASSOC))
		{
			$listeDispositif[] = new dispositif($reponse);
		}
		return $listeDispositif;
	}
		
		/* Renvoie le tableau de la liste des dispositifs en html*/
		function tableauDispositif($bdd){
			$resultat = "<table>\n<tr><th>Code du Dispositif</th><th>Nom du Dispositif</th></tr>\n";
			$requete = $bdd->query("SELECT * FROM dispositif");
			while ($data = $requete->fetch()){
				$resultat.="<tr><td>".$data['CodeDispositif']."</td><td>".$data['NomDispositif']."</td></tr>\n";
			}
			$requete->closeCursor();
			$resultat.="</table>";
			return $resultat;
		}
		
		/* Renvoie la liste des dispositifs*/
		function listeDispositif($bdd){
			$resultat = "Code du Dispositif: Nom du Dispositif:\n";
			$requete = $bdd->query("SELECT * FROM dispositif");
			while ($data = $requete->fetch()){
				$resultat.=$data['CodeDispositif']."  ".$data['NomDispositif']."\n";
			}
			$requete->closeCursor();
			return $resultat;
		}
		
		/* Renvoie un select avec la liste des dispositifs */
		function selectDispositif($bdd,$id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n\t<option selected value=\"-1\">Sélectionnez un dispositif</option>\n";
			$requete = $bdd->query("SELECT * FROM dispositif");
			while ($data = $requete->fetch()){
				$resultat.="\t<option value=\"".$data['CodeDispositif']."\">".$data['NomDispositif']."</option>\n";
			}
			$requete->closeCursor();
			$resultat.="</select>";
			return $resultat;
		}
		
		/* Renvoie un select avec la liste des dispositifs sauf*/
		function selectDispositifSauf($bdd,$sauf,$id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n";
			$requete = $bdd->query("SELECT * FROM dispositif");
			while ($data = $requete->fetch()){
				if ($data['CodeDispositif'] != $sauf)
					$resultat.="\t<option value=\"".$data['CodeDispositif']."\">".$data['NomDispositif']."</option>\n";
			}
			$requete->closeCursor();
			$resultat.="</select>";
			return $resultat;
		}
	
?>