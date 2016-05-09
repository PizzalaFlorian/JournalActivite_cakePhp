<?php
	use Cake\ORM\TableRegistry;
	/* Renvoie un tableau d'objet php contenant la liste des dispositifs de la BDD */
	/* 			- Si $codeDispo est renseigné, la fonction retourne la liste complete des dispositifs ayant pour codeLieux $codeDispo. */
	/* 			- Si $codeDispo n'est pas renseigné, la fonction retourne la liste complete des dispositifs. */
	function get_dispositif( $codeDispositif = "%"){
		$table = null;
		if($codeDispositif == '%'){
			$table = TableRegistry::get('dispositif')
		    ->find()
		    ->toArray();
		}
		else{
			$table = TableRegistry::get('dispositif')
		    ->find()
		    ->where(['CodeDispositif' => $codeDispositif])
		    ->toArray();
		}
		
		return $table;
	}
		
		/* Renvoie le tableau de la liste des dispositifs en html*/
		function tableauDispositif(){
			$resultat = "<table>\n<tr><th>Code du Dispositif</th><th>Nom du Dispositif</th></tr>\n";
			$table = null;
			$table = TableRegistry::get('dispositif')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
				$resultat.="<tr><td>".$data['CodeDispositif']."</td><td>".$data['NomDispositif']."</td></tr>\n";
			}
			$resultat.="</table>";
			return $resultat;
		}
		
		/* Renvoie la liste des dispositifs*/
		function listeDispositif(){
			$resultat = "Code du Dispositif: Nom du Dispositif:\n";
			$table = null;
			$table = TableRegistry::get('dispositif')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
				$resultat.=$data['CodeDispositif']."  ".$data['NomDispositif']."\n";
			}
			
			return $resultat;
		}
		
		/* Renvoie un select avec la liste des dispositifs */
		function selectDispositif($id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n\t<option selected value=\"-1\">Sélectionnez un dispositif</option>\n";
			$table = null;
			$table = TableRegistry::get('dispositif')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
				$resultat.="\t<option value=\"".$data['CodeDispositif']."\">".$data['NomDispositif']."</option>\n";
			}
			
			$resultat.="</select>";
			return $resultat;
		}
		
		/* Renvoie un select avec la liste des dispositifs sauf*/
		function selectDispositifSauf($sauf,$id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n";
			$table = null;
			$table = TableRegistry::get('dispositif')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
				if ($data['CodeDispositif'] != $sauf)
					$resultat.="\t<option value=\"".$data['CodeDispositif']."\">".$data['NomDispositif']."</option>\n";
			}
			
			$resultat.="</select>";
			return $resultat;
		}
	
?>