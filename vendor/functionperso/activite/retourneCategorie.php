<?php
	use Cake\ORM\TableRegistry;
	
	foreach($_POST as $key=>$value){$$key=$value;}
	foreach($_GET as $key=>$value){$$key=$value;}

	if($categorie == "lieu"){
		$liste_Lieu = TableRegistry::get('lieu')
		    ->find()
		    ->where(['CodeCategorieLieux'=>$codeCategorie])
		    ->toArray();

		foreach($liste_Lieu as $lieu){
			echo '<option id="'.$lieu['CodeLieux'].'">'.$lieu['NomLieux'].'</option>';
		}
	}
	if($categorie == "activite"){
		$liste_activite = TableRegistry::get('activite')
		    ->find()
		    ->where(['CodeCategorie'=>$codeCategorie])
		    ->toArray();
		
		foreach($liste_activite as $activite){
			echo'<option id="'.$activite['CodeActivite'].'">'.$activite['NomActivite'].'</option>';
		}
	}
?>