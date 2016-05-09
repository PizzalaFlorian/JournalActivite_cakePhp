<?php
		use Cake\ORM\TableRegistry;
		/* Renvoie un tableau d'objet php contenant la liste complete des CategorieLieu de la BDD*/
		function get_CategorieLieu($bdd){
			$table = null;
			$table = TableRegistry::get('categorielieu')
		    	->find()
		    	->toArray();
		    return $table;
		}
?>