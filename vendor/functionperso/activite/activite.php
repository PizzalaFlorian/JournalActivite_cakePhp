<?php
	
	use Cake\ORM\TableRegistry;

	/* Renvoie un tableau d'objet php contenant la liste des activités de la BDD */
	/* 			- Si $codeCategorie est renseigné, la fonction retourne la liste complete des activités ayant pour codeCategorie $codeCategorie. */
	/* 			- Si $codeCategorie n'est pas renseigné, la fonction retourne la liste complete des activités. */
	function get_Activites($codeCategorie = "%"){
		// if($codeCategorie == '%'){$option = "";}
		// else{$option = " WHERE CodeCategorie = ".$codeCategorie;}
		// $requete = "SELECT * FROM activite".$option;
		// $sth = $bdd->prepare($requete);
		// $sth->execute();
		// while ($reponse = $sth->fetch(PDO::FETCH_ASSOC))
		// {
		// 	$listeActivites[] = new activite($reponse);
		// }
		// return $listeActivites;
		$table = null;
		if($codeCategorie == '%'){
			$table = TableRegistry::get('activite')
		    ->find()
		    ->toArray();
		}
		else{
			$table = TableRegistry::get('activite')
		    ->find()
		    ->where(['CodeCategorie' => $CodeCategorie])
		    ->toArray();
		}
		
		return $table;
	}
	
	/* Renvoie le tableau de la liste des activités en html*/
	function tableauActivite(){
		// $requete = $bdd->query("SELECT * FROM activite");
		// $resultat = "<table class=\"table_act\" cellpadding=\"0\" cellspacing=\"0\" class=\"display\" width=\"100%\">\n<thead><tr><th>Code de l'activité</th><th>Nom de l'activité</th><th>Descriptif de l'activité</th><td>Code de la catégorie</td></tr></thead><tbody>\n";
		// while ($data = $requete->fetch()){
		// 		$cat = $data['CodeCategorie'];
		// 		$requete2 = $bdd->query("SELECT * FROM categorieactivite WHERE CodeCategorieActivite = $cat");
		// 		$data2 = $requete2->fetch();
		// 		$resultat.="<tr><td>".$data['CodeActivite']."</td><td>".$data['NomActivite']."</td><td>".$data['DescriptifActivite']."</td><td>".$data['CodeCategorie']."(".$data2['NomCategorie'].")</td></tr>\n";
		// 		$requete2->closeCursor();
		// }
		// $requete->closeCursor();
		// $resultat.="</tbody></table>";
		// return $resultat;
		
		$table = null;
		$table = TableRegistry::get('activite')
		    ->find()
		    ->toArray();

		$resultat = "<table class=\"table_act\" cellpadding=\"0\" cellspacing=\"0\" class=\"display\" width=\"100%\">\n<thead><tr><th>Code de l'activité</th><th>Nom de l'activité</th><th>Descriptif de l'activité</th><td>Code de la catégorie</td></tr></thead><tbody>\n";
		
		foreach ($table as $data) {
			$cat = $data['CodeCategorie'];

			$data2 = TableRegistry::get('categorieactivite')
			    ->find()
			    ->where(['CodeCategorieActivite' => $cat])
			    ->first();

			$resultat.="<tr><td>".$data['CodeActivite']."</td><td>".$data['NomActivite']."</td><td>".$data['DescriptifActivite']."</td><td>".$data['CodeCategorie']."(".$data2['NomCategorie'].")</td></tr>\n";
		}
		
		$resultat.="</tbody></table>";
		return $resultat;
	}
	
	/* Renvoie la liste des activités*/
	function listeActivite(){
		// $requete = $bdd->query("SELECT * FROM activite");
		// $resultat = "Code de l'activité: Nom de l'activité: Descriptif de l'activité: Code de la catégorie: \n";
		// while ($data = $requete->fetch()){
		// 		$cat = $data['CodeCategorie'];
		// 		$requete2 = $bdd->query("SELECT * FROM categorieactivite WHERE CodeCategorieActivite = $cat");
		// 		$data2 = $requete2->fetch();
		// 		$resultat.=$data['CodeActivite']."  ".$data['NomActivite']."  ".$data['DescriptifActivite']."  ".$data['CodeCategorie']."(".$data2['NomCategorie'].")\n";
		// 		$requete2->closeCursor();
		// }
		// $requete->closeCursor();
		// return $resultat;

		$table = null;
		$table = TableRegistry::get('activite')
		    ->find()
		    ->toArray();

		$resultat = "Code de l'activité: Nom de l'activité: Descriptif de l'activité: Code de la catégorie: \n";		
		
		foreach ($table as $data) {
			$cat = $data['CodeCategorie'];

			$data2 = TableRegistry::get('categorieactivite')
			    ->find()
			    ->where(['CodeCategorieActivite' => $cat])
			    ->first();

			$resultat.=$data['CodeActivite']."  ".$data['NomActivite']."  ".$data['DescriptifActivite']."  ".$data['CodeCategorie']."(".$data2['NomCategorie'].")\n";
		}

		return $resultat;
	}
		
	/* Renvoie un select avec la liste des activités */
	function selectActivite($id,$name){
			// $resultat = "<select name=\"$name\" id=\"$id\">\n";
			// $requete = $bdd->query("SELECT * FROM activite");
			// while ($data = $requete->fetch()){
			// 	$resultat.="\t<option value=\"".$data['CodeActivite']."\">".$data['NomActivite']."</option>\n";
			// }
			// $requete->closeCursor();
			// $resultat.="</select>";
			// return $resultat;

			$table = null;
			$table = TableRegistry::get('activite')
			    ->find()
			    ->toArray();

			$resultat = "<select name=\"$name\" id=\"$id\">\n";
			
			foreach ($table as $data) {
				
				$resultat.="\t<option value=\"".$data['CodeActivite']."\">".$data['NomActivite']."</option>\n";
			}
			$resultat.="</select>";

			return $resultat;
	}
	
	/* Renvoie un select avec la liste des activités pour la modification*/
	function selectActiviteModif($id,$name){
			// $resultat = "<select name=\"$name\" id=\"$id\">\n\t<option value=\"-1\">Sélectionnez une activité à modifier</option>\n";
			// $requete = $bdd->query("SELECT * FROM activite");
			// while ($data = $requete->fetch()){
			// 	$codeCategorie = $data['CodeCategorie'];
			// 	$resultat.="\t<option value=\"".$data['CodeActivite']."\">".$data['NomActivite']."</option>\n";
			// }
			// $requete->closeCursor();
			// $resultat.="</select>";
			// return $resultat;
			$table = null;
			$table = TableRegistry::get('activite')
			    ->find()
			    ->toArray();

			$resultat = "<select name=\"$name\" id=\"$id\">\n\t<option value=\"-1\">Sélectionnez une activité à modifier</option>\n";
			
			foreach ($table as $data) {
				$codeCategorie = $data['CodeCategorie'];
			 	$resultat.="\t<option value=\"".$data['CodeActivite']."\">".$data['NomActivite']."</option>\n";
			}
			$resultat.="</select>";

			return $resultat;
	}
	
	/* Renvoie un select avec la liste des activités le premier vide*/
	function selectActiviteVide($id,$name){
			// $resultat = "<select name=\"$name\" id=\"$id\">\n\t<option value=\"-1\">Sélectionnez une activité</option>\n";
			// $requete = $bdd->query("SELECT * FROM activite");
			// while ($data = $requete->fetch()){
			// 	$codeCategorie = $data['CodeCategorie'];
			// 	$resultat.="\t<option value=\"".$data['CodeActivite']."\">".$data['NomActivite']."</option>\n";
			// }
			// $requete->closeCursor();
			// $resultat.="</select>";
			// return $resultat;
			$table = null;
			$table = TableRegistry::get('activite')
			    ->find()
			    ->toArray();

			$resultat = "<select name=\"$name\" id=\"$id\">\n\t<option value=\"-1\">Sélectionnez une activité</option>\n";
			
			foreach ($table as $data) {
				$codeCategorie = $data['CodeCategorie'];
				$resultat.="\t<option value=\"".$data['CodeActivite']."\">".$data['NomActivite']."</option>\n";
			}
			$resultat.="</select>";

			return $resultat;
	}
	
	/* Renvoie un select avec la liste des activités sauf*/
	function selectActiviteSauf($sauf,$id,$name){
			// $resultat = "<select name=\"$name\" id=\"$id\">\n";
			// $requete = $bdd->query("SELECT * FROM activite");
			// while ($data = $requete->fetch()){
			// 	$codeCategorie = $data['CodeCategorie'];
			// 	if ($data['CodeActivite'] != $sauf)
			// 		$resultat.="\t<option value=\"".$data['CodeActivite']."\">".$data['NomActivite']."</option>\n";
			// }
			// $requete->closeCursor();
			// $resultat.="</select>";
			// return $resultat;
			$table = null;
			$table = TableRegistry::get('activite')
			    ->find()
			    ->toArray();

			$resultat = "<select name=\"$name\" id=\"$id\">\n";
			
			foreach ($table as $data) {
				if ($data['CodeActivite'] != $sauf)
					$resultat.="\t<option value=\"".$data['CodeActivite']."\">".$data['NomActivite']."</option>\n";
			}
			$resultat.="</select>";

			return $resultat;
	}
	
?>