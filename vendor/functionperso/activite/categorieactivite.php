<?php
		
		use Cake\ORM\TableRegistry;
		/* Renvoie un tableau d'objet php contenant la liste complete des CategorieActivités de la BDD*/
		function get_CategorieActivite(){
			$table = null;
			$table = TableRegistry::get('categorieactivite')
		    	->find()
		    	->toArray();
		    return $table;
		}
	
		/* Renvoie le tableau de la liste des catégories d'activités en html*/
		function tableauCategorie(){
			$resultat = "<table>\n<tr><th>Nom de la catégorie</th></tr>\n";

			$table = null;
			$table = TableRegistry::get('categorieactivite')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
		    	$resultat.="<tr><td>".$data['NomCategorie']."</td></tr>\n";
		    }
		    
		    $resultat.="</table>";
			
			return $resultat;
		}
		
		/* Renvoie un select avec la liste des catégories d'activités */
		function selectCategorie($id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n";

			$table = null;
			$table = TableRegistry::get('categorieactivite')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
		    	$resultat.="\t<option value=\"".$data['CodeCategorieActivite']."\">".$data['NomCategorie']."</option>\n";
		    }
		    
		   	$resultat.="</select>";
			
			return $resultat;
		}
		
		/* Renvoie un select avec la liste des catégories d'activités pour le js*/
		function selectCategorieModif($id,$name){
			$resultat = "<select name=\\\"$name\\\" id=\\\"$id\\\">";

			$table = null;
			$table = TableRegistry::get('categorieactivite')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
		    	$resultat.="<option value=\\\"".$data['CodeCategorieActivite']."\\\">".$data['NomCategorie']."</option>";;
		    }
		    
		    $resultat.="</select>";
			
			return $resultat;
		}
		
		function selectCategorieVide($id,$name){
			$resultat = "<select name=\"$name\" id=\"$id\">\n";

			$table = null;
			$table = TableRegistry::get('categorieactivite')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
		    	$resultat.="\t<option value=\"".$data['CodeCategorieActivite']."\">".$data['NomCategorie']."</option>\n";
		    }
		    
		    $resultat.="</select>";
			
			return $resultat;
		}
		
		/*Renvoie la liste d'activite avec l'id select selected*/
		function selectCategorieSelected($id,$name,$select){
			$resultat = "<select name=\"$name\" id=\"$id\">\n";

			$table = null;
			$table = TableRegistry::get('categorieactivite')
		    	->find()
		    	->toArray();

		    foreach($table as $data){
		    	$resultat.="\t<option value=\"".$data['CodeCategorieActivite']."\"";
				if ($data['CodeCategorieActivite'] == $select)
					$resultat.=" selected ";
				$resultat.=">".$data['NomCategorie']."</option>\n";
		    }
		    
		    $resultat.="</select>";
			
			return $resultat;
		}
?>