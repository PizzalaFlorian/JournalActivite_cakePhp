<?php	
		use Cake\ORM\TableRegistry;
		/* Renvoie le tableau de la liste des compagnies en html*/
		
		function get_compagnie( $codeCompagnie = "%"){
			$table = null;
			if($codeCompagnie == '%'){
				$table = TableRegistry::get('compagnie')
			    ->find()
			    ->toArray();
			}
			else{
				$table = TableRegistry::get('compagnie')
			    ->find()
			    ->where(['CodeCompagnie' => $codeDispositif])
			    ->toArray();
			}
			
			return $table;
		}

		function tableauCompagnie(){
			$resultat = "<table>\n<tr><th>Code de la compagnie</th><th>Nom de la compagnie</th></tr>\n";

			$table = null;
			$table = TableRegistry::get('compagnie')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
		    	$resultat.="<tr><td>".$data['CodeCompagnie']."</td><td>".$data['NomCompagnie']."</td></tr>\n";
		    }
		    
		    $resultat.="</table>";
			
			return $resultat;
		}
		
		
		/* Renvoie la liste des compagnies*/
		function listeCompagnie(){
			$resultat = "Code de la compagnie: Nom de la compagnie:\n";

			$table = null;
			$table = TableRegistry::get('compagnie')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
		    	$resultat.=$data['CodeCompagnie']." ".$data['NomCompagnie']."\n";
		    }
			
			return $resultat;
		}
		
		/* Renvoie un select avec la liste des compagnies */
		function selectCompagnieVide($id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n\t<option selected value=\"-1\">Sélectionnez une compagnie</option>\n";

			$table = null;
			$table = TableRegistry::get('compagnie')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
		    	$resultat.="\t<option value=\"".$data['CodeCompagnie']."\">".$data['NomCompagnie']."</option>\n";
		    }
			$resultat.="</select>";
			return $resultat;
		}
		
		/* Renvoie un select avec la liste des compagnies */
		function selectCompagnie($id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n";

			$table = null;
			$table = TableRegistry::get('compagnie')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
		    	$resultat.="\t<option value=\"".$data['CodeCompagnie']."\">".$data['NomCompagnie']."</option>\n";
		    }
			$resultat.="</select>";
			return $resultat;
		}
		
		function selectCompagnieSauf($sauf,$id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n";
			$table = TableRegistry::get('compagnie')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
				if ($data['CodeCompagnie'] != $sauf)
					$resultat.="\t<option value=\"".$data['CodeCompagnie']."\">".$data['NomCompagnie']."</option>\n";
			}
			$resultat.="</select>";
			return $resultat;
		}
?>