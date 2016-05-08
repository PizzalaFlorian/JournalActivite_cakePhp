<?php	
		/* Renvoie le tableau de la liste des compagnies en html*/
		function tableauCompagnie($bdd){
			$resultat = "<table>\n<tr><th>Code de la compagnie</th><th>Nom de la compagnie</th></tr>\n";
			$requete = $bdd->query("SELECT * FROM compagnie");
			while ($data = $requete->fetch()){
				$resultat.="<tr><td>".$data['CodeCompagnie']."</td><td>".$data['NomCompagnie']."</td></tr>\n";
			}
			$requete->closeCursor();
			$resultat.="</table>";
			return $resultat;
		}
		
		
		/* Renvoie la liste des compagnies*/
		function listeCompagnie($bdd){
			$resultat = "Code de la compagnie: Nom de la compagnie:\n";
			$requete = $bdd->query("SELECT * FROM compagnie");
			while ($data = $requete->fetch()){
				$resultat.=$data['CodeCompagnie']." ".$data['NomCompagnie']."\n";
			}
			$requete->closeCursor();
			return $resultat;
		}
		
		/* Renvoie un select avec la liste des compagnies */
		function selectCompagnieVide($bdd,$id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n\t<option selected value=\"-1\">Sélectionnez une compagnie</option>\n";
			$requete = $bdd->query("SELECT * FROM compagnie");
			while ($data = $requete->fetch()){
				$resultat.="\t<option value=\"".$data['CodeCompagnie']."\">".$data['NomCompagnie']."</option>\n";
			}
			$requete->closeCursor();
			$resultat.="</select>";
			return $resultat;
		}
		
		/* Renvoie un select avec la liste des compagnies */
		function selectCompagnie($bdd,$id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n";
			$requete = $bdd->query("SELECT * FROM compagnie");
			while ($data = $requete->fetch()){
				$resultat.="\t<option value=\"".$data['CodeCompagnie']."\">".$data['NomCompagnie']."</option>\n";
			}
			$requete->closeCursor();
			$resultat.="</select>";
			return $resultat;
		}
		
		function selectCompagnieSauf($bdd,$sauf,$id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n";
			$requete = $bdd->query("SELECT * FROM compagnie");
			while ($data = $requete->fetch()){
				if ($data['CodeCompagnie'] != $sauf)
					$resultat.="\t<option value=\"".$data['CodeCompagnie']."\">".$data['NomCompagnie']."</option>\n";
			}
			$requete->closeCursor();
			$resultat.="</select>";
			return $resultat;
		}
?>