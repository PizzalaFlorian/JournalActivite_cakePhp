<?php
use Cake\ORM\TableRegistry;

function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
}


/*Renvoie le nom du chercheur*/
function nomChercheur(){
	$data = TableRegistry::get('chercheur')
            ->find()
            ->where(['ID' => $_SESSION['Auth']['User']['ID']])
            ->first();
    $resultat = $data['PrenomChercheur']." ".$data['NomChercheur'];
	return $resultat;
}

/*Renvoie le nombre de candidats inscrits à l'étude*/
function nombreCandidat(){
	$data = TableRegistry::get('candidat')
            ->find()
         	->select(array('nb' => 'count(*)'))
            ->first();
    $resultat = $data['nb'];
	return $resultat;
	
}	

/*Renvoie le nombre d'ocupations*/
function nombreOccupation(){
	$data = TableRegistry::get('occupation')
            ->find()
         	->select(array('nb' => 'count(*)'))
            ->first();
    $resultat = $data['nb'];
	return $resultat;
}

function premierOccupation(){
	$data = TableRegistry::get('occupation')
            ->find()
         	->select(array('nb' => 'min(Heuredebut)'))
            ->first();
    $resultat = $data['nb'];
    $res = explode(" ", $resultat);
	return $res[0];
}

function dernierOccupation(){
	$data = TableRegistry::get('occupation')
            ->find()
         	->select(array('nb' => 'max(Heuredebut)'))
            ->first();
    $resultat = $data['nb'];
    $res = explode(" ", $resultat);
	return $res[0];
}	
?>
