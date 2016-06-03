<?php
	
	use Cake\ORM\TableRegistry;

	/* Renvoie un tableau d'objet php contenant la liste des activités de la BDD */
	/* 			- Si $codeCategorie est renseigné, la fonction retourne la liste complete des activités ayant pour codeCategorie $codeCategorie. */
	/* 			- Si $codeCategorie n'est pas renseigné, la fonction retourne la liste complete des activités. */
	function get_Activites($codeCategorie = "%"){
		$table = null;
		if($codeCategorie == '%'){
			$table = TableRegistry::get('activite')
		    ->find()
		    ->toArray();
		}
		else{
			$table = TableRegistry::get('activite')
		    ->find()
		    ->where(['CodeCategorie' => $codeCategorie])
		    ->toArray();
		}
		
		return $table;
	}
	
	/* Renvoie le tableau de la liste des activités en html*/
	function tableauActivite(){
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

	/* Renvoie la liste des activités*/
	function putListeActiviteCSV($fichierCSV,$delimiter){
		$table = null;
		$table = TableRegistry::get('activite')
		    ->find()
		    ->toArray();

		foreach ($table as $data) {
			$res = array($data['CodeActivite'],$data['NomActivite']);
           		fputcsv($fichierCSV,$res,$delimiter);
		}
	}
		
	/* Renvoie un select avec la liste des activités */
	function selectActivite($id,$name){
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