<?php

	use Cake\ORM\TableRegistry;

	/* Renvoie un tableau d'objet php contenant la liste des lieux de la BDD */
	/* 			- Si $codeLieu est renseigné, la fonction retourne la liste complete des Lieux ayant pour codeLieux $codeLieu. */
	/* 			- Si $codeLieu n'est pas renseigné, la fonction retourne la liste complete des Lieux. */
	function get_Lieux( $codeLieu = "%"){
		$table = null;
		if($codeLieu == '%'){
			$table = TableRegistry::get('lieu')
		    ->find()
		    ->toArray();
		}
		else{
			$table = TableRegistry::get('lieu')
		    ->find()
		    ->where(['CodeCategorieLieux' => $codeLieu])
		    ->toArray();
		}
		
		return $table;
	}
	
	/* Renvoie le tableau de la liste des lieu en html*/
	function tableauLieu(){
			$resultat = "<table>\n<tr><th>Code du Lieu</th><th>Nom du Lieu</th></tr>\n";

			$table = null;
			$table = TableRegistry::get('lieu')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
		    	$resultat.="<tr><td>".$data['CodeLieux']."</td><td>".$data['NomLieux']."</td></tr>\n";
		    }
		    
		    $resultat.="</table>";
			
			return $resultat;
		}
	
	/* Renvoie la liste des lieu*/
	function listeLieu(){
			$resultat = "Code du Lieu: Nom du Lieu:\n";

			$table = null;
			$table = TableRegistry::get('lieu')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
		    	$resultat.=$data['CodeLieux']."  ".$data['NomLieux']."\n";
		    }
		 	return $resultat;
		}	

	
		/* Renvoie un select avec la liste des lieux */
	function selectLieu($id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n";

			$table = null;
			$table = TableRegistry::get('lieu')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
		    	$resultat.="\t<option value=\"".$data['CodeLieux']."\">".$data['NomLieux']."</option>\n";
		    }
		    
		    $resultat.="</select>";
			
			return $resultat;
	}
	
		/* Renvoie un select avec la liste des lieux à sélectionner*/
	function selectLieuVide($id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n\t<option value=\"-1\">Sélectionnez un lieu à modifier</option>\n";

			$table = null;
			$table = TableRegistry::get('lieu')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
		    	$resultat.="\t<option value=\"".$data['CodeLieux']."\">".$data['NomLieux']."</option>\n";
		    }
		    
		    $resultat.="</select>";
			
			return $resultat;
	}
	
		/* Renvoie un select avec la liste des lieux sauf*/
	function selectLieuSauf($sauf,$id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n";

			$table = null;
			$table = TableRegistry::get('lieu')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
		    	if ($data['CodeLieux'] != $sauf)
					$resultat.="\t<option value=\"".$data['CodeLieux']."\">".$data['NomLieux']."</option>\n";
		    }
		    
		    $resultat.="</select>";
			
			return $resultat;
	}
?>