<?php
	/* Renvoie un tableau d'objet php contenant la liste des lieux de la BDD */
	/* 			- Si $codeLieu est renseigné, la fonction retourne la liste complete des Lieux ayant pour codeLieux $codeLieu. */
	/* 			- Si $codeLieu n'est pas renseigné, la fonction retourne la liste complete des Lieux. */
	function get_Lieux($bdd, $codeLieu = "%"){
		if($codeLieu == '%'){$option = "";}
		else{$option = " WHERE CodeCategorieLieux = ".$codeLieu;}
		$requete = "SELECT * FROM lieu".$option;

		$sth = $bdd->prepare($requete);
		$sth->execute();
		
		while ($reponse = $sth->fetch(PDO::FETCH_ASSOC))
		{
			$listeLieux[] = new lieu($reponse);
		}
		return $listeLieux;
	}
	
	/* Renvoie le tableau de la liste des lieu en html*/
	function tableauLieu($bdd){
			$resultat = "<table>\n<tr><th>Code du Lieu</th><th>Nom du Lieu</th></tr>\n";
			$requete = $bdd->query("SELECT * FROM lieu");
				while ($data = $requete->fetch()){
				$resultat.="<tr><td>".$data['CodeLieux']."</td><td>".$data['NomLieux']."</td></tr>\n";
			}
			$resultat.="</table>";
			$requete->closeCursor();
			return $resultat;
		}
	
	/* Renvoie la liste des lieu*/
	function listeLieu($bdd){
			$resultat = "Code du Lieu: Nom du Lieu:\n";
			$requete = $bdd->query("SELECT * FROM lieu");
				while ($data = $requete->fetch()){
				$resultat.=$data['CodeLieux']."  ".$data['NomLieux']."\n";
			}
			$requete->closeCursor();
			return $resultat;
		}	

	
		/* Renvoie un select avec la liste des lieux */
	function selectLieu($bdd,$id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n";
			$requete = $bdd->query("SELECT * FROM lieu");
			while ($data = $requete->fetch()){
				$resultat.="\t<option value=\"".$data['CodeLieux']."\">".$data['NomLieux']."</option>\n";
			}
			$resultat.="</select>";
			$requete->closeCursor();
			return $resultat;
	}
	
		/* Renvoie un select avec la liste des lieux à sélectionner*/
	function selectLieuVide($bdd,$id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n\t<option value=\"-1\">Sélectionnez un lieu à modifier</option>\n";
			$requete = $bdd->query("SELECT * FROM lieu");
			while ($data = $requete->fetch()){
				$resultat.="\t<option value=\"".$data['CodeLieux']."\">".$data['NomLieux']."</option>\n";
			}
			$resultat.="</select>";
			$requete->closeCursor();
			return $resultat;
	}
	
		/* Renvoie un select avec la liste des lieux sauf*/
	function selectLieuSauf($bdd,$sauf,$id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n";
			$requete = $bdd->query("SELECT * FROM lieu");
			while ($data = $requete->fetch()){
				if ($data['CodeLieux'] != $sauf)
					$resultat.="\t<option value=\"".$data['CodeLieux']."\">".$data['NomLieux']."</option>\n";
			}
			$resultat.="</select>";
			$requete->closeCursor();
			return $resultat;
	}
?>